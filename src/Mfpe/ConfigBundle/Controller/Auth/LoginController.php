<?php

namespace Mfpe\ConfigBundle\Controller\Auth;

use Mfpe\ConfigBundle\Controller\BaseController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Mfpe\ConfigBundle\Entity\AppUser;
use FOS\RestBundle\Request\ParamFetcher;
use Doctrine\Common\Collections\ArrayCollection;
use Mfpe\ConfigBundle\Entity\Role;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\ConfigBundle\Exception\ApiProblemException;
use Mfpe\ReferencielBundle\Entity\Referenciel;
use Nelmio\ApiDocBundle\Annotation\Model;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Swagger\Annotations as SWG;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactory;
use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\Serializer\Mapping\Loader\AnnotationLoader;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Mfpe\ConfigBundle\Exception\ValidationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController extends BaseController
{
    /**
     * @Rest\View(StatusCode = 200,serializerGroups={"AppUserGroup","RoleGroup","PermissionGroup"})
     * @Rest\Post(
     *     path="/login",
     *     name="app_login_Login",
     *     options={ "method_prefix" = false }
     * )
     * @Rest\RequestParam(name="username")
     * @Rest\RequestParam(name="password")
     * @SWG\Post(
     *  tags={"Auth"},
     *  summary="user login",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful" ,@SWG\Schema(type="array",
     * @SWG\Items(type="object",
     *  @SWG\Property(property="Token", type="string"),
     *  @SWG\Property(property="expirationDate", type="integer"),
     *  @SWG\Property(property="user", type="array" , @Model(type=AppUser::class))),
     * ) ),
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              @SWG\Property(property="username", type="integer", example="bernard84"),
     *              @SWG\Property(property="password", type="integer", example="123"),
     *          ),
     *      ),
     * @SWG\Response(response="404", description="Returned when  not found"),
     * )
     * @throw \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function postLoginAction(ParamFetcher $paramFetcher)
    {
        $global = ApiProblem::MESSAGE_GLOBAL;
        $errors = array();
        // Check username
        $userName = $paramFetcher->get('username');
        if (!$userName) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['username'] = $message;

        } else {
            $user = $this->getDoctrine()
                ->getRepository(AppUser::class)
                ->findOneBy(['username' => $userName]);
            if (!$user) {
                $user = $this->getDoctrine()
                    ->getRepository(AppUser::class)
                    ->findOneBy(['email' => $userName]);
                if (!$user) {
                    $message = ApiProblem::WRONG_PASSWORD;
                    $errors['user'] = $message;
                }
            }
        }
        //$this->throwProblem($user, 404, ApiProblem::USER_NOT_EXIST);
        // Check password
        $password = $paramFetcher->get('password');
        if (!$password) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['password'] = $message;
        }
        if (!$errors) {
            if ($user && $password) {
                $isValid = $this->get('security.password_encoder')
                    ->isPasswordValid($user, $password);

                if (!$isValid) {
                    $message = ApiProblem::WRONG_PASSWORD;
                    $errors['wrong'] = $message;
                }
            }
        }

        if ($errors) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::WRONG_PASSWORD], Response::HTTP_BAD_REQUEST);

        }

        // Check if user is enabled
        if(!$user->getEnable())
        {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $global, 'message' => ApiProblem::DISABLED_USER], Response::HTTP_BAD_REQUEST);

        }

        $userFinal = array();
        $userFinal["details"] = $user;
        $userRoles = $user->getUserRoles();
        $userFinal["ecrans"] = array();
        $userFinal["ecrans"]=$this->interfaceUsersConnecte($user);
        $userFinal["demande_status"]["status"] = $this->getStatesToSee($user);
        $userFinal["demande_status"]["stateExecute"] = $this->getStatesToExecute($user);
//        if ($userRoles)
//            foreach ($userRoles as $userRole) {
//                $userFinal['ecrans'] = @array_merge($userFinal['ecrans'], $userRole->getFrontInterfaces());
//                $permissions = $userRole->getPermissions();
//                foreach ($permissions as $permission) {
//                    $permissionExplode = explode('_', $permission->getName());// récupération interface name :
//                    if (count($permissionExplode) > 1)
//                        $userFinal['roles'][$userRole->getRole()][$permissionExplode[1]][] = $permissionExplode[2];
//                }
//            }
        // getToken
        $token = $this->getToken($user);
        $this->currentUser = $user;
        $em = $this->getDoctrine()->getManager();
        $compteur = $user->getFirstLogin();

//
//        $user->setFirstLogin($compteur + 1);
        $em->flush();
        $data = [
            'Token' => $token,
            'expirationDate' => $this->getParameter("jwt_token_ttl"),
            'User' => $userFinal,
            'FirstConnect' => $compteur
        ];
        return $data;
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
        return  $response;
    }
}
