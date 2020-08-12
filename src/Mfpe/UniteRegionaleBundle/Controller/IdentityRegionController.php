<?php


namespace Mfpe\UniteRegionaleBundle\Controller;


use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use Mfpe\AttestationBundle\Entity\Demande;
use Mfpe\CentreFormationBundle\Validator\ValidateCreateCentreFormation;
use Mfpe\UniteRegionaleBundle\Entity\Description;
use Mfpe\UniteRegionaleBundle\Validator\ValidateIdentiteRegion;
use Mfpe\ConfigBundle\Entity\AppUser;
use Mfpe\AttestationBundle\Entity\PvExam;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\UniteRegionaleBundle\Entity\CadresRegionaux;
use Mfpe\UniteRegionaleBundle\Entity\IdentiteRegion;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializationContext;
use Mfpe\ConfigBundle\Controller\BaseController;

class IdentityRegionController extends BaseController
{
    use ControllerTrait;

    /**
     * @Rest\Post(
     *     path = "/",
     *     name = "app_identiteRegion_Add"
     * )
     * @SWG\Post(
     *  tags={"IdentiteRegion"},
     *  summary="Identite Region",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="201", description="Returned when Resource created"),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     * @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="JSON Payload",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="gouvernorat",
     *                  title="gouvernorat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *              @SWG\Property(property="nbr_localite", type="integer", example=6),
     *              @SWG\Property(property="nbr_municipalities", type="integer", example=8),
     *              @SWG\Property(property="nbr_private_training_centers", type="integer", example=10),
     *              @SWG\Property(property="nbr_public_training_centers", type="integer", example=05),
     *              @SWG\Property(property="nbr_employment_offices", type="integer", example=8),
     *              @SWG\Property(property="nbr_spaces_undertake", type="integer", example=7),
     *              @SWG\Property(property="description_region", type="string", example="Le gouvernorat de Tunis, créé le 21 juin 1956, est l'un des 24 gouvernorats de la Tunisie. Il est situé dans le Nord du pays" ),
     *              @SWG\Property(property="nbr_regional_continuing_education_units", type="integer", example=05),
     *              @SWG\Property(
     *                  property="caracteristiques_region",
     *                  type="array",
     *                  @SWG\Items(
     *                      type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *                  @SWG\Property(property="description", type="string", example="Aéroport"),
     *              ),
     *              ),
     *              @SWG\Property(
     *                  property="cadres_region",
     *                  type="array",
     *                  @SWG\Items(
     *                  type="object",
     *                  @SWG\Property(property="nom", type="string", example="sadok"),
     *                  @SWG\Property(property="prenom", type="string", example="atallah"),
     *                  @SWG\Property(property="contact", type="string", example="atallah"),
     *                  @SWG\Property(
     *                  property="fonction_cadre",
     *                  title="fonction Cadre",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *              @SWG\Property(property="adresse", type="string", example="jardin de carthage"),
     *              ),
     *              ),
     *
     *          )
     *      ),
     * )
     */

