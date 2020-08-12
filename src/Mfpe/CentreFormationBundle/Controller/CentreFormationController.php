<?php

namespace Mfpe\CentreFormationBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Request\ParamFetcher;
use Mfpe\AttestationBundle\Validator\validateUniteRegional;
use Mfpe\CentreFormationBundle\Entity\CentreFormation;
use Mfpe\CentreFormationBundle\Entity\Specialite;
use Mfpe\ConfigBundle\Entity\AppUser;
use Mfpe\ReferencielBundle\Entity\Referenciel;
use Mfpe\AttestationBundle\Entity\DateExam;
use Mfpe\AttestationBundle\Entity\PvExam;
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
use Mfpe\ConfigBundle\Controller\BaseController;
use Mfpe\CentreFormationBundle\Validator\ValidateCreateCentreFormation;
use Mfpe\AttestationBundle\Entity\Demande;


/**
 * Description of CentreFormationController
 *
 * @author Wiem Hadiji
 */
class CentreFormationController extends BaseController
{
    use ControllerTrait;

    /**
     * @Rest\Post(
     *     path = "",
     *     name = "app_centreFormation_Add"
     * )
     * @SWG\Post(
     *  tags={"Centre Formation"},
     *  summary="Create centre formation",
     *  description ="<span style='color: red;'>Centre formation has a field 'type' who take three value :
    &nbsp;&nbsp; 1: centre module 2
    &nbsp;&nbsp; 2: centre public
    &nbsp;&nbsp; 3: centre prive
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
     *              @SWG\Property(property="intitule_ar", type="string", example="مركز التدريب القطاعي ابن سينا"),
     *              @SWG\Property(property="intitule_fr", type="string", example="Centre Sectoriel de Formation en Bâtiment de Ibnou Sina"),
     *              @SWG\Property(property="adresse", type="string", example="Immeuble Horizon, Rue de la bourse, Les Berges du Lac 2, 1053  Tunisie"),
     *              @SWG\Property(
     *                  property="tel",
     *                  title="Nature besoin specifique",
     *                  type="object",
     *                  @SWG\Property(property="countryCode", type="string", example="tn"),
     *                  @SWG\Property(property="dialCode", type="integer", example=216),
     *                  @SWG\Property(property="name", type="string", example="Tunisia"),
     *                  @SWG\Property(property="number", type="integer", example=22100200),
     *              ),
     *              @SWG\Property(
     *                  property="fax",
     *                  title="Numero de fax",
     *                  type="object",
     *                  @SWG\Property(property="countryCode", type="string", example="tn"),
     *                  @SWG\Property(property="dialCode", type="integer", example=216),
     *                  @SWG\Property(property="name", type="string", example="Tunisia"),
     *                  @SWG\Property(property="number", type="integer", example=22100200),
     *              ),
     *              @SWG\Property(property="email", type="string", example="test@gmail.com"),
     *              @SWG\Property(property="nom_directeur_ar", type="string", example="أمين بن مأمون"),
     *              @SWG\Property(property="nom_directeur_fr", type="string", example="Amine bin Maamoun"),
     *              @SWG\Property(property="annee_creation", type="integer", example="2019"),
     *              @SWG\Property(property="capacite_acceuil", type="integer", example="50"),
     *              @SWG\Property(property="organisme", type="string", example="afp"),
     *              @SWG\Property(
     *                  property="gouvernorat",
     *                  title="gouvernorat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=29),
     *              ),
     *              @SWG\Property(
     *                  property="delegation",
     *                  title="delegation",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=53),
     *              ),
     *              @SWG\Property(property="numero_enregistrement", type="integer", example="25ABC-45GT-RRRT-MM45"),
     *              @SWG\Property(
     *                  property="specialites",
     *                  type="array",
     *                  @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="id", type="integer", example=1),
     *                  ),
     *              ),
     *              @SWG\Property(property="nombre_formateur", type="integer", example=25),
     *              @SWG\Property(property="nbre_cadre_administratif", type="integer", example="100"),
     *              @SWG\Property(property="capacite_hybergement", type="integer", example="130"),
     *              @SWG\Property(property="capacite_resto", type="integer", example="201"),
     *              @SWG\Property(property="type", type="integer", example=1),
     *          )
     *
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
            $validator = New ValidateCreateCentreFormation($em);
            $errors = $validator->validateCreateCentreFormation($data, "");
            if ($errors) {

                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $centreFormation = new CentreFormation();
            if (isset($data["intitule_ar"])) {
                $centreFormation->setIntituleAr($data["intitule_ar"]);
            }
            if (isset($data["intitule_fr"])) {
                $centreFormation->setIntituleFr($data["intitule_fr"]);
            }
            if (isset($data["adresse"])) {
                $centreFormation->setAdresse($data["adresse"]);
            }

            $centreFormation->setTel($data["tel"]["dialCode"] . " " . $data["tel"]["number"]);
            $centreFormation->setFax($data["fax"]["dialCode"] . " " . $data["fax"]["number"]);
            if (isset($data["email"])) {
                $centreFormation->setEmail($data["email"]);
            }
            $centreFormation->setEnable(true);
            if (isset($data["nom_directeur_ar"])) {
                $centreFormation->setNomDirecteurAr($data["nom_directeur_ar"]);
            }
            if (isset($data["nom_directeur_fr"])) {
                $centreFormation->setNomDirecteurFr($data["nom_directeur_fr"]);
            }
            if (isset($data["annee_creation"])) {
                $centreFormation->setAnneeCreation($data["annee_creation"]);
            }
            if (isset($data["capacite_acceuil"])) {
                $centreFormation->setCapaciteAccueil($data["capacite_acceuil"]);
            }

            $em = $this->getDoctrine()->getManager();
//            $secteur = $em->getRepository('MfpeReferencielBundle:RefSecteur')->find($data["secteur_activite"]["id"]);
//            $centreFormation->setSecteur($secteur);
            if (isset($data["gouvernorat"]["id"])) {
                $gouvernorat = $em->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["gouvernorat"]["id"]);
                $centreFormation->setGouvernorat($gouvernorat);
                $user->setGouvernorat($gouvernorat);
            }
            if (isset($data["delegation"]["id"]) && !empty($data["delegation"]["id"])) {
                $delegation = $em->getRepository('MfpeReferencielBundle:RefDelegation')->find($data["delegation"]["id"]);
                $centreFormation->setDelegation($delegation);
                $user->setDelegation($delegation);
            }
            if (isset($data["type"]) && !empty($data["type"])) {
                {
                    $centreFormation->setType($data["type"]);
                    if ($data["type"] == 1 || $data["type"] == 2) {
                        if (isset($data["organisme"])) {
                            $centreFormation->setOrganisme(strtoupper($data["organisme"]));
                            $centreFormation->setNumeroEnregistrement(NULL);

                        }

                    } elseif ($data["type"] == 3) {

                        if (isset($data["numero_enregistrement"])) {
                            $centreFormation->setNumeroEnregistrement($data["numero_enregistrement"]);
                        }
                        //Empty Organismeif sector private
                        $centreFormation->setOrganisme("");
                    }
                }

            }
            foreach ($data["specialites"] as $sp) {
                $specialite = $em->getRepository('MfpeCentreFormationBundle:Specialite')->find($sp['id']);
                if ($specialite) {
                    $centreFormation->addSpecialiteCenter($specialite);
                }
            }

            $centreFormation->setNombreFormateur($data["nombre_formateur"]);
            $centreFormation->setNombreCadreAdministratif($data["nbre_cadre_administratif"]);
            $centreFormation->setCapaciteHebergement($data["capacite_hybergement"]);
            $centreFormation->setCapaciteRestaurant($data["capacite_resto"]);
//            $centreFormation->setEnable(true);
            $user = new AppUser();
            if (isset($data["intitule_ar"])) {
                $user->setNomAr($data["intitule_ar"]);
            }
            if (isset($data["intitule_fr"])) {
                $user->setNomFr($data["intitule_fr"]);
            }
            if (isset($data["nom_directeur_ar"])) {
                $user->setPrenomAr($data["nom_directeur_ar"]);
            }
            if (isset($data["nom_directeur_fr"])) {
                $user->setPrenomFr($data["nom_directeur_fr"]);
            }

            $user->setTel($data["tel"]["dialCode"] . " " . $data["tel"]["number"]);
            if ($data["type"] == 3) {
                $user->setDelegation($delegation);
                $user->setGouvernorat($gouvernorat);
            }

            $user->setEmail($data["email"]);
            $role = $this->em()->getRepository('MfpeConfigBundle:Role')->findOneByRole('ROLE_AGENT_CENTRE_FORMATION');
            $user->setUserRoles(array($role));
            $user->setCentreFormation($centreFormation);
            $user->setPlainPassword("P@ssw0rd");
            $user->setPasswordPrint("P@ssw0rd");
            $user->setUsername($data["email"]);
//            $user->setEnable(true);
            $user->setIdentifiant("TN-" . uniqid());
            $em->persist($centreFormation);
            $em->persist($user);
            $em->flush();

            $centreFormation = $this->get('jms_serializer')->serialize($centreFormation, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailCentreFormation')));
            $centreFormation = json_decode($centreFormation, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $centreFormation], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);

        }
    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailCentreFormation"})
     * @Rest\Get(
     *     path = "/",
     *     name="app_centreFormation_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="enable",
     *     nullable=true,
     *     description="tous les centre formation."
     * )
     * @Rest\QueryParam(
     *     name="type",
     *     description="1/module 2,2/public,3/prive"
     * )
     * @Security(name="Bearer"),
     * @SWG\Get(
     *  tags={"Centre Formation"},
     *  description ="<span style='color: red;'>Centre formation has a field 'type' who take three value :
    &nbsp;&nbsp; 1: centre module 2
    &nbsp;&nbsp; 2: centre public
    &nbsp;&nbsp; 3: centre prive
    </span>",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=CentreFormation::class, groups={"detailCentreFormation"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getCentreFormationAction(Request $request)
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
            $data = json_decode(json_encode($request->query->all()), true);

            if (isset($data['enable']) && !empty($data['enable']) && !empty($data['type'])) {
                $centreFormations = $this->getDoctrine()->getRepository('MfpeCentreFormationBundle:CentreFormation')->findBy(array('type' => $data["type"]), array('updatedAt' => 'DESC'));
            } elseif (isset($data['type']) && !empty($data['type']) && empty($data['enable'])) {

                $centreFormations = $this->getDoctrine()->getRepository('MfpeCentreFormationBundle:CentreFormation')->findBy(array('type' => $data["type"], 'enable' => true), array('updatedAt' => 'DESC'));
            } elseif (isset($data['enable']) && !empty($data['enable']) && empty($data['type'])) {
                $centreFormations = $this->getDoctrine()->getRepository('MfpeCentreFormationBundle:CentreFormation')->findBy(array(), array('updatedAt' => 'DESC'));
            } else {
                $centreFormations = $this->getDoctrine()->getRepository('MfpeCentreFormationBundle:CentreFormation')->findBy(array('enable' => true), array('updatedAt' => 'DESC'));
            }
            $centreFormation = $this->get('jms_serializer')->serialize($centreFormations, 'json', SerializationContext::create()->setGroups(array('detailCentreFormation', 'ReferencielGroup')));
            $centreFormations = json_decode($centreFormation, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $centreFormations], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(serializerGroups={"detailCentreFormation"})
     * @Rest\Put(
     *     path = "/{id}",
     *     name = "app_centreFormation_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"centreFormation"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"Centre Formation"},
     *  summary="edit Centre Formation",
     *  description ="<span style='color: red;'>Centre formation has a field 'type' who take three value :
    &nbsp;&nbsp; 1: centre module 2
    &nbsp;&nbsp; 2: centre public
    &nbsp;&nbsp; 3: centre prive
    </span>",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="centreFormation",
     *     in="path",
     *     description="centreFormation id",
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
     *              @SWG\Property(property="intitule_ar", type="string", example="مركز التدريب القطاعي ابن سينا"),
     *              @SWG\Property(property="intitule_fr", type="string", example="Centre Sectoriel de Formation en Bâtiment de Ibnou Sina"),
     *              @SWG\Property(property="adresse", type="string", example="Immeuble Horizon, Rue de la bourse, Les Berges du Lac 2, 1053  Tunisie"),
     *              @SWG\Property(
     *                  property="tel",
     *                  title="Numero de tel",
     *                  type="object",
     *                  @SWG\Property(property="countryCode", type="string", example="tn"),
     *                  @SWG\Property(property="dialCode", type="integer", example=216),
     *                  @SWG\Property(property="name", type="string", example="Tunisia"),
     *                  @SWG\Property(property="number", type="integer", example=22100200),
     *              ),
     *              @SWG\Property(
     *                  property="fax",
     *                  title="Numero de fax",
     *                  type="object",
     *                  @SWG\Property(property="countryCode", type="string", example="tn"),
     *                  @SWG\Property(property="dialCode", type="integer", example=216),
     *                  @SWG\Property(property="name", type="string", example="Tunisia"),
     *                  @SWG\Property(property="number", type="integer", example=22100200),
     *              ),
     *              @SWG\Property(property="email", type="string", example="test@gmail.com"),
     *              @SWG\Property(property="nom_directeur_ar", type="string", example="أمين بن مأمون"),
     *              @SWG\Property(property="nom_directeur_fr", type="string", example="Amine bin Maamoun"),
     *              @SWG\Property(property="annee_creation", type="string", example="2019"),
     *              @SWG\Property(property="capacite_acceuil", type="string", example="50"),
     *              @SWG\Property(property="organisme", type="string", example="afp"),
     *              @SWG\Property(
     *                  property="gouvernorat",
     *                  title="gouvernorat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="85"),
     *              ),
     *              @SWG\Property(
     *                  property="delegation",
     *                  title="delegation",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="96"),
     *              ),
     *              @SWG\Property(property="numero_enregistrement", type="string", example="25"),
     *              @SWG\Property(property="enable", type="string", example="true"),
     *              @SWG\Property(
     *                  property="specialites",
     *                  type="array",
     *                  @SWG\Items(
     *                      type="object",
     *                      @SWG\Property(property="id", type="integer", example=1),
     *                  ),
     *              ),
     *              @SWG\Property(property="nombre_formateur", type="integer", example=25),
     *              @SWG\Property(property="nbre_cadre_administratif", type="integer", example="100"),
     *              @SWG\Property(property="capacite_hybergement", type="integer", example="130"),
     *              @SWG\Property(property="capacite_resto", type="integer", example="201"),
     *              @SWG\Property(property="type", type="integer", example=1),
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
    public function updateAction(?CentreFormation $centreFormation, Request $request)
    {
        try {
            $emailCentreFormation = $centreFormation->getEmail();
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
            if (empty($centreFormation)) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['centreFormation'] = $message;
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $error_global, 'data' => $errors], Response::HTTP_BAD_REQUEST);
            }
            $data = json_decode($request->getContent(), true);
            $em = $this->getDoctrine()->getManager();
            $validator = New validateCreateCentreFormation($em);
            $errors = $validator->validateEditCentreFormation($data, $centreFormation);

            if (!empty($errors)) {

                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                // return $this->createApiResponse($errors, 400);
            }

            $em = $this->getDoctrine()->getManager();
            if (isset($data["intitule_ar"]))
                $centreFormation->setIntituleAr($data["intitule_ar"]);
            if (isset($data["intitule_fr"]))
                $centreFormation->setIntituleFr($data["intitule_fr"]);
            if (isset($data["adresse"]))
                $centreFormation->setAdresse($data["adresse"]);
            if (isset($data["tel"]))
                $centreFormation->setTel($data["tel"]["dialCode"] . " " . $data["tel"]["number"]);
            if (isset($data["fax"]))
                $centreFormation->setFax($data["fax"]["dialCode"] . " " . $data["fax"]["number"]);
            if (isset($data["email"]))
                $centreFormation->setEmail($data["email"]);
            if (isset($data["nom_directeur_ar"]))
                $centreFormation->setNomDirecteurAr($data["nom_directeur_ar"]);
            if (isset($data["nom_directeur_fr"]))
                $centreFormation->setNomDirecteurFr($data["nom_directeur_fr"]);
            if (isset($data["annee_creation"]))
                $centreFormation->setAnneeCreation($data["annee_creation"]);
            if (isset($data["capacite_acceuil"]))
                $centreFormation->setCapaciteAccueil($data["capacite_acceuil"]);
            if (isset($data["enable"])) {
                $testEnable = $data["enable"] === 'true' ? true : false;
                $centreFormation->setEnable($testEnable);
            }
            if (isset($data["gouvernorat"]["id"])) {
                $gouvernorat = $em->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["gouvernorat"]["id"]);
                $centreFormation->setGouvernorat($gouvernorat);
                $user->setGouvernorat($gouvernorat);
            }
            if (isset($data["delegation"]["id"])) {
                $delegation = $em->getRepository('MfpeReferencielBundle:RefDelegation')->find($data["delegation"]["id"]);
                $centreFormation->setDelegation($delegation);
                $user->setDelegation($delegation);
            }
            if (isset($data["type"]) && !empty($data["type"])) {
                {
                    if ($data["type"] == $centreFormation->getType()) {

                        // $centreFormation->setType($data["type"]);
                        if ($data["type"] == 1 || $data["type"] == 2) {
                            if (isset($data["organisme"])) {
                                $centreFormation->setOrganisme(strtoupper($data["organisme"]));
                                //Vider Gouvernorat/Delegation if sector public
                                $centreFormation->setNumeroEnregistrement(NULL);

                            }

                        } elseif ($data["type"] == 3) {
                            if (isset($data["numero_enregistrement"])) {
                                $centreFormation->setNumeroEnregistrement($data["numero_enregistrement"]);
                            }
                            //Empty Organismeif sector private
                            $centreFormation->setOrganisme("");
                        }
                    }
                }

            }
            //remove all ancien speciality
            $specialiteCentre = $centreFormation->getSpecialiteCenters();
            foreach ($specialiteCentre as $key => $spec) {
                $centreFormation->removeSpecialiteCenter($spec);
            }
            //add new speciality
            foreach ($data["specialites"] as $sp) {
                $specialite = $em->getRepository('MfpeCentreFormationBundle:Specialite')->find($sp['id']);
                $centreFormation->addSpecialiteCenter($specialite);
            }
            if (isset($data["nombre_formateur"]))
                $centreFormation->setNombreFormateur($data["nombre_formateur"]);
            if (isset($data["nbre_cadre_administratif"]))
                $centreFormation->setNombreCadreAdministratif($data["nbre_cadre_administratif"]);
            if (isset($data["capacite_hybergement"]))
                $centreFormation->setCapaciteHebergement($data["capacite_hybergement"]);
            if (isset($data["capacite_resto"]))
                $centreFormation->setCapaciteRestaurant($data["capacite_resto"]);
            //Persist User
            $user = $this->em()->getRepository('MfpeConfigBundle:AppUser')->findOneByEmail($emailCentreFormation);
            if (isset($data["intitule_ar"]))
                $user->setNomAr($data["intitule_ar"]);
            if (isset($data["intitule_fr"]))
                $user->setNomFr($data["intitule_fr"]);
            if (isset($data["nom_directeur_ar"]))
                $user->setPrenomAr($data["nom_directeur_ar"]);
            if (isset($data["nom_directeur_fr"]))
                $user->setPrenomFr($data["nom_directeur_fr"]);
            if (isset($data["tel"]))
                $user->setTel($data["tel"]["dialCode"] . " " . $data["tel"]["number"]);

            if (isset($data["email"]))
                $user->setEmail($data["email"]);
            $user->setUsername($data["email"]);
            $user->setEnable(true);
            $user->setIdentifiant(uniqid());
            $em->flush();
            $centreFormation = $this->get('jms_serializer')->serialize($centreFormation, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailCentreFormation')));
            $centreFormation = json_decode($centreFormation, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $centreFormation], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailCentreFormation"})
     * @Rest\Delete(
     *     path = "/{id}",
     *     name="app_CentreFormation_Delete",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"Centre Formation"},
     *  summary="delete Centre Formation",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Centre Formation id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Response(response="200", description="Returned when Resource deleted",@SWG\Schema(type="array", @Model(type=CentreFormation::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function deleteCentreFormationAction($id)
    {
        try {
            $centreFormations = $this->em()->getRepository('MfpeCentreFormationBundle:CentreFormation')->find($id);
            //Check if the center exist. Return 404 if not.
            if ($centreFormations === null) {
                $message = ApiProblem:: TRAINING_NOT_EXIST;
                $errors['centreFormation'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_NOT_FOUND, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            //Remove the role from the database
            $this->em()->remove($centreFormations);
            $this->em()->flush();
            //return 200 success response with all the users
            $centreFormations = $this->em()->getRepository('MfpeCentreFormationBundle:CentreFormation')->findAll();
            $centreFormations = $this->get('jms_serializer')->serialize($centreFormations, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailCentreFormation')));
            $centreFormations = json_decode($centreFormations, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $centreFormations], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

//    /**
//     * @Rest\View(StatusCode = 200, serializerGroups={"detailCentreFormation"})
//     * @Rest\Get(
//     *     path = "/{id}",
//     *     name="app_centreFormationById_Get",
//     *     options={ "method_prefix" = false },
//     *     requirements = {"centreFormation"="\d+"}
//     * )
//     * @SWG\Get(
//     *  tags={"Centre Formation"},
//     *  summary="Get the CentreFormation with id",
//     *  consumes={"application/json"},
//     *  produces={"application/json"},
//     * @SWG\Parameter(
//     *     name="id",
//     *     in="path",
//     *     type="integer",
//     *     description="centre formation id",
//     *     required=true
//     * ),
//     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=CentreFormation::class, groups={"detailCentreFormation"}))),
//     * @SWG\Response(response="404", description="Returned when user not found"),
//     * )
//     */
//    public function getDetailCentreAction(?CentreFormation $centreFormation)
//    {
//        try {
//
//
//            if (!is_object($centreFormation)) {
//                $message = ApiProblem::PRIVATE_TRAINIG_CENTER_DOES_NOT_EXIST;
//                $errors['centreFormation'] = $message;
//                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//            }
//            if (!$this->container->has('security.token_storage')) {
//                $message = ApiProblem::TOKEN_JWT_EXPIRED;
//                $errors['token'] = $message;
//                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//            }
//            if (null === $token = $this->container->get('security.token_storage')->getToken()) {
//                $message = ApiProblem::TOKEN_JWT_EXPIRED;
//                $errors['token'] = $message;
//                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
//                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//            }
//            $centreFormation = $this->get('jms_serializer')->serialize($centreFormation, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailCentreFormation', 'detailSpecialite', 'ReferencielGroup')));
//            $centreFormation = json_decode($centreFormation, JSON_UNESCAPED_UNICODE);
//            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $centreFormation], Response::HTTP_OK);
//        } catch (\Throwable $e) {
//            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
//        }
//
//    }
}