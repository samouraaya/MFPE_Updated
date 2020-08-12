<?php
/**
 * Created by PhpStorm.
 * User: cynapsys
 * Date: 28/06/18
 * Time: 05:37 م
 */

namespace Mfpe\ConfigBundle\Controller\Config;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Mfpe\ConfigBundle\Controller\BaseController;
use Mfpe\ConfigBundle\Entity\InterfaceEnum;
use Mfpe\ConfigBundle\Entity\Role;
use Doctrine\Common\Collections\ArrayCollection;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Mfpe\ConfigBundle\Validator\ValidateRole;
use JMS\Serializer\SerializationContext;

/**
 * Class RoleController
 * @package Mfpe\ConfigBundle\Controller\Config
 * controlleur qui gère la gestion des roles, ajouter et supprimer et modifier les noms ...
 */
class RoleController extends BaseController
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"FrontInterfaceGroup"})
     * @Rest\Get(
     *     path = "/front-interface",
     *     name = "app_front-interface_Get",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Get(
     *  tags={"Role"},
     *  summary="Get All Front Interface",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful" ,@SWG\Schema(type="array", @Model(type=FrontInterface::class))),
     * @SWG\Response(response="404", description="Returned when role not found"),
     * )
     */
    public function getAllFrontInterfacesAction()
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
            //Get the frontInterface
            $frontInterface = $this->em()->getRepository('MfpeConfigBundle:FrontInterface')->FindAll();
            return $frontInterface;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"RoleGroup","UserRole","FrontInterfaceGroup"})
     * @Rest\Get(
     *     path = "/",
     *     name = "app_role_Ref",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Get(
     *  tags={"Role"},
     *  summary="Get Role list",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful" ,@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="404", description="Returned when role not found"),
     * )
     */

    public function getAction()
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
            //Get all the roles
            $roles = $this->em()->getRepository('MfpeConfigBundle:Role')->findBy(["deleted" => false]);
            $roles = $this->get('jms_serializer')->serialize($roles, 'json', SerializationContext::create()->setGroups(array("RoleGroup", "UserRole", "FrontInterfaceGroup")));
            $roles = json_decode($roles, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $roles], Response::HTTP_OK);
            //return 200 success response with the roles
            //return $roles;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"RoleGroup","UserRole","FrontInterfaceGroup"})
     * @Rest\Get(
     *     path = "/{id}",
     *     name = "app_role_Get",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Get(
     *  tags={"Role"},
     *  summary="Get Role by id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="role id",
     *     required=true
     * ),
     * @SWG\Response(response="200", description="Returned when successful" ,@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="404", description="Returned when role not found"),
     * )
     */
    public function getRoleAction($id)
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
            //Get the role
            $role = $this->em()->getRepository('MfpeConfigBundle:Role')->find($id);
            //Check if the role exist. Return 404 if not.
            $this->throwProblem($role, 404, ApiProblem::ROLE_NOT_EXIST);
            //return 200 success response with the role
            return $role;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 202, serializerGroups={"RoleGroup","UserRole"})
     * @Rest\Post(
     *     path = "/new",
     *     name = "app_role_Add",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Post(
     *  tags={"Role"},
     *  summary="add new role",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="intituleAr", type="string", example="المشرف العام على الموقع"),
     *              @SWG\Property(property="intituleFr", type="integer", example="administrateur"),
     *              @SWG\Property(property="role", type="string", example="ROLE_ADMIN"),
     *             @SWG\Property(
     *                  property="frontInterfaces",
     *                  type="array",
     *                  @SWG\Items(type="string", example="publicProjects"),
     *             ),
     *             @SWG\Property(
     *                  property="status",
     *                  type="array",
     *                  @SWG\Items(type="string", example="SPECIALITE_CHOISIE"),
     *             ),
     *             @SWG\Property(
     *                  property="stateExecute",
     *                  type="array",
     *                  @SWG\Items(type="string", example="ATTESTATION_OK"),
     *             ),
     *              @SWG\Property(
     *                  property="users",
     *                  type="array",
     *                  @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="id", type="integer", example=10),
     *                  ),
     *              ),
     *          )
     *      ),
     * )
     * @SWG\Response(response="201", description="Returned when Resource updateded",@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="400", description="Returned when invalid data update"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function postAddAction(ParamFetcher $paramFetcher, Request $request)
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
            //Check if the role already exist to enforce the unique constraint for the role attribute. Return 409 response
            $em = $this->getDoctrine()->getManager();
            $validator = New ValidateRole($em);
            $errors = $validator->validateRole($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                // return $this->createApiResponse($errors, 400);
            } else {
                $role = new Role();
                //Set role parameter to role attribute
                $role->setIntituleAr($data["intituleAr"]);
                $role->setIntituleFr($data["intituleFr"]);
                $role->setRole($data["role"]);
                if(isset($data["frontInterfaces"])) {
                    $role->setFrontInterfaces($data["frontInterfaces"]);
                }
                if(isset($data["status"])) {
                    $role->setStatus($data["status"]);
                }
                if(isset($data["stateExecute"])) {
                    $role->setStateExecute($data["stateExecute"]);
                }
                //$role->setUsers($data["users"]);
                foreach ($data["users"] as $identifiant) {
                    $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->find($identifiant["id"]);
                    if (is_object($user)) {
                        $role->addUser($user);
                    }
                    //$user->setUserRoles(array($role));
                }
                //Persist the role in the database
                //  $this->tryPersist($role);
                $this->em()->persist($role);
                $this->em()->flush();
                //return 200 success response with the created role
                return $this->createApiResponse($role, 201);
            }
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 202, serializerGroups={"RoleGroup","UserRole"})
     * @Rest\Put(
     *     path = "/{id}",
     *     name = "app_role_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"Role"},
     *  summary="update role",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="id role ",
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
     *              @SWG\Property(property="intituleAr", type="string", example="المشرف العام على الموقع"),
     *              @SWG\Property(property="intituleFr", type="integer", example="administrateur"),
     *              @SWG\Property(property="role", type="string", example="ROLE_ADMIN"),
     *             @SWG\Property(
     *                  property="frontInterfaces",
     *                  type="array",
     *                  @SWG\Items(type="string", example="publicProjects"),
     *             ),
     *             @SWG\Property(
     *                  property="status",
     *                  type="array",
     *                  @SWG\Items(type="string", example="SPECIALITE_CHOISIE"),
     *             ),
     *             @SWG\Property(
     *                  property="stateExecute",
     *                  type="array",
     *                  @SWG\Items(type="string", example="ATTESTATION_OK"),
     *             ),
     *              @SWG\Property(
     *                  property="users",
     *                  type="array",
     *                  @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="id", type="integer", example=10),
     *                  ),
     *              ),
     *          )
     *      ),
     * )
     * @SWG\Response(response="201", description="Returned when Resource updateded",@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="400", description="Returned when invalid data update"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function putAction(ParamFetcher $paramFetcher, $id, Request $request)
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
            $errors = array();
            $role = $this->em()->getRepository('MfpeConfigBundle:Role')->find($id);
            $tabRole = ['ROLE_AGENT_CENTRE_FORMATION', 'ROLE_SUPER_ADMIN', 'ROLE_ADMIN', 'ROLE_CITOYEN'];
            if ($role->getEditable() == 0 && in_array($role->getRole(), $tabRole)) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::ROLE_NOT_EDITABLE], Response::HTTP_BAD_REQUEST);
            }
            //Check if the role exist. Return 404 if not.
            $this->throwProblem($role, 404, ApiProblem::ROLE_NOT_EXIST);
            $roleExist = $this->em()->getRepository('MfpeConfigBundle:Role')->findOneByRole(array("role" => $data["role"]));
            if ($roleExist) {
                if ($roleExist->getId() != $id) {
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::ROLE_EXIST, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
            }
            if (count($data["users"]) != 0) {
                foreach ($data["users"] as $key => $identifiant) {
                    if (empty($identifiant["id"])) {
                        $errors['users_' . $key] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } else {
                        $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->find($identifiant["id"]);
                        if (!is_object($user)) {
                            $errors['users_' . $key] = ApiProblem::USER_DOES_NOT_EXIST;
                        }
                    }
                }
                if ($errors) {
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
            }
            if (isset($data["frontInterfaces"])) {
                if (!is_array($data["frontInterfaces"])) {
                    $errors['frontInterfaces'] = ApiProblem::FIELD_NOT_COMPATIBLE;
                }
            }
            if (isset($data["status"])) {
                if (!is_array($data["status"])) {
                    $errors['status'] = ApiProblem::FIELD_NOT_COMPATIBLE;
                }
            }
            if (isset($data["stateExecute"])) {
                if (!is_array($data["stateExecute"])) {
                    $errors['stateExecute'] = ApiProblem::FIELD_NOT_COMPATIBLE;
                }
            }
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            //Check if the role already exist to enforce the unique constraint for the role attribute. Return 409 response
            //Set role parameter to role attribute
            $role->setIntituleAr($data["intituleAr"]);
            $role->setIntituleFr($data["intituleFr"]);
            $role->setRole($data["role"]);
            if(isset($data["frontInterfaces"])) {
                $role->setFrontInterfaces($data["frontInterfaces"]);
            }
            if(isset($data["status"])) {
                $role->setStatus($data["status"]);
            }
            if(isset($data["stateExecute"])) {
                $role->setStateExecute($data["stateExecute"]);
            }
            $users = $role->getUsers();
            if ($users) {
                foreach ($users as $key => $user) {
                    if (is_object($user)) {
                        $role->removeUser($user);
                    }
                }
            }
            foreach ($data["users"] as $identifiant) {
                $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->find($identifiant["id"]);
                if (is_object($user)) {
                    $role->addUser($user);
                }
                //$user->setUserRoles(array($role));
            }
            //Check if the permission parameters are set and affect them to the role.
            /*$role->setPermissions(new ArrayCollection());
            $permissions = $paramFetcher->get('permissions');
            if (is_array($permissions)) {
                foreach ($permissions as $permission) {
                    $role->addPermission($this->em()->getReference('GboConfigBundle:Permission', $permission));
                }
            }*/

            //Persist the role in the database
            $this->em()->flush();
            //$this->em()->persist($role);
            //$this->tryPersist($role);

            //return 200 success response with the modified role
            return $this->createApiResponse($role, 202);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"RoleGroup"})
     * @Rest\Delete(
     *     path = "/{id}",
     *     name = "app_role_Delete",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"Role"},
     *  summary="delete Role by id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *    type="integer"
     *     ),
     * @SWG\Response(response="200", description="Returned when deleted successful"),
     * @SWG\Response(response="404", description="Returned when role not found"),
     * )
     */
    public function deleteAction($id)
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
            $role = $this->em()->getRepository('MfpeConfigBundle:Role')->find($id);
            //Check if the role exist. Return 404 if not.
            //Check if the role exist. Return 404 if not.
            $this->throwProblem($role, 404, ApiProblem::ROLE_NOT_EXIST);
            if (count($role->getUsers()) != 0) {
                return new JsonResponse(['status' => Response::HTTP_BAD_REQUEST, 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::ROLE_AFFECTED_USER, 'message' => ApiProblem::ROLE_AFFECTED_USER], Response::HTTP_BAD_REQUEST);
            } else {
                //Remove the role from the database
                $this->em()->remove($role);
                $this->em()->flush();
                //$this->desactiveentity($role);
                return new JsonResponse(['status' => Response::HTTP_OK, 'code' => Response::HTTP_OK, 'data' => ApiProblem::DELETED_SUCCESS, 'message' => ApiProblem::DELETED_SUCCESS], Response::HTTP_OK);
            }

            //return 200 success response with all the roles
