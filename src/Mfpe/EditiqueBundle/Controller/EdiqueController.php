<?php

namespace Mfpe\EditiqueBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Request\ParamFetcher;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\ConfigBundle\Exception\ApiProblemException;
use Mfpe\ConfigBundle\Exception\ValidationException;
use Mfpe\ConfigBundle\Services\EntityMerger;
use Mfpe\ConfigBundle\Services\PermissionService;
use Mfpe\EditiqueBundle\Validator\ValidateEmploi;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use phpDocumentor\Reflection\Types\Object_;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Mfpe\ConfigBundle\Representation\UsersApp;
use Mfpe\CollectDataBundle\Entity\StatGraduateTraining;
use Mfpe\CollectDataBundle\Entity\PrivateTrainnigCenter;
use Mfpe\CollectDataBundle\Entity\ProjectData;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use JMS\Serializer\SerializationContext;
use Mfpe\ConfigBundle\Controller\BaseController;
use Mfpe\DataSocioEconomicBundle\Entity\CsvBTSData;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Description of EdiqueController
 *
 * @author Wiem Hadiji
 */
class EdiqueController extends BaseController
{
    use ControllerTrait;

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailStatGraduateTraining"})
     * @Rest\Get(
     *     path = "/professionnel_information",
     *     name="app_Professionnel-information-data_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="governorate",
     *     nullable=true,
     *     description="code or id gouvernorat to search for .Required fields for the second period"
     * )
     * @Rest\QueryParam(
     *     name="delegation",
     *     nullable=true,
     *     description="delegation to search for."
     * )
     * @Rest\QueryParam(
     *     name="sector",
     *     nullable=true,
     *     description="sector to search for."
     * )
     * @Rest\QueryParam(
     *     name="center",
     *     nullable=true,
     *     description="center to search for."
     * )
     * @Rest\QueryParam(
     *     name="registration_number",
     *     nullable=true,
     *     description="registration number to search for."
     * )
     * @Rest\QueryParam(
     *     name="from",
     *     nullable=true,
     *     default="12-12-2012",
     *     description="From search for."
     * )
     * @Rest\QueryParam(
     *     name="to",
     *     nullable=true,
     *     default="12-12-2019",
     *     description="To search for."
     * )
     * @Rest\QueryParam(
     *     name="fromSecondary",
     *     nullable=true,
     *     default="12-12-2012",
     *     description="From Secondary to search for."
     * )
     * @Rest\QueryParam(
     *     name="toSecondary",
     *     nullable=true,
     *     default="20-04-2020",
     *     description="To Secondary search for."
     * )
     * @Rest\QueryParam(
     *     name="organization",
     *     nullable=true,
     *     default="12-12-2019",
     *     description="Display if sector is public."
     * )
     *
     * @SWG\Get(
     *  tags={"Edique"},
     *  summary="Get  all Professionnel Information data",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=StatGraduateTraining::class, groups={"detailStatGraduateTraining"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     *
     *
     * )
     */
    public function getProfessionnelInformationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $national = "";
        $response = [];
        $data = json_decode(json_encode($request->query->all()), true);
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
        $response = self::getProfessionnelInformationTableDataP1($data);
        if (isset($data["from"]) && !empty($data["from"]) && isset($data["to"]) && !empty($data["to"])
            && isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])
        ) {
            $validator = New ValidateEmploi($em);
            $errors = $validator->validateGouvernorat($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $response = self::getProfessionnelInformationTableDataP1P2($data);
            //return total for the second periode
            $national = $em->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getTotalGraduateTrainingByFiltrePeriode2($data);
            //eliminate objet null

        } elseif (isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])) {
            $national = "";
            $response = [];
        }
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response, 'national' => $national], Response::HTTP_OK);

    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailStatGraduateTraining"})
     * @Rest\Get(
     *     path = "/identity_regional",
     *     name="app_identity-regional-data_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="governorate",
     *     nullable=true,
     *     description="id governorate to search for."
     * )
     * @SWG\Get(
     *  tags={"Edique"},
     *  summary="Get  all Professionnel Information data",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=IdentiteRegion::class, groups={"regionGroup"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getIdentityInformationAction(Request $request)
    {
        $data = json_decode(json_encode($request->query->all()), true);
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
        $response = self::getIdentityInformationTableData($data);
        $response1 = self::getTotalData($data);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response, 'total' => $response1], Response::HTTP_OK);

    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailEtatiqueStatGraduateTraining"})
     * @Rest\Get(
     *     path = "/prof_etatique",
     *     name="app_etatique_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="governorate",
     *     name="governorate",
     *     nullable=true,
     *     description="code or Id gouvernorat to search for .Required fields for the second period"
     * )
     * @Rest\QueryParam(
     *     name="year",
     *     nullable=true,
     *     description="year to search for."
     * )
     * @Rest\QueryParam(
     *     name="month",
     *     nullable=true,
     *     description="id month to search for."
     * )
     * @Rest\QueryParam(
     *     name="yearSecondary",
     *     nullable=true,
     *     description="year Secondary to search for."
     * )
     * @Rest\QueryParam(
     *     name="monthSecondary",
     *     nullable=true,
     *     description="id month Secondary to search for."
     * )
     * @Rest\QueryParam(
     *     name="organization",
     *     nullable=true,
     *     description="organization to search for."
     * )
     * @SWG\Get(
     *  tags={"Edique"},
     *  summary="Get  all Etatique Professionnel Information data",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=StatGraduateTraining::class, groups={"detailEtatiqueStatGraduateTraining"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getEtatiqueInformationAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();
        $national = "";
        $response = [];
        $sector = "true";
        try {
            $data = json_decode(json_encode($request->query->all()), true);
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
            $validator = New ValidateEmploi($em);
            $errors = $validator->validateYear($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $response = self::getEtatiqueProfessionnelEtatiqueInformation($data);

            if (isset($data["year"]) && !empty($data["year"]) && isset($data["yearSecondary"]) && !empty($data["yearSecondary"]) || (isset($data["monthSecondary"]) && !empty($data["monthSecondary"]))) {
                //return merge of two periode in one tab
                $response = $this->getMergeEtatiqueProfessionnel($data);
                //return total for the second periode total exist deja in the second periode
                //    $total = $em->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getTotalGraduateTrainingEtatique($data, $sector);

            } elseif (isset($data["yearSecondary"]) && !empty($data["yearSecondary"])) {
                $national = "";
                $response = [];
            }
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response, 'national' => $national], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

//    /**
//     * @Rest\View(StatusCode = 200, serializerGroups={"detailPrivateTrainingCentre"})
//     * @Rest\Get(
//     *     path = "/number_private_trainig_center/",
//     *     name="app_nomber-private-trainig-center-data_Get",
//     *     options={ "method_prefix" = false },
//     * )
//     * @Rest\QueryParam(
//     *     name="gouvernorat",
//     *     nullable=true,
//     *     description="code gouvernorat to search for."
//     * )
//     * @SWG\Get(
//     *  tags={"Edique"},
//     *  summary="Get  Number Private Trainig Center",
//     *  consumes={"application/json"},
//     *  produces={"application/json"},
//     *
//     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=PrivateTrainnigCenter::class, groups={"detailTrainingCentre"}))),
//     * @SWG\Response(response="404", description="Returned when user not found"),
//     * )
//     */
//    public function getNumberPrivateTrainigCenterAction(Request $request)
//    {
//        $data = json_decode(json_encode($request->query->all()), true);
//        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
//            $message = ApiProblem::TOKEN_JWT_EXPIRED;
//            $errors['token'] = $message;
//            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//        }
//        if (!is_object($user = $token->getUser())) {
//            // e.g. anonymous authentication
//            $message = ApiProblem::TOKEN_JWT_EXPIRED;
//            $errors['token'] = $message;
//            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//        }
//        $response = self::getNumberPrivateTrainigCenter($data);
//        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);
//
//    }
//

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailPrivateTrainingCentre"})
     * @Rest\Get(
     *     path = "/number_private_center/",
     *     name="app_private-trainig-center-data_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="governorate",
     *     nullable=true,
     *     description="code or Id gouvernorat to search for .Required fields for the second period."
     * )
     * @Rest\QueryParam(
     *     name="from",
     *     nullable=true,
     *     default="12-12-2012",
     *     description="From search for."
     * )
     * @Rest\QueryParam(
     *     name="to",
     *     nullable=true,
     *     default="12-12-2019",
     *     description="To search for."
     * )
     * @Rest\QueryParam(
     *     name="fromSecondary",
     *     nullable=true,
     *     default="12-12-2012",
     *     description="From Secondary to search for."
     * )
     * @Rest\QueryParam(
     *     name="toSecondary",
     *     nullable=true,
     *     default="12-12-2019",
     *     description="To Secondary search for."
     * )
     *
     * @SWG\Get(
     *  tags={"Edique"},
     *  summary="Get  Number Private Trainig Center",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     *
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=PrivateTrainnigCenter::class, groups={"detailTrainingCentre"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getNumberPrivateTrainigDataCenterAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $total = "";
        $response = [];
        $data = json_decode(json_encode($request->query->all()), true);
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
        $response = self::getNumberPrivateTrainigDataCenterPeriode1($data);
        if (isset($data["from"]) && !empty($data["from"]) && isset($data["to"]) && !empty($data["to"])
            && isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])
        ) {
            $validator = New ValidateEmploi($em);
            $errors = $validator->validateGouvernorat($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $response = self::getNumberPrivateTrainigDataCenter($data);
            $total = $em->getRepository('MfpeCollectDataBundle:PrivateTrainnigCenter')->getNumberTotalPrivateTrainigCenterSecondaryByFiltre($data);;

        } elseif (isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])) {
            $total = "";
            $response = [];
        }
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response, 'national' => $total], Response::HTTP_OK);

    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "/socio_economic/institutions_educatives_sante",
     *     name="app_socio-economic-institutions-educatives-sante_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="gouvernorat",
     *     nullable=true,
     *     description="code gouvernorat to search for."
     * )
     * @Rest\QueryParam(
     *     name="year",
     *     nullable=true,
     *     description="Year to search for."
     * )
     * @Rest\QueryParam(
     *     name="yearSecondary",
     *     nullable=true,
     *     description="yearSecondary to search for."
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Edique"},
     *  summary="Get  Institutions éducatives et de santé data",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=SocioEconomicData::class, groups={"detailsEconomicData"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getSocioEconomicInstitutionEdicativeSanteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $national = "";
        $response = [];
        try {
            $data = json_decode(json_encode($request->query->all()), true);
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
            $response = self::getInstitutionEducative($data);

            if (isset($data["year"]) && !empty($data["year"]) && isset($data["yearSecondary"]) && !empty($data["yearSecondary"])
            ) {
                $validator = New ValidateEmploi($em);
                $errors = $validator->validateQualification($data);
                if ($errors) {
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
                //return merge of two periode in one tab
                $response = self::getMergeInstitutionEducative($data);

                //return total for the second periode
                //  $socioEconomicData = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:SocioEconomicData')->getInstitutionSanteWithPagination($data);
                $national = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:SocioEconomicData')->getTotalInstitutionSanteWithPaginationP2($data);

            } elseif (isset($data["yearSecondary"]) && !empty($data["yearSecondary"])) {
                $national = "";
                $response = [];
            }

            $response = $this->get('jms_serializer')->serialize($response, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData')));
            $response = json_decode($response, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response, 'national' => $national], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "/socio_economic/statistique_general",
     *     name="app_socio-statictic-general_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="gouvernorat",
     *     nullable=true,
     *     description="code or Id gouvernorat to search for .Required fields for the second period."
     * )
     * @Rest\QueryParam(
     *     name="year",
     *     nullable=true,
     *     description="Year to search for."
     * )
     * @Rest\QueryParam(
     *     name="yearSecondary",
     *     nullable=true,
     *     description="yearSecondary to search for."
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Edique"},
     *  summary="Get static general socio economic",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=CsvSocioEconomicData::class, groups={"detailsEconomicData"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getSocioEconomicStatisticGeneralAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $national = "";
        $response = [];
        try {
            $data = json_decode(json_encode($request->query->all()), true);
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
            $response = $this->getSocioEconomicStatisticGeneral($data);

            if (isset($data["year"]) && !empty($data["year"]) && isset($data["yearSecondary"]) && !empty($data["yearSecondary"])
            ) {
                $validator = New ValidateEmploi($em);
                $errors = $validator->validateQualification($data);

                if ($errors) {
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
                //return merge of two periode in one tab
                $response = $this->getMergeSocioEconomicStatistic($data);

                //return total for the second periode
                $national = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:CsvSocioEconomicData')->getTotalCsvSocioEconomicP2($data);

            } elseif (isset($data["yearSecondary"]) && !empty($data["yearSecondary"])) {
                $national = "";
                $response = [];
            }

            $response = $this->get('jms_serializer')->serialize($response, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData')));
            $response = json_decode($response, JSON_UNESCAPED_UNICODE);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response, 'national' => $national], Response::HTTP_OK);

    }

    public function getMergeCandidates($result1, $result2, $newKey)
    {
        //merge two table
        $tabMerge = [];
        if (isset($result1) && !empty($result1) && isset($result2) && !empty($result2)) {
            foreach ($result1 as $key => $value) {
                if (is_array($value)) {
                    $tabMerge [$key] = array_merge($result1[$key], $result2[$key]);
                } else {
                    if (strpos($key, '_secondary') != TRUE) {
                        $tabMerge[$key] = $result1[$key];
                        $tabMerge[$key . $newKey] = $result2[$key . $newKey];
                    } else {
                        $tabMerge[$key] = $result1[$key];
                    }

                }
            }
        }
        $Result = $this->get('jms_serializer')->serialize($tabMerge, 'json', SerializationContext::create()->setGroups(array('detailPrivateTrainingCentre')));
        $Result = json_decode($Result, JSON_UNESCAPED_UNICODE);
        return $Result;
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "/professional_qualification",
     *     name="app_professional-qualification_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="gouvernorat",
     *     nullable=true,
     *     description="Code Gouvernorat to search for."
     * )
     * @Rest\QueryParam(
     *     name="delegation",
     *     nullable=true,
     *     description="Delegation to search for."
     * )
     * @Rest\QueryParam(
     *     name="centre_formation",
     *     nullable=true,
     *     description="Id centre formation to search for."
     * )
     * @Rest\QueryParam(
     *     name="secteur",
     *     nullable=true,
     *     requirements="\d+",
     *     description="Id secteur to search for."
     * )
     * @Rest\QueryParam(
     *     name="annee",
     *     nullable=true,
     *     description="Year of project to search for."
     * )
     * @Rest\QueryParam(
     *     name="from",
     *     nullable=true,
     *     default="12-12-2012",
     *     description="From search for."
     * )
     * @Rest\QueryParam(
     *     name="to",
     *     nullable=true,
     *     default="12-12-2019",
     *     description="To search for."
     * )
     * @Rest\QueryParam(
     *     name="fromSecondary",
     *     nullable=true,
     *     default="12-12-2012",
     *     description="From Secondary to search for."
     * )
     * @Rest\QueryParam(
     *     name="toSecondary",
     *     nullable=true,
     *     default="20-04-2020",
     *     description="To Secondary search for."
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Edique"},
     *  summary="Get  professional qualification",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=SocioEconomicData::class, groups={"detailsEconomicData"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getProfessionnalQualificationAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $response = [];
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
        $candidates = $this->em()->getRepository('MfpeAttestationBundle:Demande')->getAllCandidates($data);
        $response = self::getProfessionnalQualification($data, $candidates);

        if (isset($data["from"]) && !empty($data["from"]) && isset($data["to"]) && !empty($data["to"])
            && isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])
        ) {
            $validator = New ValidateEmploi($em);
            $errors = $validator->validateQualification($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $tab = [];
            //return qualification first periode
            $candidates = $this->em()->getRepository('MfpeAttestationBundle:Demande')->getAllCandidates($data);
            //return qualification first periode
            $result1 = self::getProfessionnalQualification($data, $candidates);
            $key = '_secondary';
            //return qualification second periode
            $result2 = self::getProfessionnalQualificationP2($data);
            //merge result1 et result 2
            $response1 = self::getMergeCandidates($result1, $result2, $key);
            //return national qualification second periode
            $result3 = self::getProfessionnalQualificationNationalP2($data);
            //merge response et result 3
            $key = '_national';
            $response = self::getMergeCandidates($response1, $result3, $key);

            //return total for the second periode
            //  $total = $totalSecondary = $em->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getTotalGraduateTrainingByFiltrePeriode2($data);;
        } elseif (isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])) {
            $response = [];
        }
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);
    }

    //return information condidate for the first periode
    private function getProfessionnalQualification($data, $candidates)
    {
        $result = array();
        //Step1 : numbre of candidate
        //  $candidates = $this->em()->getRepository('MfpeAttestationBundle:Demande')->getAllCandidates($data);
        $numberMen = 0;
        $numberWomen = 0;
        $numberTunisien = 0;
        $numberEtrangers = 0;
        foreach ($candidates as $candidate) {
            $refStatut = $candidate->getCurrentStatut();
            //number Men/Women
            if (strtolower($candidate->getUser()->getSexe()) == "homme") {
                $numberMen = $numberMen + 1;
            } else {
                $numberWomen = $numberWomen + 1;
            }
            //Number etranger
            if (strpos(strtolower($candidate->getUser()->getNationalite()->getIntituleFr()), 'tunis') !== false) {
                $numberTunisien = $numberTunisien + 1;
            } else {
                $numberEtrangers = $numberEtrangers + 1;
            }
        }
        $result["number_candidat"] = array(
            "number_men" => $numberMen,
            "number_women" => $numberWomen,
            "number_tunisian" => $numberTunisien,
            "number_etrangers" => $numberEtrangers,
            "total" => $numberMen + $numberWomen,
        );

        //Step2 : numbre of candidate qualifiers
        $numberMen = 0;
        $numberWomen = 0;
        $numberTunisien = 0;
        $numberEtrangers = 0;
        foreach ($candidates as $candidate) {
            $refStatut = $candidate->getCurrentStatut();
            if ($refStatut->getCode() == "ATTESTATION_OK") {
                //number Men/Women
                if (strtolower($candidate->getUser()->getSexe()) == "homme") {
                    $numberMen = $numberMen + 1;
                } else {
                    $numberWomen = $numberWomen + 1;
                }
                //Number etranger
                if (strpos(strtolower($candidate->getUser()->getNationalite()->getIntituleFr()), 'tunis') !== false) {
                    $numberTunisien = $numberTunisien + 1;
                } else {
                    $numberEtrangers = $numberEtrangers + 1;
                }
            }
        }
        $result["number_candidat_qualifier"] = array(
            "number_men" => $numberMen,
            "number_women" => $numberWomen,
            "number_tunisian" => $numberTunisien,
            "number_etrangers" => $numberEtrangers,
            "total" => $numberMen + $numberWomen,
        );

        //Step3 : numbre of candidate not qualifiers
        $numberMen = 0;
        $numberWomen = 0;
        $numberTunisien = 0;
        $numberEtrangers = 0;
        foreach ($candidates as $candidate) {
            $refStatut = $candidate->getCurrentStatut();
            if ($refStatut->getCode() == "ATTESTATION_KO") {
                //number Men/Women
                if (strtolower($candidate->getUser()->getSexe()) == "homme") {
                    $numberMen = $numberMen + 1;
                } else {
                    $numberWomen = $numberWomen + 1;
                }
                //Number etranger
                if (strpos(strtolower($candidate->getUser()->getNationalite()->getIntituleFr()), 'tunis') !== false) {
                    $numberTunisien = $numberTunisien + 1;
                } else {
                    $numberEtrangers = $numberEtrangers + 1;
                }
            }
        }
        $result["number_candidat_not_qualifier"] = array(
            "number_men" => $numberMen,
            "number_women" => $numberWomen,
            "number_tunisian" => $numberTunisien,
            "number_etrangers" => $numberEtrangers,
            "total" => $numberMen + $numberWomen,
        );

        //Step4 : numbre of specialities
        $specialities = $this->em()->getRepository('MfpeCentreFormationBundle:Specialite')->getSpecialities($data);
        $result["number_specialitie"] = count($specialities);

        //Step5 : numbre of centre formation
        $centreFormations = $this->em()->getRepository('MfpeCentreFormationBundle:CentreFormation')->getCentreFormations($data);
        $result["number_centre_formation"] = count($centreFormations);
        //  $response = json_decode(json_encode($result));
        return $result;
    }

    //return information professional qualification
    private function getProfessionnalQualificationPublic($data, $candidates)
    {
        $result = array();
        //Step1 : numbre of candidate
        $numberMen = 0;
        $numberWomen = 0;
        $numberTunisien = 0;
        $numberEtrangers = 0;
        foreach ($candidates as $candidate) {
            $refStatut = $candidate->getCurrentStatut();
            //number Men/Women
            if (strtolower($candidate->getUser()->getSexe()) == "homme") {
                $numberMen = $numberMen + 1;
            } else {
                $numberWomen = $numberWomen + 1;
            }
            //Number etranger
            if (strpos(strtolower($candidate->getUser()->getNationalite()->getIntituleFr()), 'tunis') !== false) {
                $numberTunisien = $numberTunisien + 1;
            } else {
                $numberEtrangers = $numberEtrangers + 1;
            }
        }
        $result["number_candidat"] = array(
            "number_women" => $numberWomen,
            "total" => $numberMen + $numberWomen,
        );
        //Step2 : numbre of candidate qualifiers
        $numberMen = 0;
        $numberWomen = 0;
        $numberTunisien = 0;
        $numberEtrangers = 0;
        foreach ($candidates as $candidate) {
            $refStatut = $candidate->getCurrentStatut();
            if ($refStatut->getCode() == "ATTESTATION_OK") {
                //number Men/Women
                if (strtolower($candidate->getUser()->getSexe()) == "homme") {
                    $numberMen = $numberMen + 1;
                } else {
                    $numberWomen = $numberWomen + 1;
                }
                //Number etranger
                if (strpos(strtolower($candidate->getUser()->getNationalite()->getIntituleFr()), 'tunis') !== false) {
                    $numberTunisien = $numberTunisien + 1;
                } else {
                    $numberEtrangers = $numberEtrangers + 1;
                }
            }
        }
        $result["number_candidat_qualifier"] = array(
            "number_women" => $numberWomen,
            "total" => $numberMen + $numberWomen,
        );
        return $result;
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "/mobile/professional_qualification_secteur",
     *     name="app_professional-qualification_public_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="gouvernorat",
     *     nullable=true,
     *     description="Code Gouvernorat to search for."
     * )
     * @Rest\QueryParam(
     *     name="annee",
     *     nullable=true,
     *     description="Year of project to search for."
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Edique"},
     *  summary="Get  professional qualification",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=SocioEconomicData::class, groups={"detailsEconomicData"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getProfessionnalQualificationPublicAction(Request $request)
    {
        $tabQualificationSecteur = [];
        $em = $this->getDoctrine()->getManager();
        $data = json_decode(json_encode($request->query->all()), true);
        $secteurs = $this->em()->getRepository('MfpeReferencielBundle:RefSecteur')->findBytypeSecteur(true);
        if (!empty($secteurs)) {
            foreach ($secteurs as $secteur) {
                $id = $secteur->getId();
                $data['secteur'] = $id;
                $candidates = $this->em()->getRepository('MfpeAttestationBundle:Demande')->getAllCandidates($data);
                $response = self::getProfessionnalQualificationPublic($data, $candidates);
                $tabQualificationSecteur[$id]=$response;

            }
        }


        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $tabQualificationSecteur], Response::HTTP_OK);
    }


    //return information condidate for the seconde periode
    private function getProfessionnalQualificationP2($data)
    {
        $result = array();
        $tabP2 = array();
        //Step1 : numbre of candidate
        $candidates = $this->em()->getRepository('MfpeAttestationBundle:Demande')->getAllCandidatesP2($data);
        $result = $this->getProfessionnalQualification($data, $candidates);
        if (isset($result) && !empty($result)) {
            foreach ($result as $key => $secondary) {
                if (is_array($secondary)) {
                    foreach ($secondary as $k => $sec) {
                        $newkey = $k . '_secondary';
                        $tabP2[$key][$newkey] = $sec;

                    }
                } else {
                    $newkey = $key . '_secondary';
                    $tabP2[$newkey] = $secondary;
                }
            }
        }
        return $tabP2;
    }

    //return National information condidate for the seconde periode
    private function getProfessionnalQualificationNationalP2($data)
    {

        //Step1 : numbre of candidate
        $candidates = $this->em()->getRepository('MfpeAttestationBundle:Demande')->getAllCandidatesNationalP2($data);
        $tabP2 = array();
        //Step1 : numbre of candidate
        $result = $this->getProfessionnalQualification($data, $candidates);
        if (isset($result) && !empty($result)) {
            foreach ($result as $key => $secondary) {
                if (is_array($secondary)) {
                    foreach ($secondary as $k => $sec) {
                        $newkey = $k . '_national';
                        $tabP2[$key][$newkey] = $sec;

                    }
                } else {
                    $newkey = $key . '_national';
                    $tabP2[$newkey] = $secondary;
                }
            }
        }
        return $tabP2;
    }

//getInstitutionEducative pour la premiere periode
    private function getInstitutionEducative($data)
    {
        $socioEconomicData = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:SocioEconomicData')->getInstitutionSanteWithPagination($data);
        $socioEconomicData = $this->get('jms_serializer')->serialize($socioEconomicData, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData', '')));
        $socioEconomicData = json_decode($socioEconomicData, JSON_UNESCAPED_UNICODE);
        return $socioEconomicData;
    }

//getInstitutionEducative pour la deuxieme periode
    private function getInstitutionEducativeP2($data)
    {
        $socioEconomicData = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:SocioEconomicData')->getInstitutionSanteWithPaginationP2($data);
        $socioEconomicData = $this->get('jms_serializer')->serialize($socioEconomicData, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData', '')));
        $socioEconomicData = json_decode($socioEconomicData, JSON_UNESCAPED_UNICODE);
        return $socioEconomicData;
    }

    private function getSocioEconomicStatisticGeneral($data)
    {
        $csvSocioEconomicData = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:CsvSocioEconomicData')->getCsvSocioEconomicDataWithPagination($data);
        return $csvSocioEconomicData;
    }

//merge two periode in one tab pour Institution Educative
    private function getMergeInstitutionEducative($data)
    {

        $infoSocioEconomic = '';
        $infoSocioEconomicSecondary = '';
        $em = $this->getDoctrine()->getManager();
        if (isset($data["year"]) && !empty($data["year"])) {
            $infoSocioEconomic = self::getInstitutionEducative($data);
        }
        if (isset($data["yearSecondary"]) && !empty($data["yearSecondary"])) {
            $infoSocioEconomicSecondary = self::getInstitutionEducativeP2($data);
        }
        $tab = [];
        $tabMerge = [];
        if (isset($infoSocioEconomicSecondary)) {
            foreach ($infoSocioEconomicSecondary as $key => $secondary) {
                foreach ($secondary as $k => $sec) {
                    if ($k != 'id') {
                        $newkey = $k . 'Secondary';
                        $tab[$key][$newkey] = $sec;
                    } else {
                        $newkey = $k;
                        $tab[$key][$newkey] = $sec;
                    }

                }
            }
        }
        if (isset($infoSocioEconomic) && !empty($infoSocioEconomic) && isset($tab) && !empty($tab)) {
            $tabMerge = $this->MergeIndexTabFormation($infoSocioEconomic, $tab);
        } elseif (isset($infoSocioEconomic) && !empty($infoSocioEconomic) && empty($tab)) {
            $tabMerge = $infoSocioEconomic;
        } elseif (empty($infoSocioEconomic) && isset($tab) && !empty($tab)) {
            $tabMerge = $tab;
        }
        $Result = $this->get('jms_serializer')->serialize($tabMerge, 'json', SerializationContext::create()->setGroups(array('detailPrivateTrainingCentre')));
        $Result = json_decode($Result, JSON_UNESCAPED_UNICODE);
        return $Result;
    }

//merge two periode in one tab socio Economic
    private function getMergeEtatiqueProfessionnel($data)
    {
        $infoEtatiqueProfessionnel = '';
        $infoEtatiqueProfessionnelSecondary = '';
        $em = $this->getDoctrine()->getManager();
        if (isset($data["year"]) && !empty($data["year"])) {
            $infoEtatiqueProfessionnel = $this->getEtatiqueProfessionnelEtatiqueInformation($data);
        }
        if (isset($data["yearSecondary"]) && !empty($data["yearSecondary"])) {
            $infoEtatiqueProfessionnelSecondary = $this->getEtatiqueProfessionnelP2Information($data);
        }
        $tab = [];
        $tabMerge = [];
        if (isset($infoEtatiqueProfessionnelSecondary)) {
            foreach ($infoEtatiqueProfessionnelSecondary as $key => $secondary) {
                $tab[$key] = $secondary;
                $tab[$key]['trainingCenter'] ['capaciteAccueilSecondary'] = $secondary['trainingCenter']['capaciteAccueil'];
                unset($tab[$key]['trainingCenter']['capaciteAccueil']);
                $tab[$key]['trainingCenter']['nombreFormateurSecondary'] = $secondary['trainingCenter']['nombreFormateur'];
                unset($tab[$key]['trainingCenter']['nombreFormateur']);
                $tab[$key]['trainingCenter'] ['nombreCadreAdministratifSecondary'] = $secondary['trainingCenter']['nombreCadreAdministratif'];
                unset($tab[$key]['trainingCenter']['nombreCadreAdministratif']);
                $tab[$key]['trainingCenter'] ['capaciteHebergementSecondary'] = $secondary['trainingCenter']['capaciteHebergement'];
                unset($tab[$key]['trainingCenter']['capaciteHebergement']);
                $tab[$key]['trainingCenter'] ['capaciteRestaurantSecondary'] = $secondary['trainingCenter']['capaciteRestaurant'];
                unset($tab[$key]['trainingCenter']['capaciteRestaurant']);
                $tab[$key]['nombreSpecialiteParCentreSecondary'] = $secondary['nombreSpecialiteParCentre'];
                unset($tab[$key]['nombreSpecialiteParCentre']);
            }
        }
        if (isset($infoEtatiqueProfessionnel) && !empty($infoEtatiqueProfessionnel) && isset($tab) && !empty($tab)) {
            $tabMerge = $this->MergeIndexTabFormationEtatique($infoEtatiqueProfessionnel, $tab);
        } elseif (isset($infoEtatiqueProfessionnel) && !empty($infoEtatiqueProfessionnel) && empty($tab)) {
            $tabMerge = $infoEtatiqueProfessionnel;
        } elseif (empty($infoEtatiqueProfessionnel) && isset($tab) && !empty($tab)) {
            $tabMerge = $tab;
        }
        $Result = $this->get('jms_serializer')->serialize($tabMerge, 'json', SerializationContext::create()->setGroups(array('detailPrivateTrainingCentre')));
        $Result = json_decode($Result, JSON_UNESCAPED_UNICODE);
        return $Result;
    }

//merge two periode in one tab socio Economic
    private function getMergeSocioEconomicStatistic($data)
    {
        $infoSocioEconomic = '';
        $infoSocioEconomicSecondary = '';
        $em = $this->getDoctrine()->getManager();
        if (isset($data["year"]) && !empty($data["year"])) {
            $infoSocioEconomic = $this->getSocioEconomicStatisticGeneral($data);
        }
        if (isset($data["yearSecondary"]) && !empty($data["yearSecondary"])) {
            $infoSocioEconomicSecondary = $this->getSocioEconomicStatisticGeneralP2($data);
        }
//        dd($infoSocioEconomicSecondary);
        $tab = [];
        $tabMerge = [];
        if (isset($infoSocioEconomicSecondary)) {
            foreach ($infoSocioEconomicSecondary as $key => $secondary) {
                foreach ($secondary as $k => $sec) {
                    if ($k != 'id') {
                        $newkey = $k . 'Secondary';
                        $tab[$key][$newkey] = $sec;
                    } else {
                        $newkey = $k;
                        $tab[$key][$newkey] = $sec;
                    }

                }
            }
        }
        if (isset($infoSocioEconomic) && !empty($infoSocioEconomic) && isset($tab) && !empty($tab)) {
            $tabMerge = $this->MergeIndexTabFormation($infoSocioEconomic, $tab);
        } elseif (isset($infoSocioEconomic) && !empty($infoSocioEconomic) && empty($tab)) {
            $tabMerge = $infoSocioEconomic;
        } elseif (empty($infoSocioEconomic) && isset($tab) && !empty($tab)) {
            $tabMerge = $tab;
        }
        $Result = $this->get('jms_serializer')->serialize($tabMerge, 'json', SerializationContext::create()->setGroups(array('detailPrivateTrainingCentre')));
        $Result = json_decode($Result, JSON_UNESCAPED_UNICODE);
        return $Result;
    }

//get result for second periode
    private function getSocioEconomicStatisticGeneralP2($data)
    {
        $csvSocioEconomicData = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:CsvSocioEconomicData')->getCsvSocioEconomicDataWithPaginationP2($data);
        return $csvSocioEconomicData;
    }


    private function getCSVStatistic($data)
    {
        $csvBTSStatisticData = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:CsvBTSData')->getCsvBTSDataWithPagination($data);
        return $csvBTSStatisticData;
    }

    // get Etatique Professionnel first period
    private function getEtatiqueProfessionnelEtatiqueInformation($data)
    {
        $em = $this->getDoctrine()->getManager();
        $sector = "true";
        $result = [];
        $infoPros = $em->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getGraduateTrainingEtatiqueByFiltre($data, $sector);
        $nombreSpecialite = $em->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getNombreSpecialityByCenter($data, $sector);

        if (!empty($infoPros) && !empty($nombreSpecialite)) {
            foreach ($nombreSpecialite as $key => $line) {
                array_push($result, array_merge($infoPros[$key], $line));
            }
        }
        $result = $this->get('jms_serializer')->serialize($result, 'json', SerializationContext::create()->setGroups(array('detailEtatiqueStatGraduateTraining')));
        $result = json_decode($result, JSON_UNESCAPED_UNICODE);
        return $result;
    }

    // get Etatique Professionnel second period
    private function getEtatiqueProfessionnelP2Information($data)
    {
        $em = $this->getDoctrine()->getManager();
        $sector = "true";
        $result = [];
        $infoPros = $em->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getGraduateTrainingEtatiqueByFiltreP2($data, $sector);
        $NombreSpecialite = $em->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getNombreSpecialityByCenterP2($data, $sector);
        if (!empty($infoPros) && !empty($NombreSpecialite)) {
            foreach ($NombreSpecialite as $key => $line) {
                array_push($result, array_merge($infoPros[$key], $line));
            }
        }
        $result = $this->get('jms_serializer')->serialize($result, 'json', SerializationContext::create()->setGroups(array('detailEtatiqueStatGraduateTraining')));
        $result = json_decode($result, JSON_UNESCAPED_UNICODE);
        return $result;
    }

    private function getEtatiqueProfessionnelInformation($data)
    {
        $em = $this->getDoctrine()->getManager();
        $sector = 1;
        $infoPros = $em->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getGraduateTrainingByGouvernorat($data, $sector);
        $infoPros = $this->get('jms_serializer')->serialize($infoPros, 'json', SerializationContext::create()->setGroups(array('detailEtatiqueStatGraduateTraining')));
        $infoPros = json_decode($infoPros, JSON_UNESCAPED_UNICODE);
        return $infoPros;
    }

    private function getTotalData()
    {
        //total delegations ,total municipalite,total population,total active population
        $nbtotaldelegation = count($this->getDoctrine()->getRepository('MfpeReferencielBundle:RefDelegation')->findAll());
        $nbtotalMunicipality = $this->getDoctrine()->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findMinicipalityInformation();
        $csvSocioEconomicData = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:CsvSocioEconomicData')->getTotalCsvSocioEconomicFunction();
        $totalAllDelegation = ['nbDelegations' => $nbtotaldelegation];
        $totalDelMunici = array_merge($totalAllDelegation, $nbtotalMunicipality);
        $totalAllGouvernoratTotal = array_merge($totalDelMunici, $csvSocioEconomicData);
        $total = $this->get('jms_serializer')->serialize($totalAllGouvernoratTotal, 'json', SerializationContext::create()->setGroups(array('regionGroup', 'descriptionGroup', 'cadreGroup', 'ReferencielGroup')));
        $total = json_decode($total, JSON_UNESCAPED_UNICODE);
        return $total;
    }

    private function getIdentityInformationTableData($data)
    {
        $identityRegion = $this->getDoctrine()->getManager()->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->getIdentityRegionByGouvernorat($data);
        if (isset($data["governorate"]) && !empty($data["governorate"])) {
            $governorat = trim($data["governorate"]);
            $structure = $this->getDoctrine()->getRepository('MfpeReferencielBundle:RefStructure')->findByIntituleFr("Direction regionale");
            $nbUser = count($this->getDoctrine()->getRepository('MfpeConfigBundle:AppUser')->findBy(array('structure' => $structure, 'gouvernorat' => $governorat), array('updatedAt' => 'DESC')));
            //   $nbdelegations = count($this->getDoctrine()->getRepository('MfpeReferencielBundle:RefDelegation')->findByParent($governorat));
            $csvSocioEconomicData = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:CsvSocioEconomicData')->getCsvSocioEconomicDataFunction($data);
            if (isset($nbUser)) {
                $tabNumber = ['nbEmployee' => $nbUser];

            }
        } else {
            $structure = $this->getDoctrine()->getRepository('MfpeReferencielBundle:RefStructure')->findByIntituleFr("Direction regionale");
            $nbUser = count($this->getDoctrine()->getRepository('MfpeConfigBundle:AppUser')->findByStructure($structure));
            $csvSocioEconomicData = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:CsvSocioEconomicData')->getCsvSocioEconomicDataFunction($data);
            $tabNumber = ['nbEmployee' => $nbUser];

        }

        $response = [];
        $identityResponse = [];
        $responseIdentitySocio = [];
        //parcourir les identite regional
        if (isset($identityRegion) && !empty($identityRegion)) {
            foreach ($identityRegion as $identity) {

                $nbdelegations = count($this->getDoctrine()->getRepository('MfpeReferencielBundle:RefDelegation')->findByParent($identity['gouvernorate']['id']));
                //mettre delegation dans un tableau
                $delegation = ['nbDelegations' => $nbdelegations];
                //parcourir csvSocioEconomic
                if (isset($csvSocioEconomicData) && !empty($csvSocioEconomicData)) {

                    foreach ($csvSocioEconomicData as $EconomicData) {

                        if ($identity['gouvernorate']['code'] === $EconomicData['codeGovernorat']) {

                            $identityResponse = array_merge($identity, $delegation);
                            $responseIdentitySocio[] = array_merge($identityResponse, $EconomicData);
                            break;
                        }

                        //tester si le code gouvernorat est different
                        //calculer le nombre de délegation pour chaque gouvernorat
                        if ($identity['gouvernorate']['code'] != $EconomicData['codeGovernorat']) {

                            $identityResponse = array_merge($identity, $delegation);
                            $EconomicData1 = ['populationSize' => 0, 'activePopulation' => 0, 'activePopulationOccupied' => 0
                                , 'unemployedPopulation' => 0, 'unemploymentRate' => 0];
                            $responseIdentitySocio[] = array_merge($identityResponse, $EconomicData1);
                            break;
                        }
                    }

                } else {
                    $identityResponse = array_merge($identity, $delegation);
                    $EconomicData1 = ['populationSize' => 0, 'activePopulation' => 0, 'activePopulationOccupied' => 0
                        , 'unemployedPopulation' => 0, 'unemploymentRate' => 0];
                    $responseIdentitySocio[] = array_merge($identityResponse, $EconomicData1);
                }
            }
        }
        foreach ($responseIdentitySocio as $responseIdenti) {
            $response[] = array_merge($responseIdenti, $tabNumber);
        }

        $identityRegion = $this->get('jms_serializer')->serialize($response, 'json', SerializationContext::create()->setGroups(array('regionGroup', 'descriptionGroup', 'cadreGroup', 'ReferencielGroup')));
        $identityRegion = json_decode($identityRegion, JSON_UNESCAPED_UNICODE);
        return $identityRegion;
    }


    private function getNumberPrivateTrainigCenter($data)
    {
        $em = $this->getDoctrine()->getManager();
        $infoPros = $em->getRepository('MfpeCollectDataBundle:PrivateTrainnigCenter')->getNumberPrivateTrainigCenterByGouvernorat($data);
        $infoPros = $this->get('jms_serializer')->serialize($infoPros, 'json', SerializationContext::create()->setGroups(array('detailPrivateTrainingCentre')));
        $infoPros = json_decode($infoPros, JSON_UNESCAPED_UNICODE);
        return $infoPros;
    }

    private function getNumberPrivateTrainigDataCenterPeriode1($data)
    {
        $infoPros = '';
        $em = $this->getDoctrine()->getManager();
        $infoPros = $em->getRepository('MfpeCollectDataBundle:PrivateTrainnigCenter')->getNumberPrivateTrainigCenterByFiltre($data);
        $Result = $this->get('jms_serializer')->serialize($infoPros, 'json', SerializationContext::create()->setGroups(array('detailPrivateTrainingCentre')));
        $Result = json_decode($Result, JSON_UNESCAPED_UNICODE);
        return $Result;
    }

    private function getNumberPrivateTrainigDataCenter($data)
    {
        $infoPros = '';
        $infoProsSecondary = '';
        $em = $this->getDoctrine()->getManager();
        if (isset($data["from"]) && !empty($data["from"]) && isset($data["to"]) && !empty($data["to"])) {
            $infoPros = $em->getRepository('MfpeCollectDataBundle:PrivateTrainnigCenter')->getNumberPrivateTrainigCenterByFiltre($data);
        }
        if (isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])) {
            $infoProsSecondary = $em->getRepository('MfpeCollectDataBundle:PrivateTrainnigCenter')->getNumberPrivateTrainigCenterSecondaryByFiltre($data);
        }
        $tab = [];
        $tabMerge = [];
        if (isset($infoProsSecondary)) {
            foreach ($infoProsSecondary as $key => $secondary) {
                $tab[$key] = $secondary;
                if (isset($secondary['initialNumber'])) {
                    $tab[$key]['initialNumberSecondary'] = $secondary['initialNumber'];
                    unset($tab[$key]['initialNumber']);
                }
                if (isset($secondary['continusNumber'])) {
                    $tab[$key]['continusNumberSecondary'] = $secondary['continusNumber'];
                    unset($tab[$key]['continusNumber']);
                }
                if (isset($secondary['initialContiusNumber'])) {
                    $tab[$key]['InitialContiusNumberSecondary'] = $secondary['initialContiusNumber'];
                    unset($tab[$key]['initialContiusNumber']);
                }
                if (isset($secondary['changeNumber'])) {
                    $tab[$key]['changeNumberSecondary'] = $secondary['changeNumber'];
                    unset($tab[$key]['changeNumber']);
                }
                if (isset($secondary['closedTrainingCenterNumber'])) {
                    $tab[$key]['closedTrainingCenterNumberSecondary'] = $secondary['closedTrainingCenterNumber'];
                    unset($tab[$key]['closedTrainingCenterNumber']);
                }
            }
        }
        if (isset($infoPros) && !empty($infoPros) && isset($tab) && !empty($tab)) {
            $tabMerge = $this->MergeIndexTabFormation($infoPros, $tab);
        } elseif (isset($infoPros) && !empty($infoPros) && empty($tab)) {
            $tabMerge = $infoPros;
        } elseif (empty($infoPros) && isset($tab) && !empty($tab)) {
            $tabMerge = $tab;
        }
        $Result = $this->get('jms_serializer')->serialize($tabMerge, 'json', SerializationContext::create()->setGroups(array('detailPrivateTrainingCentre')));
        $Result = json_decode($Result, JSON_UNESCAPED_UNICODE);
        return $Result;
    }

    private function getProfessionnelInformationData($data)
    {
        $sector = 0;
        $em = $this->getDoctrine()->getManager();
        $infoPros = $em->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getGraduateTrainingByGouvernorat($data, $sector);
        $infoPros = $this->get('jms_serializer')->serialize($infoPros, 'json', SerializationContext::create()->setGroups(array('detailStatGraduateTraining')));
        $infoPros = json_decode($infoPros, JSON_UNESCAPED_UNICODE);
        return $infoPros;

    }

    private function getProfessionnelInformationTableDataP1($data)
    {
        $em = $this->getDoctrine()->getManager();
        $infoPros = $em->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getGraduateTrainingByFiltre($data);
        $Result = $this->get('jms_serializer')->serialize($infoPros, 'json', SerializationContext::create()->setGroups(array('detailStatGraduateTraining')));
        $Result = json_decode($Result, JSON_UNESCAPED_UNICODE);
        return $Result;
    }

//return a liste of same index
    private function findSameResult($tab1, $tab2)
    {
        $tab5 = [];

//        $bigArray = sizeof($tab1) > sizeof($tab2) ? $tab1 : $tab2;
//        $smallArray = sizeof($tab1) <= sizeof($tab2) ? $tab1 : $tab2;
        if (sizeof($tab1) >= sizeof($tab2)) {
            $bigArray = $tab1;
            $smallArray = $tab2;
        } else {
            $bigArray = $tab2;
            $smallArray = $tab1;
        }
        foreach ($bigArray as $key => $value) {
            foreach ($smallArray as $k => $val) {
                if ($value['id'] == $val['id']) {
                    $index1 = $key;
                    $index2 = $k;
                    $tab5[$key] = ['index1' => $index1, 'index2' => $index2];
                    break;
                }
            }

        }
        return $tab5;
    }

//merge table for professional information
    private function MergeIndexTab($tab1, $tab2)
    {
        $tabMerge = [];
        $tab1Merge = [];
        $tab5 = [];
        if (sizeof($tab1) >= sizeof($tab2)) {
            $bigArray = $tab1;
            $smallArray = $tab2;
        } else {
            $bigArray = $tab2;
            $smallArray = $tab1;
        }
        //return a table of index same element into two table
        $tab5 = $this->findSameResult($bigArray, $smallArray);

        //faire le merge des deux table
        if (!empty($tab5)) {
            foreach ($tab5 as $p1 => $indice) {
                $tabMerge[$p1] = array_merge($bigArray[$tab5[$p1]['index1']], $smallArray[$tab5[$p1]['index2']]);
                //merge same table and levelStudy
                foreach ($bigArray[$tab5[$p1]['index1']]['levelStudy'] as $k => $level) {
                    $tabMerge[$p1]['levelStudy'][$k] = array_merge($level, $smallArray[$tab5[$p1]['index2']]['levelStudy'] [$k]);

                }
                //delete l'element qui se rèpete dans le premier tableau
                unset($bigArray[$tab5[$p1]['index1']]);
                //delete l'element qui se rèpete dans le deuxieme tableau
                unset($smallArray[$tab5[$p1]['index2']]);

            }
        }

//        //merge two table
        $tab1Merge = array_merge($bigArray, $smallArray);
        $tab1Merge = array_merge($tabMerge, $tab1Merge);
        return $tab1Merge;

    }

    private function MergeIndexTabFormationEtatique($tab1, $tab2)
    {
        $tabMerge = [];
        $tab1Merge = [];
        $tab5 = [];
        if (sizeof($tab1) >= sizeof($tab2)) {
            $bigArray = $tab1;
            $smallArray = $tab2;
        } else {
            $bigArray = $tab2;
            $smallArray = $tab1;
        }
        //return a table of index same element into two table
        $tab5 = $this->findSameResult($bigArray, $smallArray);

        //faire le merge des deux table
        if (!empty($tab5)) {
            foreach ($tab5 as $p1 => $indice) {
                //  dd($indice) ;

                $tabMerge[$p1] = array_merge($bigArray[$tab5[$p1]['index1']], $smallArray[$tab5[$p1]['index2']]);
                $tabMerge[$p1]['trainingCenter'] = array_merge($bigArray[$tab5[$p1]['index1']]['trainingCenter'], $smallArray[$tab5[$p1]['index2']]['trainingCenter']);

                //delete l'element qui se rèpete dans le premier tableau
                unset($bigArray[$tab5[$p1]['index1']]);
                //delete l'element qui se rèpete dans le deuxieme tableau
                unset($smallArray[$tab5[$p1]['index2']]);

            }
        }

//        //merge two table
        $tab1Merge = array_merge($bigArray, $smallArray);
        $tab1Merge = array_merge($tabMerge, $tab1Merge);
        return $tab1Merge;

    }

    private function MergeIndexTabFormation($tab1, $tab2)
    {
        $tabMerge = [];
        $tab1Merge = [];
        $tab5 = [];
        if (sizeof($tab1) >= sizeof($tab2)) {
            $bigArray = $tab1;
            $smallArray = $tab2;
        } else {
            $bigArray = $tab2;
            $smallArray = $tab1;
        }
        //return a table of index same element into two table
        $tab5 = $this->findSameResult($bigArray, $smallArray);
        //faire le merge des deux table
        if (!empty($tab5)) {
            foreach ($tab5 as $p1 => $indice) {
                $tabMerge[$p1] = array_merge($bigArray[$tab5[$p1]['index1']], $smallArray[$tab5[$p1]['index2']]);
                //delete l'element qui se rèpete dans le premier tableau
                unset($bigArray[$tab5[$p1]['index1']]);
                //delete l'element qui se rèpete dans le deuxieme tableau
                unset($smallArray[$tab5[$p1]['index2']]);

            }
        }

//        //merge two table
        $tab1Merge = array_merge($bigArray, $smallArray);
        $tab1Merge = array_merge($tabMerge, $tab1Merge);
        return $tab1Merge;

    }

//return professional information for the second period
    private function getProfessionnelInformationTableDataP1P2($data)
    {
        $infoPros = '';
        $infoProsSecondary = '';
        $em = $this->getDoctrine()->getManager();
        if (isset($data["from"]) && !empty($data["from"]) && isset($data["to"]) && !empty($data["to"])) {
            $infoPros = $em->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getGraduateTrainingByFiltre($data);
        }
        if (isset($data["fromSecondary"]) && !empty($data["fromSecondary"]) && isset($data["toSecondary"]) && !empty($data["toSecondary"])) {
            $infoProsSecondary = $em->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getGraduateTrainingByFiltrePeriode2($data);
            //  $infoProsNational = $em->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getTotalGraduateTrainingByFiltrePeriode2($data);;
        }

        $tab = [];
        $tabMerge = [];
        if (isset($infoProsSecondary) && !empty($infoProsSecondary)) {
            foreach ($infoProsSecondary as $key => $secondary) {
                {
                    $tab[$key] = $secondary;
                    foreach ($secondary['levelStudy'] as $k => $level) {
                        $tab[$key]['levelStudy'] [$k]['nbrTrainedFSecondary'] = $level['nbrTrainedF'];
                        unset($tab[$key]['levelStudy'][$k]['nbrTrainedF']);
                        $tab[$key]['levelStudy'] [$k]['nbrTrainedHSecondary'] = $level['nbrTrainedH'];
                        unset($tab[$key]['levelStudy'][$k]['nbrTrainedH']);
                        $tab[$key]['levelStudy'] [$k]['nbrForeignerSecondary'] = $level['nbrForeigner'];
                        unset($tab[$key]['levelStudy'][$k]['nbrForeigner']);
                        $tab[$key]['levelStudy'] [$k]['nbrAbundantSecondary'] = $level['nbrAbundant'];
                        unset($tab[$key]['levelStudy'][$k]['nbrAbundant']);
                        $tab[$key]['levelStudy'] [$k]['nbrTotalSecondary'] = $level['nbrTotal'];
                        unset($tab[$key]['levelStudy'][$k]['nbrTotal']);
                        $tab[$key]['levelStudy'] [$k]['levelSecondary'] = $level['level'];
                        unset($tab[$key]['levelStudy'][$k]['level']);
                    }
                }

            }
        }
        if (isset($infoPros) && !empty($infoPros) && isset($tab) && !empty($tab)) {
            $tabMerge = $this->MergeIndexTab($infoPros, $tab);
            //infoPros check if from--> to return result
            ////tab check if fromSecondary and toSecondary  return null
        } elseif (isset($infoPros) && !empty($infoPros) && empty($tab)) {
            $tabMerge = $infoPros;
            //infoPros check if from--> to return null
            ////tab check if fromSecondary and toSecondary  return result
        } elseif (empty($infoPros) && isset($tab) && !empty($tab)) {
            $tabMerge = $tab;
        }
//dd($tabMerge);
        $Result = $this->get('jms_serializer')->serialize($tabMerge, 'json', SerializationContext::create()->setGroups(array('detailStatGraduateTraining')));
        $Result = json_decode($Result, JSON_UNESCAPED_UNICODE);
        return $Result;
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "/projets_publics",
     *     name="app_projets-publics_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="gouvernorat",
     *     nullable=true,
     *     description="gouvernorat to search for."
     * )
     * @Rest\QueryParam(
     *     name="delegation",
     *     nullable=true,
     *     description="delegation to search for."
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Edique"},
     *  summary="Get projets publics",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=ProjectDataCsv::class, groups={"projetCsv"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getProjectAction(Request $request)
    {

        $data = json_decode(json_encode($request->query->all()), true);
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
        $response = self::getProjectData($data);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);
    }

    private function getProjectData($data)
    {

        $em = $this->getDoctrine()->getManager();
        $listeProjet = $em->getRepository('MfpeCollectDataBundle:ProjectDataCsv')->getProjectDataByFiltre($data);
        $listeProjet = $this->get('jms_serializer')->serialize($listeProjet, 'json', SerializationContext::create()->setGroups(array('projetCsv', 'ReferencielGroup')));
        $listeProjet = json_decode($listeProjet, JSON_UNESCAPED_UNICODE);
        return $listeProjet;

    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsBTS"})
     * @Rest\Get(
     *     path = "/BTS/csv",
     *     name="app_socio-economic-statictic-general_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="gouvernorat",
     *     nullable=true,
     *     description="gouvernorat to search for."
     * )
     * @Rest\QueryParam(
     *     name="annee",
     *     nullable=true,
     *     description="annee to search for."
     * )
     * @Rest\QueryParam(
     *     name="secteur",
     *     nullable=true,
     *     description="secteur to search for."
     * )
     * @Rest\QueryParam(
     *     name="niveau",
     *     nullable=true,
     *     description="niveau to search for."
     * )
     * @Rest\QueryParam(
     *     name="genre",
     *     nullable=true,
     *     description="genre to search for."
     * )
     * @Rest\QueryParam(
     *     name="nature_projet",
     *     nullable=true,
     *     description="nature_projet to search for."
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Edique"},
     *  summary="Get static general socio economic",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=CsvBTSData::class, groups={"detailsBTS"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getCSVStatisticAction(Request $request)
    {
        try {
            $data = json_decode(json_encode($request->query->all()), true);
//            if (null === $token = $this->container->get('security.token_storage')->getToken()) {
//                $message = ApiProblem::TOKEN_JWT_EXPIRED;
//                $errors['token'] = $message;
//                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//            }
//            if (!is_object($user = $token->getUser())) {
//                // e.g. anonymous authentication
//                $message = ApiProblem::TOKEN_JWT_EXPIRED;
//                $errors['token'] = $message;
//                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//            }
            $response = $this->getCSVStatistic($data);
            $response = $this->get('jms_serializer')->serialize($response, 'json', SerializationContext::create()->setGroups(array('detailsBTS', 'ReferencielGroup')));
            $response = json_decode($response, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }
}