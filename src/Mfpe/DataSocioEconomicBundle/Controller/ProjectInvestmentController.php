<?php

namespace Mfpe\DataSocioEconomicBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use Mfpe\AttestationBundle\Validator\ValidateCreateDemande;
use Mfpe\DataSocioEconomicBundle\Entity\ProjectInvestment;
use Mfpe\DataSocioEconomicBundle\Validator\ValidateProjectInvestmentData;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\DataSocioEconomicBundle\Validator\ValidateSocioEconomicData;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializationContext;
use Mfpe\ConfigBundle\Controller\BaseController;

/**
 * Description of ProjectInvestmentController
 *
 * @author Lamine Mansouri
 */
class ProjectInvestmentController extends BaseController {

    use ControllerTrait;

    /**
     * @Rest\Post(
     *     path = "",
     *     name = "app_create-project-investment_Add"
     * )
     * @SWG\Post(
     *  tags={"Project Investment"},
     *  summary="Create Project Investment",
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
     *          description ="<span style='color: red;'>Field Type take three values :
      &nbsp;&nbsp; 1: Projets investissement API
      &nbsp;&nbsp; 2: Projets investissement APIA
      &nbsp;&nbsp; 3: Nombre d’entreprise en difficulté
      </span>",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="governorat",
     *                  title="Gouvernorat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=15),
     *              ),
     *              @SWG\Property(
     *                  property="delegation",
     *                  title="Delegation",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=39),
     *              ),
     *              @SWG\Property(
     *                  property="object_economic",
     *                  title="object",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=5),
     *              ),
     *              @SWG\Property(
     *                  property="sector_economic",
     *                  title="object",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=5),
     *              ),
     *              @SWG\Property(
     *                  property="regime",
     *                  title="object",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=5),
     *              ),
     *              @SWG\Property(property="job_estimed", type="integer", example=985315),
     *              @SWG\Property(property="investment_cost", type="float", example=9645.5),
     *              @SWG\Property(property="year", type="integer", example=2019),
     *              @SWG\Property(property="activiry_cessation", type="string", example="activiry cessation"),
     *              @SWG\Property(property="duration", type="float", example=36.6),
     *              @SWG\Property(property="number_job_lost", type="integer", example=3615),
     *              @SWG\Property(property="date", type="date", example="01-05-2015"),
     *              @SWG\Property(property="type", type="integer", example=3),
     *          )
     *
     *      ),
     * )
     */
    public function postAction(Request $request) {
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
            $validator = New ValidateProjectInvestmentData($em);
            $errors = $validator->validateProjectInvestmentData($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                // return $this->createApiResponse($errors, 400);
            }

            $projectInvestment = new ProjectInvestment();
            if (isset($data["governorat"]["id"])) {
                $governorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["governorat"]["id"]);
                $projectInvestment->setGovernorat($governorat);
            }
            if (isset($data["delegation"]["id"])) {
            $delegation = $this->em()->getRepository('MfpeReferencielBundle:RefDelegation')->find($data["delegation"]["id"]);
            $projectInvestment->setDelegation($delegation);
            }
            if (isset($data["sector_economic"]["id"])) {
                $sector = $this->em()->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->find($data["sector_economic"]["id"]);
                $projectInvestment->setSectorEconomic($sector);
            }
            if (isset($data["object_economic"]["id"])) {
                $object = $this->em()->getRepository('MfpeReferencielBundle:RefObjetEconomic')->find($data["object_economic"]["id"]);
                $projectInvestment->setObjectEconomic($object);
            }
            if (isset($data["regime"]["id"])) {
                $regime = $this->em()->getRepository('MfpeReferencielBundle:RefRegime')->find($data["regime"]["id"]);
                $projectInvestment->setRegime($regime);
            }
            if (isset($data["job_estimed"])) {
                $projectInvestment->setJobEstimed($data["job_estimed"]);
            }
            if (isset($data["investment_cost"])) {
                $projectInvestment->setInvestmentCost($data["investment_cost"]);
            }
            if (isset($data["year"])) {
                $projectInvestment->setYear($data["year"]);
            }
            if (isset($data["activiry_cessation"])) {
                $projectInvestment->setActiviryCessation($data["activiry_cessation"]);
            }
            if (isset($data["duration"])) {
                $projectInvestment->setDuration($data["duration"]);
            }
            if (isset($data["number_job_lost"])) {
                $projectInvestment->setNumberJobLost($data["number_job_lost"]);
            }
            if (isset($data["type"])) {
                $projectInvestment->setType($data["type"]);
            }
            if (isset($data["date"])) {
                $date = new \DateTime($data["date"]);
                $projectInvestment->setDate($date);
            }

