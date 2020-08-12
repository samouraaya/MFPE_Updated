<?php

namespace Mfpe\ReferencielBundle\Controller;

use Doctrine\DBAL\DBALException;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcher;
use Mfpe\CentreFormationBundle\Validator\ValidateAppUser;
use Mfpe\ConfigBundle\Controller\BaseController;
use Doctrine\Common\Collections\ArrayCollection;
use Mfpe\ReferencielBundle\Entity\Referenciel;
use JMS\Serializer\SerializationContext;
use Mfpe\ReferencielBundle\Services\ReferencielService;
use Nelmio\ApiDocBundle\Annotation\Model;
use FOS\RestBundle\Controller\ControllerTrait;
use Swagger\Annotations as SWG;
use Doctrine\ORM\Query\ResultSetMapping;
use Mfpe\ConfigBundle\Entity\AppUser;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\ConfigBundle\Exception\ApiProblemException;
use Mfpe\ConfigBundle\Exception\ValidationException;
use Mfpe\ConfigBundle\Services\EntityMerger;
use Mfpe\ConfigBundle\Services\PermissionService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Mfpe\ReferencielBundle\Representation\Referentiels;
use Symfony\Component\HttpFoundation\Response;
use Mfpe\ReferencielBundle\Validator\ValidateCreateReferenciel;

class ReferencielController extends BaseController
{
    use ControllerTrait;

    private $tokenStorage;
    private $entityMerger;
    private $permissionService;

    public function __construct(
        TokenStorageInterface $tokenStorage,
        EntityMerger $entityMerger,
        PermissionService $permissionService
    )
    {
        $this->tokenStorage = $tokenStorage;
        $this->entityMerger = $entityMerger;
        $this->permissionService = $permissionService;
    }


    /**
     * @Rest\View(serializerGroups={"ReferencielGroup"})
     * @Rest\Get(
     *     path = "/",
     *     name="app_referencial_Pagination",
     *     options={ "method_prefix" = false }
     * )
     *
     * @Rest\QueryParam(
     *     name="intituleFr",
     *     nullable=true,
     *     description="IntituleFr to search for."
     * )
     * @Rest\QueryParam(
     *     name="intituleAr",
     *     nullable=true,
     *     description="IntituleAr to search for."
     * )
     * @Rest\QueryParam(
     *     name="categorie",
     *     nullable=true,
     *     description="Categorie to search for."
     * )
     * @Rest\QueryParam(
     *     name="enable",
     *     nullable=true,
     *     description="activé référenciel "
     * )
     * @Rest\QueryParam(
     *     name="order",
     *     requirements="asc|desc",
     *     default="desc",
     *     description="Sort order (asc or desc)"
     * )
     *
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="10",
     *     description="Max number of referentiels per page."
     * )
     * @Rest\QueryParam(
     *     name="page",
     *     requirements="\d+",
     *     default="1",
     *     description="The current page"
     * )
     *
     * @SWG\Get(
     *  tags={"Referenciel"},
     *  summary="Gets all  Referenciels with pagination",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Referenciel::class, groups={"ReferencielGroup"}))),
     * @SWG\Response(response="404", description="Returned when mission not found"),
     * )
     */

    public function getReferentielAction(ParamFetcherInterface $paramFetcher)
    {
        $pager = $this->getDoctrine()->getRepository(Referenciel::class)->search(
            $paramFetcher->get('intituleFr'),
            $paramFetcher->get('intituleAr'),
            $paramFetcher->get('categorie'),
            $paramFetcher->get('enable'),
            $paramFetcher->get('order'),
            $paramFetcher->get('limit'),
            $paramFetcher->get('page')
        );

        return new Referentiels($pager);
    }


