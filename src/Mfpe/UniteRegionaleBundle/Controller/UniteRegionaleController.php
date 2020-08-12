<?php


namespace Mfpe\UniteRegionaleBundle\Controller;


use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Mfpe\AttestationBundle\Entity\Demande;
use Mfpe\CentreFormationBundle\Validator\ValidateCreateCentreFormation;
use Mfpe\UniteRegionaleBundle\Validator\ValidateUniteRegional;
use Mfpe\ConfigBundle\Entity\AppUser;
use Mfpe\AttestationBundle\Entity\PvExam;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\ReferencielBundle\Entity\Referenciel;
use Mfpe\UniteRegionaleBundle\Entity\UniteRegionale;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializationContext;
use Mfpe\ConfigBundle\Controller\BaseController;

class UniteRegionaleController extends BaseController
{
    use ControllerTrait;

    /**
     * @Rest\Post(
     *     path = "/",
     *     name = "app_unite_regionale_Add"
     * )
     * @SWG\Post(
     *  tags={"UniteRegionale"},
     *  summary="Unite Regionale",
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
     *              @SWG\Property(property="code_unite", type="string", example="code_1234"),
     *              @SWG\Property(property="titre_ar", type="string", example="الإدارة الجهويه للتكوين المهني والتشغيل بتونس"),
     *              @SWG\Property(property="titre_fr", type="string", example="Direction régionale de la formation professionnelle et de l'emploi en Tunisie"),
     *              @SWG\Property(
     *                  property="gouvernorat",
     *                  title="Gouvernoat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="123"),
     *              ),
     *              @SWG\Property(property="premier_responsable", type="string", example="ali"),
     *              @SWG\Property(
     *                  property="tel",
     *                  title="telephone",
     *                  type="object",
     *                  @SWG\Property(property="countryCode", type="string", example="tn"),
     *                  @SWG\Property(property="dialCode", type="integer", example=216),
     *                  @SWG\Property(property="name", type="string", example="Tunisia"),
     *                  @SWG\Property(property="number", type="integer", example=22100200),
     *              ),
     *              @SWG\Property(
     *                  property="fax",
     *                  title="fax",
     *                  type="object",
     *                  @SWG\Property(property="countryCode", type="string", example="tn"),
     *                  @SWG\Property(property="dialCode", type="integer", example=216),
     *                  @SWG\Property(property="name", type="string", example="Tunisia"),
     *                  @SWG\Property(property="number", type="integer", example=22100200),
     *              ),
     *              @SWG\Property(property="email", type="string", example="had@gmail.com"),
     *          )
     *
     *      ),
     * )
     */
    public function postAction(Request $request)
    {
        $errors=[];
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
            $validator = New ValidateUniteRegional($em);
            $errors = $validator->validateUniteRegional($data,'');
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $uniteRegionale = new UniteRegionale();
            $uniteRegionale->setCodeUnite($data["code_unite"]);
            $uniteRegionale->setTitreAr($data["titre_ar"]);
            $uniteRegionale->setTitreFr($data["titre_fr"]);
            $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["gouvernorat"]["id"]);
            $uniteRegionale->setGouvernorat($gouvernorat);
            $uniteRegionale->setPremierResponsable($data["premier_responsable"]);
            $uniteRegionale->setTel("+" . $data["tel"]["dialCode"] . " " . $data["tel"]["number"]);
            $uniteRegionale->setFax("+" . $data["fax"]["dialCode"] . " " . $data["fax"]["number"]);
            $uniteRegionale->setEmail($data["email"]);
            $uniteRegionale->setEnable(true);
            $em = $this->getDoctrine()->getManager();
            $em->persist($uniteRegionale);
            $em->flush();
            $uniteRegional = $this->em()->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array('id' => $uniteRegionale->getId()));
            $uniteRegional = $this->get('jms_serializer')->serialize($uniteRegional, 'json', SerializationContext::create()->setGroups(array('uniteRegional')));
            $uniteRegional = json_decode($uniteRegional, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => 'success', 'code' => Response::HTTP_OK, 'data' => $uniteRegional,], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'message' => $errors], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"uniteRegional"})
     * @Rest\Get(
     *     path = "/",
     *     name="app_uniteRegionale_Get",
     *     options={ "method_prefix" = false },
     * )
     *  @Rest\QueryParam(
     *     name="enable",
     *     nullable=true,
     *     description="tous les unites Regionale."
     * )
     * @SWG\Get(
     *  tags={"UniteRegionale"},
     *  summary="Get  all Unites Regionales",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=UniteRegionale::class, groups={"uniteRegional"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getUniteRegionalAction(ParamFetcherInterface $paramFetcher)
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
        $param = $paramFetcher->get('enable');
        if (isset($param) && !empty($param)) {
            $uniteRegionale = $this->getDoctrine()->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findAll();
        } else {
            $uniteRegionale = $this->getDoctrine()->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findByEnable(true);
        }
        $uniteRegional = $this->get('jms_serializer')->serialize($uniteRegionale, 'json', SerializationContext::create()->setGroups(array('uniteRegional')));
        $uniteRegionale = json_decode($uniteRegional, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $uniteRegionale], Response::HTTP_OK);

    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"uniteRegional"})
     * @Rest\Get(
     *     path = "/byUser",
     *     name="app_uniteRegionaleUser_Get",
     *     options={ "method_prefix" = false },
     * )
     *
     * @SWG\Get(
     *  tags={"UniteRegionale"},
     *  summary="Get Unité Regionale By User",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=UniteRegionale::class, groups={"uniteRegional"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getUniteRegionalByUserAction()
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
        $uniteRegional = $user->getUniteRegionale();

        if (!$uniteRegional) {
            $message = ApiProblem::UNIITE_REGIONAL_DOES_NOT_EXIST;
            $errors['unite_regional'] = $message;
            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }


        $uniteRegional = $this->get('jms_serializer')->serialize($uniteRegional, 'json', SerializationContext::create()->setGroups(array('uniteRegional')));
        $uniteRegionale = json_decode($uniteRegional, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $uniteRegionale], Response::HTTP_OK);

    }

    /**
     * @Rest\View(serializerGroups={"uniteRegional"})
     * @Rest\Put(
     *     path = "/{id}",
     *     name = "app_uniteRegional_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"uniteRegional"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"UniteRegionale"},
     *  summary="edit Unite Regionale",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="uniteRegional",
     *     in="path",
     *     description="uniteRegional id",
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
     *              @SWG\Property(property="code_unite", type="string", example="DR-TN-CAP"),
     *              @SWG\Property(property="titre_ar", type="string", example="الإدارة الجهويه للتكوين المهني والتشغيل بتونس"),
     *              @SWG\Property(property="titre_fr", type="string", example="Direction régionale de la formation professionnelle et de l'emploi en Tunisie"),
     *              @SWG\Property(
     *                  property="gouvernorat",
     *                  title="gouvernorat de l'unité regionale",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="123"),
     *              ),
     *              @SWG\Property(property="premier_responsable", type="string", example="saleh"),
     *              @SWG\Property(property="enable", type="string", example="true"),
     *              @SWG\Property(
     *                  property="tel",
     *                  title="telephone",
     *                  type="object",
     *                  @SWG\Property(property="countryCode", type="string", example="tn"),
     *                  @SWG\Property(property="dialCode", type="integer", example=216),
     *                  @SWG\Property(property="name", type="string", example="Tunisia"),
     *                  @SWG\Property(property="number", type="integer", example=22100200),
     *              ),
     *              @SWG\Property(
     *                  property="fax",
     *                  title="fax",
     *                  type="object",
     *                  @SWG\Property(property="countryCode", type="string", example="tn"),
     *                  @SWG\Property(property="dialCode", type="integer", example=216),
     *                  @SWG\Property(property="name", type="string", example="Tunisia"),
     *                  @SWG\Property(property="number", type="integer", example=22100200),
     *              ),
     *              @SWG\Property(property="email", type="string", example="had@gmail.com"),
     *          )
     *
     *      ),
     *
     * ),
     * @SWG\Response(response="200", description="Returned when Resource modified",@SWG\Schema(type="array", @Model(type=UniteRegionale::class, groups={"uniteRegional"}))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function updateAction(?UniteRegionale $uniteRegionale, Request $request)
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
        $error_global = ApiProblem::MESSAGE_GLOBAL;
        $em = $this->getDoctrine()->getManager();
        $validator = New ValidateUniteRegional($em);
        $errors = $validator->validateUniteRegional($data,$uniteRegionale);

        if (empty($uniteRegionale)) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['uniteRegionale'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $error_global, 'data' => $errors], Response::HTTP_BAD_REQUEST);
        }
        if ($errors) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        } else {
            $uniteRegionale->setCodeUnite($data["code_unite"]);
            $uniteRegionale->setTitreAr($data["titre_ar"]);
            $uniteRegionale->setTitreFr($data["titre_fr"]);
            $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["gouvernorat"]["id"]);
            $uniteRegionale->setGouvernorat($gouvernorat);
            $uniteRegionale->setPremierResponsable($data["premier_responsable"]);
            $uniteRegionale->setTel($data["tel"]["dialCode"] . " " . $data["tel"]["number"]);
            $uniteRegionale->setFax($data["fax"]["dialCode"] . " " . $data["fax"]["number"]);
            $uniteRegionale->setEmail($data["email"]);
            if (isset($data["enable"])) {
                $testEnable = $data["enable"] === 'true'? true: false;
                $uniteRegionale->setEnable($testEnable);
            }

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $uniteRegionale = $this->get('jms_serializer')->serialize($uniteRegionale, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailDemande')));
            $uniteRegionale = json_decode($uniteRegionale, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $uniteRegionale], Response::HTTP_OK);
        }


    }


    /**
     * @Rest\Post(
     *     path = "/personnelDR",
     *     name = "app_user-personnelDR_Add"
     * )
     * @SWG\Post(
     *  tags={"UniteRegionale"},
     *  summary="Personnel DR",
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
     *              @SWG\Property(property="nom", type="string", example="dammak"),
     *              @SWG\Property(property="prenom", type="string", example="ali"),
     *              @SWG\Property(property="identifiant", type="string", example="MZD5264"),
     *              @SWG\Property(property="grade", type="string", example="agent Dr"),
     *              @SWG\Property(property="premier_responsable", type="string", example="saleh"),
     *              @SWG\Property(
     *                  property="structure",
     *                  title="structure",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example="1"),
     *     ),
     *              @SWG\Property(
     *                  property="fonction",
     *                  title="fonction",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example="15"),
     *       ),
     *              @SWG\Property(
     *                  property="roles",
     *                  type="array",
     *                  @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="id", type="integer", example=75),
     *                  ),
     *              ),
     *              @SWG\Property(
     *                  property="tel",
     *                  title="tel",
     *                  type="object",
     *                  @SWG\Property(property="countryCode", type="string", example="tn"),
     *                  @SWG\Property(property="dialCode", type="integer", example=216),
     *                  @SWG\Property(property="name", type="string", example="Tunisia"),
     *                  @SWG\Property(property="number", type="integer", example=22100200),
     *              ),
     *              @SWG\Property(property="email", type="string", example="admin@admin.com"),
     *              @SWG\Property(
     *                  property="direction_regionale",
     *                  title="Direction Régionale",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example="12"),
     *              ),
     *              @SWG\Property(
     *                  property="centre_formation",
     *                  title="centre_formation",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example="12"),
     *              ),
     *          )
     * )
     */
    public function personnelAction(Request $request)
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
            $validator = New ValidateUniteRegional($em);
            $errors = $validator->validateUniteRegional($data,null);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $user = new AppUser();
            $user->setNomAr($data["nom"]);
            $user->setNomFr($data["nom"]);
            $user->setPrenomAr($data["prenom"]);
            $user->setPrenomFr($data["prenom"]);
            //validate User EXIST IN DATABASE
            $userExist = $em->getRepository('MfpeConfigBundle:AppUser')->findByEmail($data['email']);
            if ($userExist) {
                $message = ApiProblem::EMAIL_EXIST_IN_DATABASE;
                $errors['email'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }

            if (isset($data["identifiant"]) && !empty($data["identifiant"])) {
                //validate User EXIST IN DATABASE
                $user1 = $em->getRepository('MfpeConfigBundle:AppUser')->findByIdentifiant($data['identifiant']);
                if ($user1) {
                    $message = ApiProblem::IDENTIFIANT_EXIST_IN_DATABASE;
                    $errors['identifiant'] = $message;
                    $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
                $user->setIdentifiant($data["identifiant"]);

            }
            $user->setEmail($data["email"]);
            $user->setUsername($data["email"]);
            $user->setPlainPassword("P@ssw0rd");
            $user->setPasswordPrint("P@ssw0rd");
            $user->setGrade($data["grade"]);
            $user->setPremierResponsable($data["premier_responsable"]);
            $structure = $em->getRepository('MfpeReferencielBundle:RefStructure')->find($data["structure"]["id"]);
            $user->setStructure($structure);
            $fonction = $em->getRepository('MfpeReferencielBundle:RefFonction')->find($data["fonction"]["id"]);
            $user->setFonction($fonction);
            $user->setTel($data["tel"]["dialCode"] . " " . $data["tel"]["number"]);
            $user->setEnable(true);
            //validate structure
            if (isset($data["direction_regionale"]["id"])) {
                if (!empty($data["direction_regionale"]["id"])) {
                    $directionRegional = $this->em()->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->find($data["direction_regionale"]["id"]);
                    $user->setUniteRegionale($directionRegional);
                }
            }
            if (isset($data["centre_formation"]["id"])) {
                if (!empty($data["centre_formation"]["id"])) {
                    $centreFormation = $this->em()->getRepository('MfpeCentreFormationBundle:CentreFormation')->find($data["centre_formation"]["id"]);
                    $user->setCentreFormation($centreFormation);
                }
            }
            // set Role
            $roles = $data["roles"];
            $tabRoles = [];
            foreach ($roles as $role) {
                $roleExist = $this->em()->getRepository('MfpeConfigBundle:Role')->find($role);
                if (!is_object($roleExist)) {
                    // e.g. anonymous authentication
                    $message = ApiProblem::ROLES_DOES_NOT_EXIST;
                    $errors['role'] = $message;
                    $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }

                $tabRoles[] = $roleExist;
            }
            $user->setUserRoles($tabRoles);
            //persist data
            $em->persist($user);
            $em->flush();
            $currentUser = $em->getRepository('MfpeConfigBundle:AppUser')->findUser($user->getId());
            //dd($currentUser);
            $user = $this->get('jms_serializer')->serialize($currentUser, 'json', SerializationContext::create()->setGroups(array('AppUserGroup','UserRole')));
            $user = json_decode($user, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => 'success', 'code' => Response::HTTP_OK, 'data' => $user], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
           // return new JsonResponse(['status' => 'error', 'message' => $errors], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    /**
     * @Rest\View(serializerGroups={"AppUserGroup"})
     * @Rest\Patch(
     *     path = "personnelDR/{id}",
     *     name = "app_personnelDR-patch_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"personnelDR"="\d+"}
     * )
     * @SWG\Patch(
     *  tags={"UniteRegionale"},
     *  summary="Patch Personnel Unite Regionale",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="personnel unite regional",
     *     in="path",
     *     description="personnel id",
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
     *              @SWG\Property(property="nom", type="string", example="dammak"),
     *              @SWG\Property(property="prenom", type="string", example="ali"),
     *              @SWG\Property(property="identifiant", type="string", example="MZD5264"),
     *              @SWG\Property(property="grade", type="string", example="agent Dr"),
     *              @SWG\Property(property="enable", type="string", example="true"),
     *              @SWG\Property(property="premier_responsable", type="string", example="saleh"),
     *              @SWG\Property(
     *                  property="structure",
     *                  title="fonction",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example="1"),
     *     ),
     *              @SWG\Property(
     *                  property="fonction",
     *                  title="fonction",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example="15"),
     *       ),
     *              @SWG\Property(
     *                  property="roles",
     *                  type="array",
     *                  @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="id", type="integer", example=75),
     *                  ),
     *              ),
     *              @SWG\Property(
     *                  property="tel",
     *                  title="Nature besoin specifique",
     *                  type="object",
     *                  @SWG\Property(property="countryCode", type="string", example="tn"),
     *                  @SWG\Property(property="dialCode", type="integer", example=216),
     *                  @SWG\Property(property="name", type="string", example="Tunisia"),
     *                  @SWG\Property(property="number", type="integer", example=22100200),
     *              ),
     *              @SWG\Property(property="email", type="string", example="admin@admin.com"),
     *              @SWG\Property(
     *                  property="direction_regionale",
     *                  title="Direction Régionale",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example="12"),
     *              ),
     *          )
     * ),
     *
     * ),
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Demande::class, groups={"DeserializeUserGroup"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     *
     */
    public function updatePersonelAction(?AppUser $appUser, Request $request)
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

        $error_global = ApiProblem::MESSAGE_GLOBAL;
        if (empty($appUser)) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['appUser'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $error_global, 'data' => $errors], Response::HTTP_BAD_REQUEST);
        }

        $data = json_decode($request->getContent(), true);
        $em = $this->getDoctrine()->getManager();
        $validator = New ValidateUniteRegional($em);
        $errors = $validator->validateUniteRegional($data);
        if ($errors) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        if (isset($data["nom"]) && !empty($data["nom"])) {
            $appUser->setNomAr($data["nom"]);
            $appUser->setNomFr($data["nom"]);
        }
        if (isset($data["prenom"]) && !empty($data["prenom"])) {
            $appUser->setPrenomAr($data["prenom"]);
            $appUser->setPrenomFr($data["prenom"]);
        }
        if (isset($data["identifiant"]) && !empty($data["identifiant"])) {
            //validate User EXIST IN DATABASE
            $user1 = $em->getRepository('MfpeConfigBundle:AppUser')->findOneByIdentifiant($data['identifiant']);
            if ($user1) {
                if ($user1->getId() != $appUser->getId()) {
                    $message = ApiProblem::IDENTIFIANT_EXIST_IN_DATABASE;
                    $errors['identifiant'] = $message;
                    $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
            }
            $appUser->setIdentifiant($data["identifiant"]);

        }
        if (isset($data["email"]) && !empty($data["email"])) {
            //validate User EXIST IN DATABASE
            $user = $em->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("id" => $appUser->getId(), "email" => $data['email']));
            if (!$user) {
                $user = $em->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => $data['email']));
                if ($user) {
                    $message = ApiProblem::EMAIL_EXIST_IN_DATABASE;
                    $errors['email'] = $message;
                    $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                } else {
                    $appUser->setUsername($data["email"]);
                    $appUser->setEmail($data["email"]);

                }
            }
        }

        if (isset($data["grade"]) && !empty($data["grade"])) {
            $appUser->setGrade($data["grade"]);
        }
        if (isset($data["enable"]) && !empty($data["enable"])) {
            $testEnable = $data["enable"]=== 'true'? true: false;
            $appUser->setEnable($testEnable);
        }
        if (isset($data["premier_responsable"]) && !empty($data["premier_responsable"])) {
            $appUser->setPremierResponsable($data["premier_responsable"]);
        }
        if (isset($data["structure"]["id"]) && !empty($data["structure"]["id"])) {
            $structure = $this->em()->getRepository('MfpeReferencielBundle:RefStructure')->find($data["structure"]["id"]);
            $appUser->setStructure($structure);
        }
        if (isset($data["fonction"]["id"]) && !empty($data["fonction"]["id"])) {
            $fonction = $this->em()->getRepository('MfpeReferencielBundle:RefFonction')->find($data["fonction"]["id"]);
            $appUser->setFonction($fonction);
        }
        //  dd($data["tel"]["dialCode"] . $data["tel"]["number"]);
        $appUser->setTel($data["tel"]["dialCode"] . " " . $data["tel"]["number"]);
        $roles = $data["roles"];
        $tabRoles = [];
        foreach ($roles as $role) {
            $roleExist = $this->em()->getRepository('MfpeConfigBundle:Role')->find($role);
            if (!is_object($roleExist)) {
                // e.g. anonymous authentication
                $message = ApiProblem::ROLES_DOES_NOT_EXIST;
                $errors['role'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
                $tabRoles[] = $roleExist;

        }
        $appUser->setUserRoles($tabRoles);
        //validate structure
        if (isset($data["direction_regionale"]["id"])) {
            if (!empty($data["direction_regionale"]["id"])) {
                $directionRegional = $this->em()->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->find($data["direction_regionale"]["id"]);
                $appUser->setUniteRegionale($directionRegional);
            }
        }
        //persist data
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        $currentUser = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findUser($appUser->getId());
        $appUser = $this->get('jms_serializer')->serialize($currentUser, 'json', SerializationContext::create()->setGroups(array('AppUserGroup')));
        $appUser = json_decode($appUser, JSON_UNESCAPED_UNICODE);

        return new JsonResponse(['status' => 'success', 'code' => Response::HTTP_OK, 'data' => $appUser], Response::HTTP_OK);

    }


}