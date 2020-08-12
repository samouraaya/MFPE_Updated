<?php

namespace Mfpe\ConfigBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Request\ParamFetcher;
use Mfpe\ConfigBundle\Entity\AppUser;
use Mfpe\ReferencielBundle\Entity\Referenciel;
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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Mfpe\ConfigBundle\Entity\ResetPassword;

class UserController extends BaseController
{
    use ControllerTrait;


    private $entityMerger;
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage,
                                EntityMerger $entityMerger

    )
    {
        $this->entityMerger = $entityMerger;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Si l'utilisateur connecté n'a pas le role 'ROLE_CYNAPSYS', alors il ne pourra récupérer que la liste des
     * utilisateurs qui n'ont pas les roles ('ROLE_CYNAPSYS', 'ADMIN_SYSTEM', 'ADMINISTRATEUR')
     * Si l'utilisateur connecté a le role 'ROLE_CYNAPSYS', alors il a accès à liste de tous les utilisateurs.
     *
     * @Rest\View(StatusCode = 200,serializerGroups={"AppUserGroup","uniteRegional"})
     * @Rest\Get(
     *     path = "/all",
     *     name="app_user_Ref",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Get(
     *  tags={"User"},
     *  summary="Gets the users",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=AppUser::class, groups={"AppUserGroup"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * @Security(name="Bearer")
     * )
     */

    public function getUsersAction()
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
            $userLogged = $this->tokenStorage->getToken()->getUser();
            $roles = $userLogged->getUserRoles();
            $role = $roles[0];
            $roleName = $role->getRole();
            $users = $roleName == 'ROLE_CYNAPSYS'
                ? $this->getDoctrine()->getRepository(AppUser::class)->findBy(["deleted" => false])
                : $this->getDoctrine()->getRepository(AppUser::class)->getAllUserFilterRoles();
            $users = $this->get('jms_serializer')->serialize($users, 'json', SerializationContext::create()->setGroups(array('AppUserGroup')));
            $users = json_decode($users, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $users], Response::HTTP_OK);

        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Si l'utilisateur connecté n'a pas le role 'ROLE_CYNAPSYS','ROLE_ADMIN','ROLE_SUPER_ADMIN', alors il ne pourra récupérer que la liste des
     * utilisateurs qui n'ont pas les roles ('ROLE_CYNAPSYS', 'ADMIN_SYSTEM', 'ADMINISTRATEUR')
     * Si l'utilisateur connecté a le role 'ROLE_CYNAPSYS',ADMIN_SYSTEM,ADMINISTRATEUR alors il a accès à liste de tous les utilisateurs.
     *
     * @Rest\View(StatusCode = 200,serializerGroups={"AppUserGroup","uniteRegional"})
     * @Rest\Get(
     *     path = "/all-agents",
     *     name="app_user-agents_Ref",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Get(
     *  tags={"User"},
     *  summary="Gets All Agents users",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=AppUser::class, groups={"AppUserGroup"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * @Security(name="Bearer")
     * )
     */

    public function getAgentUsersAction()
    {
        $tabRoles = ['ROLE_CYNAPSYS', 'ROLE_ADMIN', 'ROLE_SUPER_ADMIN'];
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
            $userLogged = $this->tokenStorage->getToken()->getUser();
            $roles = $userLogged->getUserRoles();
            $role = $roles[0];

            $roleName = $role->getRole();

            if (in_array($roleName, $tabRoles)) {
                $users = $this->getDoctrine()->getRepository(AppUser::class)->getAllUserFilterRolesAgentEnableDisable();
            } else {
                $users = $this->getDoctrine()->getRepository(AppUser::class)->getAllUserFilterRolesAgent();
            }

            return $users;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(serializerGroups={"AppUserGroup"})
     * @Rest\Get(
     *     path = "/bypage",
     *     name="app_user_Pagination",
     *     options={ "method_prefix" = false }
     * )
     * @Rest\QueryParam(
     *     name="username",
     *     nullable=true,
     *     description="Username to search for."
     * )
     * @Rest\QueryParam(
     *     name="nomFr",
     *     nullable=true,
     *     description="nomFr to search for."
     * )
     * @Rest\QueryParam(
     *     name="prenomFr",
     *     nullable=true,
     *     description="prenomFr to search for."
     * )
     * @Rest\QueryParam(
     *     name="prenomAr",
     *     nullable=true,
     *     description="prenomAr to search for."
     * )
     * @Rest\QueryParam(
     *     name="nomAr",
     *     nullable=true,
     *     description="nomAr to search for."
     * )
     * @Rest\QueryParam(
     *     name="fonction",
     *     nullable=true,
     *     description="fonction to search for."
     * )
     * @Rest\QueryParam(
     *     name="grade",
     *     nullable=true,
     *     description="grade to search for."
     * )
     * @Rest\QueryParam(
     *     name="role",
     *     nullable=true,
     *     requirements="\d+",
     *     description="Id role to search for."
     * )
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="desc",
     *     description="Sort order (asc or desc)"
     * )
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="10",
     *     description="Max number of user per page."
     * )
     * @Rest\QueryParam(
     *     name="page",
     *     requirements="\d+",
     *     default="1",
     *     description="The current page"
     * )
     * @SWG\Get(
     *  tags={"User"},
     *  summary="Gets all users with pagination",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=AppUser::class, groups={"AppUserGroup"}))),
     * @SWG\Response(response="404", description="Returned when mission not found"),
     * )
     */
    public function getUserpaginationAction(ParamFetcherInterface $paramFetcher)
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
            $userLogged = $this->tokenStorage->getToken()->getUser();
            $roles = $userLogged->getUserRoles();
            $role = $roles[0];
            $roleName = $role->getRole();
