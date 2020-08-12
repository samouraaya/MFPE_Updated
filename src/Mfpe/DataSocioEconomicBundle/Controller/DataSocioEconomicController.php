<?php

namespace Mfpe\DataSocioEconomicBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use Mfpe\DataSocioEconomicBundle\Entity\SocioEconomicData;
use Mfpe\DataSocioEconomicBundle\Entity\UniteRegionale;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\DataSocioEconomicBundle\Validator\ValidateSocioEconomicData;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializationContext;
use Mfpe\ConfigBundle\Controller\BaseController;

class DataSocioEconomicController extends BaseController
{
    use ControllerTrait;


    /**
     * @Rest\Post(
     *     path = "/economic_data",
     *     name = "app_economic-data_Add"
     * )
     * @SWG\Post(
     *  tags={"Socio Economic data"},
     *  summary="insert Socio Economic Data",
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
     *              @SWG\Property(property="health_institution_number", type="string", example="12345678999"),
     *              @SWG\Property(property="health_institution_year", type="integer", example=2020),
     *              @SWG\Property(property="school_institution_number", type="string", example="12345678999"),
     *              @SWG\Property(property="school_institution_year", type="integer", example=2020),
     *              @SWG\Property(property="university_institution_number", type="string", example="12345678999"),
     *              @SWG\Property(property="institution_university_year", type="integer", example=2020),
     *              @SWG\Property(property="dropout_school_number", type="string", example="12345678999"),
     *              @SWG\Property(property="dropout_school_year", type="integer", example=2020),
     *              @SWG\Property(property="needy_family_number", type="string", example="12345678999"),
     *              @SWG\Property(property="needy_family_year", type="integer", example=2020),
     *              @SWG\Property(property="association_number", type="string", example="12345678999"),
     *              @SWG\Property(property="association_year", type="integer", example=2020),
     *              @SWG\Property(property="description", type="string", example="Boulangerie"),
     *              @SWG\Property(property="current_project", type="string", example="ProjetA"),
     *              @SWG\Property(
     *                  property="direction_regionale",
     *                  title="Direction regionale",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *          )
     *      ),
     * )
     */

