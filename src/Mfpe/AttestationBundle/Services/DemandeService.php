<?php
/**
 * Created by PhpStorm.
 * User: cynapsys
 * Date: 04/07/18
 * Time: 01:21 م
 */

namespace Mfpe\AttestationBundle\Services;

use Doctrine\ORM\EntityManager;
use Mfpe\AttestationBundle\Entity\Demande;
use Mfpe\AttestationBundle\Entity\Delais;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\NotificationBundle\Entity\Notification;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class DemandeService
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

//recherche delais
    public function rechercheDelais()
    {
        $delais = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeAttestationBundle:Delais')->findOneById(1);
        return $delais;
    }

//recherche date examen ok
    public function rechercheDemandeDateExamenOk()
    {
        $delais = $this->rechercheDelais();
        $refStatut = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeReferencielBundle:RefStatut')->findOneByCode('DATE_EXAM_OK');
        $demandes = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeAttestationBundle:Demande')->findDemandeByStatutDelais($refStatut, $delais->getNbDelaisPv());
        return $demandes;
    }

//envoyer des notifications et envoyer des emails
    private function sendNotificationEmail($user, $demande)
    {
        try {

            // Remove Last Notification of this demande
            $notifications = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeNotificationBundle:Notification')->findBy(array('demande' => $demande));
            if ($notifications) {
                foreach ($notifications as $notification) {
                    $this->container->get('doctrine.orm.entity_manager')->remove($notification);
                    $this->container->get('doctrine.orm.entity_manager')->flush();
                }
            }
            //return email user receiver
            $EmailuserReceiver = $demande->getCentreFormation()->getEmail();
            //return user receiver
            $userReceiver = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeConfigBundle:AppUser')->findOneByEmail($EmailuserReceiver);
            //First : Send Notification systeme to agent centre lié a la demande
            $this->sendNotificationSystem(5, $user, $userReceiver, $demande);
            //Second : Send Email if agent centre lier a la demande
            $parameters = array(
                'user' => $userReceiver,
                'demande' => $demande,
                'host' => $this->container->getParameter('host')
            );
            $template = 'Emails/send_email_exceed_time_upload_pv_to_center_formation.html.twig';
            $from = $this->container->getParameter('mailer_user');
            $to = $EmailuserReceiver;
            $subject = $this->container->getParameter('object_mail_centre_attente_upload');
            $attachement = "";
            $this->container->get('mfpe_configbundle_mailer_sendmailer')->sendMailer($template, $parameters, $from, $to, $subject, $attachement);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


//send notif System du admin et super admin au centre de formation
    private function sendNotificationSystem($type, $user, $userReceiver, $demande)
    {
        try {
            $notification = New Notification();
            $notification->setType($type);
            $notification->setStatusNotif(false);
            $notification->setDemande($demande);
            $notification->setUserSend($user);
            $notification->setUserReceive($userReceiver);
            //$notification->getCreatedBy($user->getId());
            $now = new \DateTime();
            $notification->setDateCreation($now);
            $em = $this->container->get('doctrine.orm.entity_manager');
            $em->persist($notification);
            $em->flush();
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

//function to send email to excced time pv upload
    public function sendEmailUserExccedTimePvUpload()
    {
        $demandes = $this->rechercheDemandeDateExamenOk(1);
        $roles = ['ROLE_ADMIN', 'ROLE_SUPER_ADMIN'];
        $users = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeConfigBundle:AppUser')->getUsersByRoles($roles);
        foreach ($users as $user) {
            foreach ($demandes as $key => $demande) {
                $this->sendNotificationEmail($user, $demande);
            }
        }

    }

//find demands that have passed the limited number of exams
    public function rechercheDemandeLimtsNbExam()
    {
        $delais = $this->rechercheDelais();
        $refStatut = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeReferencielBundle:RefStatut')->findByCode('RE_DATE_EXAM_OK');
        $demandes = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeAttestationBundle:Demande')->findDemandeByStatutAndNbExamen($refStatut, $delais->getNbDelaisExamen());
        return $demandes;
    }


//update status of demands with new status and send mail to user
    public function sendEmailToUserNotPassExam($demande)
    {
        try {
            //return email user receiver
            $EmailuserReceiver = $demande->getUser()->getEmail();
            //return user receiver
            $userReceiver = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeConfigBundle:AppUser')->findOneByEmail($EmailuserReceiver);
            $parameters = array(
                'user' => $userReceiver,
                'demande' => $demande,
                'host' => $this->container->getParameter('host')
            );
            $template = 'Emails/send_email_stop_process_citoyen.html.twig';
            $from = $this->container->getParameter('mailer_user');
            $to = $EmailuserReceiver;
            $subject = $this->container->getParameter('object_mail_stop_process');
            $attachement = "";
            $this->container->get('mfpe_configbundle_mailer_sendmailer')->sendMailer($template, $parameters, $from, $to, $subject, $attachement);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    public function sendEmailToAllDemandeNotPassExam()
    {
        $demandes = $this->rechercheDemandeLimtsNbExam();
        $refStatut = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeReferencielBundle:RefStatut')->findOneByCode('CONDIDAT_ABSENT');

        foreach ($demandes as $demande) {
            $this->sendEmailToUserNotPassExam($demande);
            $demande->setCurrentStatut($refStatut);
            $this->container->get('doctrine.orm.entity_manager')->flush();
        }
    }


    //update status of demands with new status and send mail to user
    public function sendEmailTransfertDemandeFromDrToDr($demande, $dr)
    {
        try {
            //return user receiver
            $userReceivers = $this->container->get('doctrine.orm.entity_manager')->getRepository('MfpeConfigBundle:AppUser')->findByUniteRegionale($demande->getUniteRegionale());
            if ($userReceivers) {
                //Second : send email for agent in the new regional management
                foreach ($userReceivers as $userReceiver) {
                    $parameters = array(
                        'user' => $userReceiver,
                        'demande' => $demande,
                        'ancienDr' => $dr,
                        'host' => $this->container->getParameter('host')
                    );
                    $template = 'Emails/send_email_transfert_demande_dr_to_dr.html.twig';
                    $from = $this->container->getParameter('mailer_user');
                    $to = $userReceiver->getEmail();

                    $subject = $this->container->getParameter('object_mail_transfert_demande');
                    $attachement = "";
                    $this->container->get('mfpe_configbundle_mailer_sendmailer')->sendMailer($template, $parameters, $from, $to, $subject, $attachement);
                }
            }

        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

}