//        $roles = $this->em()->getRepository('MfpeConfigBundle:Role')->findAll();
//        return $roles;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 201, serializerGroups={"RoleGroup"})
     * @Rest\Post(
     *     path = "/give_permission/{id_role}/{id_permission}",
     *     name = "app_role_AddPermission",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Post(
     *  tags={"Role"},
     *  summary="add permission to role  role",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id_role",
     *     in="path",
     *     required=true,
     *     description=" id role",
     *    type="integer"
     *     ),
     * @SWG\Parameter(
     *     name="id_permission",
     *     in="path",
     *     description="id permission",
     *     required=true,
     *    type="integer"
     *     ),
     * @SWG\Response(response="201", description="Returned when Resource created",@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function postAffectPermissionAction($id_role, $id_permission)
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
            //Get a reference to the role and the permission
            $role = $this->em()->getReference('MfpeConfigBundle:Role', $id_role);
            $permission = $this->em()->getReference('MfpeConfigBundle:Permission', $id_permission);
            //Check if the role exist. Return 404 if not.
            $this->throwProblem($role, 404, ApiProblem::ROLE_NOT_EXIST);
            //Check if the permission exist. Return 404 if not.
            $this->throwProblem($permission, 404, ApiProblem::PERMISSION_NOT_EXIST);

            //Add the permission to the role and persist it to the database.
            $role->addPermission($permission);
            $this->tryPersist($role);

            //return 200 success response with the role
            return $role;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 201, serializerGroups={"RoleGroup"})
     * @Rest\Post(
     *     path = "/give_permissions_to_role/",
     *     name = "app_role_AddPermissions",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Post(
     *  tags={"Role"},
     *  summary="add permission to role",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     *
     * @SWG\Parameter(
     *     name="id_role",
     *     in="path",
     *     required=true,
     *     description=" id role",
     *    type="integer"
     *     ),
     * @SWG\Parameter(
     *     name="id_permissions",
     *     in="path",
     *     description="array of id permission",
     *     required=true,
     *    type="integer"
     *     ),
     * @SWG\Response(response="201", description="Returned when Resource created",@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function postAffectPermissionsAction(Request $request)
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
            $id_role = $request->get('id_role');
            $ids_permissions = $request->get('id_permissions');
            //Get a reference to the role and the permission
            $role = $this->em()->getRepository(Role::class)->find($id_role);
            //Check if the role exist. Return 404 if not.
            $this->throwProblem($role, 404, ApiProblem::ROLE_NOT_EXIST);
            $LastPermissions = $role->getPermissions($id_role);
            // delete all last permissions affected
            foreach ($LastPermissions as $lastpermission) {
                $role->removePermission($lastpermission);
            }
            foreach ($ids_permissions as $id) {
                //Check if the permission exist. Return 404 if not.
                $permission = $this->em()->getRepository('MfpeConfigBundle:Permission')->find($id);
                $this->throwProblem($permission, 404, ApiProblem::PERMISSION_NOT_EXIST);
                //Add the permission to the role and persist it to the database.
                $role->addPermission($permission);
            }
            $this->tryPersist($role);

            //return 200 success response with the role
            return $role;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"RoleGroup"})
     * @Rest\Delete(
     *     path = "/remove_permission/{id_role}/{id_permission}",
     *     name = "app_role_DeletePermission",
     *     options={ "method_prefix" = false }
     *
     * )
     * @SWG\Delete(
     *  tags={"Role"},
     *  summary="delete Permission from Role by id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id_role",
     *     in="path",
     *     type="integer",
     *     description="permission id",
     *     required=true
     * ),
     * @SWG\Parameter(
     *     name="id_permission",
     *     in="path",
     *     type="integer",
     *     description="permission id",
     *     required=true
     * ),
     * @SWG\Response(response="200", description="Returned when successful"),
     * @SWG\Response(response="404", description="Returned when role not found"),
     * )
     *
     */
    public function deletePermissionRoleAction($id_role, $id_permission)
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
            //Get a reference to the role and the permission
            $role = $this->em()->getReference('MfpeConfigBundle:Role', $id_role);
            $permission = $this->em()->getReference('MfpeConfigBundle:Permission', $id_permission);
            //Check if the role exist. Return 404 if not.
            $this->throwProblem($role, 404, ApiProblem::ROLE_NOT_EXIST);
            //Check if the permission exist. Return 404 if not.
            $this->throwProblem($permission, 404, ApiProblem::PERMISSION_NOT_EXIST);
            //Remove the permission from the role and persist it to the database.
            $role->removePermission($permission);
            $this->tryPersist($role);
            //return 200 success response with the role
            return $role;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"RoleGroup"})
     * @Rest\Delete(
     *     path = "/roles",
     *     name="app_roles_Delete",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"Role"},
     *  summary="delete multiple roles",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="201", description="Returned when Resource deleted",@SWG\Schema(type="array", @Model(type=Role::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     * @Rest\RequestParam(name="ids")
     */
    public function deleteUsersAction(Request $request)
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
            $ids = $request->get("ids");
            foreach ($ids as $id) {
                $role = $this->em()->getRepository('MfpeConfigBundle:Role')->find($id);
                //Check if the user exist. Return 404 if not.
                if ($role === null) {
                    return $this->createApiResponse("role not found", 404);
                }
                $this->desactiveentity($role);
            }
            //Remove the role from the database
            //return 200 success response with all the users
            $roles = $this->em()->getRepository('MfpeConfigBundle:Role')->findBy(["deleted" => false]);
            return $this->createApiResponse($roles, 200);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }
}