    public function postAction(Request $request)
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
            $data = json_decode($request->getContent(), true);
            $em = $this->getDoctrine()->getManager();
            $validator = New ValidateSocioEconomicData($em);
            $errors = $validator->validateSocioEconomicData($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $SocioEconomicData = new SocioEconomicData();
            $SocioEconomicData->setHealthInstitutionNumber($data["health_institution_number"]);
            $SocioEconomicData->setHealthInstitutionYear($data["health_institution_year"]);
            $SocioEconomicData->setSchoolInstitutionNumber($data["school_institution_number"]);
            $SocioEconomicData->setSchoolInstitutionYear($data["school_institution_year"]);
            $SocioEconomicData->setUniversityInstitutionNumber($data["university_institution_number"]);
            $SocioEconomicData->setInstitutionUniversityYear($data["institution_university_year"]);
            $SocioEconomicData->setDropoutSchoolNumber($data["dropout_school_number"]);
            $SocioEconomicData->setDropoutSchoolYear($data["dropout_school_year"]);
            $SocioEconomicData->setNeedyFamilyNumber($data["needy_family_number"]);
            $SocioEconomicData->setNeedyFamilyYear($data["needy_family_year"]);
            $SocioEconomicData->setAssociationNumber($data["association_number"]);
            $SocioEconomicData->setAssociationYear($data["association_year"]);
            $SocioEconomicData->setDescription($data["description"]);
            $SocioEconomicData->setCurrentProject($data["current_project"]);
            $direction_regionale = $em->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array('id' => $data["direction_regionale"]["id"]));
            $SocioEconomicData->setDirectionRegional($direction_regionale);
            $em->persist($SocioEconomicData);
            $em->flush();
            $SocioEconomicData = $this->get('jms_serializer')->serialize($SocioEconomicData, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailsEconomicData')));
            $SocioEconomicData = json_decode($SocioEconomicData, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $SocioEconomicData], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @Rest\View(serializerGroups={"detailsEconomicData"})
     * @Rest\Put(
     *     path = "/economic_data/{id}",
     *     name = "app_economic-data_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"Data"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"Socio Economic data"},
     *  summary="edit Socio Economic data",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="EconomicData",
     *     in="path",
     *     description="Socio EconomicData id",
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
     *              @SWG\Property(property="health_institution_number", type="integer", example="20"),
     *              @SWG\Property(property="health_institution_year", type="integer", example="2020"),
     *              @SWG\Property(property="school_institution_number", type="integer", example="50"),
     *              @SWG\Property(property="school_institution_year", type="integer", example="2020"),
     *              @SWG\Property(property="university_institution_number", type="integer", example="50"),
     *              @SWG\Property(property="institution_university_year", type="integer", example="2020"),
     *              @SWG\Property(property="dropout_school_number", type="integer", example="50"),
     *              @SWG\Property(property="dropout_school_year", type="integer", example="2020"),
     *              @SWG\Property(property="needy_family_number", type="integer", example="50"),
     *              @SWG\Property(property="needy_family_year", type="integer", example="2020"),
     *              @SWG\Property(property="association_number", type="integer", example="50"),
     *              @SWG\Property(property="association_year", type="integer", example="2020"),
     *              @SWG\Property(property="description", type="string", example="Boulangerie"),
     *              @SWG\Property(property="current_project", type="string", example="ProjetB"),
     *              @SWG\Property(
     *                  property="direction_regionale",
     *                  title="Direction regionale",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *          )
     *      ),
     * )
     * @SWG\Response(response="200", description="Returned when Resource modified",
     * @SWG\Schema(type="array", @Model(type=SocioEconomicData::class, groups={"detailsEconomicData"}))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function updateAction(?SocioEconomicData $SocioEconomicData, Request $request)
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
            $error_global = ApiProblem::MESSAGE_GLOBAL;
            if (empty($SocioEconomicData)) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['SocioEconomicData'] = $message;
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $error_global, 'data' => $errors], Response::HTTP_BAD_REQUEST);
            }
            $data = json_decode($request->getContent(), true);
            $em = $this->getDoctrine()->getManager();
            $validator = New ValidateSocioEconomicData($em);
            $errors = $validator->ValidateSocioEconomicData($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $direction_regionale = $em->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array('id' => $data["direction_regionale"]["id"]));
            $SocioEconomicData->setDirectionRegional($direction_regionale);
            $SocioEconomicData->setHealthInstitutionNumber($data["health_institution_number"]);
            $SocioEconomicData->setHealthInstitutionYear($data["health_institution_year"]);
            $SocioEconomicData->setSchoolInstitutionNumber($data["school_institution_number"]);
            $SocioEconomicData->setSchoolInstitutionYear($data["school_institution_year"]);
            $SocioEconomicData->setUniversityInstitutionNumber($data["university_institution_number"]);
            $SocioEconomicData->setInstitutionUniversityYear($data["institution_university_year"]);
            $SocioEconomicData->setDropoutSchoolNumber($data["dropout_school_number"]);
            $SocioEconomicData->setDropoutSchoolYear($data["dropout_school_year"]);
            $SocioEconomicData->setNeedyFamilyNumber($data["needy_family_number"]);
            $SocioEconomicData->setNeedyFamilyYear($data["needy_family_year"]);
            $SocioEconomicData->setAssociationNumber($data["association_number"]);
            $SocioEconomicData->setAssociationYear($data["association_year"]);
            $SocioEconomicData->setDescription($data["description"]);
            $SocioEconomicData->setCurrentProject($data["current_project"]);
            $em->flush();
            $SocioEconomicData = $this->get('jms_serializer')->serialize($SocioEconomicData, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailsEconomicData')));
            $SocioEconomicData = json_decode($SocioEconomicData, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $SocioEconomicData], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Delete(
     *     path = "economic_data/{id}",
     *     name="app_economic-data_Delete",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"Socio Economic data"},
     *  summary="delete Socio Economic data",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Socio Economic data id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Response(response="200", description="Returned when Resource deleted",
     * @SWG\Schema(type="array", @Model(type=SocioEconomicData::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function deleteSocioEconomicDataAction($id)
    {
        try {
            $SocioEconomicData = $this->em()->getRepository('MfpeDataSocioEconomicBundle:SocioEconomicData')->find($id);
            //Check if the  SocioEconomicData exist. Return 404 if not.
            if ($SocioEconomicData === null) {
                $message = ApiProblem::SOCIO_ECONOMIC_DATA_DOES_NOT_EXIST;
                $errors['SocioEconomicData'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_NOT_FOUND, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            //Remove the data from the database
            $this->em()->remove($SocioEconomicData);
            //dd($this->em()->remove($SocioEconomicData));
            $this->em()->flush();
            //return 200 success response with all the users
            $SocioEconomicData = $this->em()->getRepository('MfpeDataSocioEconomicBundle:SocioEconomicData')->findAll();
            $SocioEconomicData = $this->get('jms_serializer')->serialize($SocioEconomicData, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailsEconomicData')));
            $SocioEconomicData = json_decode($SocioEconomicData, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $SocioEconomicData], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "/economic_data/{id}",
     *     name="app_Economic_Get",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Get(
     *  tags={"Socio Economic data"},
     *  summary="Get the data with id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="data id",
     *     required=true
     * ),
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=SocioEconomicData::class, groups={"detailsEconomicData"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getDetailDataAction($id)
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
            $SocioEconomicData = $this->em()->getRepository('MfpeDataSocioEconomicBundle:SocioEconomicData')->find($id);
            if (!$SocioEconomicData) {
                $message = ApiProblem::SOCIO_ECONOMIC_DATA_DOES_NOT_EXIST;
                $errors['SocioEconomicData'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $SocioEconomicData = $this->get('jms_serializer')->serialize($SocioEconomicData, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData')));
            $SocioEconomicData = json_decode($SocioEconomicData, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $SocioEconomicData], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "/economic_data",
     *     name="app_socio-economic_Get",
     *     options={ "method_prefix" = false },
     * )
     * @SWG\Get(
     *  tags={"Socio Economic data"},
     *  summary="Get All",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=SocioEconomicData::class, groups={"detailsEconomicData"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getAllAction()
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
            $SocioEconomicData = $this->em()->getRepository('MfpeDataSocioEconomicBundle:SocioEconomicData')->findAll();
            $SocioEconomicData = $this->get('jms_serializer')->serialize($SocioEconomicData, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData')));
            $SocioEconomicData = json_decode($SocioEconomicData, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $SocioEconomicData], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


}