    /**
     * @Rest\View(serializerGroups={"ReferencielGroup"})
     * @Rest\Get(
     *     path = "/all",
     *     name = "app_referencial_list"
     * )
     * @Rest\QueryParam(
     *     name="enable",
     *     nullable=true,
     *     description="tous les référenciel."
     * )
     * @SWG\Get(
     *  tags={"Referenciel"},
     *  summary="Gets all  Referenciel",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Referenciel::class))),
     * @SWG\Response(response="404", description="Returned when referencial not found"),
     * ),
     */
    public function getAllAction(ParamFetcherInterface $paramFetcher)
    {
        //recuperer le paramatre all
        $param = $paramFetcher->get('enable');

        //Get all the referenciels

        $result = ReferencielService::getInstance()->getAllReferenciel($this->em(), $param);

        $refs = $this->get('jms_serializer')->serialize($result, 'json', SerializationContext::create()->setGroups(array('ReferencielGroup')));
        $refs = json_decode($refs, JSON_UNESCAPED_UNICODE);
        $response = new Response();
        $response->setContent(json_encode(["code" => "200", "message" => "ok",
            "data" => $refs]));

        $response->headers->set('Content-Type', 'application/json');
        // Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        return $response;
        //return 200 success response with the referenciels
        //return $this->createApiResponse($result, 200);
    }


    /**
     * @Rest\View(serializerGroups={"ReferencielGroup","filtrecateggroup"})
     * @Rest\Get(
     *     path = "filtre/{categorie}",
     *     name = "app_referencial_categorie-list"
     * )
     * * @Rest\QueryParam(
     *     name="typeSecteur",
     *     description="true/false"
     * )
     *
     * @SWG\Get(
     *  tags={"Referenciel"},
     *  summary="Gets   Referenciel filtred by categorie",
     *  description ="<span style='color: red;'>RefSector has a field 'typeSecteur' who take two value :
    &nbsp;&nbsp; true: Sector for module de module 2
    &nbsp;&nbsp; false : Sector for formation
    </span>",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Referenciel::class))),
     * @SWG\Response(response="404", description="Returned when referencial not found"),
     * ),
     */

    public function filtrebycategorieAction($categorie, Request $request)
    {
        $data = json_decode(json_encode($request->query->all()), true);
        //Get all the referenciels
        $response = ReferencielService::getInstance()->getReferencielbycategorie($this->em(), $categorie, $data);
        //return 200 success response with the referenciels
        return $this->createApiResponse($response, 200);
    }


    /**
     * @Rest\View(serializerGroups={"ReferencielGroup","filtrecateggroup"})
     * @Rest\Get(
     *     path = "filtre/Refastronomiegouvernorat/{lang}",
     *     name = "app_filtreRefastronomiegouvernorat_list"
     * )
     * @SWG\Get(
     *  tags={"Referenciel"},
     *  summary="Gets   Referenciel filtred by categorie",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Referenciel::class))),
     * @SWG\Response(response="404", description="Returned when referencial not found"),
     * ),
     */

    public function filtreRefastronomiegouvernoratAction($lang)
    {
        //Get all the referenciels
        $response = ReferencielService::getInstance()->getRefastronomiegouvernorat($this->em(), $lang);
        //return 200 success response with the referenciels
        return $this->createApiResponse($response, 200);
    }


    /**
     * @Rest\Post(
     *     path = "/new",
     *     name = "app_referencial_add"
     * )
     * @SWG\Post(
     *  tags={"Referenciel"},
     *  summary="Add newReferenciel",
     *  description ="<span style='color: red;'>RefSector has a field 'typeSecteur' who take two value :
    &nbsp;&nbsp; true: Sector for module 2
    &nbsp;&nbsp; false: Sector for module de formation
    </span>",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="201", description="Returned when Resource created",@SWG\Schema(type="array", @Model(type=Referenciel::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * ),
     * @Rest\RequestParam(name="intituleAr")
     * @Rest\RequestParam(name="intituleFr")
     * @Rest\RequestParam(name="intituleAn")
     * @Rest\RequestParam(name="categorie")
     * @Rest\RequestParam(name="parent", nullable=true)
     * @Rest\RequestParam(name="typeSecteur", nullable=true)
     * @Rest\RequestParam(name="longitude",nullable=true)
     * @Rest\RequestParam(name="latitude",nullable=true)
     * @Rest\RequestParam(name="code",nullable=true)
     * @Rest\RequestParam(name="role",nullable=true)
     * @Rest\RequestParam(name="delegation",nullable=true)
     * @Rest\RequestParam(name="motif_dr",nullable=true)
     */
    public function postAddAction(ParamFetcher $paramFetcher)
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