//dump($paramFetcher->get('role')).die();
            $pager = $this->getDoctrine()->getRepository(AppUser::class)->search(
                $roleName,
                $paramFetcher->get('username'),
                $paramFetcher->get('nomFr'),
                $paramFetcher->get('prenomFr'),
                $paramFetcher->get('prenomAr'),
                $paramFetcher->get('nomAr'),
                $paramFetcher->get('fonction'),
                $paramFetcher->get('grade'),
                $paramFetcher->get('role'),
                $paramFetcher->get('order'),
                $paramFetcher->get('limit'),
                $paramFetcher->get('page')
            );
            return new UsersApp($pager);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View()
     * @ParamConverter("modifiedUser", converter="fos_rest.request_body",
     *     options={"validator" = {"groups" = {"Patch"}}}
     * )
     * @Rest\Patch(
     *     path = "/{user}",
     *     name="app_user_Edit",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Patch(
     *  tags={"User"},
     *  summary="edit user",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="user",
     *     in="path",
     *     description="user id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Parameter(
     *     name="user",
     *     in="body",
     *     description="user",
     *     required=true,
     *     @SWG\Schema(type="array",@Model(type=AppUser::class))
     * ),
     * @SWG\Response(response="200", description="Returned when Resource modified",@SWG\Schema(type="array", @Model(type=AppUser::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function patchUserAction(?AppUser $user, AppUser $modifiedUser, ConstraintViolationListInterface $validationErrors)
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
            //var_dump($modifiedUser);die();
            if (null === $user) {
                $apiProblem = new ApiProblem(
                    404,
                    ApiProblem::USER_NOT_EXIST
                );
                throw new ApiProblemException($apiProblem);
            }
            if (count($validationErrors) > 0) {
                throw new ValidationException($validationErrors);
            }
            //Merge entities
            $this->entityMerger->merge($user, $modifiedUser);
            //Persist
            $em = $this->getDoctrine()->getManager();
            $user->setEnable(true);
            if ($modifiedUser->getPassword()) {
                $user->setPlainPassword($modifiedUser->getPassword());
                //dump($modifiedUser->getPassword());die();
            }
            //dump($user);die();
            $em->persist($user);
            $em->flush();
            //Return
            return $user;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\Post(
     *     path = "/affect_role/{id_user}/{id_role}",
     *     name="app_user-role_Add",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Post(
     *  tags={"User"},
     *  summary="affect role to  user",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id_user",
     *     in="path",
     *     description="user id",
     *     required=true,
     *     type="integer"
     * ),
     *     * @SWG\Parameter(
     *     name="id_role",
     *     in="path",
     *     description="role id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Response(response="201", description="Returned when Resource modified",@SWG\Schema(type="array", @Model(type=AppUser::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function postAffectRoleAction($id_user, $id_role)
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
            //Get a reference to the user and the role
            $user = $this->em()->getReference('MfpeConfigBundle:AppUser', $id_user);
            $role = $this->em()->getReference('MfpeConfigBundle:Role', $id_role);
            //Check if the user exist. Return 404 if not.
            if ($user === null) {
                return $this->createApiResponse("User not found", 404);
            }
            //Check if the role exist. Return 404 if not.
            if ($role === null) {
                return $this->createApiResponse("Role not found", 404);
            }

            //Add the role to the user and persist it to the database.
            $user->addRole($role);
            $this->em()->persist($user);
            $this->em()->flush();

            //return 200 success response with the user
            return $this->createApiResponse($user, 200);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 201, serializerGroups={"AppUserGroup"})
     * @Rest\Post(
     *     path = "/register",
     *     name="app_user_Add",
     *     options={ "method_prefix" = false }
     * )
     * @ParamConverter("appUser", converter="fos_rest.request_body",
     *                  options={"deserializationContext"={"groups"={"DeserializeUserGroup"}}})
     *
     * @SWG\Post(
     *  tags={"User"},
     *  summary="user register",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="201", description="Returned when successful",@SWG\Schema(type="array", @Model(type=AppUser::class, groups={"DeserializeUserGroup"}))),
     * @SWG\Response(response="404", description="Returned when register not found"),
     * )
     */
    public function postUserAction(AppUser $appUser, ConstraintViolationListInterface $validationErrors)
    {
        //Check if the username already exist to enforce the unique constraint for the attribute. Return 409 response
        if (count($validationErrors) > 0) {
            throw new ValidationException($validationErrors);
        }
        $usernameExist = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findBy(array("username" => $appUser->getUsername()));
        if ($usernameExist)
            $this->throwProblem(null, 409, ApiProblem::USERNAME_ALREADY_EXISTS);

        //Check if the email already exist to enforce the unique constraint for the attribute. Return 409 response
        $EmailExist = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findBy(array("email" => $appUser->getEmail()));
        if ($EmailExist)
            $this->throwProblem(null, 409, ApiProblem::EMAIL_ALREADY_EXISTS);

        // Set password
        $appUser->setPlainPassword($appUser->getPassword());
        // set Role
        $appUser->getUserRoles() ? $roles = $appUser->getUserRoles() : $roles = null;
        $this->throwProblem($roles, 404, ApiProblem::ROLE_NOT_EXIST, "===", null);
        $this->throwProblem(count($roles), 404, ApiProblem::ROLE_NOT_EXIST, "<=", 0);

        $roleId = array();
        if (count($roles) == 0) {
            $this->$this->throwProblem(count($roleId), 400, ApiProblem::ROLE_NOT_EXIST);
        }
        foreach ($roles as $role) {
            $roleIdControle = $this->em()->getRepository(Role::class)->find($role->getId());
            $this->throwProblem($roleIdControle, 404, ApiProblem::ROLE_NOT_EXIST, "===", null);
            $roleId[] = $roleIdControle;
        }
        $appUser->setUserRoles($roleId);
        //Persist the user in the database
        $this->tryPersist($appUser);
        return $this->createApiResponse($appUser, 201);
    }

    /**
     * @Rest\View(serializerGroups={"AppUserGroup"})
     * @ParamConverter(
     *     "modifiedAppUser",
     *     converter="fos_rest.request_body",
     *     options={"validator" = {"groups" = {"Patch"}},
     *     "deserializationContext"={"groups"={"DeserializeUserGroup"}}},
     * )
     * @Rest\Patch(
     *     path = "/edit/{appUser}",
     *     name="app_user_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"appUser"="\d+"}
     * )
     *
     * @SWG\Patch(
     *  tags={"User"},
     *  summary="user edit",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="appUser",
     *     in="path",
     *     description="user id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=AppUser::class, groups={"DeserializeUserGroup"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function EditUserAction(?AppUser $appUser, AppUser $modifiedAppUser, ConstraintViolationListInterface $validationErrors)
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
            if (count($validationErrors) > 0) {
                throw new ValidationException($validationErrors);
            }
            //Check if the username already exist to enforce the unique constraint for the attribute. Return 409 response
            $usernameExist = $this->getDoctrine()->getRepository(AppUser::class)
                ->findSameUsername($appUser->getId(), $modifiedAppUser->getUsername());
            if ($usernameExist > 0)
                $this->throwProblem(null, 409, ApiProblem::USERNAME_ALREADY_EXISTS);
            //Check if the email already exist to enforce the unique constraint for the attribute. Return 409 response
            $EmailExist = $this->getDoctrine()->getRepository(AppUser::class)->findSameMail($appUser->getId(), $modifiedAppUser->getEmail());
            if ($EmailExist > 0)
                $this->throwProblem(null, 409, ApiProblem::EMAIL_ALREADY_EXISTS);
            // set Role
            $modifiedAppUser->getUserRoles() ? $roles = $modifiedAppUser->getUserRoles() : $roles = null;
            $this->throwProblem($roles, 404, ApiProblem::ROLE_NOT_EXIST, "===", null);
            $this->throwProblem(count($roles), 404, ApiProblem::ROLE_NOT_EXIST, ">", 0);
            $roleId = array();
            foreach ($roles as $role) {
                $roleIdControle = $this->em()->getRepository(Role::class)->find($role->getId());
                $this->throwProblem($roleIdControle, 404, ApiProblem::ROLE_NOT_EXIST, "===", null);
                $roleId[] = $roleIdControle;
            }
            $modifiedAppUser->setUserRoles($roleId);
            //Merge entities
            $this->entityMerger->merge($appUser, $modifiedAppUser);

            //Persist
            $this->tryPersist($appUser);
            //return 200 success response with the modified user
            return $this->createApiResponse($appUser, 202);
            // return $appUser;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"AppUserGroup"})
     * @Rest\Delete(
     *     path = "/{id}",
     *     name="app_user_Delete",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"User"},
     *  summary="delete auth user",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="user id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Response(response="200", description="Returned when Resource deleted",@SWG\Schema(type="array", @Model(type=AppUser::class, groups={"AppUserGroup"}))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function deleteUserAction($id)
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
        $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->find($id);
        //Check if the user exist. Return 404 if not.
        if ($user === null) {
            return $this->createApiResponse("User not found", 404);
        }
        //Remove the role from the database
        //$this->em()->remove($user);
        $this->desactiveentity($user);
        return new JsonResponse(['status' => Response::HTTP_OK, 'code' => Response::HTTP_OK, 'data' => null], Response::HTTP_OK);
    }


    /**
     * @Rest\Delete(
     *     path = "/remove_role/{id_user}/{id_role}",
     *     name="app_user-role_Delete",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Delete(
     *  tags={"User"},
     *  summary="delete role to user",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id_user",
     *     in="path",
     *     description="user id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Parameter(
     *     name="id_role",
     *     in="path",
     *     description="role id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Response(response="200", description="Returned when Resource deleted" ,@SWG\Schema(type="array", @Model(type=AppUser::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function deleteUserRoleAction($id_user, $id_role)
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
            //Get a reference to the user and the role
            $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->find($id_user);
            $role = $this->em()->getRepository('MfpeConfigBundle:Role')->find($id_role);
            //Check if the user exist. Return 404 if not.
            if ($user === null) {
                return $this->createApiResponse("User not found", 404);
            }
            //Check if the role exist. Return 404 if not.
            if ($role === null) {
                return $this->createApiResponse("Role not found", 404);
            }
            //Remove the role from the user and persist it to the database.
            $user->removeRole($role);
            $this->em()->persist($user);
            $this->em()->flush();

            //return 200 success response with the user
            return $this->createApiResponse($user, 200);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"AppUserGroup","uniteRegional"})
     * @Rest\Get(
     *     path = "/{user}",
     *     name="app_user_Get",
     *     options={ "method_prefix" = false },
     *     requirements = {"user"="\d+"}
     * )
     * @SWG\Get(
     *  tags={"User"},
     *  summary="Gets the user with id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="user id",
     *     required=true
     * ),
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=AppUser::class, groups={"AppUserGroup"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getUserAction(?AppUser $user)
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
            if (!is_object($userConnected = $token->getUser())) {
                $message = ApiProblem::TOKEN_JWT_EXPIRED;
                $errors['token'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            if (!$user) {
                $message = ApiProblem::USER_NOT_EXIST;
                $errors['user'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            return $user;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"AppUserGroup"})
     * @Rest\Get(
     *     path = "/current-user",
     *     name="app_current-user_Get",
     *     options={ "method_prefix" = false },
     * )
     * @SWG\Get(
     *  tags={"User"},
     *  summary="Get current user",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=AppUser::class, groups={"AppUserGroup"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getCurrentUserAction()
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
            if (!$this->container->has('security.token_storage')) {
                return $this->createApiResponse("Token not found", 401);
            }
            if (null === $token = $this->container->get('security.token_storage')->getToken()) {
                return $this->createApiResponse("Token not found", 401);
            }
            if (!is_object($user = $token->getUser())) {
                // e.g. anonymous authentication
                return $this->createApiResponse("Token not found", 401);
            }
            return $user;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\Post(
     *     path = "/sendmail",
     *     name="app_user_sendmail_password",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Post(
     *  tags={"User"},
     *  summary="Send mail reinitialisation password",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="email",
     *     in="path",
     *     description="email user",
     *     required=true,
     *     type="string"
     * ),
     * @SWG\Parameter(
     *     name="url",
     *     in="path",
     *     description=" url de réinitialisation mot de passe",
     *     required=false,
     *     type="string"
     * ),
     *
     * @SWG\Response(response="201", description="Returned when Resource modified",@SWG\Schema(type="array", @Model(type=ResetPassword::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function postRestPasswordAction(\Swift_Mailer $mailer, Request $request)
    {

        $email = $request->get('email');
        $url = $request->get('url');
        $appUser = $this->em()->getRepository(AppUser::class)->findOneBy(['email' => $email]);

        $this->throwProblem($appUser, 404, ApiProblem::USER_NOT_EXIST, "===", null);
        $enable = $appUser->getEnable();
        $this->throwProblem($enable, 404, ApiProblem::USER_NOT_ENABLED, "===", null);
        if ($appUser !== null) {
            $ResetPassword = new ResetPassword();
            $ResetPassword->setUser($this->em()->getReference(AppUser::class, $appUser->getId()));
            $ResetPassword->setValidate(1);
            $token = bin2hex(random_bytes(64));
            $ResetPassword->setToken($token);
            $expiredDate = date('Y-m-d H:i:s', strtotime('+1 day', time()));
            $ResetPassword->setDateExpiration($expiredDate);
            $this->em()->persist($ResetPassword);
            $this->em()->flush();
            $url_reset = str_replace("_", "/", $url);
            try {
                $mail_sender = $this->container->getParameter('mailer_user');
                $message = (new \Swift_Message('Demande de nouveau mot de passe '))
                    ->setFrom($mail_sender)
                    ->setTo($email)
                    ->setBody('<html>' .
                        '<head></head>' .
                        '<body>' .
                        'Bonjour,<br> <br>
                 <p>   Vous avez demandé de réinitialiser votre mot de passe GBO. Si vous n\'avez pas sollicité ce message, vous pouvez ignorer cet email sans cliquer sur le lien.Le lien ci-dessous vous mènera directement dans votre compte, afin que vous puissiez réinitialiser votre mot de passe vous-même: <a href="' . $url_reset . '?token=' . $token . '">réinitialiser votre mot de passe.</a></p>
                    <br><br>
                  Bien à vous,  ' .

                        '</body>' .
                        '</html>'
                        , 'text/html');

                $mailer->send($message);
            } catch (\Swift_TransportException $Ste) {
                return $Ste->getMessage();

            }

            return $this->createApiResponse("email de réinitialisation mot de passe envoyé avec succès", 200);

        }
    }


    /**
     * @Rest\View(StatusCode = 200,serializerGroups={"PasswordGroup"})
     * )
     * @Rest\Patch(
     *     path = "/edit/password",
     *     name="app_Edit_password_forgotten",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Patch(
     *  tags={"User"},
     *  summary="edit password",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="token",
     *     in="path",
     *     description="token envoyé par mail",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Parameter(
     *     name="password",
     *     in="path",
     *     description="nouveau password",
     *     required=true,
     *     type="string"
     * ),
     * @SWG\Response(response="200", description="Returned when Resource modified",@SWG\Schema(type="array", @Model(type=ResetPassword::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function patchPasswordAction(Request $request)
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
            $token = $request->get('token');
            $password = $request->get('password');
            $user_token = $this->em()->getRepository(ResetPassword::class)->findOneBy(['token' => $token]);
            $this->throwProblem($user_token, 404, ApiProblem::TOKEN_NOT_EXIST, "===", null);
            $isvalide = $user_token->getValidate();
            $this->throwProblem($isvalide, 404, ApiProblem::TOKEN_NOT_VALIDE, "===", null);
            $dateExpirationToken = $user_token->getDateExpiration();
            $dateNow = date('Y-m-d H:i:s', time());
            $date_exp = StrToTime($dateExpirationToken);
            $date_actuelle = StrToTime($dateNow);
            $diff = $date_exp - $date_actuelle;
            $nb_hours = $diff / (60 * 60);
            if ($nb_hours < 0) {
                $user_token->setValidate(0);
                $this->tryPersist($user_token);
                $this->throwProblem(null, 404, ApiProblem::TOKEN_EXPIRED);;
            } else {
                $id_user = $user_token->getUser();
                $user = $this->em()->getRepository(AppUser::class)->find($id_user);
                $user_token->setValidate(0);
                $user->setPlainPassword($password);
                $this->tryPersist($user);
                $this->tryPersist($user_token);
                return $this->createApiResponse("succes de modification password", 200);
            }
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * @Rest\Delete(
     *     path = "/users",
     *     name="app_users_Delete",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"User"},
     *  summary="delete multiple auth users",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when Resource deleted",@SWG\Schema(type="array", @Model(type=AppUser::class))),
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
                $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->find($id);
                //Check if the user exist. Return 404 if not.
                if ($user === null) {
                    return $this->createApiResponse("User not found", 404);
                }
                $this->desactiveentity($user);
            }
            //Remove the role from the database
            //return 200 success response with all the users
            $users = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findBy(["deleted" => false]);
            return $this->createApiResponse($users, 200);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"AppUserGroup"})
     * @Rest\Put(
     *     path = "/change_password",
     *     name = "app_user_EditPassword",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"User"},
     *  summary="update password",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="new password ",
     *     required=true,
     *     @SWG\Schema(type="array",@Model(type=AppUser::class))
     * ),
     * @SWG\Response(response="200", description="Returned when Resource updateded",@SWG\Schema(type="array", @Model(type=AppUser::class))),
     * @SWG\Response(response="400", description="Returned when invalid data update"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     * @Rest\RequestParam(name="password")
     */
    public function putAction(ParamFetcher $paramFetcher)
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
            $messageEchec = ApiProblem::PASSWORD_USER_RESET_ECHEC;
            if (null === $token = $this->container->get('security.token_storage')->getToken()) {
                return $this->createApiResponse('Token not exist.', 400);
            }
            if (!is_object($user = $token->getUser())) {
                // e.g. anonymous authentication
                return $this->createApiResponse('Token not exist.', 400);
            }

            if (!$user) {
                $message = ApiProblem::USER_NOT_EXIST;
                $errors['password'] = $message;
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $messageEchec, 'data' => $errors], Response::HTTP_BAD_REQUEST);
            }
            // $this->throwProblem($user, 404, ApiProblem::USER_NOT_EXIST);
            $password = $paramFetcher->get('password'); // new password
            if (!$password) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['password'] = $message;
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $messageEchec, 'data' => $errors], Response::HTTP_BAD_REQUEST);
            }
            $user->setFirstLogin(1);
            //$this->throwProblem($password, 400, ApiProblem::PASSWORD_REQUIRED);
            $user->setPlainPassword($password);
            $user->setPasswordPrint($password);
            $userFinal = array();
            $userFinal["details"] = $user;
            $userFinal["ecrans"] = array();
            $userFinal["ecrans"] = $this->interfaceUsersConnecte($user);
            $userFinal["demande_status"]["status"] = $this->getStatesToSee($user);
            $userFinal["demande_status"]["stateExecute"] = $this->getStatesToExecute($user);
