<?php

namespace Mfpe\AttestationBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Request\ParamFetcher;
use Mfpe\AttestationBundle\Validator\validateUniteRegional;
use Mfpe\ConfigBundle\Entity\AppUser;
use Mfpe\NotificationBundle\Entity\Notification;
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
use Mfpe\AttestationBundle\Validator\ValidateCreateDemande;
use Mfpe\ConfigBundle\Validator\ValidateUser;
use Mfpe\AttestationBundle\Entity\Demande;
use Mfpe\AttestationBundle\Entity\ApplicationHistory;
use \DateTime;
use ArUtil\I18N\Arabic;

/**
 * Description of DemandeController
 *
 * @author Lamine Mansouri
 */
class DemandeController extends BaseController
{

    use ControllerTrait;

    /**
     * @Rest\Post(
     *     path = "",
     *     name = "app_create-demande_Add"
     * )
     * @SWG\Post(
     *  tags={"Demande"},
     *  summary="Create demande",
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
     *          description ="<span style='color: red;'>Field justificatif_experience take three values :
    &nbsp;&nbsp; ATTESTATION_TRAVAIL: ATTESTATION_TRAVAIL is selected
    &nbsp;&nbsp; DEUX_TEMOINS: DEUX_TEMOINS is selected
    &nbsp;&nbsp; ATTESTATION_TEMOINS: ATTESTATION_TRAVAIL and DEUX_TEMOINS are selected
    </span>",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="domaine",
     *                  title="Domaine",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=123),
     *              ),
     *              @SWG\Property(
     *                  property="secteur",
     *                  title="Secteur",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=123),
     *              ),
     *              @SWG\Property(
     *                  property="sousSecteursecteur",
     *                  title="Sous secteur",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=123),
     *              ),
     *              @SWG\Property(property="specialite_citoyen", type="string", example="boulangerie"),
     *              @SWG\Property(property="justificatif_experience", type="string", example="ATTESTATION_TRAVAIL,DEUX_TEMOINS,ATTESTATION_TEMOINS"),
     *              @SWG\Property(property="attestation_formation", type="boolean", example=0),
     *              @SWG\Property(property="nom_employeur", type="string", example="admin"),
     *              @SWG\Property(property="adresse_entreprise", type="string", example="Immeuble Horizon, Rue de la bourse, Les Berges du Lac 2, 1053  Tunisie"),
     *              @SWG\Property(property="adresse_residence_actuelle", type="string", example="Immeuble Horizon, Rue de la bourse, Les Berges du Lac 2, 1053  Tunisie"),
     *              @SWG\Property(
     *                  property="gouvernorat",
     *                  title="Gouvernorat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=38),
     *              ),
     *              @SWG\Property(
     *                  property="delegation",
     *                  title="Delegation",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=25),
     *              ),
     *              @SWG\Property(
     *                  property="gouvernorat_residence",
     *                  title="gouvernorat_residence",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=38),
     *              ),
     *              @SWG\Property(
     *                  property="delegation_residence",
     *                  title="delegation_residence",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=25),
     *              ),
     *              @SWG\Property(property="current_statut", type="string", example="ATTENTE_DR"),
     *              @SWG\Property(property="projet", type="boolean", example=0),
     *              @SWG\Property(property="adresse_projet", type="string", example="Immeuble Horizon, Rue de la bourse, Les Berges du Lac 2, 1053  Tunisie"),
     *              @SWG\Property(
     *                  property="gouvernorat_projet",
     *                  title="Gouvernorat_projet",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=30),
     *              ),
     *              @SWG\Property(
     *                  property="delegation_projet",
     *                  title="Delegation_projet",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=632),
     *              ),
     *              @SWG\Property(
     *                  property="direction_regionale",
     *                  title="Direction regionale",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *              @SWG\Property(property="preview", type="boolean", example="false"),
     *          )
     *
     *      ),
     * )
     */
    public function createDemandeAction(Request $request)
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

