<?php

namespace Mfpe\CollectDataBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use Mfpe\CentreFormationBundle\Entity\CentreFormation;
use Mfpe\CentreFormationBundle\Validator\ValidateCreateCentreFormation;
use Mfpe\CollectDataBundle\Entity\PrivateTrainnigCenter;
use Mfpe\CollectDataBundle\Entity\StatGraduateTraining;
use Mfpe\CollectDataBundle\Validator\ValidateCreateTrainingCentre;
use Mfpe\CollectDataBundle\Validator\ValidateCreateStatGraduateTraining;
use Mfpe\CollectDataBundle\Entity\LevelStudy;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializationContext;
use Mfpe\ConfigBundle\Controller\BaseController;

/**
 * Description of CollectDataController
 *
 * @author Wiem Hadiji
 */
class CollectDataController extends BaseController {

    use ControllerTrait;

    /**
     * @Rest\Post(
     *     path = "/graduate_training",
     *     name = "app_graduate-training_Add"
     * )
     * @SWG\Post(
     *  tags={"Collect Data"},
     *  summary="Create graduate and training",
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
     *              @SWG\Property(
     *                  property="training_center",
     *                  title="training center",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *              @SWG\Property(
     *                  property="sector",
     *                  title="sector",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *              @SWG\Property(
     *                  property="subsector",
     *                  title="subsector",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *              @SWG\Property(
     *                  property="speciality",
     *                  title="speciality",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *              @SWG\Property(property="approved", type="boolean", example=true),
     *              @SWG\Property(property="administrative_year", type="integer", example=2020),
     *              @SWG\Property(property="month", type="integer", example=05),
     *              @SWG\Property(
     *                  property="level_study",
     *                  type="array",
     *                  @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="nbr_trained_f", type="integer", example=75),
     *                      @SWG\Property(property="nbr_trained_h", type="integer", example=75),
     *                      @SWG\Property(property="nbr_foreigner", type="integer", example=75),
     *                      @SWG\Property(property="nbr_abundant", type="integer", example=75),
     *                      @SWG\Property(property="nbr_total", type="integer", example=75),
     *                      @SWG\Property(property="level", type="integer", example="0,1,2"),
     *                  ),
     *              ),
     *              @SWG\Property(property="sector_type", type="string", example=true),
     *          )
     *      ),
     * )
     */
    public function postAction(Request $request) {
        try {
            if (null === $token = $this->container->get('security.token_storage')->getToken()) {
                $message         = ApiProblem::TOKEN_JWT_EXPIRED;
                $errors['token'] = $message;
                $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            if (!is_object($user = $token->getUser())) {
                // e.g. anonymous authentication
                $message         = ApiProblem::TOKEN_JWT_EXPIRED;
                $errors['token'] = $message;
                $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $data      = json_decode($request->getContent(), true);
            $em        = $this->getDoctrine()->getManager();
            $validator = New ValidateCreateStatGraduateTraining($em);
            $errors    = $validator->validateCreateStatGraduateTraining($data);

            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $statGraduateTraining = new StatGraduateTraining();
            $training_center      = $em->getRepository('MfpeCentreFormationBundle:CentreFormation')->find($data["training_center"]["id"]);
            $statGraduateTraining->setTrainingCenter($training_center);
            $sector               = $em->getRepository('MfpeReferencielBundle:RefSecteur')->find($data["sector"]["id"]);
            $statGraduateTraining->setSector($sector);
            $subsector            = $em->getRepository('MfpeReferencielBundle:RefSousSecteur')->find($data["subsector"]["id"]);
            $statGraduateTraining->setSubsector($subsector);
            $speciality           = $em->getRepository('MfpeCentreFormationBundle:Specialite')->find($data["speciality"]["id"]);
            $statGraduateTraining->setSpeciality($speciality);
            $statGraduateTraining->setApproved($data["approved"]);
            $statGraduateTraining->setAdministrativeYear($data["administrative_year"]);
            $statGraduateTraining->setMonth($data["month"]);
            $date='01'.'-'.$data["month"].'-'.$data["administrative_year"];
            $dateStatGraduateTraining = new \DateTime($date);
            $statGraduateTraining->setDateStatGraduateTraining($dateStatGraduateTraining);
            $statGraduateTraining->setSectorType($data["sector_type"]);
            $em->persist($statGraduateTraining);
            foreach ($data["level_study"] as $level) {
                $levelStudy = new LevelStudy();
                $levelStudy->setNbrTrainedH($level["nbr_trained_h"]);
                $levelStudy->setNbrTrainedF($level["nbr_trained_f"]);
                $levelStudy->setNbrForeigner($level["nbr_foreigner"]);
                if (isset($level["nbr_abundant"])) {
                    $levelStudy->setNbrAbundant($level["nbr_abundant"]);
                }
                $levelStudy->setNbrTotal($level["nbr_total"]);
                $levelStudy->setLevel($level["level"]);
                $levelStudy->setStatGraduateTraining($statGraduateTraining);
                $em->persist($levelStudy);
            }
            $em->flush();
            $statGraduateTraining = $this->get('jms_serializer')->serialize($statGraduateTraining, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailStatGraduateTraining', 'ReferencielGroup', 'detailCentreFormation')));
            $statGraduateTraining = json_decode($statGraduateTraining, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $statGraduateTraining], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\Post(
     *     path = "/private_training_center",
     *     name = "app_private-center_Add"
     * )
     * @SWG\Post(
     *  tags={"Collect Data"},
     *  summary="Create Private training Center",
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
     *              @SWG\Property(property="year", type="integer", example=2020),
     *              @SWG\Property(property="initial_number", type="integer", example=20),
     *              @SWG\Property(property="continus_number", type="integer", example=50),
     *              @SWG\Property(property="initial_continus_number", type="integer", example=50),
     *              @SWG\Property(property="change_number", type="integer", example=50),
     *              @SWG\Property(property="closed_training_center_number", type="integer", example=50),
     *              @SWG\Property(
     *                  property="gouvernorat",
     *                  title="gouvernorat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=85),
     *              ),
     *              @SWG\Property(property="month", type="integer", example=02),
     *          )
     *      ),
     * )
     */
    public function postPrivateTrainigCenterAction(Request $request) {
        try {
            if (null === $token = $this->container->get('security.token_storage')->getToken()) {
                $message         = ApiProblem::TOKEN_JWT_EXPIRED;
                $errors['token'] = $message;
                $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            if (!is_object($user = $token->getUser())) {
                // e.g. anonymous authentication
                $message         = ApiProblem::TOKEN_JWT_EXPIRED;
                $errors['token'] = $message;
                $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $data      = json_decode($request->getContent(), true);
            $em        = $this->getDoctrine()->getManager();
            $validator = New ValidateCreateTrainingCentre($em);
            $errors    = $validator->ValidateCreateTrainingCentre($data);

            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $privateTrainnigCenter = new PrivateTrainnigCenter();
            $gouvernorat           = $em->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["gouvernorat"]["id"]);
            $privateTrainnigCenter->setGovernorat($gouvernorat);
            $privateTrainnigCenter->setYear($data["year"]);
            $privateTrainnigCenter->setMonth($data["month"]);
            $date='01'.'-'.$data["month"].'-'.$data["year"];
            $datePrivateTrainingCenter = new \DateTime($date);
            $privateTrainnigCenter->setDatePrivateTrainingCenter($datePrivateTrainingCenter);
            $privateTrainnigCenter->setInitialNumber($data["initial_number"]);
            $privateTrainnigCenter->setContinusNumber($data["continus_number"]);
            $privateTrainnigCenter->setInitialContiusNumber($data["initial_continus_number"]);
            $privateTrainnigCenter->setChangeNumber($data["change_number"]);
            $privateTrainnigCenter->setChangeNumber($data["change_number"]);
            $privateTrainnigCenter->setClosedTrainingCenterNumber($data["closed_training_center_number"]);
            $em->persist($privateTrainnigCenter);
            $em->flush();
            $privateTrainnigCenter = $this->get('jms_serializer')->serialize($privateTrainnigCenter, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailTrainingCentre')));
            $privateTrainnigCenter = json_decode($privateTrainnigCenter, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $privateTrainnigCenter], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(serializerGroups={"detailTrainingCentre"})
     * @Rest\Put(
     *     path = "/private_training_center/{id}",
     *     name = "app_private-center_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"TrainigCenter"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"Collect Data"},
     *  summary="edit private Trainig center",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="PrivateTrainigCenter",
     *     in="path",
     *     description="PrivateTrainigCenter id",
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
     *              @SWG\Property(property="year", type="integer", example=2013),
     *              @SWG\Property(property="initial_number", type="integer", example=20),
     *              @SWG\Property(property="continus_number", type="integer", example=30),
     *              @SWG\Property(property="initial_continus_number", type="integer", example=30),
     *              @SWG\Property(property="change_number", type="integer", example=30),
     *              @SWG\Property(property="closed_training_center_number", type="integer", example=30),
     *              @SWG\Property(
     *                  property="gouvernorat",
     *                  title="gouvernorat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=33),
     *              ),
     *              @SWG\Property(property="month", type="integer", example=05),
     *          )
     *
     *      ),
     * )
     * @SWG\Response(response="200", description="Returned when Resource modified",
     * @SWG\Schema(type="array", @Model(type=PrivateTrainnigCenter::class, groups={"detailTrainingCentre"}))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function updateTraingCenterAction(?PrivateTrainnigCenter $privateTrainnigCenter, Request $request) {
        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            $message         = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            $message         = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        $error_global = ApiProblem::MESSAGE_GLOBAL;
        if (empty($privateTrainnigCenter)) {
            $message                         = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['privateTrainnigCenter'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $error_global, 'data' => $errors], Response::HTTP_BAD_REQUEST);
        }
        $data = json_decode($request->getContent(), true);

        $em        = $this->getDoctrine()->getManager();
        $validator = New ValidateCreateTrainingCentre($em);
        $errors    = $validator->ValidateCreateTrainingCentre($data);

        if ($errors) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }

        $gouvernorat           = $em->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["gouvernorat"]["id"]);
        $privateTrainnigCenter->setGovernorat($gouvernorat);
        $privateTrainnigCenter->setYear($data["year"]);
        $privateTrainnigCenter->setMonth($data["month"]);
        $date='01'.'-'.$data["month"].'-'.$data["year"];
        $datePrivateTrainingCenter = new \DateTime($date);
        $privateTrainnigCenter->setDatePrivateTrainingCenter($datePrivateTrainingCenter);
        $privateTrainnigCenter->setInitialNumber($data["initial_number"]);
        $privateTrainnigCenter->setContinusNumber($data["continus_number"]);
        $privateTrainnigCenter->setInitialContiusNumber($data["initial_continus_number"]);
        $privateTrainnigCenter->setChangeNumber($data["change_number"]);
        $privateTrainnigCenter->setChangeNumber($data["change_number"]);
        $privateTrainnigCenter->setClosedTrainingCenterNumber($data["closed_training_center_number"]);
        $em->flush();
        $privateTrainnigCenter = $this->get('jms_serializer')->serialize($privateTrainnigCenter, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailTrainingCentre')));
        $privateTrainnigCenter = json_decode($privateTrainnigCenter, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $privateTrainnigCenter], Response::HTTP_OK);
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailTrainingCentre"})
     * @Rest\Get(
     *     path = "/private_training_center/",
     *     name="app_TrainingCentre_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Collect Data"},
     *  summary="Get  all Private Training Centre",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=PrivateTrainnigCenter::class, groups={"detailTrainingCentre"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getTrainingCentreAction() {
        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            $message         = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            $message         = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        $privateTrainnigCenter = $this->getDoctrine()->getRepository('MfpeCollectDataBundle:PrivateTrainnigCenter')->findAll();


        $privateTrainnigCenter = $this->get('jms_serializer')->serialize($privateTrainnigCenter, 'json', SerializationContext::create()->setGroups(array('detailTrainingCentre')));
        $privateTrainnigCenter = json_decode($privateTrainnigCenter, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $privateTrainnigCenter], Response::HTTP_OK);
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailTrainingCentre"})
     * @Rest\Delete(
     *     path = "/private_training_center/{id}",
     *     name="app_TrainingCentre_Delete",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"Collect Data"},
     *  summary="delete Private Training Centre",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="TrainingCentre id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Response(response="200", description="Returned when Resource deleted",@SWG\Schema(type="array", @Model(type=PrivateTrainnigCenter::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function deletePrivateTrainnigCenterAction($id) {
        try {

            $PrivateTrainnigCenter = $this->em()->getRepository('MfpeCollectDataBundle:PrivateTrainnigCenter')->find($id);

            //Check if the center exist. Return 404 if not.
            if ($PrivateTrainnigCenter === null) {
                $message                         = ApiProblem::PRIVATE_TRAINIG_CENTER_DOES_NOT_EXIST;
                $errors['PrivateTrainnigCenter'] = $message;
                $errors                          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_NOT_FOUND, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            //Remove the role from the database
            $this->em()->remove($PrivateTrainnigCenter);
            //dd($this->em()->remove($PrivateTrainnigCenter));
            $this->em()->flush();
            //return 200 success response with all the users
            $PrivateTrainnigCenter = $this->em()->getRepository('MfpeCollectDataBundle:PrivateTrainnigCenter')->findAll();
            $PrivateTrainnigCenter = $this->get('jms_serializer')->serialize($PrivateTrainnigCenter, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailTrainingCentre')));
            $PrivateTrainnigCenter = json_decode($PrivateTrainnigCenter, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $PrivateTrainnigCenter], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => ApiProblem::MESSAGE_EXCEPTION, 'message' => ApiProblem::MESSAGE_EXCEPTION], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * @Rest\View(serializerGroups={"detailStatGraduateTraining"})
     * @Rest\Put(
     *     path = "/graduate_training/{id}",
     *     name = "app_graduate-training_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"graduateTraining"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"Collect Data"},
     *  summary="edit graduate and training",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="graduateTraining",
     *     in="path",
     *     description="graduateTraining id",
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
     *              @SWG\Property(
     *                  property="training_center",
     *                  title="training center",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *              @SWG\Property(
     *                  property="sector",
     *                  title="sector",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *              @SWG\Property(
     *                  property="subsector",
     *                  title="subsector",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *              @SWG\Property(
     *                  property="speciality",
     *                  title="speciality",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *              @SWG\Property(property="approved", type="boolean", example=true),
     *              @SWG\Property(property="administrative_year", type="integer", example=2020),
     *              @SWG\Property(property="month", type="integer", example=12),
     *              @SWG\Property(
     *                  property="level_study",
     *                  type="array",
     *                  @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="nbr_trained_f", type="integer", example=75),
     *                      @SWG\Property(property="nbr_trained_h", type="integer", example=75),
     *                      @SWG\Property(property="nbr_foreigner", type="integer", example=75),
     *                      @SWG\Property(property="nbr_abundant", type="integer", example=75),
     *                      @SWG\Property(property="nbr_total", type="integer", example=75),
     *                      @SWG\Property(property="level", type="string", example="1,2,0"),
     *                  ),
     *              ),
     *              @SWG\Property(property="sector_type", type="string", example="true"),
     *          )
     *
     *      ),
     * )
     * @SWG\Response(response="200", description="Returned when Resource modified",@SWG\Schema(type="array", @Model(type=StatGraduateTraining::class, groups={"detailStatGraduateTraining"}))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function updateAction(?StatGraduateTraining $statGraduateTraining, Request $request) {

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            $message         = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            $message         = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        $error_global = ApiProblem::MESSAGE_GLOBAL;
        if (empty($statGraduateTraining)) {
            $message                        = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['statGraduateTraining'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $error_global, 'data' => $errors], Response::HTTP_BAD_REQUEST);
        }
        $data      = json_decode($request->getContent(), true);
        $em        = $this->getDoctrine()->getManager();
        $validator = New ValidateCreateStatGraduateTraining($em);
        $errors    = $validator->validateCreateStatGraduateTraining($data);
        if ($errors) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }

        $trainingCenter = $em->getRepository('MfpeCentreFormationBundle:CentreFormation')->find($data["training_center"]["id"]);
        $statGraduateTraining->setTrainingCenter($trainingCenter);
        $sector         = $em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["sector"]["id"]);
        $statGraduateTraining->setSector($sector);
        $subsector      = $em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["subsector"]["id"]);
        $statGraduateTraining->setSubsector($subsector);
        $speciality     = $em->getRepository('MfpeCentreFormationBundle:Specialite')->find($data["speciality"]["id"]);
        $statGraduateTraining->setSpeciality($speciality);
        $statGraduateTraining->setApproved($data["approved"]);
        $statGraduateTraining->setAdministrativeYear($data["administrative_year"]);
        $statGraduateTraining->setMonth($data["month"]);
        $date='01'.'-'.$data["month"].'-'.$data["administrative_year"];
        $dateStatGraduateTraining = new \DateTime($date);
        $statGraduateTraining->setDateStatGraduateTraining($dateStatGraduateTraining);
        $statGraduateTraining->setSectorType($data["sector_type"]);
        $levels = $em->getRepository('MfpeCollectDataBundle:LevelStudy')->findBy(array('statGraduateTraining' => $statGraduateTraining));
        //remove levels
        foreach ($levels as $level) {
            $em->remove($level);
            $em->flush();
        }
        if (isset($data["level_study"])&& !empty($data["level_study"])) {
            foreach ($data["level_study"] as $level) {
                $levelStudy = new LevelStudy();
                $levelStudy->setNbrTrainedH($level["nbr_trained_h"]);
                $levelStudy->setNbrTrainedF($level["nbr_trained_f"]);
                $levelStudy->setNbrForeigner($level["nbr_foreigner"]);
                if (isset($level["nbr_abundant"])) {
                    $levelStudy->setNbrAbundant($level["nbr_abundant"]);
                }
                $levelStudy->setNbrTotal($level["nbr_total"]);
                $levelStudy->setLevel($level["level"]);
                $levelStudy->setStatGraduateTraining($statGraduateTraining);
                $em->persist($levelStudy);
            }
        }
        $em->flush();
        $statGraduateTraining = $this->get('jms_serializer')->serialize($statGraduateTraining, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailStatGraduateTraining', 'ReferencielGroup', 'detailCentreFormation')));
        $statGraduateTraining = json_decode($statGraduateTraining, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $statGraduateTraining], Response::HTTP_OK);
    }

//    /**
//     * @Rest\View(StatusCode = 200, serializerGroups={"listStatGraduateTraining"})
//     * @Rest\Get(
//     *     path = "/graduate_training/",
//     *     name="app_Graduate-training_Get",
//     *     options={ "method_prefix" = false },
//     * )
//     * @SWG\Get(
//     *  tags={"Collect Data"},
//     *  summary="Get  all graduate training",
//     *  consumes={"application/json"},
//     *  produces={"application/json"},
//     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=StatGraduateTraining::class, groups={"listStatGraduateTraining"}))),
//     * @SWG\Response(response="404", description="Returned when user not found"),
//     * )
//     */
//    public function getAction() {
//        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
//            $message         = ApiProblem::TOKEN_JWT_EXPIRED;
//            $errors['token'] = $message;
//            $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//        }
//        if (!is_object($user = $token->getUser())) {
//            // e.g. anonymous authentication
//            $message         = ApiProblem::TOKEN_JWT_EXPIRED;
//            $errors['token'] = $message;
//            $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//        }
//        $statGraduateTraining = $this->getDoctrine()->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->findBy(array(), array('updatedAt' => 'DESC'));
//
//        if (!$statGraduateTraining) {
//            $message                        = ApiProblem::STATGRADUATE_NOT_EXIST;
//            $errors['statGraduateTraining'] = $message;
//            $errors                         = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//        }
//        $statGraduateTraining = $this->get('jms_serializer')->serialize($statGraduateTraining, 'json', SerializationContext::create()->setGroups(array('listStatGraduateTraining')));
//        $statGraduateTraining = json_decode($statGraduateTraining, JSON_UNESCAPED_UNICODE);
//        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $statGraduateTraining], Response::HTTP_OK);
//    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"listStatGraduateTraining"})
     * @Rest\Get(
     *     path = "/graduate_training/",
     *     name="app_Graduate-training-by-type-sector_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="level",
     *     requirements="\d+",
     *     default=1,
     *     description="0/1"
     * )
     * @Rest\QueryParam(
     *     name="sector_type",
     *     description="true/false"
     * )
     * @SWG\Get(
     *  tags={"Collect Data"},
     *  summary="Get  all graduate training",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=StatGraduateTraining::class, groups={"detailStatGraduateTraining"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getGaduateTrainingBySectorTypeAction(Request $request) {
        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            $message         = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            $message         = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        $data = json_decode(json_encode($request->query->all()), true);
        $statGraduateTraining = $this->getDoctrine()->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->getStatGraduateTraining($data);
        $statGraduateTraining = $this->get('jms_serializer')->serialize($statGraduateTraining, 'json', SerializationContext::create()->setGroups(array('detailStatGraduateTraining','ReferencielGroup','BmsGroup')));
        $statGraduateTraining = json_decode($statGraduateTraining, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $statGraduateTraining], Response::HTTP_OK);
    }



    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailTrainingCentre"})
     * @Rest\Delete(
     *     path = "/graduate_training/{id}",
     *     name="app_graduateTraining_Delete",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"Collect Data"},
     *  summary="delete Stat Graduate Training Center",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Stat Graduate Training id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Response(response="200", description="Returned when Resource deleted",@SWG\Schema(type="array", @Model(type=StatGraduateTraining::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function deleteGraduateTrainingAction($id) {
        try {

            $statGraduateTraining = $this->getDoctrine()->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->find($id);

            //Check if the stat Graduate Training exist. Return 404 if not.
            if ($statGraduateTraining === null) {
                $message                         = ApiProblem::PRIVATE_FORME_INSCRIT_DOES_NOT_EXIST;
                $errors['statGraduateTraining'] = $message;
                $errors                          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_NOT_FOUND, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $em        = $this->getDoctrine()->getManager();
            if(!empty($statGraduateTraining))
            $levels = $em->getRepository('MfpeCollectDataBundle:LevelStudy')->findBy(array('statGraduateTraining' => $statGraduateTraining));
            //remove levels
            foreach ($levels as $level) {
                $em->remove($level);
                $em->flush();
            }
            $statGraduateTraining = $this->getDoctrine()->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->find($id);
            //Remove the statGraduateTraining from the database
            $this->em()->remove($statGraduateTraining);
            $this->em()->flush();
            //return all liste of StatGraduateTraining
            $liste = $this->getDoctrine()->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->findAll();
            $liste = $this->get('jms_serializer')->serialize($liste, 'json', SerializationContext::create()->setGroups(array('detailStatGraduateTraining','ReferencielGroup','BmsGroup')));
            $liste = json_decode($liste, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $liste], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => ApiProblem::MESSAGE_EXCEPTION, 'message' => ApiProblem::MESSAGE_EXCEPTION], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailTrainingCentre"})
     * @Rest\Get(
     *     path = "/graduate_training/{id}",
     *     name = "app_stat-graduate-training_Get",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Get(
     *  tags={"Collect Data"},
     *  summary="Get Graduate Training by id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="role id",
     *     required=true
     * ),
     * @SWG\Response(response="200", description="Returned when successful" ,@SWG\Schema(type="array", @Model(type=StatGraduateTraining::class))),
     * @SWG\Response(response="404", description="Returned when role not found"),
     * )
     */
    public function getGraduateTrainingAction($id)
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
            //Get the StatGraduateTraining
            $statGraduateTraining = $this->em()->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->find($id);
            //Check if the stat Graduate Training exist. Return 404 if not.
            if ($statGraduateTraining === null) {
                $message                         = ApiProblem::PRIVATE_FORME_INSCRIT_DOES_NOT_EXIST;
                $errors['statGraduateTraining'] = $message;
                $errors                          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_NOT_FOUND, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $liste = $this->get('jms_serializer')->serialize($statGraduateTraining, 'json', SerializationContext::create()->setGroups(array('detailStatGraduateTraining','ReferencielGroup','BmsGroup')));
            $liste = json_decode($liste, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $liste], Response::HTTP_OK);

        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }


}