            $this->em()->persist($projectInvestment);
            $this->em()->flush();

            $projectInvestment = $this->get('jms_serializer')->serialize($projectInvestment, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailProjectInvestment','ReferencielGroup')));
            $projectInvestment = json_decode($projectInvestment, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_CREATED, 'message' => 'success', 'data' => $projectInvestment], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(serializerGroups={"detailProjectInvestment"})
     * @Rest\Put(
     *     path = "/{id}",
     *     name = "app_create-project-investment_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"centreFormation"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"Project Investment"},
     *  summary="edit Project Investment",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="ProjectInvestment",
     *     in="path",
     *     description="ProjectInvestment id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description ="<span style='color: red;'>Field Type take three values :
      &nbsp;&nbsp; 1: Projets investissement API
      &nbsp;&nbsp; 2: Projets investissement APIA
      &nbsp;&nbsp; 3: Nombre d’entreprise en difficulté
      </span>",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="governorat",
     *                  title="Gouvernorat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=15),
     *              ),
     *              @SWG\Property(
     *                  property="delegation",
     *                  title="Delegation",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=39),
     *              ),
     *              @SWG\Property(
     *                  property="object_economic",
     *                  title="object",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=5),
     *              ),
     *              @SWG\Property(
     *                  property="sector_economic",
     *                  title="object",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=5),
     *              ),
     *              @SWG\Property(
     *                  property="regime",
     *                  title="object",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=5),
     *              ),
     *              @SWG\Property(property="job_estimed", type="integer", example=985315),
     *              @SWG\Property(property="investment_cost", type="float", example=9645.5),
     *              @SWG\Property(property="year", type="integer", example=2019),
     *              @SWG\Property(property="activiry_cessation", type="string", example="activiry cessation"),
     *              @SWG\Property(property="duration", type="float", example=36.6),
     *              @SWG\Property(property="number_job_lost", type="integer", example=3615),
     *              @SWG\Property(property="type", type="integer", example=3),
     *          )
     *
     *      ),
     * )
     * @SWG\Response(response="200", description="Returned when Resource modified",@SWG\Schema(type="array", @Model(type=ProjectInvestment::class, groups={"detailProjectInvestment"}))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function putAction(Request $request, ?ProjectInvestment $projectInvestment) {
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
            if (!is_object($projectInvestment)) {
                $message                   = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['centreFormation'] = $message;
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => ApiProblem::MESSAGE_GLOBAL, 'data' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $data      = json_decode($request->getContent(), true);
            $em        = $this->getDoctrine()->getManager();
            $validator = New ValidateProjectInvestmentData($em);
            $errors    = $validator->validateProjectInvestmentData($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                // return $this->createApiResponse($errors, 400);
            }

            if (isset($data["governorat"]["id"])) {
                $governorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["governorat"]["id"]);
                $projectInvestment->setGovernorat($governorat);
            }
            if (isset($data["delegation"]["id"])) {
                $delegation = $this->em()->getRepository('MfpeReferencielBundle:RefDelegation')->find($data["delegation"]["id"]);
                $projectInvestment->setDelegation($delegation);
            }
            if (isset($data["sector_economic"]["id"])) {
                $sector = $this->em()->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->find($data["sector_economic"]["id"]);
                $projectInvestment->setSectorEconomic($sector);
            }
            if (isset($data["object_economic"]["id"])) {
                $object_economic = $this->em()->getRepository('MfpeReferencielBundle:RefObjetEconomic')->find($data["object_economic"]["id"]);
                $projectInvestment->setObjectEconomic($object_economic);
            }
            if (isset($data["regime"]["id"])) {
                $object_economic = $this->em()->getRepository('MfpeReferencielBundle:RefRegime')->find($data["regime"]["id"]);
                $projectInvestment->setRegime($object_economic);
            }
            if (isset($data["job_estimed"])) {
                $projectInvestment->setJobEstimed($data["job_estimed"]);
            }
            if (isset($data["investment_cost"])) {
                $projectInvestment->setInvestmentCost($data["investment_cost"]);
            }
            if (isset($data["year"])) {
                $projectInvestment->setYear($data["year"]);
            }
            if (isset($data["activiry_cessation"])) {
                $projectInvestment->setActiviryCessation($data["activiry_cessation"]);
            }
            if (isset($data["duration"])) {
                $projectInvestment->setDuration($data["duration"]);
            }
            if (isset($data["number_job_lost"])) {
                $projectInvestment->setNumberJobLost($data["number_job_lost"]);
            }
            if (isset($data["type"])) {
                $projectInvestment->setType($data["type"]);
            }
            //$this->em()->persist($projectInvestment);
            $em->flush();

            $projectInvestment = $this->get('jms_serializer')->serialize($projectInvestment, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailProjectInvestment','ReferencielGroup')));
            $projectInvestment = json_decode($projectInvestment, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_CREATED, 'message' => 'success', 'data' => $projectInvestment], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"listStatGraduateTraining"})
     * @Rest\Get(
     *     path = "/",
     *     name="app_project-investment_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="type",
     *     requirements="\d+",
     *     default=1,
     *     description="1/2/3"
     * )
     * @SWG\Get(
     *  tags={"Project Investment"},
     *  summary="Get  project investment",
     *          description ="<span style='color: red;'>Field Type take three values :
      &nbsp;&nbsp; 1: Projets investissement API
      &nbsp;&nbsp; 2: Projets investissement APIA
      &nbsp;&nbsp; 3: Nombre d’entreprise en difficulté
      </span>",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=ProjectInvestment::class, groups={"detailProjectInvestment"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getProjectInvestmentAction(Request $request) {
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
        $data                 = json_decode(json_encode($request->query->all()), true);
        $projet = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:ProjectInvestment')->getProjectInvestmentByType($data);
        $projet = $this->get('jms_serializer')->serialize($projet, 'json', SerializationContext::create()->setGroups(array('detailProjectInvestment', 'ReferencielGroup')));
        $projet = json_decode($projet, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $projet], Response::HTTP_OK);
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailProjectInvestment"})
     * @Rest\Delete(
     *     path = "/{id}",
     *     name="app_project-investment_Delete",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"Project Investment"},
     *  summary="delete project investment",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="project investment id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Response(response="200", description="Returned when Resource deleted",@SWG\Schema(type="array", @Model(type=ProjectInvestment::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function deleteProjectInvestmentAction($id) {
        try {

            $projetInvestissment = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:ProjectInvestment')->find($id);
            //Check if the center exist. Return 404 if not.
            if ($projetInvestissment === null) {
                $message                         = ApiProblem::PROJET_DOES_NOT_EXIST;
                $errors['ProjetInvestissment'] = $message;
                $errors                          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_NOT_FOUND, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            //Remove the role from the database
            $this->em()->remove($projetInvestissment);

            $this->em()->flush();
            //return 200 success response with all the investissements projects
            $projetInvestissments= $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:ProjectInvestment')->findAll();
            $projetInvestissments = $this->get('jms_serializer')->serialize($projetInvestissments, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailProjectInvestment', 'ReferencielGroup')));
            $projetInvestissments = json_decode($projetInvestissments, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $projetInvestissments], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => ApiProblem::MESSAGE_EXCEPTION, 'message' => ApiProblem::MESSAGE_EXCEPTION], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailProjectInvestment"})
     * @Rest\Get(
     *     path = "/{id}",
     *     name="app_project-investment-id_Get",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Get(
     *  tags={"Project Investment"},
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
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=ProjectInvestment::class, groups={"detailProjectInvestment"}))),
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
            $projetInvestissment = $this->getDoctrine()->getRepository('MfpeDataSocioEconomicBundle:ProjectInvestment')->find($id);

            if (!$projetInvestissment) {
                $message                         = ApiProblem::PROJET_DOES_NOT_EXIST;
                $errors['ProjetInvestissment'] = $message;
                $errors                          = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_NOT_FOUND, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $projetInvestissment = $this->get('jms_serializer')->serialize($projetInvestissment, 'json', SerializationContext::create()->setGroups(array('detailProjectInvestment', 'ReferencielGroup')));
            $projetInvestissment = json_decode($projetInvestissment, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $projetInvestissment], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

}