//        $user->setFirstLogin(0);
            $this->em()->persist($user);
            $this->em()->flush();

            //send mailer
//        $template = 'Emails/update_password_citoyen.html.twig';
//        $parameters = array(
//            'currentUser' => $user,
//            'dataAuth' => array('login' => $user->getUsername(),
//                'password' => $password
//            )
//        );
//        $from = $this->container->getParameter('mailer_user');
//        $to = $user->getEmail();
//        $subject = $this->container->getParameter('object_update_password_citoyen');
//        $this->get('mfpe_configbundle_mailer_sendmailer')->sendMailer($template, $parameters, $from, $to, $subject, NULL);

            $userFinal = $this->get('jms_serializer')->serialize($userFinal, 'json', SerializationContext::create()->setGroups(array('AppUserGroup')));
            $userFinal = json_decode($userFinal, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => 'sucess', 'code' => Response::HTTP_ACCEPTED, 'data' => $userFinal], Response::HTTP_ACCEPTED);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @param AppUser $user
     * @return string
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function getToken(AppUser $user)
    {
        return $this->get('lexik_jwt_authentication.encoder')
            ->encode(
                [
                    'username' => $user->getUsername()
                ]
            );
    }

    //return les interfaces du users connecté
    public function interfaceUsersConnecte($user)
    {
        $frontInterface = array();
        $frontI = array();
        if ($this->getToken($user) != null && $user != "anon.") {
            //récupérer le user connecté à partir du tocken
            // $user = $this->tokenStorage->getToken()->getUser();
            //récupérer les roles du user connecté à partir du tocken
            $roles = $user->getUserRoles();
            foreach ($roles as $role) {
                //stocker les frontInterfaces du user connecté
                array_push($frontInterface, $role->getFrontInterfaces());
            }
            //faire le merge des interface et éliminer les niveaux
            $allFrontToSee = array_merge([], ...$frontInterface);
            //eliminer les doublon du tableau
            $frontI = array_unique($allFrontToSee);
        }
        return $frontI;
    }

    //return states to see of current user
    public function getStatesToSee($user)
    {
        $status = array();
        if ($this->getToken($user) != null && $user != "anon.") {
            //récupérer le user connecté à partir du tocken
            // $user = $this->tokenStorage->getToken()->getUser();
            //récupérer les roles du user connecté à partir du tocken
            $roles = $user->getUserRoles();
            foreach ($roles as $role) {
                //push states to see and states to execute of current user
                array_push($status, $role->getStatus());
            }
            //Merge states to see  of current user
            $response = array_merge([], ...$status);
            //eliminer les doublon du tableau
            $response = array_unique($response);
        }
        return $response;
    }

    //return to execute of current user
    public function getStatesToExecute($user)
    {
        $stateExecute = array();
        if ($this->getToken($user) != null && $user != "anon.") {
            //récupérer le user connecté à partir du tocken
            // $user = $this->tokenStorage->getToken()->getUser();
            //récupérer les roles du user connecté à partir du tocken
            $roles = $user->getUserRoles();
            foreach ($roles as $role) {
                //push states to see and states to execute of current user
                array_push($stateExecute, $role->getStateExecute());
            }
            //Merge states to see and states to execute of current user
            $response = array_merge([], ...$stateExecute);
            //eliminer les doublon du tableau
            $response = array_unique($response);
        }
        return $response;
    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"AppUserGroup"})
     * @Rest\Put(
     *     path = "/reset_password",
     *     name = "app_user_ResetPassword",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Put(
     *  tags={"User"},
     *  summary="Reset password",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="body",
     *     in="body",
     *     description="Reset password",
     *     required=true,
     *     @SWG\Schema(type="array",@Model(type=AppUser::class))
     * ),
     * @SWG\Response(response="200", description="Returned when Resource updateded",@SWG\Schema(type="array", @Model(type=AppUser::class))),
     * @SWG\Response(response="400", description="Returned when invalid data update"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     * @Rest\RequestParam(name="identity")
     */
    public function ResetAction(ParamFetcher $paramFetcher)
    {
        $username = $paramFetcher->get('identity');
        $errors = [];
        $messageSuccess = ApiProblem::PASSWORD_USER_RESET_SUCCESS;
        $messageEchec = ApiProblem::PASSWORD_USER_RESET_ECHEC;
        if (!$username) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['identity'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $messageEchec, 'data' => $errors], Response::HTTP_BAD_REQUEST);
        }
        $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array('email' => $username));

        if (!$user) {
            $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array('numCin' => $username));
            if (!$user) {
                $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array('numPassport' => $username));
            }
            if (!$user) {
                $message = ApiProblem::USER_NOT_EXIST;
                $errors['identity'] = $message;
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $messageEchec, 'data' => $errors], Response::HTTP_BAD_REQUEST);
            }


        }
        if ($user) {
            $roles = $user->getUserRoles();
            $roleUser = [];
            foreach ($roles as $role) {
                array_push($roleUser, $role->getRole());
            }
            if (!in_array("ROLE_CITOYEN", $roleUser)) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_UNAUTHORIZED, 'data' => ApiProblem::USER_NOT_EXIST, 'message' => ApiProblem::USER_NOT_EXIST], Response::HTTP_UNAUTHORIZED);
            }
        }
        $nationalite = $user->getNationalite();
        if (strpos(strtolower($nationalite->getIntituleFr()), 'tunis') !== false) {
            $password = $user->getNumCin();
            $user->setPlainPassword($user->getNumCin());
            $user->setPasswordPrint($user->getNumCin());
        } else {
            $password = $user->getNumPassport();
            $user->setPlainPassword($user->getNumPassport());
            $user->setPasswordPrint($user->getNumPassport());
        }
        $user->setFirstLogin(0);
        $this->em()->flush();
        //send mailer
        $template = 'Emails/update_password_citoyen.html.twig';
        $parameters = array(
            'currentUser' => $user,
            'dataAuth' => array('login' => $user->getUsername(),
                'password' => $password
            )
        );
        $from = $this->container->getParameter('mailer_user');
        $to = $user->getEmail();
        $subject = $this->container->getParameter('object_update_password_citoyen');
        $this->get('mfpe_configbundle_mailer_sendmailer')->sendMailer($template, $parameters, $from, $to, $subject, NULL);
        return new JsonResponse(['status' => 'sucess', 'code' => Response::HTTP_ACCEPTED, 'message' => $messageSuccess, 'data' => $errors], Response::HTTP_ACCEPTED);
    }

    /**
     * @Rest\Post(
     *     path = "/inscription",
     *     name = "app_user-inscription_Add"
     * )
     * @SWG\Post(
     *  tags={"User"},
     *  summary="Inscription user",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="201", description="Returned when Resource created"),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="nationalite",
     *                  title="nationalite",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="123"),
     *              ),
     *              @SWG\Property(property="num_cin", type="string", example="12345678"),
     *              @SWG\Property(property="date_delivrance_cin", type="string", example="19-06-2019"),
     *              @SWG\Property(property="num_passport", type="string", example="12345678"),
     *              @SWG\Property(property="date_delivrance_passport", type="string", example="19-06-2019"),
     *              @SWG\Property(property="num_carte_sejour", type="string", example="55894555"),
     *              @SWG\Property(property="date_validite_sejour", type="string", example="19-06-2019"),
     *              @SWG\Property(property="nom", type="string", example="admin"),
     *              @SWG\Property(property="prenom", type="string", example="admin"),
     *              @SWG\Property(property="date_naissance", type="string", example="19-06-2019"),
     *              @SWG\Property(
     *                  property="gouvernorat",
     *                  title="Gouvernoat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="123"),
     *              ),
     *              @SWG\Property(
     *                  property="delegation",
     *                  title="Delegation",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="123"),
     *              ),
     *              @SWG\Property(property="lieu_naissance", type="string", example="Tunis"),
     *              @SWG\Property(
     *                  property="tel",
     *                  title="telephone",
     *                  type="object",
     *                  @SWG\Property(property="countryCode", type="string", example="tn"),
     *                  @SWG\Property(property="dialCode", type="integer", example=216),
     *                  @SWG\Property(property="name", type="string", example="Tunisia"),
     *                  @SWG\Property(property="number", type="integer", example=22100200),
     *              ),
     *              @SWG\Property(property="email", type="string", example="admin@admin.com"),
     *              @SWG\Property(property="sexe", type="string", example="Homme"),
     *              @SWG\Property(property="personne_besoin_specifique", type="string", example=0),
     *              @SWG\Property(
     *                  property="nature_besoin_specifique",
     *                  title="Nature besoin specifique",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="123"),
     *              ),
     *              @SWG\Property(
     *                  property="niveau_etude",
     *                  title="Niveau etude",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="123"),
     *              ),
     *              @SWG\Property(property="preview", type="string", example=false),
     *          )
     *
     *      ),
     * )
     */
    public function inscriptionAction(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
            $errors = $this->validateInscription($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL, 'preview' => $data['preview']], Response::HTTP_BAD_REQUEST);
            }

            $user = new AppUser();
            $nationalite = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["nationalite"]["id"]);
            if (!$nationalite) {
                return $this->createApiResponse("Referenciel nationalite not found", 404);
            }
            $user->setNationalite($nationalite);

            if (strpos($nationalite->getIntituleFr(), 'unis') !== false) {
                $login = 'TUN-' . $data["num_cin"];
                $user->setNumCin($data["num_cin"]);
                $date_delivrance_cin = new \DateTime($data["date_delivrance_cin"]);
                $user->setDateDelivranceCin($date_delivrance_cin);
                $password = $data["num_cin"];
                $user->setPasswordPrint($data["num_cin"]);
                $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                $encodedPassword = $encoder->encodePassword($data["num_cin"], $user->getSalt());
            } else {
                $login = $nationalite->getCode() . '-' . $data["num_passport"];
                $user->setNumPassport($data["num_passport"]);
                $date_delivrance_passport = new \DateTime($data["date_delivrance_passport"]);
                $user->setDateDelivrancePassport($date_delivrance_passport);
                $user->setNumCarteSejour($data["num_carte_sejour"]);
                $date_validite_sejour = new \DateTime($data["date_validite_sejour"]);
                $user->setDateValiditeSejour($date_validite_sejour);
                $password = $data["num_passport"];
                $user->setPasswordPrint($data["num_passport"]);
                $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                $encodedPassword = $encoder->encodePassword($data["num_passport"], $user->getSalt());
            }
            $user->setPassword($encodedPassword);
            $user->setNomAr($data["nom"]);
            $user->setNomFr($data["nom"]);
            $user->setPrenomAr($data["prenom"]);
            $user->setPrenomFr($data["prenom"]);
            $user->setUsername($login);
            $user->setIdentifiant($login);
            $date_naissance = new \DateTime($data["date_naissance"]);
            $user->setDateNaissance($date_naissance);
            $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["gouvernorat"]["id"]);
            $user->setGouvernorat($gouvernorat);
            $user->setGouvernoratResidence($gouvernorat);
            $delegation = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["delegation"]["id"]);
            $user->setDelegation($delegation);
            $user->setDelegationResidence($delegation);
            $user->setLieuNaissance($data['lieu_naissance']);
            $user->setTel("+" . $data["tel"]["dialCode"] . " " . $data["tel"]["number"]);
            $user->setEmail($data["email"]);
            $user->setEnable(true);
            $user->setSexe($data["sexe"]);
            $user->setPersonneBesoinSpecifique($data["personne_besoin_specifique"]);
            if ($data["personne_besoin_specifique"] == 1) {
                $natureBesoinSpecifique = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["nature_besoin_specifique"]["id"]);
                $user->setNatureBesoinSpecifique($natureBesoinSpecifique);
            }
            $niveauEtude = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["niveau_etude"]["id"]);
            if (!$niveauEtude) {
                return $this->createApiResponse("Referenciel niveauEtude not found", 404);
            }

            $user->setNiveauEtude($niveauEtude);
            // set Role
            $roles = $this->em()->getRepository('MfpeConfigBundle:Role')->findByRole('ROLE_CITOYEN');
            foreach ($roles as $role) {
                $user->setUserRoles(array($role));
            }

            //persist data
            if ($data['preview'] == 'true') {
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
                $currentUser = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findUser($user->getId());
                //send mailer
                $template = 'Emails/inscription_citoyen.html.twig';
                $parameters = array(
                    'currentUser' => $currentUser,
                    'dataAuth' => array('login' => $login,
                        'password' => $password
                    ),
                    'url_authentication' => $this->container->getParameter('url_authentication'),
                    'host' => $this->getParameter('host')
                );
                $from = $this->container->getParameter('mailer_user');
                $to = $user->getEmail();
                $subject = $this->container->getParameter('object_mail_inscription_citoyen');
                $this->get('mfpe_configbundle_mailer_sendmailer')->sendMailer($template, $parameters, $from, $to, $subject, NULL);
                $user = $this->get('jms_serializer')->serialize($user, 'json', SerializationContext::create()->setGroups(array('AppUserGroup')));
                $user = json_decode($user, JSON_UNESCAPED_UNICODE);
            }
            return new JsonResponse(['status' => 'success', 'code' => Response::HTTP_CREATED, 'data' => $user, 'preview' => $data['preview']], Response::HTTP_CREATED);

        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(serializerGroups={"AppUserGroup"})
     * @Rest\Post(
     *     path = "/active",
     *     name="app_user_Active",
     *     options={ "method_prefix" = false },
     * )
     *
     * @SWG\Post(
     *  tags={"User"},
     *  summary="activate user",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="token", type="string", example="dfsfsdfsdfs757596dfsdfzexarryculkuykuyj1341"),
     *          )
     *
     *      ),
     * @SWG\Response(response="201", description="Returned when successful",
     * @SWG\Schema(type="array", @Model(type=AppUser::class, groups={"AppUserGroup"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function ActiveUserAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $appUser = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array('token' => $data["token"]));
        if ($appUser === null) {
            return $this->createApiResponse("User not found", 404);
        }
        $dateExpiration = $appUser->getDateExpiration();
        $now = new \DateTime();
        $interval = date_diff($now, $dateExpiration)->format('%R%a');
        if ($interval < 0) {
            $message = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token_link'] = $message;
            return $this->createApiResponse($errors, 400);

        }
        $appUser->setEnable(true);
        //Persist
        $this->tryPersist($appUser);
        $user = $this->get('jms_serializer')->serialize($appUser, 'json', SerializationContext::create()->setGroups(array('AppUserGroup')));
        $user = json_decode($user, JSON_UNESCAPED_UNICODE);
        //return 200 success response with the modified user
        return new JsonResponse(['status' => 'success', 'code' => Response::HTTP_OK, 'data' => $user], Response::HTTP_OK);
    }

    //fonction de validation formulaire
    private function validateInscription($data)
    {
        $errors = [];
        //validate nationalite NOT EMPTY
        if (empty($data["nationalite"]["id"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['nationalite'] = $message;
        } else {
            //validate nationalite DOES NOT EXIST IN DATABASE
            $nationalite = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["nationalite"]["id"]);
            if (!$nationalite) {
                $message = ApiProblem::NATIONALITY_DOES_NOT_EXIST;
                $errors['nationalite'] = $message;
            }
        }
        //validate gouvernorat DOES NOT EXIST IN DATABASE
        if (empty($data['gouvernorat']['id'])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['gouvernorat'] = $message;
        } else {
            $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["gouvernorat"]["id"]);
            if (!$gouvernorat) {
                $message = ApiProblem::GOUVERNERAT_DOES_NOT_EXIST;
                $errors['gouvernorat'] = $message;
            }
        }
        //validate delegation DOES NOT EXIST	IN DATABASE
        if (empty($data['delegation']['id'])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['delegation'] = $message;
        } else {
            $delegation = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["delegation"]["id"]);
            if (!$delegation) {
                $message = ApiProblem::DELEGATION_DOES_NOT_EXIST;
                $errors['delegation'] = $message;
            }
        }
        //validate nature besoin specifique DOES NOT EXIST IN DATABASE
        if ($data["personne_besoin_specifique"] == 1) {
            if (isset($data["nature_besoin_specifique"]["id"])) {
                if (empty($data['nature_besoin_specifique']['id'])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['nature_besoin_specifique'] = $message;

                } else {
                    $natureBesoinSpecifique = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["nature_besoin_specifique"]["id"]);
                    if (!$natureBesoinSpecifique) {
                        $message = ApiProblem::NATURE_BESOIN_SPECIFIQUE_DOES_NOT_EXIST;
                        $errors['nature_besoin_specifique'] = $message;
                    }
                }
            }


        }

        //validate niveau d'étude DOES NOT EXIST  IN DATABASE
        if (empty($data['niveau_etude']['id'])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['niveau_etude'] = $message;
        } else {
            $niveauEtude = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["niveau_etude"]["id"]);
            if (!$niveauEtude) {
                $message = ApiProblem::NIVEAU_ETUDE_DOES_NOT_EXIST;
                $errors['niveau_etude'] = $message;
            }
        }
        //validate Roles DOES NOT EXIST IN DATABASE
        $roles = $this->em()->getRepository('MfpeConfigBundle:Role')->findByRole('ROLE_CITOYEN');
        if (!$roles) {
            $message = ApiProblem::ROLES_DOES_NOT_EXIST;
            $errors['role_not_exist'] = $message;
        }
        if (empty($data['email'])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['email'] = $message;
        } else {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $message = ApiProblem::EMAIL_FALSE;
                $errors['email'] = $message;
            } else {
                //validate User EXIST IN DATABASE
                $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findByEmail($data['email']);
                if ($user) {
                    $message = ApiProblem::EMAIL_EXIST_IN_DATABASE;
                    $errors['email'] = $message;
                }
            }
        }
        //validate nom NOT EMPTY
        if (empty($data["nom"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['nom'] = $message;
        }
        //validate prenom NOT EMPTY
        if (empty($data["prenom"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['prenom'] = $message;
        }
        //validate date naissance NOT EMPTY
        if (empty($data["date_naissance"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['date_naissance'] = $message;
        }


        //validate Code country NOT EMPTY
        if (empty($data["tel"]["dialCode"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['tel'] = $message;
        } else {
            if (!is_numeric($data["tel"]["dialCode"])) {
                $message = ApiProblem::COUNTRY_CODE_TEL_NUMERIQUE;
                $errors['tel'] = $message;
            } else {
                //validate num tel is 13 caractere
                if ($data["tel"]["dialCode"] && strlen($data["tel"]["dialCode"]) > 3) {
                    $message = ApiProblem::COUNTRY_CODE_TEL_EQUAL_3;
                    $errors['tel'] = $message;
                }
            }
        }

        //validate number phone NOT EMPTY
        //validate Code country NOT EMPTY
        if (empty($data["tel"]["dialCode"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['tel'] = $message;
        } else {

            if (!is_numeric($data["tel"]["dialCode"])) {
                $message = ApiProblem::TEL_NUMERIQUE;
                $errors['tel'] = $message;
            }

        }

        //validate number phone NOT EMPTY
        if (empty($data["tel"]["number"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['tel'] = $message;
        } else {
            if (!is_numeric($data["tel"]["number"])) {
                $message = ApiProblem::TEL_NUMERIQUE;
                $errors['tel'] = $message;
            } else {
                //validate num tel is 13 caractere
                if ($data["tel"]["dialCode"] === 216) {
                    if ($data["tel"]["number"] && strlen($data["tel"]["number"]) != 8) {
                        $message = ApiProblem::TEL_EQUAL_8;
                        $errors['tel'] = $message;
                    }
                }

            }
        }
        //validate email NOT EMPTY
        if (empty($data["email"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['email'] = $message;
        }
        //validate sexe NOT EMPTY
        if (empty($data["sexe"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['sexe'] = $message;
        }
        //validate gouvernorat
        if (empty($data["gouvernorat"]["id"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['gouvernorat'] = $message;
        }
        //validate delegation
        if (empty($data["delegation"]["id"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['delegation'] = $message;
        }
        //validation lieu de naissance
        if (empty($data["lieu_naissance"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['lieu_naissance'] = $message;
        }
        //validate personne_besoin_specifique NOT EMPTY
        if (!in_array($data["personne_besoin_specifique"]["id"], array(0, 1))) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['personne_besoin_specifique'] = $message;
        }
        //validate nature_besoin_specifique NOT EMPTY
        if ($data["personne_besoin_specifique"] == 1) {
            if (empty($data["nature_besoin_specifique"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nature_besoin_specifique'] = $message;
            }
        }
        //validate niveau_etude NOT EMPTY
        if (empty($data["niveau_etude"]["id"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['niveau_etude'] = $message;
        }
        // IF Nationalité tunisienne
        if ($data["nationalite"] && $nationalite instanceof Referenciel && strpos($nationalite->getIntituleFr(), 'unis') !== false) {
            //validate num cin NOT EMPTY

            if (empty($data["num_cin"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['num_cin'] = $message;
            }
            //validate num cin is numeric
            if ($data["num_cin"] && !is_numeric($data["num_cin"])) {
                $message = ApiProblem::CIN_NOT_NUMERIC;
                $errors['num_cin'] = $message;
            }
            //validate num cin is 8 caractere
            if ($data["num_cin"] && is_numeric($data["num_cin"]) && strlen($data["num_cin"]) != 8) {
                $message = ApiProblem::CIN_EQUAL_8;
                $errors['num_cin'] = $message;
            } else {
                //validate User EXIST IN DATABASE
                $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findByNumCin($data['num_cin']);
                if ($user) {
                    $message = ApiProblem::CIN_EXIST_IN_DATABASE;
                    $errors['num_cin'] = $message;
                }
            }
            //validate date delivrance passport  NOT EMPTY
            if (empty($data["date_delivrance_cin"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['date_delivrance_cin'] = $message;
            }
        }//IF Nationalité étrangère
        else {
            if ($data["nationalite"]["id"]) {
                //validate passport  NOT EMPTY
                if (empty($data["num_passport"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['num_passport'] = $message;
                }
                //validate num cin is 8 caractere
//            if ($data["num_passport"] && strlen($data["num_passport"]) != 8) {
//                $message = ApiProblem::PASSPORT_EQUAL_8;
//                $errors['num_passport'] = $message;
//            }
                //validate date delivrance passport  NOT EMPTY
                if (empty($data["date_delivrance_passport"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['date_delivrance_passport'] = $message;
                }
                //validate User EXIST IN DATABASE
                $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findByNumPassport($data['num_passport']);
                if ($user) {
                    $message = ApiProblem::PASSPORT_EXIST_IN_DATABASE;
                    $errors['num_passport'] = $message;
                }
            }
        }


        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }

    /**
     * @Rest\View(serializerGroups={"AppUserGroup"})
     * @Rest\Put(
     *     path = "/direction/{id}",
     *     name = "app_update-user-by-direction-original_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"user"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"User"},
     *  summary="Editer compte citoyen par direction regional",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="user",
     *     in="path",
     *     description="user id",
     *     required=true,
     *     type="integer"
     * ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="nationalite",
     *                  title="Nationalite",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="1"),
     *              ),
     *              @SWG\Property(property="num_cin", type="string", example="12345678"),
     *              @SWG\Property(property="date_delivrance_cin", type="string", example="19-06-2019"),
     *              @SWG\Property(property="num_passport", type="string", example="12345678"),
     *              @SWG\Property(property="date_delivrance_passport", type="string", example="19-06-2019"),
     *              @SWG\Property(property="num_carte_sejour", type="string", example="55894555"),
     *              @SWG\Property(property="date_validite_sejour", type="string", example="19-06-2019"),
     *          )
     *
     *      ),
     *
     * ),
     * @SWG\Response(response="200", description="Returned when Resource modified",@SWG\Schema(type="array", @Model(type=AppUser::class, groups={"AppUserGroup"}))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function updateUserByDirectionRegionalAction(Request $request, $id)
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
            $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->find($id);
            if (!$user) {
                return $this->createApiResponse("User not found", 404);
            }
            $nationalite = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["nationalite"]["id"]);
            if (!$nationalite) {
                return $this->createApiResponse(ApiProblem::NATIONALITY_DOES_NOT_EXIST, 400);
            }
            if (strpos($nationalite->getIntituleFr(), 'unis') !== false) {
                if (!$data['num_cin']) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['num_cin'] = $message;
                    return $this->createApiResponse($errors, 400);
                }
                if (!$data['date_delivrance_cin']) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['date_delivrance_cin'] = $message;
                    return $this->createApiResponse($errors, 400);
                }
                $login = 'TUN-' . $data["num_cin"];
                $user->setNumCin($data["num_cin"]);
                $date_delivrance_cin = new \DateTime($data["date_delivrance_cin"]);
                $user->setDateDelivranceCin($date_delivrance_cin);
                $user->setUsername($login);
                $user->setIdentifiant($login);
                $password = $data["num_cin"];
                $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                $encodedPassword = $encoder->encodePassword($data["num_cin"], $user->getSalt());
                $user->setPassword($encodedPassword);
            } else {
                if (!$data['num_passport']) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['num_passport'] = $message;
                    return $this->createApiResponse($errors, 400);
                }
                if (!$data['date_delivrance_passport']) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['date_delivrance_passport'] = $message;
                    return $this->createApiResponse($errors, 400);
                }
                if (!$data['date_validite_sejour']) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['date_validite_sejour'] = $message;
                    return $this->createApiResponse($errors, 400);
                }
                $login = $nationalite->getCode() . '-' . $data["num_passport"];
                $user->setNumPassport($data["num_passport"]);
                $date_delivrance_passport = new \DateTime($data["date_delivrance_passport"]);
                $user->setDateDelivrancePassport($date_delivrance_passport);
                $user->setNumCarteSejour($data["num_carte_sejour"]);
                $date_validite_sejour = new \DateTime($data["date_validite_sejour"]);
                $user->setDateValiditeSejour($date_validite_sejour);
                $user->setUsername($login);
                $user->setIdentifiant($login);
                $password = $data["num_passport"];
                $encoder = $this->get('security.encoder_factory')->getEncoder($user);

                $encodedPassword = $encoder->encodePassword($data["num_passport"], $user->getSalt());
                $user->setPassword($encodedPassword);
            }
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $user = $this->get('jms_serializer')->serialize($user, 'json', SerializationContext::create()->setGroups(array('AppUserGroup')));
            $user = json_decode($user, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $user], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @Rest\Put(
     *     path = "",
     *     name = "app_update-my-account_Edit",
     *     options={ "method_prefix" = false },
     * )
     * @SWG\Put(
     *  tags={"User"},
     *  summary="Update my account",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when Resource created"),
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
     *               @SWG\Property(property="email", type="string", example="admin@admin.com"),
     *              @SWG\Property(property="date_naissance", type="string", example="19-06-2019"),
     *               @SWG\Property(property="date_delivrance_cin", type="string", example="19-06-2019"),
     *               @SWG\Property(property="date_delivrance_passport", type="string", example="19-06-2019"),
     *              @SWG\Property(
     *                  property="tel",
     *                  title="tel",
     *                  type="object",
     *                  @SWG\Property(property="countryCode", type="string", example="tn"),
     *                  @SWG\Property(property="dialCode", type="integer", example=216),
     *                  @SWG\Property(property="name", type="string", example="Tunisia"),
     *                  @SWG\Property(property="number", type="integer", example=22100200),
     *              ),
     *          )
     *
     *      ),
     * )
     */
    public function updateMyAccountAction(Request $request)
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
            $global = ApiProblem::MESSAGE_GLOBAL;
            if (!$this->container->has('security.token_storage')) {
                return $this->createApiResponse("Token not found", 401);
            }
            if (null === $token = $this->container->get('security.token_storage')->getToken()) {
                return $this->createApiResponse("Token not found", 401);
            }
            if (!is_object($user = $token->getUser())) {
                // e.g. anonymous authentication
                return $this->createApiResponse("Token not found", 401);
            }
            if (isset($data['email'])) {
                if (empty($data['email'])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['email'] = $message;
                } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $message = ApiProblem::EMAIL_FALSE;
                    $errors['email'] = $message;
                } else {
                    //Check if the email already exist to enforce the unique constraint for the attribute. Return 409 response
                    $EmailExist = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findBy(array("email" => $data["email"]));
                    if ($EmailExist) {
                        $message = ApiProblem::EMAIL_EXIST_IN_DATABASE;
                        $errors['email'] = $message;
                    }
                }
            }
            if (isset($data['date_naissance'])) {
                if (empty($data["date_naissance"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['date_naissance'] = $message;
                } else {
                    if (!strtotime($data["date_naissance"])) {
                        $message = ApiProblem::DATE_NAISSANCE_NOT_VALID;
                        $errors['date_naissance'] = $message;
                    }
                }
            }
            if (isset($data['date_delivrance_cin'])) {
                if (empty($data["date_delivrance_cin"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['date_delivrance_cin'] = $message;
                } else {
                    if (!strtotime($data["date_delivrance_cin"])) {
                        $message = ApiProblem::DATE_DELIVRANCE_CIN_NOT_VALID;
                        $errors['date_delivrance_cin'] = $message;
                    }
                }
            }

            if (isset($data['date_delivrance_passport'])) {
                if (empty($data["date_delivrance_passport"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['date_delivrance_passport'] = $message;
                } else {
                    if (!strtotime($data["date_delivrance_passport"])) {
                        $message = ApiProblem::DATE_DELIVRANCE_PASSWORT_NOT_VALID;
                        $errors['date_delivrance_passport'] = $message;
                    }
                }
            }

            //validate Code country NOT EMPTY
            if (isset($data["tel"]["dialCode"])) {
                if (empty($data["tel"]["dialCode"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['tel'] = $message;
                } else {
                    if (!is_numeric($data["tel"]["dialCode"])) {
                        $message = ApiProblem::COUNTRY_CODE_TEL_NUMERIQUE;
                        $errors['tel'] = $message;
                    } else {
                        //validate num tel is 13 caractere
                        if ($data["tel"]["dialCode"] && strlen($data["tel"]["dialCode"]) > 3) {
                            $message = ApiProblem::COUNTRY_CODE_TEL_EQUAL_3;
                            $errors['tel'] = $message;
                        }
                    }
                }
            }

            //validate number phone NOT EMPTY
            if (isset($data["tel"]["number"])) {
                if (empty($data["tel"]["number"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['tel'] = $message;
                } else {
                    if (!is_numeric($data["tel"]["number"])) {
                        $message = ApiProblem::TEL_NUMERIQUE;
                        $errors['tel'] = $message;
                    } else {
                        //validate num tel is 13 caractere
                        if ($data["tel"]["number"] && strlen($data["tel"]["number"]) > 13) {
                            $message = ApiProblem::TEL_EQUAL_13;
                            $errors['tel'] = $message;
                        }
                    }
                }
            }


            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $global, 'data' => $errors], Response::HTTP_BAD_REQUEST);
            }
            if (isset($data["email"])) {
                if (filter_var($user->getUsername(), FILTER_VALIDATE_EMAIL)) {
                    $user->setUsername($data["email"]);
                }
                $user->setEmail($data["email"]);
            }
            if (isset($data["date_naissance"])) {
                $date_debut = new \DateTime('01-01-1900');
                $date_naissance = new \DateTime($data["date_naissance"]);
                $date_jour = new \DateTime();

                if (($date_naissance > $date_debut) && ($date_naissance < $date_jour)) {
                    $user->setDateNaissance($date_naissance);
                } else {
                    $message = ApiProblem::DATE_NAISSANCE_NOT_VALID;
                    $errors['date_naissance'] = $message;
                    $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
            }
            if (isset($data["date_delivrance_cin"])) {
                $date_delivrance_cin = new \DateTime($data["date_delivrance_cin"]);
                $user->setDateDelivranceCin($date_delivrance_cin);
            }
            if (isset($data["date_delivrance_passport"])) {
                $date_delivrance_passport = new \DateTime($data["date_delivrance_passport"]);
                $user->setDateDelivrancePassport($date_delivrance_passport);
            }
            if (isset($data["tel"]["dialCode"]) && isset($data["tel"]["number"])) {
                $user->setTel("+" . $data["tel"]["dialCode"] . " " . $data["tel"]["number"]);
            }
            //update
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $userFinal = array();
            $userFinal["details"] = $user;
            $userFinal["ecrans"] = array();
            $userFinal["ecrans"] = $this->interfaceUsersConnecte($user);
            $userFinal["demande_status"]["status"] = $this->getStatesToSee($user);
            $userFinal["demande_status"]["stateExecute"] = $this->getStatesToExecute($user);
            $userFinal = $this->get('jms_serializer')->serialize($userFinal, 'json', SerializationContext::create()->setGroups(array('AppUserGroup')));
            $userFinal = json_decode($userFinal, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $userFinal], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @Rest\Post(
     *     path = "/export_pdf",
     *     name = "app_user-donwloadpdf"
     * )
     * @SWG\Post(
     *  tags={"User"},
     *  summary="Exporter en pdf",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="201", description="Returned when Resource created"),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="lang", type="string", example="fr"),
     *              @SWG\Property(property="email", type="string", example="abc@gmail.com"),
     *          )
     *
     *      ),
     * )
     */
    public function exportpdfAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $lang = $data["lang"];
        if (!$lang) {
            $lang = 'fr';
        }
        $email = $data["email"];
        if ($email) {
            $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array('email' => $email));
        }
        if (!$user) {
            $message = ApiProblem::USER_NOT_EXIST;
            $errors['email'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors], Response::HTTP_BAD_REQUEST);
        }
        $dir = __DIR__ . '../../../../../web/';
        $filePath = $this->get("mfpe_user_doc")->returnPDFResponseFromHTMLvig($dir, $lang, $user);
        $response = array(
            'code' => 0,
            'message' => 'file uploaded!',
            'errors' => null,
            'result' => $filePath
        );
        return new JsonResponse($response, Response::HTTP_CREATED);
    }


    private function validateUpdateAccount($data)
    {

        $errors = [];
        //validate nom directeur AR
        if (isset($data['email'])) {
            if (empty($data['email'])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['email'] = $message;
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $message = ApiProblem::EMAIL_FALSE;
                $errors['email'] = $message;
            } else {
                //Check if the email already exist to enforce the unique constraint for the attribute. Return 409 response
                $EmailExist = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findBy(array("email" => $data["email"]));
                if ($EmailExist) {
                    $message = ApiProblem::EMAIL_EXIST_IN_DATABASE;
                    $errors['email'] = $message;
                }
            }
        }
        if (isset($data['date_naissance'])) {
            if (empty($data["date_naissance"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['date_naissance'] = $message;
            } else {
                if (!strtotime($data["date_naissance"])) {
                    $message = ApiProblem::DATE_NAISSANCE_NOT_VALID;
                    $errors['date_naissance'] = $message;
                }
            }
        }
        if (isset($data['date_delivrance_cin'])) {
            if (empty($data["date_delivrance_cin"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['date_delivrance_cin'] = $message;
            } else {
                if (!strtotime($data["date_delivrance_cin"])) {
                    $message = ApiProblem::DATE_DELIVRANCE_CIN_NOT_VALID;
                    $errors['date_delivrance_cin'] = $message;
                }
            }
        }

        if (isset($data['date_delivrance_passport'])) {
            if (empty($data["date_delivrance_passport"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['date_delivrance_passport'] = $message;
            } else {
                if (!strtotime($data["date_delivrance_passport"])) {
                    $message = ApiProblem::DATE_DELIVRANCE_PASSWORT_NOT_VALID;
                    $errors['date_delivrance_passport'] = $message;
                }
            }
        }

        //validate Code country NOT EMPTY
        if (isset($data["tel"]["dialCode"])) {
            if (empty($data["tel"]["dialCode"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['tel'] = $message;
            } else {
                if (!is_numeric($data["tel"]["dialCode"])) {
                    $message = ApiProblem::COUNTRY_CODE_TEL_NUMERIQUE;
                    $errors['tel'] = $message;
                } else {
                    //validate num tel is 13 caractere
                    if ($data["tel"]["dialCode"] && strlen($data["tel"]["dialCode"]) > 3) {
                        $message = ApiProblem::COUNTRY_CODE_TEL_EQUAL_3;
                        $errors['tel'] = $message;
                    }
                }
            }
        }

        //validate number phone NOT EMPTY
        if (isset($data["tel"]["number"])) {
            if (empty($data["tel"]["number"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['tel'] = $message;
            } else {
                if (!is_numeric($data["tel"]["number"])) {
                    $message = ApiProblem::TEL_NUMERIQUE;
                    $errors['tel'] = $message;
                } else {
                    //validate num tel is 13 caractere
                    if ($data["tel"]["number"] && strlen($data["tel"]["number"]) > 13) {
                        $message = ApiProblem::TEL_EQUAL_13;
                        $errors['tel'] = $message;
                    }
                }
            }
        }
        //validate nom NOT EMPTY
        if (isset($data["nom"])) {
            if (empty($data["nom"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nom'] = $message;
            }
        }
        //validate prenom NOT EMPTY
        if (isset($data["prenom"])) {
            if (empty($data["prenom"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['prenom'] = $message;
            }
        }

        //validate niveau d'étude DOES NOT EXIST  IN DATABASE
        if (isset($data['niveau_etude']['id'])) {
            if (empty($data['niveau_etude']['id'])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['niveau_etude'] = $message;
            } else {
                $niveauEtude = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["niveau_etude"]["id"]);
                if (!$niveauEtude) {
                    $message = ApiProblem::NIVEAU_ETUDE_DOES_NOT_EXIST;
                    $errors['niveau_etude'] = $message;
                }
            }
        }
        //validate nature besoin specifique DOES NOT EXIST IN DATABASE
        if (isset($data["personne_besoin_specifique"])) {
            if (!empty($data["personne_besoin_specifique"])) {

                //validate personne_besoin_specifique NOT EMPTY
                if (!in_array($data["personne_besoin_specifique"]["id"], array(0, 1))) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['personne_besoin_specifique'] = $message;
                }

                if ($data["personne_besoin_specifique"] == 1) {
                    if (isset($data["nature_besoin_specifique"]["id"])) {
                        if (empty($data['nature_besoin_specifique']['id'])) {
                            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                            $errors['nature_besoin_specifique'] = $message;

                        } else {
                            $natureBesoinSpecifique = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["nature_besoin_specifique"]["id"]);
                            if (!$natureBesoinSpecifique) {
                                $message = ApiProblem::NATURE_BESOIN_SPECIFIQUE_DOES_NOT_EXIST;
                                $errors['nature_besoin_specifique'] = $message;
                            }
                        }
                    }
                }
            }

        }
        //validate sexe NOT EMPTY
        if (isset($data["sexe"])) {
            if (empty($data["sexe"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['sexe'] = $message;
            }
        }


        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }


    /**
     * @Rest\View(serializerGroups={"AppUserGroup"})
     * @Rest\Put(
     *     path = "/citoyen/{id}",
     *     name = "app_citoyen_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"appUser"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"User"},
     *  summary="edit User",
     *  description =" edit Ciyoyen info",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="appUser",
     *     in="path",
     *     description="user id",
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
     *              @SWG\Property(property="nom", type="string", example="chedli"),
     *              @SWG\Property(property="prenom", type="string", example="ali"),
     *               @SWG\Property(
     *                  property="niveau_etude",
     *                  title="Niveau etude",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="13"),
     *              ),
     *              @SWG\Property(property="sexe", type="string", example="Homme"),
     *              @SWG\Property(
     *                  property="tel",
     *                  title="tel",
     *                  type="object",
     *                  @SWG\Property(property="countryCode", type="string", example="tn"),
     *                  @SWG\Property(property="dialCode", type="integer", example=216),
     *                  @SWG\Property(property="name", type="string", example="Tunisia"),
     *                  @SWG\Property(property="number", type="integer", example=22100200),
     *              ),
     *              @SWG\Property(property="personne_besoin_specifique", type="boolean", example=1),
     *              @SWG\Property(
     *                  property="nature_besoin_specifique",
     *                  title="Nature besoin specifique",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="12"),
     *              ),
     *
     *          )
     *
     *      ),
     * )
     * @SWG\Response(response="200", description="Returned when Resource modified",@SWG\Schema(type="array", @Model(type=CentreFormation::class, groups={"detailCentreFormation"}))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function updateAccountCitoyenAction(?AppUser $appUser, Request $request)
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
            $errors = $this->validateUpdateAccount($data);
            $global = ApiProblem::MESSAGE_GLOBAL;
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $global, 'data' => $errors], Response::HTTP_BAD_REQUEST);
            }

            $error_global = ApiProblem::MESSAGE_GLOBAL;
            if (empty($appUser)) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['user'] = $message;
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $error_global, 'data' => $errors], Response::HTTP_BAD_REQUEST);
            }
            if (isset($data["tel"]["dialCode"]) && isset($data["tel"]["number"])) {
                $appUser->setTel("+" . $data["tel"]["dialCode"] . " " . $data["tel"]["number"]);
            }
            if (isset($data["nom"])) {
                $appUser->setNomFr($data["nom"]);
                $appUser->setNomAr($data["nom"]);
            }
            if (isset($data["prenom"])) {
                $appUser->setPrenomFr($data["prenom"]);
                $appUser->setPrenomAr($data["prenom"]);
            }
            if (isset($data["sexe"])) {
                $appUser->setSexe(strtoupper($data["sexe"]));
            }

            //validate personne_besoin_specifique NOT EMPTY
            if (in_array($data["personne_besoin_specifique"]["id"], array(0, 1))) {
                $appUser->setPersonneBesoinSpecifique($data["personne_besoin_specifique"]);
            }
            if ($data["personne_besoin_specifique"] == 1) {
                if (isset($data["nature_besoin_specifique"]["id"])) {
                    $natureBesoinSpecifique = $this->em()->getRepository('MfpeReferencielBundle:RefNatureBesoinSpecifique')->find($data["nature_besoin_specifique"]["id"]);

                }
                if ($natureBesoinSpecifique) {
                    $appUser->setNatureBesoinSpecifique($natureBesoinSpecifique);
                }

            }
            $niveauEtude = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["niveau_etude"]["id"]);
            if (!$niveauEtude) {
                return $this->createApiResponse("Referenciel niveauEtude not found", 404);
            }

            $appUser->setNiveauEtude($niveauEtude);
            //update
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $userFinal = array();
            $userFinal["details"] = $appUser;
            $userFinal["ecrans"] = array();
            $userFinal["ecrans"] = $this->interfaceUsersConnecte($user);
            $userFinal["demande_status"]["status"] = $this->getStatesToSee($user);
            $userFinal["demande_status"]["stateExecute"] = $this->getStatesToExecute($user);
            $userFinal = $this->get('jms_serializer')->serialize($userFinal, 'json', SerializationContext::create()->setGroups(array('AppUserGroup', 'ReferencielGroup')));
            $userFinal = json_decode($userFinal, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $userFinal], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


}