            $em = $this->getDoctrine()->getManager();
            $validator = New ValidateCreateReferenciel($em);
            $errors = $validator->validateCreateReferenciel($paramFetcher);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }

            //instanciate the referenciel class
            $class = 'Mfpe\ReferencielBundle\Entity\\' . $paramFetcher->get('categorie');
            $referenciel = new $class();

            //Set the parameters to the referenciel attributes
            $referenciel->setIntituleFr($paramFetcher->get('intituleFr'));
            $referenciel->setIntituleAr($paramFetcher->get('intituleAr'));
            $referenciel->setEnable(true);
            //$referenciel->setIntituleAn($paramFetcher->get('intituleAn'));
            if ($paramFetcher->get('code')) {
                $referenciel->setCode($paramFetcher->get('code'));
            }
            if ($paramFetcher->get('role')) {
                $referenciel->setRole($paramFetcher->get('role'));
            }
            if ($paramFetcher->get('delegation')) {
                $referenciel->setDelegation($paramFetcher->get('delegation'));
            }
            if ($paramFetcher->get('categorie') == 'RefSecteur') {
                if ($paramFetcher->get('typeSecteur')) {
                    $typeSecteur = $paramFetcher->get('typeSecteur');
                    $testFormation = $typeSecteur === 'true' ? true : false;
                    $referenciel->setTypeSecteur($testFormation);
                }
            }
            if ($paramFetcher->get('motif_dr')) {
                $referenciel->setMotifDr($paramFetcher->get('motif_dr'));
            }

            //Check if the parent referenctiel is specified and affect it
            if ($paramFetcher->get('parent')) {
                $parentReferenciel = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($paramFetcher->get('parent'));
                if ($parentReferenciel === null)
                    return $this->createApiResponse("Parent referenciel not found", 404);
                $referenciel->setParent($parentReferenciel);
            }
            //Persist the referenciel in the database
            $this->em()->persist($referenciel);
            $this->em()->flush();
            return $this->createApiResponse($referenciel, 201, "crée avec succée");

        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }

    }

    /**
     * @Rest\Put(
     *     path = "/{id}",
     *     name = "app_referencial_Edit",
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"Referenciel"},
     *  summary="edit  Referenciel by id",
     *  description ="<span style='color: red;'>RefSector has a field 'typeSecteur' who take two value :
    &nbsp;&nbsp; true: Sector for module 2
    &nbsp;&nbsp; false: Sector for module de formation
    </span>",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when Resource created",@SWG\Schema(type="array", @Model(type=Referenciel::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * ),
     * @Rest\RequestParam(name="intituleFr")
     * @Rest\RequestParam(name="intituleAr")
     * @Rest\RequestParam(name="intituleAn")
     * @Rest\RequestParam(name="categorie")
     * @Rest\RequestParam(name="parent", nullable=true)
     * @Rest\RequestParam(name="longitude",nullable=true)
     * @Rest\RequestParam(name="latitude",nullable=true)
     * @Rest\RequestParam(name="code",nullable=true)
     * @Rest\RequestParam(name="role",nullable=true)
     * @Rest\RequestParam(name="enable",nullable=true)
     * @Rest\RequestParam(name="delegation",nullable=true)
     * @Rest\RequestParam(name="motif_dr",nullable=true)
     */
    public function putAction(ParamFetcher $paramFetcher, $id)
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
            $em = $this->getDoctrine()->getManager();
            $validator = New ValidateCreateReferenciel($em);
            $errors = $validator->validateEditReferenciel($paramFetcher);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $referenciel = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($id);
            //Check if the referenciel exist. Return 404 if not.
            if ($referenciel === null)
                return $this->createApiResponse("Referenciel not found", 404);
            //Check if the referenciel categorie is valid
            if (!Referenciel::checkIfValidCategorie($paramFetcher->get('categorie')))
                return $this->createApiResponse("Categorie not found", 404);
            //Set the parameters to the referenciel attributes
            $referenciel->setIntituleFr($paramFetcher->get('intituleFr'));
            $referenciel->setIntituleAr($paramFetcher->get('intituleAr'));
            if ($paramFetcher->get('code')) {
                $referenciel->setCode($paramFetcher->get('code'));
            }
            if ($paramFetcher->get('role')) {
                $referenciel->setRole($paramFetcher->get('role'));
            }
            if ($paramFetcher->get('enable')) {
                //  dd($paramFetcher->get('enable'));
                $testEnable = $paramFetcher->get('enable') === 'true' ? true : false;
                $referenciel->setEnable($testEnable);
            }

            if ($paramFetcher->get('delegation')) {
                $referenciel->setDelegation($paramFetcher->get('delegation'));
            }
            if ($paramFetcher->get('motif_dr')) {
                $referenciel->setMotifDr($paramFetcher->get('motif_dr'));
            }
