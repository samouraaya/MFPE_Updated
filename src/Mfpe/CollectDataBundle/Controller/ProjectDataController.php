<?php


namespace Mfpe\CollectDataBundle\Controller;


use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Request\ParamFetcher;
use Mfpe\AttestationBundle\Validator\validateUniteRegional;
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
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Mfpe\ConfigBundle\Representation\UsersApp;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use JMS\Serializer\SerializationContext;
use Mfpe\ConfigBundle\Controller\BaseController;

use Mfpe\CollectDataBundle\Entity\ProjectData;
use Mfpe\CollectDataBundle\Validator\ValidateEmploi;


/**
 * Description of ProjectDataController
 *
 * @author Lamine Mansouri
 */
class ProjectDataController extends BaseController
{
    use ControllerTrait;


    /**
     * @Rest\Post(
     *     path = "/project",
     *     name = "app_project-data_Add"
     * )
     * @SWG\Post(
     *  tags={"Project Data"},
     *  summary="Create project data",
     *  description ="<span style='color: red;'>Field Type take two values :
    &nbsp;&nbsp; false: Projets cooperation internationale
    &nbsp;&nbsp; true: Projets public
    </span>",
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
     *                  property="governorat",
     *                  title="governorat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=15),
     *              ),
     *              @SWG\Property(
     *                  property="delegation",
     *                  title="delegation",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=39),
     *              ),
     *              @SWG\Property(property="title_project", type="string", example="Title of project"),
     *              @SWG\Property(property="type_project", type="string", example="type of project"),
     *              @SWG\Property(
     *                  property="sector",
     *                  title="sector",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=13),
     *              ),
     *              @SWG\Property(property="target_population", type="string", example="Population cible"),
     *              @SWG\Property(property="number_beneficiarie", type="integer", example=05),
     *              @SWG\Property(property="project_manager", type="string", example="chef de projet"),
     *              @SWG\Property(property="project_cost", type="integer", example=191919),
     *              @SWG\Property(property="project_cost_updated", type="integer", example=98656222),
     *              @SWG\Property(property="finance", type="string", example="Bank Afrique development"),
     *              @SWG\Property(property="expense_extimed", type="integer", example=2597666),
     *              @SWG\Property(property="expense_real", type="integer", example=165965),
     *              @SWG\Property(property="type_finance", type="string", example="Crédit banquaire"),
     *              @SWG\Property(property="registration_project_year", type="integer", example=2018),
     *              @SWG\Property(property="project_duration", type="integer", example=5),
     *              @SWG\Property(property="project_component", type="string", example="Composition du durée par 6 mois, donc il sera décomposé en 5 parties"),
     *              @SWG\Property(property="project_progress_percent", type="integer", example=80),
     *              @SWG\Property(property="project_progress", type="string", example="80% du projet est validé est fini"),
     *              @SWG\Property(property="observation", type="string", example="80% du projet est fini, le projet avance selon la norme décrit dans le cahier de charge"),
     *              @SWG\Property(property="type", type="string", example="true"),
     *          )
     *      ),
     * )
     */
    public function postAction(Request $request)
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

