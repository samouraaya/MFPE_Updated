<?php

namespace Mfpe\AttestationBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Mfpe\AttestationBundle\Entity\Delais;
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
class DelaisController extends BaseController
{




//function to add  Pv in the table
    public function addDelais($data)
    {
        $delaisNew = new Delais();
        if (isset($data['nbDelaisExamen']) && !empty($data['nbDelaisExamen'])) {
            $delaisExamen = trim($data['nbDelaisExamen']);
            $delaisNew->setNbDelaisExamen($delaisExamen);
        }
        if (isset($data['nbDelaisPv']) && !empty($data['nbDelaisPv'])) {
            $delaisPv = trim($data['nbDelaisPv']);
            $delaisNew->setNbDelaisPv($delaisPv);
        }
        $em = $this->getDoctrine()->getManager();
        $em->persist($delaisNew);
        $em->flush();
        return $delaisNew;
    }


//function to update delais Pv in the table
    public function updateDelais($delaisUpdate, $data)
    {
        if (!empty($delaisUpdate)) {
            if (isset($data['nbDelaisExamen']) && !empty($data['nbDelaisExamen'])) {
                $delaisExamen = trim($data['nbDelaisExamen']);
                $delaisUpdate->setNbDelaisExamen($delaisExamen);
            }
            if (isset($data['nbDelaisPv']) && !empty($data['nbDelaisPv'])) {
                $delaisPv = trim($data['nbDelaisPv']);
                $delaisUpdate->setNbDelaisPv($delaisPv);
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
        }
        else
        {
            $this->addDelais($data);
        }

        return $delaisUpdate;
    }

    /**
     * @Rest\View(serializerGroups={"detailDelais"})
     * @Rest\Put(
     *     path = "/{id}",
     *     name = "app_delais_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"Delais"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"Demande"},
     *  summary="edit demande",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="Delais",
     *     in="path",
     *     description="Delais id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="nbDelaisExamen", type="integer"),
     *              @SWG\Property(property="nbDelaisPv", type="integer"),
     *          )
     *
     *      ),
     * )
     * @SWG\Response(response="200", description="Returned when Resource modified",
     * @SWG\Schema(type="array", @Model(type=Delais::class, groups={"detailDelais"}))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function updateDelaisPvAction(Request $request)
    {
        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            $message = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            $message = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $delai= $em->getRepository('MfpeAttestationBundle:Delais')->findOneById(1);
        $delais = $this->updateDelais($delai, $data);
        $delais = $this->get('jms_serializer')->serialize($delais, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailDelais')));
        $delais = json_decode($delais, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $delais], Response::HTTP_OK);
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailDelais"})
     * @Rest\Get(
     *     path = "/",
     *     name="app_delais_Get",
     *     options={ "method_prefix" = false },
     * )
     * @SWG\Get(
     *  tags={"Demande"},
     *  summary="Get delais",
     *          description ="",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Delais::class, groups={"detailDelais"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getDelaisAction(Request $request)
    {
        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            $message = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            $message = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        $data = json_decode(json_encode($request->query->all()), true);
        $delais = $this->getDoctrine()->getRepository('MfpeAttestationBundle:Delais')->findById(1);
        $delais = $this->get('jms_serializer')->serialize($delais, 'json', SerializationContext::create()->setGroups(array('detailDelais')));
        $delais = json_decode($delais, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $delais], Response::HTTP_OK);
    }

//    /**
//     * @Rest\View(StatusCode = 200, serializerGroups={"detailDelais"})
//     * @Rest\Get(
//     *     path = "/{id}",
//     *     name = "app_delais-id_Get",
//     *     options={ "method_prefix" = false }
//     * )
//     * @SWG\Get(
//     *  tags={"Demande"},
//     *  summary="Get Delais by id",
//     *  consumes={"application/json"},
//     *  produces={"application/json"},
//     * @SWG\Parameter(
//     *     name="id",
//     *     in="path",
//     *     type="integer",
//     *     description="role id",
//     *     required=true
//     * ),
//     * @SWG\Response(response="200", description="Returned when successful" ,@SWG\Schema(type="array", @Model(type=Delais::class))),
//     * @SWG\Response(response="404", description="Returned when role not found"),
//     * )
//     */
//    public function getDelaisByIdAction($id)
//    {
//        try {
//            if (!$this->container->has('security.token_storage')) {
//                $message = ApiProblem::TOKEN_JWT_EXPIRED;
//                $errors['token'] = $message;
//                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//            }
//            if (null === $token = $this->container->get('security.token_storage')->getToken()) {
//                $message = ApiProblem::TOKEN_JWT_EXPIRED;
//                $errors['token'] = $message;
//                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//            }
//            if (!is_object($user = $token->getUser())) {
//                $message = ApiProblem::TOKEN_JWT_EXPIRED;
//                $errors['token'] = $message;
//                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//            }
//            //Get the delais by id
//            $delais = $this->em()->getRepository('MfpeAttestationBundle:Delais')->find($id);
//            //Check if the delais exist. Return 404 if not.
//            if ($delais === null) {
//                $message = ApiProblem::DELAIS_DOES_NOT_EXIST;
//                $errors['delais'] = $message;
//                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_NOT_FOUND, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//            }
//            $delais = $this->get('jms_serializer')->serialize($delais, 'json', SerializationContext::create()->setGroups(array('detailDelais')));
//            $delais = json_decode($delais, JSON_UNESCAPED_UNICODE);
//            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $delais], Response::HTTP_OK);
//
//        } catch (\Throwable $e) {
//            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
//        }
//    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailDelais"})
     * @Rest\Get(
     *     path = "/time/",
     *     name="app_delais-pv_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Demande"},
     *  summary="Get  all delais PV",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Delais::class, groups={"detailDelais"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getDelaisDemandeAction()
    {
        try {
            if (null === $token = $this->container->get('security.token_storage')->getToken()) {
                $message = ApiProblem::TOKEN_JWT_EXPIRED;
                $errors['token'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            if (!is_object($user = $token->getUser())) {
                // e.g. anonymous authentication
                $message = ApiProblem::TOKEN_JWT_EXPIRED;
                $errors['token'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            // $delais = $this->get('mfpe_user_demandes_service')->sendEmailUserExccedTimePvUpload();
           $delais = $this->get('mfpe_user_demandes_service')->sendEmailToAllDemandeNotPassExam();
//            $delais = $this->get('jms_serializer')->serialize($delais, 'json', SerializationContext::create()->setGroups(array('detailDelais')));
//            $delais = json_decode($delais, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $delais], Response::HTTP_OK);

        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }


    }
}