//            if ($paramFetcher->get('categorie') == 'RefSecteur') {
//                if ($paramFetcher->get('typeSecteur')) {
//                    $typeSecteur = $paramFetcher->get('typeSecteur');
//                    $testFormation = $typeSecteur === 'true' ? true : false;
//                    $referenciel->setTypeSecteur($testFormation);
//                }
//            }
            //Check if the parent referenctiel is specified and affect it
            if ($paramFetcher->get('parent')) {
                $parentReferenciel = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($paramFetcher->get('parent'));
                if ($parentReferenciel === null)
                    return $this->createApiResponse("Parent referenciel not found", 404);
                $referenciel->setParent($parentReferenciel);
            }
            //Persist the role in the database
            //  $this->em()->persist($referenciel);
            $this->em()->flush();
            //return 200 success response with the modified role
            return $this->createApiResponse($referenciel, 202);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\Delete(
     *     path = "/{id}",
     *     name = "app_referencial_Delete",
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"Referenciel"},
     *  summary="delete Referenciel by id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when Resource created",@SWG\Schema(type="array", @Model(type=Referenciel::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * ),
     */
    public function deleteAction(?Referenciel $referenciel)
    {
        $this->throwProblem($referenciel, 404, ApiProblem::REFERNCIEL_NOT_EXIST);
        // Remove entity
        return $this->tryDelete($referenciel);
    }

    /**
     * @Rest\View()
     * @Rest\Get(
     *     path = "delegations",
     *     name = "app_delegation-list"
     * )
     * @SWG\Get(
     *  tags={"Referenciel"},
     *  summary="Gets   delégations avec les  gouvernorats",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Referenciel::class))),
     * @SWG\Response(response="404", description="Returned when referencial not found"),
     * ),
     */

    public function getdelegationAction()
    {
        $delegations = $this->getDoctrine()->getRepository('MfpeReferencielBundle:Refdelegation')->findAll();
        return $this->createApiResponse($delegations, 200);
    }

    /**
     * @Rest\View(StatusCode = 201, serializerGroups={"ReferencielGroup","SoleilGroup","LuneGroup","PriereGroup","LuneGroup"})
     * @Rest\Get(
     *     path = "/{champs}/{value}",
     *     name = "app_Referenciel_Search_Get",
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Get(
     *  tags={"Referenciel"},
     *  summary="Selectionnez la valeur du champs à partir d'une valeur",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when Resource deleted",
     *      @SWG\Schema(type="array", @Model(type=Referenciel::class))),
     *      @SWG\Response(response="400", description="Returned when invalid data posted"),
     *      @SWG\Response(response="401", description="Returned when not authenticated"),
     *      @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     * @param $request
     * @return JsonResponse
     */
    public function getReferencielfilterAction($champs, $value)
    {
        $referenciel = $this->getDoctrine()
            ->getRepository('MfpeReferencielBundle:Referenciel')->findBy(array($champs => $value));
        return $referenciel;
    }

    function base64_to_svg($base64_string)
    {
        $path = __DIR__ . '/../../../../web/uploadspicto/pictogrammes/';
        if (!is_dir($path)) {
            if (!mkdir($path, 0777, true)) {
                die('Echec lors de la création des répertoires...');
            }
        }
        $output_file = $path . md5(uniqid()) . '.' . "svg";
        $ifp = fopen($output_file, 'wb');
        $data = explode(',', $base64_string);
        fwrite($ifp, base64_decode($data[1]));
        fclose($ifp);
        $filename = substr(strrchr($output_file, "/"), 1);
        return "web/uploadspicto/pictogrammes/" . $filename;
    }
}