    public function postAction(Request $request)
    {
        try {
            $data = json_decode($request->getContent(), true);
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

            $em = $this->getDoctrine()->getManager();
            $validator = New ValidateIdentiteRegion($em);
            $errors = $validator->validateIdentiteRegion($data);
            if ($errors) {

                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $identiteRegion = new IdentiteRegion();
            if (isset($data["gouvernorat"]["id"])) {

                $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["gouvernorat"]["id"]);
                $identity = $this->em()->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findByGouvernorate($gouvernorat);
                if ($identity) {
                    $message = ApiProblem::IDENTITY_REGIONAL;
                    $errors['gouvernorat'] = $message;
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                }
                if ($gouvernorat) {
                    $identiteRegion->setGouvernorate($gouvernorat);
                }

            }


            if (isset($data["nbr_localite"])) {
                $nbrLocalite = trim(intval($data["nbr_localite"]));
                $identiteRegion->setNbrLocalities($nbrLocalite);
            }
            if (isset($data["nbr_municipalities"])) {
                $nbrMunicipalities = trim(intval($data["nbr_municipalities"]));
                $identiteRegion->setNbrMunicipalities($nbrMunicipalities);
            }
            if (isset($data["nbr_private_training_centers"])) {
                $nbrPrivateTrainingCenters = trim(intval($data["nbr_private_training_centers"]));
                $identiteRegion->setNbrPrivateTrainingCenters($nbrPrivateTrainingCenters);
            }
            if (isset($data["nbr_public_training_centers"])) {
                $nbrPublicTrainingCenters = trim(intval($data["nbr_public_training_centers"]));
                $identiteRegion->setNbrPublicTrainingCenters($nbrPublicTrainingCenters);
            }
            if (isset($data["nbr_employment_offices"])) {
                $nbrEmploymentOffices = trim(intval($data["nbr_employment_offices"]));
                $identiteRegion->setNbrEmploymentOffices($nbrEmploymentOffices);
            }
            if (isset($data["nbr_spaces_undertake"])) {
                $nbrSpacesUndertake = trim(intval($data["nbr_spaces_undertake"]));
                $identiteRegion->setNbrSpacesUndertake($nbrSpacesUndertake);
            }
            if (isset($data["nbr_regional_continuing_education_units"])) {
                $nbrRegionalContinuing = trim(intval($data["nbr_regional_continuing_education_units"]));
                $identiteRegion->setNbrRegionalContinuingEducationUnits($nbrRegionalContinuing);
            }
            if (isset($data["description_region"])) {
                $descriptionRegion = trim(($data["description_region"]));
                $identiteRegion->setDescriptionRegion($descriptionRegion);
            }

            $em->persist($identiteRegion);
            $em->flush();
            if (isset($data["cadres_region"])) {
                foreach ($data["cadres_region"] as $cardre) {
                    $cadresRegionaux = new CadresRegionaux();
                    if (isset($cardre["nom"])) {
                        $cadresRegionaux->setNomFr($cardre["nom"]);
                        $cadresRegionaux->setNomAr($cardre["nom"]);
                    }
                    if (isset($cardre["prenom"])) {
                        $cadresRegionaux->setPrenomFr($cardre["prenom"]);
                        $cadresRegionaux->setPrenomAr($cardre["prenom"]);
                    }

                    if (isset($cardre["contact"])) {
                        $cadresRegionaux->setContact($cardre["contact"]);
                    }
                    if (isset($cardre["adresse"])) {
                        $cadresRegionaux->setAdresse($cardre["adresse"]);
                    }
                    $cadresRegionaux->setIdentiteRegionId($identiteRegion);
                    if (isset($cardre["fonction_cadre"]["id"])) {
                        $fonctionCadre = $this->em()->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->find($cardre["fonction_cadre"]["id"]);
                        $cadresRegionaux->setFonctionCadre($fonctionCadre);
                    }
                    $em->persist($cadresRegionaux);
                }

            }
            if (isset($data["caracteristiques_region"])) {
                foreach ($data["caracteristiques_region"] as $caracteristique) {

                    $description = new Description();
                    $description->setIdentiteRegion($identiteRegion);
                    if (isset($caracteristique["description"])) {
                        $description->setDescription($caracteristique['description']);
                    }
                    $caracteristiqueRegion = $this->em()->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->find($caracteristique['id']);
                    if (is_object($caracteristiqueRegion)) {
                        $description->setCaracteristiqueRegion($caracteristiqueRegion);
                        $em->persist($description);
                        $em->flush();
                    }
                    else
                    {
                        $message = ApiProblem::CARACTERESTIQUE_DOES_NOT_EXIST;
                        $errors['caracteristiqueRegion'] = $message;
                        return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                    }
                }
            }

            $identiteRegion = $this->get('jms_serializer')->serialize($identiteRegion, 'json', SerializationContext::create()->setGroups(array("ReferencielGroup", "regionGroup", "cadreGroup", "descriptionGroup")));
            $identiteRegion = json_decode($identiteRegion, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => 'success', 'code' => Response::HTTP_OK, 'data' => $identiteRegion], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'message' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * @Rest\View(serializerGroups={"IdentiteRegion"})
     * @Rest\Put(
     *     path = "/{id}",
     *     name = "app_identiteRegion_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"uniteRegional"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"IdentiteRegion"},
     *  summary="edit Identite Region",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="IdentiteRegion",
     *     in="path",
     *     description="IdentiteRegion id",
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
     *                  property="gouvernorat",
     *                  title="gouvernorat",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *              @SWG\Property(property="nbr_localite", type="integer", example=6),
     *              @SWG\Property(property="nbr_municipalities", type="integer", example=8),
     *              @SWG\Property(property="nbr_private_training_centers", type="integer", example=10),
     *              @SWG\Property(property="nbr_public_training_centers", type="integer", example=05),
     *              @SWG\Property(property="nbr_employment_offices", type="integer", example=8),
     *              @SWG\Property(property="nbr_spaces_undertake", type="integer", example=7),
     *              @SWG\Property(property="nbr_regional_continuing_education_units", type="integer", example=05),
     *              @SWG\Property(property="description_region", type="string", example="Le gouvernorat de Tunis, créé le 21 juin 1956, est l'un des 24 gouvernorats de la Tunisie. Il est situé dans le Nord du pays" ),
     *              @SWG\Property(
     *                  property="caracteristiques_region",
     *                  type="array",
     *                  @SWG\Items(
     *                      type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *                  @SWG\Property(property="description", type="string", example="Aéroport"),
     *              ),
     *              ),
     *              @SWG\Property(
     *                  property="cadres_region",
     *                  type="array",
     *                  @SWG\Items(
     *                  type="object",
     *                  @SWG\Property(property="nom", type="string", example="sadok"),
     *                  @SWG\Property(property="prenom", type="string", example="atallah"),
     *                  @SWG\Property(property="contact", type="string", example="atallah"),
     *                  @SWG\Property(
     *                  property="fonction_cadre",
     *                  title="fonction Cadre",
     *                  type="object",
     *                  @SWG\Property(property="id", type="integer", example=52),
     *              ),
     *              @SWG\Property(property="adresse", type="string", example="jardin de carthage"),
     *              ),
     *              ),
     *
     *          )
     *      ),
     * )
     * @SWG\Response(response="200", description="Returned when Resource modified",@SWG\Schema(type="array", @Model(type=IdentiteRegion::class, groups={"detailRegion"}))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function updateAction(?IdentiteRegion $identiteRegion, Request $request)
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
        if (empty($identiteRegion)) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['identiteRegion'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'message' => $error_global, 'data' => $errors], Response::HTTP_BAD_REQUEST);
        }
        $em = $this->getDoctrine()->getManager();
        $validator = New ValidateIdentiteRegion($em);
        $errors = $validator->validateIdentiteRegion($data);
        if ($errors) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }

        if (isset($data["gouvernorat"]["id"])) {
            $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->find($data["gouvernorat"]["id"]);
            $identiteRegion->setGouvernorate($gouvernorat);
        }
        if (isset($data["nbr_localite"])) {
            $nbrLocalite = trim(intval($data["nbr_localite"]));
            $identiteRegion->setNbrLocalities($nbrLocalite);
        }
        if (isset($data["nbr_municipalities"])) {
            $nbrMunicipalities = trim(intval($data["nbr_municipalities"]));
            $identiteRegion->setNbrMunicipalities($nbrMunicipalities);
        }
        if (isset($data["nbr_private_training_centers"])) {
            $nbrPrivateTrainingCenters = trim(intval($data["nbr_private_training_centers"]));
            $identiteRegion->setNbrPrivateTrainingCenters($nbrPrivateTrainingCenters);
        }
        if (isset($data["nbr_public_training_centers"])) {
            $nbrPublicTrainingCenters = trim(intval($data["nbr_public_training_centers"]));
            $identiteRegion->setNbrPublicTrainingCenters($nbrPublicTrainingCenters);
        }
        if (isset($data["nbr_employment_offices"])) {
            $nbrEmploymentOffices = trim(intval($data["nbr_employment_offices"]));
            $identiteRegion->setNbrEmploymentOffices($nbrEmploymentOffices);
        }
        if (isset($data["nbr_spaces_undertake"])) {
            $nbrSpacesUndertake = trim(intval($data["nbr_spaces_undertake"]));
            $identiteRegion->setNbrSpacesUndertake($nbrSpacesUndertake);
        }
        if (isset($data["nbr_regional_continuing_education_units"])) {
            $nbrRegionalContinuing = trim(intval($data["nbr_regional_continuing_education_units"]));
            $identiteRegion->setNbrRegionalContinuingEducationUnits($nbrRegionalContinuing);
        }
        if (isset($data["description_region"])) {
            $descriptionRegion = trim(($data["description_region"]));
            $identiteRegion->setDescriptionRegion($descriptionRegion);
        }
        $em->persist($identiteRegion);
        $em->flush();
        $cadresRegionaux = $this->em()->getRepository('MfpeUniteRegionaleBundle:CadresRegionaux')->findByIdentiteRegionId($identiteRegion);
        //remove les cadresRegionaux
        foreach ($cadresRegionaux as $cadres) {
            $em->remove($cadres);
            $em->flush();
        }
        //ajout  des cadresRegionaux
        if (isset($data["cadres_region"])) {
            foreach ($data["cadres_region"] as $cardre) {
                $cadresRegionaux = new CadresRegionaux();
                if (isset($cardre["nom"])) {
                    $cadresRegionaux->setNomFr($cardre["nom"]);
                    $cadresRegionaux->setNomAr($cardre["nom"]);
                }
                if (isset($cardre["prenom"])) {
                    $cadresRegionaux->setPrenomFr($cardre["prenom"]);
                    $cadresRegionaux->setPrenomAr($cardre["prenom"]);
                }
                if (isset($cardre["contact"])) {
                    $cadresRegionaux->setContact($cardre["contact"]);
                }
                if (isset($cardre["adresse"])) {
                    $cadresRegionaux->setAdresse($cardre["adresse"]);
                }
                $cadresRegionaux->setIdentiteRegionId($identiteRegion);
                if (isset($cardre["fonction_cadre"]["id"])) {
                    $fonctionCadre = $this->em()->getRepository('MfpeReferencielBundle:RefFonctionCadreRegion')->find($cardre["fonction_cadre"]["id"]);
                    $cadresRegionaux->setFonctionCadre($fonctionCadre);
                }
                $em->persist($cadresRegionaux);
            }

        }


        $descriptions = $this->getDoctrine()->getRepository('MfpeUniteRegionaleBundle:Description')->findAllDescription($identiteRegion);
        foreach ($descriptions as $description) {
            $em->remove($description);
            $em->flush();
        }
        if (isset($data["caracteristiques_region"])) {
            foreach ($data["caracteristiques_region"] as $caracteristique) {

                $description = new Description();
                $description->setIdentiteRegion($identiteRegion);
                if (isset($caracteristique["description"])) {
                    $description->setDescription($caracteristique['description']);
                }
                $caracteristiqueRegion = $this->em()->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->find($caracteristique['id']);
                if (is_object($caracteristiqueRegion)) {
                    $description->setCaracteristiqueRegion($caracteristiqueRegion);
                }

                $em->persist($description);
            }
        }
        $em->flush();
        $identiteRegion = $this->get('jms_serializer')->serialize($identiteRegion, 'json', SerializationContext::create()->setGroups(array("ReferencielGroup", "regionGroup", "cadreGroup", "descriptionGroup")));
        $identiteRegion = json_decode($identiteRegion, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => 'success', 'code' => Response::HTTP_OK, 'data' => $identiteRegion], Response::HTTP_OK);

    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"regionGroup"})
     * @Rest\Get(
     *     path = "/",
     *     name="app_IdentityRegion_Get",
     *     options={ "method_prefix" = false },
     * )
     * @SWG\Get(
     *  tags={"IdentiteRegion"},
     *  summary="Get  all identite region",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=IdentiteRegion::class, groups={"regionGroup","descriptionGroup","ReferencielGroup","cadreGroup"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getAllRegionAction()
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
            $identiteRegions = $this->getDoctrine()->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findAll();
            $identiteRegions = $this->get('jms_serializer')->serialize($identiteRegions, 'json', SerializationContext::create()->setGroups(array("regionGroup", "descriptionGroup", "ReferencielGroup", "cadreGroup")));
            $identiteRegions = json_decode($identiteRegions, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $identiteRegions], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


}