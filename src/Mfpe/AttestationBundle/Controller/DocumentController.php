<?php

namespace Mfpe\AttestationBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Mfpe\AttestationBundle\Entity\Document;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Mfpe\ConfigBundle\Entity\AppUser;
use Mfpe\NotificationBundle\Entity\Notification;
use Mfpe\ReferencielBundle\Entity\Referenciel;
use Mfpe\AttestationBundle\Entity\Demande;
use Mfpe\AttestationBundle\Entity\ApplicationHistory;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\ConfigBundle\Exception\ApiProblemException;
use Mfpe\ConfigBundle\Exception\ValidationException;
use Mfpe\ConfigBundle\Controller\BaseController;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Request\ParamFetcherInterface;
use JMS\Serializer\SerializationContext;

// Include the requires classes of Phpword
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

/**
 * Description of DocumentController
 *
 * @author Wiem Hadiji
 */
class DocumentController extends BaseController
{


    /**
     * @Rest\Post(
     *     path = "/upload/{id}",
     *     name = "app_files-upload-demande_Add",
     *     options={ "method_prefix" = false },
     *     requirements = {"demande"="\d+"}
     * )
     * @SWG\Post(
     *  tags={"Demande"},
     *  summary="Upload file demande",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="201", description="Returned when Resource created"),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * ),
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="file[]", type="string"),
     *          )
     *
     *      ),
     * )
     */
    public function getUploadFileAction(Request $request, ?Demande $demande)
    {
        try {
            if (!is_object($demande)) {
                return $this->createApiResponse('Demande does not exist', 400);
            } else {
                if (!$this->container->has('security.token_storage')) {
                    $message = ApiProblem::TOKEN_JWT_EXPIRED;
                    $errors['token'] = $message;
                    $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
                if (null === $token = $this->container->get('security.token_storage')->getToken()) {
                    $message = ApiProblem::TOKEN_JWT_EXPIRED;
                    $errors['token'] = $message;
                    $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
                if (!is_object($user = $token->getUser())) {
                    $message = ApiProblem::TOKEN_JWT_EXPIRED;
                    $errors['token'] = $message;
                    $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
                //Static Access List
                $rolesCurrentUser = array();
                $roles = $user->getUserRoles();
                foreach ($roles as $role) {
                    array_push($rolesCurrentUser, $role->getRole());
                }
                if (in_array("ROLE_SUPER_ADMIN", $rolesCurrentUser) || in_array("ROLE_ADMIN", $rolesCurrentUser) || in_array("ROLE_CYNAPSYS", $rolesCurrentUser)) {

                } else {
                    //First ACL By gouvernorat
                    if (in_array("ROLE_CITOYEN", $rolesCurrentUser)) {
                        $userConnectedId = $user->getId();
                        $demandeUserId = $demande->getUser()->getId();
                        if ($userConnectedId != $demandeUserId) {
                            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_UNAUTHORIZED, 'data' => ApiProblem::ACCESS_FORBIDDEN, 'message' => ApiProblem::ACCESS_FORBIDDEN], Response::HTTP_UNAUTHORIZED);
                        }
                    } else {
                        if (in_array("ROLE_AGENT_DR1", $rolesCurrentUser) || in_array("ROLE_AGENT_DR2", $rolesCurrentUser) || in_array("ROLE_AGENT_DR3", $rolesCurrentUser) || in_array("ROLE_AGENT_DR4", $rolesCurrentUser) || in_array("ROLE_DIRECTEUR_DR", $rolesCurrentUser)) {
                            $gouvernoratUniteRegionale = $demande->getUniteRegionale()->getGouvernorat()->getId();
                            $userConnectedGouvernorat = $user->getUniteRegionale()->getGouvernorat()->getId();
                            if ($gouvernoratUniteRegionale != $userConnectedGouvernorat) {
                                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_UNAUTHORIZED, 'data' => ApiProblem::ACCESS_FORBIDDEN, 'message' => ApiProblem::ACCESS_FORBIDDEN], Response::HTTP_UNAUTHORIZED);
                            }
                        }
                        if (in_array("ROLE_AGENT_CENTRE_FORMATION", $rolesCurrentUser)) {
                            $userConnectedEmail = $user->getEmail();
                            $centreFormationEmail = $demande->getCentreFormation()->getEmail();
                            if ($userConnectedEmail != $centreFormationEmail) {
                                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_UNAUTHORIZED, 'data' => ApiProblem::ACCESS_FORBIDDEN, 'message' => ApiProblem::ACCESS_FORBIDDEN], Response::HTTP_UNAUTHORIZED);
                            }

                        }
                    }
                    //Second ACL By state to execute
                    $allStateExecuteCurrentUser = array();
                    $roles = $user->getUserRoles();
                    foreach ($roles as $role) {
                        $stateExecute = $role->getStateExecute();
                        foreach ($stateExecute as $state)
                            array_push($allStateExecuteCurrentUser, $state);
                    }
                    if (!in_array("SCAN_OK", $allStateExecuteCurrentUser)) {
                        return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_UNAUTHORIZED, 'data' => ApiProblem::ACCESS_FORBIDDEN, 'message' => ApiProblem::ACCESS_FORBIDDEN], Response::HTTP_UNAUTHORIZED);
                    }
                }
                $em = $this->getDoctrine()->getManager();
                $files = $request->files->get('file');
                if (!($files) || count($files) == 0) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['file[]'] = $message;
                    $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
                foreach ($files as $file) {
                    if (!is_file($file)) {
                        $message = ApiProblem::NOT_EXTENSION_FILE;
                        $errors['file'] = $message;
                        $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                        return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                    }
                }
                $statut = $em->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array('code' => "SCAN_OK"));
                if (!is_object($statut)) {
                    $message = ApiProblem::STATUT_DOES_NOT_EXIST;
                    $errors['statut'] = $message;
                    $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
                $files = $request->files->get('file');

                // Modifie current statut demande
                $demande->setCurrentStatut($statut);
                foreach ($files as $file) {
                    $document = new Document();
                    $fileOriginName = $file->getClientOriginalName();
                    // dd($fileName);
                    $fileName = md5(uniqid()) . '.' . $file->guessExtension();
                    $file->move($this->container->getParameter('file_directory'), $fileName);
                    $document->setName($fileOriginName);
                    $document->setCreatedBy($user->getId());
                    $document->setCreatedAt(new \DateTime ());
                    $servername = $_SERVER['HTTP_HOST'];
                    $fileurl = "/uploads/assets/" . $fileName;
                    $path = $servername . $fileurl;
                    $document->setPath($path);
                    $document->setType("Document");
                    $document->setDemande($demande);
                    $em->persist($document);
                    $em->flush();
                }
                //Insert in History Demand
                $this->forward('Mfpe\AttestationBundle\Controller\DemandeController::addApplicationHistory', [
                    'demande' => $demande,
                ]);
                //Send Mailer to centre formation
                $centre_formation = $demande->getCentreFormation();
                $parameters = array(
                    'centre_formation' => $centre_formation,
                    'demande' => $demande,
                );
                $template = 'Emails/send_email_dr_to_atfp.html.twig';
                $from = $user->getEmail();
                $to = $centre_formation->getEmail();
                $subject = $this->container->getParameter('object_mail_ATFP') . ' ' . $centre_formation->getIntituleFr();
                $this->get('mfpe_configbundle_mailer_sendmailer')->sendMailer($template, $parameters, $from, $to, $subject, NULL);

                $demande = $this->get('jms_serializer')->serialize($demande, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailDemande')));
                $demande = json_decode($demande, JSON_UNESCAPED_UNICODE);

                return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $demande], Response::HTTP_OK);
            }
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @Rest\Post(
     *     path = "/upload-pv/{id}",
     *     name = "app_upload-pv-demande_Add",
     *     options={ "method_prefix" = false },
     *     requirements = {"demande"="\d+"}
     * )
     * @SWG\Post(
     *  tags={"Demande"},
     *  summary="Upload PV demande",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="201", description="Returned when Resource created"),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * ),
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="file", type="string"),
     *          )
     *
     *      ),
     * )
     */
    public function UploadPvDemandeAction(Request $request, ?Demande $demande)
    {
        try {

            if (!$this->container->has('security.token_storage')) {
                $message = ApiProblem::TOKEN_JWT_EXPIRED;
                $errors['token'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            if (null === $token = $this->container->get('security.token_storage')->getToken()) {
                $message = ApiProblem::TOKEN_JWT_EXPIRED;
                $errors['token'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            if (!is_object($user = $token->getUser())) {
                $message = ApiProblem::TOKEN_JWT_EXPIRED;
                $errors['token'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }

            if (!is_object($demande)) {
                return $this->createApiResponse('Demande does not exist', 400);
            }
            //Static Access List
            $rolesCurrentUser = array();
            $roles = $user->getUserRoles();
            foreach ($roles as $role) {
                array_push($rolesCurrentUser, $role->getRole());
            }
            if (in_array("ROLE_SUPER_ADMIN", $rolesCurrentUser) || in_array("ROLE_ADMIN", $rolesCurrentUser) || in_array("ROLE_CYNAPSYS", $rolesCurrentUser)) {

            } else {
                //First ACL By gouvernorat
                if (in_array("ROLE_CITOYEN", $rolesCurrentUser)) {
                    $userConnectedId = $user->getId();
                    $demandeUserId = $demande->getUser()->getId();
                    if ($userConnectedId != $demandeUserId) {
                        return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_UNAUTHORIZED, 'data' => ApiProblem::ACCESS_FORBIDDEN, 'message' => ApiProblem::ACCESS_FORBIDDEN], Response::HTTP_UNAUTHORIZED);
                    }
                } else {
                    if (in_array("ROLE_AGENT_DR1", $rolesCurrentUser) || in_array("ROLE_AGENT_DR2", $rolesCurrentUser) || in_array("ROLE_AGENT_DR3", $rolesCurrentUser) || in_array("ROLE_AGENT_DR4", $rolesCurrentUser) || in_array("ROLE_DIRECTEUR_DR", $rolesCurrentUser)) {
                        $gouvernoratUniteRegionale = $demande->getUniteRegionale()->getGouvernorat()->getId();
                        $userConnectedGouvernorat = $user->getUniteRegionale()->getGouvernorat()->getId();
                        if ($gouvernoratUniteRegionale != $userConnectedGouvernorat) {
                            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_UNAUTHORIZED, 'data' => ApiProblem::ACCESS_FORBIDDEN, 'message' => ApiProblem::ACCESS_FORBIDDEN], Response::HTTP_UNAUTHORIZED);
                        }
                    }
                    if (in_array("ROLE_AGENT_CENTRE_FORMATION", $rolesCurrentUser)) {
                        $userConnectedEmail = $user->getEmail();
                        $centreFormationEmail = $demande->getCentreFormation()->getEmail();
                        if ($userConnectedEmail != $centreFormationEmail) {
                            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_UNAUTHORIZED, 'data' => ApiProblem::ACCESS_FORBIDDEN, 'message' => ApiProblem::ACCESS_FORBIDDEN], Response::HTTP_UNAUTHORIZED);
                        }

                    }
                }
                //Second ACL By state to execute
                $allStateExecuteCurrentUser = array();
                $roles = $user->getUserRoles();
                foreach ($roles as $role) {
                    $stateExecute = $role->getStateExecute();
                    foreach ($stateExecute as $state)
                        array_push($allStateExecuteCurrentUser, $state);
                }
                if (!in_array("PV_UPLOAD", $allStateExecuteCurrentUser)) {
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_UNAUTHORIZED, 'data' => ApiProblem::ACCESS_FORBIDDEN, 'message' => ApiProblem::ACCESS_FORBIDDEN], Response::HTTP_UNAUTHORIZED);
                }
            }

            $file = $request->files->get('file');
            $em = $this->getDoctrine()->getManager();
            if (!is_file($file)) {
                $message = ApiProblem::NOT_EXTENSION_FILE;
                $errors['file'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $statut = $em->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array('code' => "PV_UPLOAD"));
            if (!is_object($statut)) {
                $message = ApiProblem::STATUT_DOES_NOT_EXIST;
                $errors['statut'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            // Modifie current statut demande
            $demande->setCurrentStatut($statut);

            $document = new Document();
            $fileNameorigine = $file->getClientOriginalName();
            $fileName = '@PV---' . date('Y-m-d H-i-s') . '.' . $file->guessExtension();
            $file->move($this->container->getParameter('pv_directory'), $fileName);
            $document->setName($fileNameorigine);
            $document->setCreatedBy($user->getId());
            $document->setCreatedAt(new \DateTime ());
            $servername = $_SERVER['HTTP_HOST'];
            $fileurl = "/uploads/pv/" . $fileName;
            $path = $servername . $fileurl;
            $document->setPath($path);
            $document->setType("PV");
            //$demande->setStatus("PV_UPLOAD");
            $document->setDemande($demande);
            $em->persist($document);
            $em->flush();
            $this->forward('Mfpe\AttestationBundle\Controller\DemandeController::addApplicationHistory', [
                'demande' => $demande,
            ]);
            //Remove Last Notification of this demande
            $notifications = $this->em()->getRepository('MfpeNotificationBundle:Notification')->findBy(array('demande' => $demande));
            if ($notifications) {
                foreach ($notifications as $notification) {
                    $this->em()->remove($notification);
                    $this->em()->flush();
                }
            }
            $uniteRegionale = $demande->getUniteRegionale();
            $roles = $this->em()->getRepository('MfpeConfigBundle:Role')->getRolesByStatus("PV_UPLOAD");
            $valueRoles = array();
            foreach ($roles as $role) {
                $currentRole = $role->getRole();
                $position = strpos($currentRole, "ROLE_AGENT_DR");
                if (is_int($position)) {
                    array_push($valueRoles, $role->getRole());
                }
            }
//            $roles = array(
//                "ROLE_AGENT_DR1",
//                "ROLE_AGENT_DR2",
//                "ROLE_AGENT_DR3",
//                "ROLE_AGENT_DR4"
//            );
            //$usersReceivers = $this->em()->getRepository('MfpeConfigBundle:AppUser')->getUsersByGouvernoratRoles($gouvernoratDemandId, $roles);
            $usersReceivers = $this->em()->getRepository('MfpeConfigBundle:AppUser')->getUsersByUniteRegionaleRoles($uniteRegionale, $valueRoles);
            foreach ($usersReceivers as $userReceiver) {
                //First : Send Notification if REFUS_CENTRE
                $this->sendNotificationSystem(2, $user, $userReceiver, $demande);
//                $this->forward('Mfpe\NotificationBundle\Controller\NotificationController::sendNotificationSystem', [
//                    "type" => 2,
//                    "user" => $user,
//                    "userReceiver" => $userReceiver,
//                    "demande" => $demande,
//                ]);
            }

            $demande = $this->get('jms_serializer')->serialize($demande, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailDemande')));
            $demande = json_decode($demande, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $demande], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => Response::HTTP_INTERNAL_SERVER_ERROR, 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);

        }
    }


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
            $em = $this->getDoctrine()->getManager();
            $em->persist($notification);
            $em->flush();
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => Response::HTTP_BAD_REQUEST, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
    }


}
