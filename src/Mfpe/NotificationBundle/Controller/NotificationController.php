<?php

namespace Mfpe\NotificationBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Request\ParamFetcher;
use Mfpe\ConfigBundle\Entity\AppUser;
use Mfpe\ReferencielBundle\Entity\Referenciel;
use Mfpe\NotificationBundle\Entity\Notification;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\ConfigBundle\Exception\ApiProblemException;
use Mfpe\ConfigBundle\Exception\ValidationException;
use Mfpe\ConfigBundle\Services\EntityMerger;
use Mfpe\ConfigBundle\Services\PermissionService;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Mfpe\ConfigBundle\Entity\Role;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Mfpe\ConfigBundle\Representation\UsersApp;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use JMS\Serializer\SerializationContext;
use Mfpe\ConfigBundle\Controller\BaseController;
use Mfpe\AttestationBundle\Validator\ValidateCreateDemande;
use Mfpe\ConfigBundle\Validator\ValidateUser;
use Mfpe\AttestationBundle\Entity\Demande;
use Mfpe\AttestationBundle\Entity\ApplicationHistory;
use \DateTime;
use ArUtil\I18N\Arabic;

class NotificationController extends BaseController
{
    use ControllerTrait;


    public function sendNotificationSystemAction($type, $user, $userReceiver, $demande)
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
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @Rest\Get(
     *     path = "",
     *     name="app_notification-user_Get",
     *     options={ "method_prefix" = false },
     * )
     * @SWG\Get(
     *  tags={"Notification"},
     *  summary="Get  all notification by current user",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Notification::class, groups={"notification"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getNotificationByUserAction()
    {
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
        $notifs = $this->getDoctrine()->getRepository('MfpeNotificationBundle:Notification')
            ->findBy(
                array('userReceive' => $user),
                array('createdAt' => 'DESC'),
                5
            );
        $notifs = $this->get('jms_serializer')->serialize($notifs, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('notification')));
        $notifs = json_decode($notifs, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $notifs], Response::HTTP_OK);
    }


    /**
     * @Rest\View(serializerGroups={"notification"})
     * @Rest\Patch(
     *     path = "/{id}",
     *     name="app_notification_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"notification"="\d+"}
     * )
     *
     * @SWG\Patch(
     *  tags={"Notification"},
     *  summary="Patch notification",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Notification::class, groups={"DeserializeUserGroup"}))),
     * @SWG\Response(response="404", description="Returned when notification not found"),
     * )
     */
    public function patchNotificationAction(Request $request, ?Notification $notification)
    {
        if (!is_object($notification)) {
            $message = ApiProblem::NOTIFICATION_DOES_NOT_EXIST;
            $errors['notification'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
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
        $currentStatutDemande = $notification->getDemande()->getCurrentStatut()->getCode();
        if ($currentStatutDemande == "ATTESTATION_KO") {
            $this->em()->remove($notification);
            $this->em()->flush();
            return new JsonResponse(['status' => Response::HTTP_OK, 'code' => Response::HTTP_OK, 'data' => ApiProblem::DELETED_SUCCESS, 'message' => ApiProblem::DELETED_SUCCESS], Response::HTTP_OK);
        } else {
            $notification->setStatusNotif(1);
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $notification = $this->get('jms_serializer')->serialize($notification, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('notification')));
            $notification = json_decode($notification, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $notification,], Response::HTTP_OK);
        }
    }
}