            $data = json_decode($request->getContent(), true);
            $em = $this->getDoctrine()->getManager();
            $validator = New ValidateEmploi($em);
            $errors = $validator->validateCreateProjet($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                // return $this->createApiResponse($errors, 400);
            }
            $project = new ProjectData();
            $governorat = $em->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["governorat"]["id"]);
            $project->setGovernorat($governorat);
            $delegation = $em->getRepository('MfpeReferencielBundle:RefDelegation')->find($data["delegation"]["id"]);
            $project->setDelegation($delegation);
            $project->setTitleProject($data["title_project"]);
            $project->setTypeProject($data["type_project"]);
            $secteur = $em->getRepository('MfpeReferencielBundle:RefSecteur')->find($data["sector"]["id"]);
            $project->setSector($secteur);
            if (isset($data["target_population"])) {
                $project->setTargetPopulation($data["target_population"]);
            }
            if (isset($data["number_beneficiarie"])) {
                $project->setNumberBeneficiarie($data["number_beneficiarie"]);
            }
            $project->setProjectManager($data["project_manager"]);
            $project->setProjectCost($data["project_cost"]);
            $project->setProjectCostUpdated($data["project_cost_updated"]);
            $project->setFinance($data["finance"]);
            if (isset($data["expense_extimed"])) {
                $project->setExpenseExtimed($data["expense_extimed"]);
            }
            if (isset($data["expense_real"])) {
                $project->setExpenseReal($data["expense_real"]);
            }
            $project->setTypeFinance($data["type_finance"]);
            $project->setRegistrationProjectYear($data["registration_project_year"]);
            $project->setProjectDuration($data["project_duration"]);
            $project->setProjectComponent($data["project_component"]);
            if (isset($data["project_progress_percent"])) {
                $project->setProjectProgressPercent($data["project_progress_percent"]);
            }
            if (isset($data["project_progress"])) {
                $project->setProjectProgress($data["project_progress"]);
            }
            if (isset($data["observation"])) {
                $project->setObservation($data["observation"]);
            }
            if (isset($data["type"])) {
                $project->setType($data["type"]);
            }

            $em->persist($project);
            $em->flush();
            $project = $this->get('jms_serializer')->serialize($project, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailProject')));
            $project = json_decode($project, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $project,], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @Rest\Put(
     *     path = "/project/{id}",
     *     name = "app_project-data_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"projectData"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"Project Data"},
     *  summary="Update project data",
     *  description ="<span style='color: red;'>Field Type take two values :
    &nbsp;&nbsp; false: Projets cooperation internationale
    &nbsp;&nbsp; true: Projets public
    </span>",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when Resource modified",@SWG\Schema(type="array", @Model(type=ProjectData::class, groups={"detailProject"}))),
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
     *                  property="governorat",
     *                  title="governorat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=15),
     *              ),
     *              @SWG\Property(
     *                  property="delegation",
     *                  title="delegation",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=39),
     *              ),
     *              @SWG\Property(property="title_project", type="string", example="Title of project"),
     *              @SWG\Property(property="type_project", type="string", example="type of project"),
     *              @SWG\Property(
     *                  property="sector",
     *                  title="sector",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=13),
     *              ),
     *              @SWG\Property(property="target_population", type="string", example="Population cible"),
     *              @SWG\Property(property="number_beneficiarie", type="integer", example=05),
     *              @SWG\Property(property="project_manager", type="string", example="chef de projet"),
     *              @SWG\Property(property="project_cost", type="integer", example=191919),
     *              @SWG\Property(property="project_cost_updated", type="integer", example=98656222),
     *              @SWG\Property(property="finance", type="string", example="Bank Afrique development"),
     *              @SWG\Property(property="expense_extimed", type="integer", example=2597666),
     *              @SWG\Property(property="expense_real", type="integer", example=165965),
     *              @SWG\Property(property="type_finance", type="string", example="Crédit banquaire"),
     *              @SWG\Property(property="registration_project_year", type="integer", example=2018),
     *              @SWG\Property(property="project_duration", type="string", example="2 ans et 5 mois"),
     *              @SWG\Property(property="project_component", type="string", example="Composition du durée par 6 mois, donc il sera décomposé en 5 parties"),
     *              @SWG\Property(property="project_progress_percent", type="integer", example=80),
     *              @SWG\Property(property="project_progress", type="string", example="80% du projet est validé est fini"),
     *              @SWG\Property(property="observation", type="string", example="80% du projet est fini, le projet avance selon la norme décrit dans le cahier de charge"),
     *              @SWG\Property(property="type", type="string", example="true"),
     *          )
     *      ),
     * )
     */


    public function putAction(Request $request, ?ProjectData $project)
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

            if (!is_object($project)) {
                $message = ApiProblem::OBJECT_DOES_NOT_EXIST;
                $errors['demande'] = $message;
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::OBJECT_DOES_NOT_EXIST, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }

            $data = json_decode($request->getContent(), true);
            $em = $this->getDoctrine()->getManager();
            $validator = New ValidateEmploi($em);
            $errors = $validator->validateCreateProjet($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                // return $this->createApiResponse($errors, 400);
            }
            //$project = new ProjectData();
            if (isset($data["governorat"]["id"])) {
                $governorat = $em->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["governorat"]["id"]);
                $project->setGovernorat($governorat);
            }
            if (isset($data["delegation"]["id"])) {
                $delegation = $em->getRepository('MfpeReferencielBundle:RefDelegation')->find($data["delegation"]["id"]);
                $project->setDelegation($delegation);
            }
            if (isset($data["title_project"])) {
                $project->setTitleProject($data["title_project"]);
            }
            if (isset($data["type_project"])) {
                $project->setTypeProject($data["type_project"]);
            }
            if (isset($data["sector"]["id"])) {
                $secteur = $em->getRepository('MfpeReferencielBundle:RefSecteur')->find($data["sector"]["id"]);
                $project->setSector($secteur);
            }
            if (isset($data["target_population"])) {
                $project->setTargetPopulation($data["target_population"]);
            }
            if (isset($data["number_beneficiarie"])) {
                $project->setNumberBeneficiarie($data["number_beneficiarie"]);
            }
            if (isset($data["project_manager"])) {
                $project->setProjectManager($data["project_manager"]);
            }
            if (isset($data["project_cost"])) {
                $project->setProjectCost($data["project_cost"]);
            }
            if (isset($data["project_cost_updated"])) {
                $project->setProjectCostUpdated($data["project_cost_updated"]);
            }
            if (isset($data["finance"])) {
                $project->setFinance($data["finance"]);
            }
            if (isset($data["expense_extimed"])) {
                $project->setExpenseExtimed($data["expense_extimed"]);
            }
            if (isset($data["expense_real"])) {
                $project->setExpenseReal($data["expense_real"]);
            }
            if (isset($data["type_finance"])) {
                $project->setTypeFinance($data["type_finance"]);
            }
            if (isset($data["registration_project_year"])) {
                $project->setRegistrationProjectYear($data["registration_project_year"]);
            }
            if (isset($data["project_duration"])) {
                $project->setProjectDuration($data["project_duration"]);
            }
            if (isset($data["project_component"])) {
                $project->setProjectComponent($data["project_component"]);
            }
            if (isset($data["project_progress_percent"])) {
                $project->setProjectProgressPercent($data["project_progress_percent"]);
            }
            if (isset($data["project_progress"])) {
                $project->setProjectProgress($data["project_progress"]);
            }
            if (isset($data["observation"])) {
                $project->setObservation($data["observation"]);
            }
            if (isset($data["type"])) {
                $project->setType($data["type"]);

            }

            //$em->persist($project);
            $em->flush();
            $project = $this->get('jms_serializer')->serialize($project, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailProject')));
            $project = json_decode($project, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $project,], Response::HTTP_OK);

        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"listStatGraduateTraining"})
     * @Rest\Get(
     *     path = "/project",
     *     name="app_project-data_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="type",
     *     nullable=true,
     *     description="type de project"
     * )
     * @SWG\Get(
     *  tags={"Project Data"},
     *  summary="Get  all Project Data",
     *  description ="<span style='color: red;'>Field Type take two values :
    &nbsp;&nbsp; false: Projets cooperation internationale
    &nbsp;&nbsp; true: Projets public
    </span>",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=ProjectData::class, groups={"publicProject","cooperateProject"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getAction(Request $request)
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
        $type = $data['type'];
        $project = $this->getDoctrine()->getRepository('MfpeCollectDataBundle:ProjectData')->findBy(array('type' => $type), array('updatedAt' => 'DESC'));
        $project = $this->get('jms_serializer')->serialize($project, 'json', SerializationContext::create()->setGroups(array('publicProject', 'ReferencielGroup', 'BmsGroup')));
        $project = json_decode($project, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $project], Response::HTTP_OK);

    }



}