            $preview = $data["preview"];
            $em = $this->getDoctrine()->getManager();
            $validator = New validateCreateDemande($em);
            $errors = $validator->validateCreateDemande($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                // return $this->createApiResponse($errors, 400);
            }
            $demande = new Demande();
            $demande->setUser($user);
            $em = $this->getDoctrine()->getManager();
            $secteur = $em->getRepository('MfpeReferencielBundle:RefSecteur')->find($data["secteur"]["id"]);
            $demande->setSecteur($secteur);
            $sousSecteur = $em->getRepository('MfpeReferencielBundle:RefSousSecteur')->find($data["sousSecteur"]["id"]);
            $demande->setSousSecteur($sousSecteur);
            $demande->setSpecialiteCitoyen($data["specialite_citoyen"]);
            $demande->setJustificatifExperience($data["justificatif_experience"]);
            $demande->setAttestationFormation($data["attestation_formation"]);
            $demande->setNomEmployeur($data["nom_employeur"]);
            $demande->setAdresseEntreprise($data["adresse_entreprise"]);
            $demande->setAdresseResidenceActuelle($data["adresse_residence_actuelle"]);
            $gouvernorat = $em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["gouvernorat"]["id"]);
            $demande->setGouvernorat($gouvernorat);
            //gouvernorat Residence
            $gouvernoratResidence = $em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["gouvernorat_residence"]["id"]);
            $demande->getUser()->setGouvernoratResidence($gouvernoratResidence);
            $delegation = $em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["delegation"]["id"]);
            $demande->setDelegation($delegation);
            //delegation Residence
            $delegationResidence = $em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["delegation_residence"]["id"]);
            $demande->getUser()->setDelegationResidence($delegationResidence);

            $demande->setProjet($data["projet"]);
            $currentStatus = $em->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array('code' => $data["current_statut"]));
            $demande->setCurrentStatut($currentStatus);

            $LastDemande = $em->getRepository('MfpeAttestationBundle:Demande')->findLastDemande();
            $codeGouvernorat = $gouvernorat->getCode();
            if ($LastDemande) {
                $date_demande = $LastDemande->getCreatedAt()->format('Y');

                if (date('Y') == $date_demande) {
                    $num_inc = explode("/", $LastDemande->getCode());
                    $last_number = (int)end($num_inc);
                    $num_demande_actuel = $last_number + 1;
                    if (!$codeGouvernorat) {
                        $this->throwProblem($gouvernorat, 404, ApiProblem::GOUVERNERAT_DOES_NOT_EXIST);
                    }
                    $code = $codeGouvernorat . '/' . date('Y') . '/' . $num_demande_actuel;
                } else {
                    $code = $codeGouvernorat . '/' . date('Y') . '/' . '1';
                }
            } else {
                $code = $codeGouvernorat . '/' . date('Y') . '/' . '1';
            }
            $demande->setCode($code);
            $direction_regionale = $em->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array('id' => $data["direction_regionale"]["id"]));
            $demande->setUniteRegionale($direction_regionale);
            if ($data["projet"] == 1) {
                $demande->setAdresseProjet($data["adresse_projet"]);
                $gouvernoratProjet = $em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["gouvernorat_projet"]["id"]);
                $demande->setGouvernoratProjet($gouvernoratProjet);
                $delegationProjet = $em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["delegation_projet"]["id"]);
                $demande->setDelegationProjet($delegationProjet);
                $idGouvernouratProjet = $direction_regionale->getGouvernorat()->getId();
                //if gouv project equal gouv regional unit
                if ($idGouvernouratProjet == $data["gouvernorat_projet"]["id"]) {
                    $demande->setUniteRegionaleGouvernoratProjet(true);
                }

            }
            if ($preview === 'true') {
                $em = $this->getDoctrine()->getManager();
                $em->persist($demande);
                $em->flush();
                $id = $demande->getId();
                $filePath = $this->export_pdf_demande($request, $id);
                $demande->setUrlDemandePdf($filePath);
                $this->addApplicationHistory($demande);
                $em->flush();
            }

            $demande = $this->get('jms_serializer')->serialize($demande, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailDemande')));
            $demande = json_decode($demande, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_CREATED, 'message' => 'success', 'data' => $demande, 'preview' => $data['preview']], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(serializerGroups={"AppUserGroup"})
     * @Rest\Patch(
     *     path = "/{id}",
     *     name="app_demande-patch_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"demande"="\d+"}
     * )
     *
     * @SWG\Patch(
     *  tags={"Demande"},
     *  summary="Patch Demande",
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
     *              @SWG\Property(
     *                  property="domaine",
     *                  title="Domaine",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=123),
     *              ),
     *              @SWG\Property(
     *                  property="secteur",
     *                  title="Secteur",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=123),
     *              ),
     *              @SWG\Property(
     *                  property="sousSecteursecteur",
     *                  title="Sous secteur",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=13),
     *              ),
     *              @SWG\Property(
     *                  property="specialite",
     *                  title="Specialite",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=123),
     *              ),
     *              @SWG\Property(
     *                  property="centre_formation",
     *                  title="Centre de formation",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=123),
     *              ),
     *              @SWG\Property(property="specialite_citoyen", type="string", example="Boulangerie"),
     *              @SWG\Property(property="justificatif_experience", type="string", example="ATTESTATION_TRAVAIL"),
     *              @SWG\Property(property="attestation_formation", type="string", example=0),
     *              @SWG\Property(property="nom_employeur", type="string", example="admin"),
     *              @SWG\Property(property="adresse_entreprise", type="string", example="Immeuble Horizon, Rue de la bourse, Les Berges du Lac 2, 1053  Tunisie"),
     *              @SWG\Property(property="adresse_residence_actuelle", type="string", example="Immeuble Horizon, Rue de la bourse, Les Berges du Lac 2, 1053  Tunisie"),
     *              @SWG\Property(
     *                  property="gouvernorat",
     *                  title="Gouvernorat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=123),
     *              ),
     *              @SWG\Property(
     *                  property="delegation",
     *                  title="Delegation",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=123),
     *              ),
     *              @SWG\Property(property="projet", type="boolean", example=1),
     *              @SWG\Property(property="adresse_projet", type="string", example="Immeuble Horizon, Rue de la bourse, Les Berges du Lac 2, 1053  Tunisie"),
     *              @SWG\Property(
     *                  property="gouvernorat_projet",
     *                  title="Gouvernorat du projet",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=123),
     *              ),
     *              @SWG\Property(
     *                  property="delegation_projet",
     *                  title="Delegation du projet",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=123),
     *              ),
     *              @SWG\Property(
     *                  property="direction_regionale",
     *                  title="Direction regionale",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=123),
     *              ),
     *              @SWG\Property(property="action", type="integer", example=1),
     *              @SWG\Property(property="observation", type="string", example="Le directeur d’EHPAD assure la responsabilité de vous permettre une attestation pour créé votre projet personnel avec un crédit matériels"),
     *              @SWG\Property(property="statut", type="string", example="PAIEMENT_OK"),
     *              @SWG\Property(
     *                  property="motif",
     *                  title="Motif",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=123),
     *              ),
     *              @SWG\Property(property="date_exam", type="string", example="2019-12-11T13:38:56.334Z"),
     *              @SWG\Property(property="material", type="string", example="Tablier, Pinceaux, Calculatrice"),
     *
     *          )
     *
     *      ),
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Demande::class, groups={"DeserializeUserGroup"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function patchDemandeAction(Request $request, ?Demande $demande)
    {
        try {
            if (!is_object($demande)) {
                $message = ApiProblem::DEMANDES_DOES_NOT_EXIST;
                $errors['demande'] = $message;
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
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
            //Modification all fields demande
            $result = $this->patchDemande($request, $demande);
            if (is_array($result)) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $result, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $this->addApplicationHistory($demande);
            //Send mailer and notification
            $this->sendNotificationEmail($request, $user, $demande);
            return $result;
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailDemande"})
     * @Rest\Get(
     *     path = "/{id}",
     *     name="app_demande_Get",
     *     options={ "method_prefix" = false },
     *     requirements = {"user"="\d+"}
     * )
     * @SWG\Get(
     *  tags={"Demande"},
     *  summary="Get the demande with id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     type="integer",
     *     description="demande id",
     *     required=true
     * ),
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Demande::class, groups={"detailDemande"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getDetailDemandeAction(?Demande $demande)
    {
        try {


            if (!is_object($demande)) {
                $message = ApiProblem::DEMANDES_DOES_NOT_EXIST;
                $errors['demande'] = $message;
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
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
            $demande = $this->get('jms_serializer')->serialize($demande, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailDemande',"ReferencielGroup")));
            $demande = json_decode($demande, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $demande], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }

    }


    /**
     * @Rest\Post(
     *     path = "/export_pdf",
     *     name = "app_demande_donwloadpdf"
     * )
     * @SWG\Post(
     *  tags={"Demande"},
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
     *              @SWG\Property(property="id", type="string", example="2"),
     *          )
     *
     *      ),
     * )
     */
    public function exportpdfAction(Request $request)
    {
        $id = null;
        $filePath = $this->export_pdf_demande($request, $id);
        $response = array(
            'code' => 0,
            'message' => 'file uploaded!',
            'errors' => null,
            'result' => $filePath
        );
        return new JsonResponse($response, Response::HTTP_CREATED);
    }

    public function export_pdf_demande(Request $request, $id1)
    {
        $data = json_decode($request->getContent(), true);
        if ($data) {
            if (isset ($data["id"])) {
                $id = $data["id"];
                if ($id) {
                    $demande = $this->em()->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array('id' => $id));
                }
            }
        }
        if (isset($id1)) {
            $demande = $this->em()->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array('id' => $id1));
        }

        if (!$demande) {
            $message = ApiProblem::DEMANDES_DOES_NOT_EXIST;
            $errors['demande'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors], Response::HTTP_BAD_REQUEST);
        }
        $lang = "ar";
        $dir = __DIR__ . '../../../../../web/';
        $filePath = $this->get("mfpe_attestation_doc")->returnPDFResponseFromHTMLvig($dir, $lang, $demande);
        return $filePath;
    }

    /**
     * @Rest\Get(
     *     path = "",
     *     name="app_list-demandes-by-roles_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="all",
     *     nullable=true,
     *     description="tous les demandes avec role uniquement."
     * )
     * @SWG\Get(
     *  tags={"Demande"},
     *  summary="Get  all demandes by roles current user",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Demande::class, groups={"listDemande"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getDemandesByRolesUserAction(ParamFetcherInterface $paramFetcher, Request $request)
    {
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
        $roles = $user->getUserRoles();
        $currentUserRoles = array();
        foreach ($roles as $role) {
            array_push($currentUserRoles, $role->getRole());
        }
        $demandes = "";
        //recuperer le paramatre all
        $param = $paramFetcher->get('all');

        //ROLE_CITOYEN for current user
        if (in_array("ROLE_CITOYEN", $currentUserRoles)) {
            $demandes = $this->getDemandeByCitoyen($currentUserRoles, $user);
            $demandes = $this->get('jms_serializer')->serialize($demandes, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('listDemande', "AppUserGroup", "ReferencielGroup", "document")));
        }
        if (in_array("ROLE_AGENT_DR1", $currentUserRoles) || in_array("ROLE_AGENT_DR2", $currentUserRoles) || in_array("ROLE_AGENT_DR3", $currentUserRoles) || in_array("ROLE_AGENT_DR4", $currentUserRoles) || in_array("ROLE_DIRECTEUR_DR", $currentUserRoles)) {
            $demandes = $this->getDemandeByDirectionRegional($currentUserRoles, $user, $param);
            $demandes = $this->get('jms_serializer')->serialize($demandes, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('listDemande')));

        }
        if (in_array("ROLE_AGENT_CENTRE_FORMATION", $currentUserRoles)) {

            $demandes = $this->getDemandeByCentreFormation($currentUserRoles, $user, $param);
            $demandes = $this->get('jms_serializer')->serialize($demandes, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('listDemande')));
        }
        //ROLE_ADMIN ou ROLE_SUPER_ADMIN for current user
        if (in_array("ROLE_ADMIN", $currentUserRoles) || in_array("ROLE_SUPER_ADMIN", $currentUserRoles)) {

            $demandes = $this->getDoctrine()->getRepository('MfpeAttestationBundle:Demande')->findAll();
            $demandes = $this->get('jms_serializer')->serialize($demandes, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('listDemande')));

        }


        //  $demandes = $this->get('jms_serializer')->serialize($demandes, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('listDemande')));

        $demandes = json_decode($demandes, JSON_UNESCAPED_UNICODE);

        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $demandes], Response::HTTP_OK);
    }

    //fonction patch demande
    private function patchDemande(Request $request, ?Demande $demande)
    {
        $data = json_decode($request->getContent(), true);
        if (!is_object($demande)) {
            $message = ApiProblem::DEMANDES_DOES_NOT_EXIST;
            $errors['demande'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors], Response::HTTP_BAD_REQUEST);
        }
        $error_global = ApiProblem::MESSAGE_GLOBAL;
        $em = $this->getDoctrine()->getManager();
        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return $this->createApiResponse('Token not exist.', 400);
        }
        if (!is_object($user = $token->getUser())) {
            $message = ApiProblem::TOKEN_JWT_EXPIRED;
            $errors['token'] = $message;
            $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        } //update demande
        else {
            $em = $this->getDoctrine()->getManager();
            $validator = New ValidateCreateDemande($em);
            $errors = $validator->validateCreateDemande($data);
            if (isset($data['specialite']['id']) && !empty($data['specialite']['id'])) {
                $specialite = $data['specialite']['id'];
                $errorsPatch = $validator->validatePatchDemande($demande, $specialite);
                if ($errorsPatch) {
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errorsPatch, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
            }

            if ($errors) {
                return $errors;
            }
//            if ($errors) {
//                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
//                // return $this->createApiResponse($errors, 400);
//            }

            if (isset($data["secteur"]["id"]) && !empty($data["secteur"]["id"])) {
                $secteur = $em->getRepository('MfpeReferencielBundle:RefSecteur')->find($data["secteur"]["id"]);
                $demande->setSecteur($secteur);
            }
            if (isset($data["sousSecteur"]["id"]) && !empty($data["sousSecteur"]["id"])) {
                $sousSecteur = $em->getRepository('MfpeReferencielBundle:RefSousSecteur')->find($data["sousSecteur"]["id"]);
                $demande->setSousSecteur($sousSecteur);
            }
            if (isset($data["centre_formation"]["id"]) && !empty($data["centre_formation"]["id"])) {
                $centreFormation = $em->getRepository('MfpeCentreFormationBundle:CentreFormation')->find($data["centre_formation"]["id"]);
                $demande->setCentreFormation($centreFormation);
            }
            if (isset($data["specialite"]["id"]) && !empty($data["specialite"]["id"])) {
                $specialite = $em->getRepository('MfpeCentreFormationBundle:Specialite')->find($data["specialite"]["id"]);
                $demande->setSpecialite($specialite);
            }
            if (isset($data["specialite_citoyen"]) && !empty($data["specialite_citoyen"])) {
                $demande->setSpecialiteCitoyen($data["specialite_citoyen"]);
            }
            if (isset($data["justificatif_experience"]) && !empty($data["justificatif_experience"])) {
                $demande->setJustificatifExperience($data["justificatif_experience"]);
            }
            if (isset($data["attestation_formation"]) && !empty($data["attestation_formation"])) {
                $demande->setAttestationFormation($data["attestation_formation"]);
            }
            if (isset($data["nom_employeur"]) && !empty($data["nom_employeur"])) {
                $demande->setNomEmployeur($data["nom_employeur"]);
            }
            if (isset($data["adresse_entreprise"]) && !empty($data["adresse_entreprise"])) {
                $demande->setAdresseEntreprise($data["adresse_entreprise"]);
            }
            if (isset($data["adresse_residence_actuelle"]) && !empty($data["adresse_residence_actuelle"])) {
                $demande->setAdresseResidenceActuelle($data["adresse_residence_actuelle"]);
            }
            if (isset($data["gouvernorat"]["id"]) && !empty($data["gouvernorat"]["id"])) {
                $gouvernorat = $em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["gouvernorat"]["id"]);
                $demande->setGouvernorat($gouvernorat);
            }
            if (isset($data["delegation"]["id"]) && !empty($data["delegation"]["id"])) {
                $delegation = $em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["delegation"]["id"]);
                $demande->setDelegation($delegation);
            }
            if (isset($data["projet"]) && !empty($data["projet"])) {
                $demande->setProjet($data["projet"]);
            }
            if (isset($data["observation"]) && !empty($data["observation"])) {
                $demande->setObservation($data["observation"]);
            }
            if (isset($data["statut"])) {
                $statut = $em->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array('code' => $data["statut"]));
                // dd($data["statut"]);
                $demande->setCurrentStatut($statut);
                // if refus demande , don't forget motif of refuse
                if (isset($data["motif"]["id"]) && !empty($data["motif"]["id"])) {
                    $motif = $em->getRepository('MfpeReferencielBundle:RefMotif')->find($data["motif"]["id"]);
                    $demande->setMotif($motif);
                }
                elseif (empty($data["motif"]["id"]))
                {
                    $demande->setMotif(NULL);
                }
            }
            if (isset($data["projet"]) && $data["projet"] == 1) {
                if (isset($data["adresse_projet"]) && !empty($data["adresse_projet"])) {
                    $demande->setAdresseProjet($data["adresse_projet"]);
                }
                if (isset($data["gouvernorat_projet"]) && !empty($data["gouvernorat_projet"]["id"])) {
                    $gouvernoratProjet = $em->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["gouvernorat_projet"]["id"]);
                    $demande->setGouvernoratProjet($gouvernoratProjet);
                }
                if (isset($data["delegation_projet"]) && !empty($data["delegation_projet"]["id"])) {
                    $delegationProjet = $em->getRepository('MfpeReferencielBundle:RefDelegation')->find($data["delegation_projet"]["id"]);
                    $demande->setDelegationProjet($delegationProjet);
                }
                if (isset($data["direction_regionale"]) && !empty($data["direction_regionale"]["id"])) {
                    $directionRegionale = $em->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->find($data["direction_regionale"]["id"]);
                    $demande->setUniteRegionale($directionRegionale);
                }
            }
            if (isset($data["statut"])) {
                if ($data["statut"] == "ATTESTATION_OK") {
                    $codeGouvernorat = $demande->getUniteRegionale()->getGouvernorat()->getCode();
                    $statut = $em->getRepository('MfpeReferencielBundle:RefStatut')->findOneByCode("ATTESTATION_OK");
                    $currentYear = date('Y');
                    //$LastDemandeDiplomedByGouv = $em->getRepository('MfpeAttestationBundle:Demande')->findLastDemandeDiplomedThisYearByGouvernorat($demande->getUniteRegionale()->getGouvernorat(),$statut,$year);
                    $LastDemandeDiplomedByGouv = $em->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("gouvernorat" => $demande->getUniteRegionale()->getGouvernorat(), "currentStatut" => $statut), array('updatedAt' => 'DESC'));
                    if ($LastDemandeDiplomedByGouv instanceof Demande) {
                        $updatedAt = $LastDemandeDiplomedByGouv->getUpdatedAt();
                        if ($currentYear == $updatedAt) {
                            $identifiant = $LastDemandeDiplomedByGouv->getIdentifiant();
                            if (is_null($identifiant)) {
                                $code = $codeGouvernorat . '/' . "0001" . '/' . substr(date('Y'), 2);
                            } else {
                                $identifiant = explode("/", $identifiant);
                                $nbr_inc = (int)$identifiant[1] + 1;
                                $nbr_inc = substr("0000{$nbr_inc}", -4);
                                $code = $codeGouvernorat . '/' . $nbr_inc . '/' . substr(date('Y'), 2);
                            }
                        } else {
                            $code = $codeGouvernorat . '/' . "0001" . '/' . substr(date('Y'), 2);
                        }
                    } else {
                        $code = $codeGouvernorat . '/' . "0001" . '/' . substr(date('Y'), 2);
                    }
                    $demande->setIdentifiant($code);
                }
            }
            $demande->setUpdatedBy($user->getId());
            $em = $this->getDoctrine()->getManager();
            if (isset($data["date_exam"]) && !empty($data["date_exam"])) {
                $date = date_create($data["date_exam"]);
                $date_exam = date_timezone_set($date, timezone_open('Africa/Tunis'));
                $dateExam = new DateExam();
                $dateExam->setDateExam($date_exam);
                $dateExam->setMaterial($data["material"]);
                $NbTimesNotPassExamen = 0;
                $dateExam->setNbTimesNotPassExamen($NbTimesNotPassExamen);

                if (isset($data["statut"])) {
                    if ($data["statut"] == "RE_DATE_EXAM_OK") {
                        $lastNbTimesNotPassExamen = $em->getRepository('MfpeAttestationBundle:DateExam')->findOneBy(
                            array('demande' => $demande),
                            array('id' => 'DESC')
                        );
                        if (isset($lastNbTimesNotPassExamen) && !empty($lastNbTimesNotPassExamen)) {
                            $dateExam->setNbTimesNotPassExamen($lastNbTimesNotPassExamen->getNbTimesNotPassExamen() + 1);

                        } else {
                            $dateExam->setNbTimesNotPassExamen($NbTimesNotPassExamen + 1);
                        }

                    }
                }
                $dateExam->setDemande($demande);
                $em->persist($dateExam);
            }
            $em->flush();
            $demande = $this->get('jms_serializer')->serialize($demande, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailDemande')));
            $demande = json_decode($demande, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $demande,], Response::HTTP_OK);
        }
    }

    private function sendNotificationEmail($request, $user, $demande)
    {
        try {
            $data = json_decode($request->getContent(), true);
            //Remove Last Notification of this demande
            $notifications = $this->em()->getRepository('MfpeNotificationBundle:Notification')->findBy(array('demande' => $demande));
            if ($notifications) {
                foreach ($notifications as $notification) {
                    $this->em()->remove($notification);
                    $this->em()->flush();
                }
            }
            //refus demande by centre formation
            if ($data['statut'] == "REFUS_CENTRE") {
                $gouvernoratDemandId = $demande->getGouvernorat()->getId();
                $uniteRegionale = $demande->getUniteRegionale();
                $roles = $this->em()->getRepository('MfpeConfigBundle:Role')->getRolesByStatus("REFUS_CENTRE");
                $valueRoles = array();
                foreach ($roles as $role) {
                    $currentRole = $role->getRole();
                    $position = strpos($currentRole, "ROLE_AGENT_DR");
                    if (is_int($position)) {
                        array_push($valueRoles, $role->getRole());
                    }
                }
//                $roles               = array(
//                    "ROLE_AGENT_DR1",
//                    "ROLE_AGENT_DR2",
//                    "ROLE_AGENT_DR3",
//                    "ROLE_AGENT_DR4"
//                );
                $usersReceivers = $this->em()->getRepository('MfpeConfigBundle:AppUser')->getUsersByUniteRegionaleRoles($uniteRegionale, $valueRoles);
                foreach ($usersReceivers as $userReceiver) {
                    //First : Send Notification if REFUS_CENTRE
                    $this->sendNotificationSystem(1, $user, $userReceiver, $demande);


                    //Second : Send Email if REFUS_CENTRE
                    $motif = $this->em()->getRepository('MfpeReferencielBundle:RefMotif')->find($data["motif"]["id"]);

                    $parameters = array(
                        'user' => $userReceiver,
                        'demande' => $demande,
                        'motif' => $motif,
                        'host' => $this->getParameter('host')
                    );
                    $template = 'Emails/send_email_refus_atfp_to_agent_dr.html.twig';
                    $from = $this->container->getParameter('mailer_user');
                    $to = $userReceiver->getEmail();
                    $subject = $this->container->getParameter('object_mail_refus');
                    $response = $this->generatePdfRefuseDemandeByCentreFormation($request, $demande);
                    $file = explode("/", $response["result"]);
                    $nameFile = end($file);
                    $attachement = __DIR__ . "/../../../../web/uploads/refus_demande/" . $nameFile;
                    $this->get('mfpe_configbundle_mailer_sendmailer')->sendMailer($template, $parameters, $from, $to, $subject, $attachement);
                }
            }
            // Modif demande par centre formation en attente peyement
            if ($data['statut'] == "ATTENTE_PAIEMENT") {
                $parameters = array(
                    'user' => $user,
                    'demande' => $demande,
                );
                $template = 'Emails/send_email_dde_payement_citoyen.html.twig';
                $from = $this->container->getParameter('mailer_user');
                $to = $demande->getUser()->getEmail();
                $subject = $this->container->getParameter('object_mail_demande_payement') . ' ' . $demande->getSpecialiteCitoyen();
                $this->get('mfpe_configbundle_mailer_sendmailer')->sendMailer($template, $parameters, $from, $to, $subject, NULL);
            }

            // Modif demande par centre formation en attente peyement
            if ($data['statut'] == "PV_REFUSE") {
                //First : Send Notification if REFUS_CENTRE
                //No notification System
                //Second : Send Mailer if REFUS_CENTRE
                $parameters = array(
                    'user' => $user,
                    'demande' => $demande,
                );
                $template = 'Emails/send_email_refus_pv_to_centre_formation.html.twig';
                $from = $this->container->getParameter('mailer_user');
                $to = $demande->getCentreFormation()->getEmail();
                $subject = $this->container->getParameter('object_mail_demande_payement') . ' ' . $demande->getSpecialiteCitoyen();
                $this->get('mfpe_configbundle_mailer_sendmailer')->sendMailer($template, $parameters, $from, $to, $subject, NULL);
            }

            if ($data['statut'] == "PV_ACCEPTE") {
                $gouvernoratDemandId = $demande->getGouvernorat()->getId();
                $uniteRegionale = $demande->getUniteRegionale();
                $roles = array(
                    "ROLE_DIRECTEUR_DR"
                );
                $usersReceivers = $this->em()->getRepository('MfpeConfigBundle:AppUser')->getUsersByUniteRegionaleRoles($uniteRegionale, $roles);
                foreach ($usersReceivers as $userReceiver) {
                    if (is_object($userReceiver)) {
                        $this->sendNotificationSystem(3, $user, $userReceiver, $demande);
                    }
                }
            }

            if ($data['statut'] == "ATTESTATION_KO") {
                //First : Send Notification if REFUS_CENTRE
                $userReceiver = $demande->getUser();
                $this->sendNotificationSystem(4, $user, $userReceiver, $demande);
                //Second : Send Mailer if REFUS_CENTRE
                $parameters = array(
                    'user' => $user,
                    'demande' => $demande,
                );
                $template = 'Emails/send_email_attestation_ko_to_cotoyen.html.twig';
                $from = $this->container->getParameter('mailer_user');
                $to = $demande->getUser()->getEmail();
                $subject = $this->container->getParameter('object_attestation_ko') . ' ' . $demande->getSpecialiteCitoyen();
                $this->get('mfpe_configbundle_mailer_sendmailer')->sendMailer($template, $parameters, $from, $to, $subject, NULL);
            }
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    public function addApplicationHistory($demande)
    {
        $em = $this->getDoctrine()->getManager();
        $applicationHistory = new ApplicationHistory();
        $applicationHistory->setStatut($demande->getCurrentStatut());
        $applicationHistory->setMotif($demande->getMotif());
        $applicationHistory->setUpdatedBy($demande->getUpdatedBy());
        $applicationHistory->setDemande($demande);
        $applicationHistory->setCreatedAt(new \DateTime ());
        $em->persist($applicationHistory);
        $em->flush();
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailDemande"})
     * @Rest\Get(
     *     path = "/attestation_public/",
     *     name="app_demande-donwload-attestation_public",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="numero_attestation",
     *     nullable=true,
     *     description="Numero attestation to search for"
     * )
     * @Rest\QueryParam(
     *     name="numero_cin",
     *     nullable=true,
     *     description="Numero CIN to search for."
     * )
     * @Rest\QueryParam(
     *     name="date_naissance",
     *     nullable=true,
     *     description="date naissance to search for."
     * )
     * @SWG\Get(
     *  tags={"Demande"},
     *  summary="Exporter en pdf",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Demande::class, groups={"detailDemande"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function exportAttestationPublicAction(Request $request)
    {
        $data = json_decode(json_encode($request->query->all()), true);
        $em = $this->getDoctrine()->getManager();
        $validator = New validateCreateDemande($em);
        $errors = $validator->validateExportAttestation($data);
        if ($errors) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }

        $attestation = $this->em()->getRepository('MfpeAttestationBundle:Demande')->findAttestion($data);
        $lang = "ar";
        $dir = __DIR__ . '../../../../../web';

        //$nom = 'attestation.jpeg';
        if (!empty($attestation)) {
            $filePath = $this->createAttestation($dir, $lang, $attestation);
            $response = array(
                'code' => 0,
                'message' => 'file uploaded!',
                'errors' => null,
                'result' => $filePath
            );
        } else {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::ATTESTATION_NOT_EXIST, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);

        }

        return new JsonResponse($response, Response::HTTP_CREATED);
    }

    /**
     * @Rest\Post(
     *     path = "/export-attestation_pdf",
     *     name = "app_demande_donwload-attestation-pdf"
     * )
     * @SWG\Post(
     *  tags={"Demande"},
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
     *              @SWG\Property(property="id", type="string", example="2"),
     *              @SWG\Property(property="lang", type="string", example="ar")
     *          )
     *
     *      ),
     * )
     */
    public function exportAttestationAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $id = $data["id"];
        if ($id) {
            $demande = $this->em()->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array('id' => $id));
        }
        if (!$demande) {
            $message = ApiProblem::DEMANDES_DOES_NOT_EXIST;
            $errors['demande'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors], Response::HTTP_BAD_REQUEST);
        }
        $lang = "ar";
        $dir = __DIR__ . '../../../../../web';
        $filePath = $this->createAttestation($dir, $lang, $demande);

        $response = array(
            'code' => 0,
            'message' => 'file uploaded!',
            'errors' => null,
            'result' => $filePath
        );
        return new JsonResponse($response, Response::HTTP_CREATED);
    }


    //function to create attestation
    public function createAttestation($dir, $lang, $demande)
    {
        try {
            $dateExamen = $this->getDoctrine()->getRepository(DateExam::class)
                ->findOneBy(
                    array('demande' => $demande),
                    array('id' => 'DESC')
                );
            $nom = 'attestation.jpeg';
            $nom_image = $dir . "/images/" . $nom;
            //   $nom = 'attestation.jpeg'; // le nom de votre image avec l'extension jpeg
            $image = imagecreatefromjpeg($nom_image);
            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                putenv("LANG=" . $lang);
                $font = $dir . '/fonts/arial.ttf';
            } else {
                // Définir la variable d'environnement pour GD
                putenv('GDFONTPATH=' . realpath('.'));
                $font = 'arial.ttf';
            }


            $black = imagecolorallocate($image, 0, 0, 0);
            $red=	imagecolorallocate($image, 255, 0, 0);
            // header('Content-type: image/jpeg');
            // Add some shadow to the text
            $date1 = new DateTime();
            $fileurl1 = "/images/" . $date1->getTimestamp() . $nom;
            $fileurl = $dir . "/images/" . $date1->getTimestamp() . $nom;
            $obj = new Arabic('Glyphs');
            if ($demande->getCode()) {
                if ($demande->getIdentifiant()) {
                    $identifiant = $demande->getIdentifiant();
                    $identifiants = explode("-", $identifiant);


                    $j = 0;
                    imagettftext($image, 50, 0, 1300, 490, $black, $font, $identifiants[0]);
                    $datetab = explode("/", $identifiants[1]);
                    imagettftext($image, 50, 0, 1445, 490, $black, $font, $datetab[0][0]);
                    imagettftext($image, 50, 0, 1505, 490, $black, $font, $datetab[0][1]);
                    for ($i = 0; $i < strlen($datetab[1]); $i++) {
                        $j = $j + 80;
                        imagettftext($image, 50, 0, 1535 + $j, 490, $black, $font, $datetab[1][$i]);
                    }
                    imagettftext($image, 50, 0, 1950, 490, $black, $font, sprintf("%02d", $datetab[2])[0]);
                    imagettftext($image, 50, 0, 2030, 490, $black, $font, sprintf("%02d", $datetab[2])[1]);
                }
            }
            if ($demande->getUniteRegionale()) {
                $gouvernoratUniteRegional = $demande->getUniteRegionale()->getGouvernorat()->getIntituleAr();
                $gouvernoratUniteRegional = $obj->utf8Glyphs($gouvernoratUniteRegional);
                $lengthGouvernorat = strlen($obj->utf8Glyphs($gouvernoratUniteRegional));

                if ($lengthGouvernorat > 1 && $lengthGouvernorat < 13) {

                    imagettftext($image, 30, 0, 2650, 275, $black, $font, $gouvernoratUniteRegional);
                    imagettftext($image, 52, 0, 1040, 1850, $black, $font, $gouvernoratUniteRegional);
                    imagettftext($image, 52, 0, 360, 1985, $black, $font, $gouvernoratUniteRegional);
                }
                if ($lengthGouvernorat >= 13) {
                    imagettftext($image, 30, 0, 2570, 275, $black, $font, $gouvernoratUniteRegional);
                    imagettftext($image, 52, 0, 910, 1850, $black, $font, $gouvernoratUniteRegional);
                    imagettftext($image, 52, 0, 230, 1985, $black, $font, $gouvernoratUniteRegional);
                }


            }

            if ($dateExamen) {
                $dateExamen = $dateExamen->getDateExam();
                $dateEx = $dateExamen->format('d-m-Y');
                $dateEx = $this->get("mfpe_configbundle.services.convert_date")->convertDate($dateEx, "ar");
                $dateEx = $obj->utf8Glyphs($dateEx);
                imagettftext($image, 44, 0, 2320, 1220, $black, $font, $dateEx);
            }

            if ($demande->getUser()->getNomAr() && $demande->getUser()->getPrenomAr()) {

                $nom = $demande->getUser()->getNomAr();
                $nom = $obj->utf8Glyphs($nom);
                $prenom = $demande->getUser()->getPrenomAr();
                $prenom = $obj->utf8Glyphs($prenom);
                $lengthNomPrenom = strlen($demande->getUser()->getPrenomAr()) + strlen($demande->getUser()->getNomAr());

                if ($lengthNomPrenom <= 18) {
                    imagettftext($image, 52, 0, 1270, 1432, $black, $font, $nom . " " . $prenom);
                }

                if ($lengthNomPrenom >= 19 && $lengthNomPrenom < 40) {

                    imagettftext($image, 52, 0, 1120, 1432, $black, $font, $nom . " " . $prenom);
                }
                if ($lengthNomPrenom >= 40) {

                    imagettftext($image, 52, 0, 950, 1432, $black, $font, $nom . " " . $prenom);
                }
//         dd($lengthNomPrenom);
//            imagettftext($image, 52, 0, 1250, 1432, $black, $font, $nom . " " . $prenom);
            }
            if ($demande->getUser()->getDateNaissance()) {
                $dateNaissance = $demande->getUser()->getDateNaissance();
                $dateNaissance = $dateNaissance->format('d-m-Y');
                $dateNaissance = $this->get("mfpe_configbundle.services.convert_date")->convertDate($dateNaissance, "ar");
                $dateNaissance = $obj->utf8Glyphs($dateNaissance);
                imagettftext($image, 52, 0, 1150, 1505, $black, $font, $dateNaissance);
            }

            if ($demande->getUser()->getNumCin()) {
                $numeroCIN = $demande->getUser()->getNumCin();
                //$numeroCIN= $obj->utf8Glyphs($numeroCIN);
                imagettftext($image, 52, 0, 1300, 1580, $black, $font, $numeroCIN);
            }
            if ($demande->getUser()->getNumPassport()) {
                $numeroPassport = $demande->getUser()->getNumPassport();
                //$numeroPassport= $obj->utf8Glyphs($numeroPassport);
                imagettftext($image, 52, 0, 1300, 1580, $black, $font, $numeroPassport);
            }
            //dd($demande->getSpecialite()->getId());
            if ($demande->getSpecialite()) {
                if ($demande->getSpecialite()->getIntituleAr()) {
                    $specialite = $demande->getSpecialite()->getIntituleAr();
                    $specialite = $obj->utf8Glyphs($specialite);
                    $lengthSpecialite = strlen($obj->utf8Glyphs($specialite));
                    if ($lengthSpecialite < 30) {
                        imagettftext($image, 52, 0, 1400, 1660, $black, $font, $specialite);
                    }
                    if ($lengthSpecialite > 30 && $lengthSpecialite < 60) {
                        imagettftext($image, 52, 0, 1200, 1660, $black, $font, $specialite);
                    }
                    if ($lengthSpecialite > 60) {
                        imagettftext($image, 52, 0, 800, 1660, $black, $font, $specialite);
                    }

                }
            }

            $dateJour = $date1->format('d-m-Y');
            $dateJour = $this->get("mfpe_configbundle.services.convert_date")->convertDate($dateJour, "ar");
            $dateJour = $obj->utf8Glyphs($dateJour);
            imagettftext($image, 44, 0, 480, 1845, $black, $font, $dateJour);
            $servername = $_SERVER['HTTP_HOST'];

            if ($this->container->get('security.token_storage')->getToken()->getUser() == 'anon.') {
                $fake = $obj->utf8Glyphs('مزيفة');
                imagettftext($image, 400, 35, 1200, 1660, $red, $font, $fake);

                imagejpeg($image, $fileurl, 80, NULL);
                imagedestroy($image);
                return $servername . $fileurl1;
            } else {
                if (null == $token = $this->container->get('security.token_storage')->getToken()) {
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
                imagejpeg($image, $fileurl, 80, NULL);
                imagedestroy($image);
                return $servername . $fileurl1;
            }


        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    private function generatePdfRefuseDemandeByCentreFormation(Request $request, ?Demande $demande)
    {
        try {
            $data = json_decode($request->getContent(), true);
            if (!is_object($demande)) {
                $message = ApiProblem::DEMANDES_DOES_NOT_EXIST;
                $errors['demande'] = $message;
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors], Response::HTTP_BAD_REQUEST);
            } else {
                $lang = "ar";
                $dir = __DIR__ . '../../../../../web/';
                $filePath = $this->get("mfpe_attestation_doc")->returnRefusCentreFormationPDFResponseFromHTMLvig($dir, $lang, $demande);

                $response = array(
                    'code' => 0,
                    'message' => 'file uploaded!',
                    'errors' => null,
                    'result' => $filePath
                );
                return $response;
            }
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    private function getDemandeByDirectionRegional($currentUserRole, $user, $param)
    {
        $em = $this->getDoctrine()->getManager();
        $alldemande = array();
        $allStatus = array();
        foreach ($currentUserRole as $currentUserRole) {
            $roles = $em->getRepository('MfpeConfigBundle:Role')->findByRole($currentUserRole);
            foreach ($roles as $role) {
                array_push($allStatus, $role->getStatus());
            }
        }
        $allStatesToSee = array_merge([], ...$allStatus);
        $uniteRegionale = $user->getUniteRegionale();
        if (is_object($uniteRegionale)) {
            if (!isset($param)) {
                foreach ($allStatesToSee as $status) {
                    $statusRef = $em->getRepository('MfpeReferencielBundle:RefStatut')->findOneByCode($status);
                    $demandestatus = $em->getRepository('MfpeAttestationBundle:Demande')->findBy(array('uniteRegionale' => $uniteRegionale, 'currentStatut' => $statusRef), array('updatedAt' => 'DESC'));
                    $alldemande = array_merge($alldemande, $demandestatus);
                }
            } elseif (isset($param) && $param == 1) {

                $alldemande = $em->getRepository('MfpeAttestationBundle:Demande')->findBy(array('uniteRegionale' => $uniteRegionale), array('updatedAt' => 'DESC'));
            }
        }
        return $alldemande;
    }

    private function getDemandeByCentreFormation($currentUserRole, $user, $param)
    {
        $em = $this->getDoctrine()->getManager();
        $alldemande = array();
        $allStatus = array();
        foreach ($currentUserRole as $currentUserRole) {
            $roles = $em->getRepository('MfpeConfigBundle:Role')->findByRole($currentUserRole);
            foreach ($roles as $role) {
                array_push($allStatus, $role->getStatus());
            }
        }
        $allStatesToSee = array_merge([], ...$allStatus);
        $centreFormation = $em->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array('email' => $user->getEmail()));
        if (is_object($centreFormation)) {
            $id_centre_formation = $centreFormation->getId();
            if (!isset($param)) {
                foreach ($allStatesToSee as $status) {
                    $statusRef = $em->getRepository('MfpeReferencielBundle:RefStatut')->findOneByCode($status);
                    $demandestatus = $em->getRepository('MfpeAttestationBundle:Demande')->findBy(array('centreFormation' => $id_centre_formation, 'currentStatut' => $statusRef), array('updatedAt' => 'DESC'));
                    $alldemande = array_merge($alldemande, $demandestatus);
                }
            } elseif (isset($param) && $param == 1) {
                $alldemande = $em->getRepository('MfpeAttestationBundle:Demande')->findBy(array('centreFormation' => $id_centre_formation), array('updatedAt' => 'DESC'));
            }
        }
        return $alldemande;
    }

    private function getDemandeByCitoyen($currentUserRole, $user)
    {
        $em = $this->getDoctrine()->getManager();
        $demandes = $em->getRepository('MfpeAttestationBundle:Demande')->findBy(array('user' => $user), array('updatedAt' => 'DESC'));
        return $demandes;
    }

    /**
     * @Rest\Post(
     *     path = "/export-convocation_pdf",
     *     name = "app_demande-donwloadconvocationpdf"
     * )
     * @SWG\Post(
     *  tags={"Demande"},
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
     *              @SWG\Property(property="id", type="integer", example=5),
     *          )
     *
     *      ),
     * )
     */
    public function exportConvocationPdfAction(Request $request)
    {
        $data = json_decode($request->getContent(), true);
        $lang = $data["lang"];
        if (!$lang) {
            $lang = 'fr';
        }
        $id = $data["id"];
        if ($id) {
            $demande = $this->em()->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array('id' => $id));
        }
        if (!$demande) {
            $message = ApiProblem::DEMANDES_DOES_NOT_EXIST;
            $errors['demande'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors], Response::HTTP_BAD_REQUEST);
        }
        $now = new \DateTime();
        $year = $now->format("Y");
        $LastDemande = $this->em()->getRepository('MfpeAttestationBundle:Demande')->findLastDemandeByCentreFormationYear($year, $demande->getCentreFormation());
        if (is_null($LastDemande)) {
            $codeConvocation = $year . "-" . "0001";
        } else {
            if ($LastDemande["id"] != $id) {
                $lastCodeConvocation = explode("-", $LastDemande["codeConvocation"]);
                $last_number = (int)end($lastCodeConvocation);
                $current_number = $last_number + 1;
                $current_number = substr("0000{$current_number}", -4);
                $codeConvocation = $year . "-" . $current_number;
            } else {
                $codeConvocation = $demande->getCodeConvocation();
            }
        }
        $demande->setCodeConvocation($codeConvocation);
        $this->em()->flush();

        $dir = __DIR__ . '../../../../../web/';
        $dateExamen = $this->getDoctrine()->getRepository(DateExam::class)
            ->findOneBy(
                array('demande' => $demande),
                array('id' => 'DESC')
            );
        $filePath = $this->get("mfpe_attestation_doc")->returnConvocationPDFResponseFromHTML($dir, $lang, $demande, $dateExamen);
        $response = array(
            'code' => 0,
            'message' => 'file uploaded!',
            'errors' => null,
            'result' => $filePath
        );
        return new JsonResponse($response, Response::HTTP_CREATED);
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={""})
     * @Rest\Get(
     *     path = "/archive/",
     *     name="app_archive-demande_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Security(name="Bearer"),
     * @Rest\QueryParam(
     *     name="date_debut",
     *     nullable=true,
     *     description="date debut to search for."
     * )
     * @Rest\QueryParam(
     *     name="date_fin",
     *     nullable=true,
     *     description="date fin to search for."
     * )
     * @Rest\QueryParam(
     *     name="governorate",
     *     nullable=true,
     *     description="code gouvernorat"
     * )
     * @Rest\QueryParam(
     *     name="numIdentity",
     *     nullable=true,
     *     description="numero passport"
     * )
     * @SWG\Get(
     *  tags={"Demande"},
     *  summary="Get all archive demande ",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Demande::class, groups={"listDetailDemande"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getArchiveDemandeAction(Request $request)
    {
        $data = json_decode(json_encode($request->query->all()), true);
        if ((isset($data['date_debut'])) && (!empty($data['date_debut']))) {
            if (strtoupper($data['date_debut']) != 'NULL') {
                if (!$this->is_date($data['date_debut'])) {
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::DATE_NOT_VALID], Response::HTTP_BAD_REQUEST);

                }
            }
        }
        if ((isset($data['date_fin'])) && (!empty($data['date_fin']))) {
            if (strtoupper($data['date_fin']) != 'NULL') {
                if (!$this->is_date($data['date_fin'])) {
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::DATE_NOT_VALID], Response::HTTP_BAD_REQUEST);
                }
            }
        }
        $em = $this->getDoctrine()->getManager();
        $demandes = $em->getRepository('MfpeAttestationBundle:Demande')->getDemandesWithFiltre($data);
        $demandes = $this->get('jms_serializer')->serialize($demandes, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('listDetailDemande', 'AppUserGroup', 'detailSpecialite')));
        $demandes = json_decode($demandes, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $demandes], Response::HTTP_OK);
    }

    private function is_date($date)
    {
        if (date_create($date) === false) {
            return false;
        } else
            return true;
    }

    private function sendNotificationSystem($type, $user, $userReceiver, $demande)
    {
        try {
            $notification = New Notification();
            $notification->setType($type);
            $notification->setStatusNotif(false);
            $notification->setDemande($demande);
            $notification->setUserSend($user);
            $notification->setUserReceive($userReceiver);
            //$notification->getCreatedBy($user->getId());
            $now = new \DateTime();
            $notification->setDateCreation($now);
            $em = $this->getDoctrine()->getManager();
            $em->persist($notification);
            $em->flush();
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @Rest\View(serializerGroups={"detailDemande"})
     * @Rest\Put(
     *     path = "transfert/{id}",
     *     name = "app_demande_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"Demande"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"Demande"},
     *  summary="transfert demande",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="Demande",
     *     in="path",
     *     description="Demande id",
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
     *                  property="direction_regionale",
     *                  title="Direction regionale",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *          )
     *
     *      ),
     * )
     * @SWG\Response(response="200", description="Returned when Resource modified",
     * @SWG\Schema(type="array", @Model(type=Demande::class, groups={"detailDemande"}))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function updateDemandeAction(?Demande $demande, Request $request)
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
        if (empty($demande)) {
            $message = ApiProblem::DEMANDE_NOT_EXIST;
            $errors['demande'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $error_global, 'data' => $errors], Response::HTTP_BAD_REQUEST);
        }
        $em = $this->getDoctrine()->getManager();
        $data = json_decode($request->getContent(), true);
        $validator = New validateCreateDemande($em);
        $errors = $validator->validateTransfertDemande($data,$demande);
        if ($errors) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }

        $dr=$demande->getUniteRegionale();
        $direction_regionale = $em->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array('id' => $data["direction_regionale"]["id"]));
        $demande->setUniteRegionale($direction_regionale);
        $em->flush();
       $this->get('mfpe_user_demandes_service')->sendEmailTransfertDemandeFromDrToDr($demande,$dr);

        $demande = $this->get('jms_serializer')->serialize($demande, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailDemande')));
        $demande = json_decode($demande, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $demande], Response::HTTP_OK);
    }
}
