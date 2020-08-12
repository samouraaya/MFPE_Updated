<?php

namespace Mfpe\CentreFormationBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use FOS\RestBundle\Request\ParamFetcher;
use Mfpe\AttestationBundle\Validator\validateUniteRegional;
use Mfpe\CentreFormationBundle\Entity\Specialite;
use Mfpe\CentreFormationBundle\Validator\ValidateCreateSpecialite;
use Mfpe\ConfigBundle\Entity\AppUser;
use Mfpe\ReferencielBundle\Entity\Referenciel;
use Mfpe\AttestationBundle\Entity\DateExam;
use Mfpe\AttestationBundle\Entity\PvExam;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\ConfigBundle\Exception\ApiProblemException;
use Mfpe\ConfigBundle\Exception\ValidationException;
use Mfpe\ConfigBundle\Services\EntityMerger;
use Mfpe\ConfigBundle\Services\PermissionService;
use Mfpe\UniteRegionaleBundle\Entity\UniteRegionale;
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


use Mfpe\AttestationBundle\Entity\Demande;


/**
 * Description of DemandeController
 *
 * @author Wiem Hadiji
 */
class SpecialteController extends BaseController
{
    use ControllerTrait;

    /**
     * @Rest\Post(
     *     path = "",
     *     name = "app_specialite_Add"
     * )
     * @SWG\Post(
     *  tags={"Specialité"},
     *  summary="Create specialite de centre formation",
     *  description ="<span style='color: red;'>Specialité has a field 'type' who take two value :
    &nbsp;&nbsp; true: Specialité for module 2
    &nbsp;&nbsp; false: Specialité for module de formation
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
     *                  property="secteur_activite",
     *                  title="secteur d'activite",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="13"),
     *              ),
     *              @SWG\Property(
     *                  property="sousSecteur",
     *                  title="sous secteur d'activite",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="5"),
     *              ),
     *              @SWG\Property(property="intitule_ar", type="string", example="تربية النحل"),
     *              @SWG\Property(property="type", type="string", example="true"),
     *              @SWG\Property(property="intitule_fr", type="string", example="Apiculture"),
     *              @SWG\Property(property="code_specialite", type="string", example="BOUl-44"),
     *              @SWG\Property(property="frais_specialite_exam", type="string", example="140"),
     *              @SWG\Property(
     *                  property="niveau_diplome",
     *                  title="niveau du diplome",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="63"),
     *              ),
     *              @SWG\Property(
     *                  property="niveau_etude",
     *                  title="Niveau d'etude",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="66"),
     *              ),
     *          )
     *
     *      ),
     * )
     */
    public function PostAction(Request $request)
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
            $validator = New ValidateCreateSpecialite($em);
            $errors = $validator->validateCreateSpecialite($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $specialite = new Specialite();
            $em = $this->getDoctrine()->getManager();
            $secteur = $em->getRepository('MfpeReferencielBundle:RefSecteur')->find($data["secteur_activite"]["id"]);
            $specialite->setSecteur($secteur);
            $sousSecteur = $em->getRepository('MfpeReferencielBundle:RefSousSecteur')->find($data["sousSecteur"]["id"]);
            $specialite->setSousSecteur($sousSecteur);
            $specialite->setIntituleAr($data["intitule_ar"]);
            $specialite->setIntituleFr($data["intitule_fr"]);

            if (!empty($data["type"])) {
                $testFormation = $data["type"] === 'true' ? true : false;
                $specialite->setType($testFormation);
            }
            $specialite->setCodeSpecialite($data["code_specialite"]);
            $specialite->setFraisSpecialiteExam($data["frais_specialite_exam"]);
            $niveauDiplome = $em->getRepository('MfpeReferencielBundle:RefNiveauDiplome')->find($data["niveau_diplome"]["id"]);
            $specialite->setNiveauDiplome($niveauDiplome);
            $niveauEtude = $em->getRepository('MfpeReferencielBundle:RefNiveauEtude')->find($data["niveau_etude"]["id"]);
            $specialite->setNatureFormation($niveauEtude);
            $specialite->setEnable(true);
            $em->persist($specialite);
            $em->flush();
            $specialite = $this->get('jms_serializer')->serialize($specialite, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailSpecialite')));
            $specialite = json_decode($specialite, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $specialite], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailSpecialite"})
     * @Rest\Get(
     *     path = "/",
     *     name="app_specialite_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="enable",
     *     nullable=true,
     *     description="enable=true return all specialite"
     * )
     * * @Rest\QueryParam(
     *     name="type",
     *     description="true/false"
     * )
     * @SWG\Get(
     *  tags={"Specialité"},
     *  summary="Get  all Specialité",
     *  description ="<span style='color: red;'>Specialité has a field 'type' who take two value :
    &nbsp;&nbsp; true: Specialité for  module 2
    &nbsp;&nbsp; false : Specialité for module de formation
    </span>" ,
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=Specialite::class, groups={"detailSpecialite"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getSpecialiteAction(Request $request)
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
        if (isset($data['enable']) && !empty($data['enable']) && !empty($data['type'])) {
            $type = $data["type"] === 'true' ? true : false;
            $specialites = $this->getDoctrine()->getRepository('MfpeCentreFormationBundle:Specialite')->findBy(array('type'=>$type), array('updatedAt' => 'DESC'));

        }
        elseif (isset($data['type']) && !empty($data['type']) && empty($data['enable'])) {
            $type = $data["type"] === 'true' ? true : false;
            $specialites = $this->getDoctrine()->getRepository('MfpeCentreFormationBundle:Specialite')->findBy(array('type'=>$type,'enable' => true), array('updatedAt' => 'DESC'));
        }
        elseif (isset($data['enable']) && !empty($data['enable']) && empty($data['type'])) {
            $specialites = $this->getDoctrine()->getRepository('MfpeCentreFormationBundle:Specialite')->findBy(array(), array('updatedAt' => 'DESC'));
        }
        else {
            $specialites = $this->getDoctrine()->getRepository('MfpeCentreFormationBundle:Specialite')->findBy(array('enable' => true), array('updatedAt' => 'DESC'));
        }
        
        $specialites = $this->get('jms_serializer')->serialize($specialites, 'json', SerializationContext::create()->setGroups(array('detailSpecialite')));
        $specialites = json_decode($specialites, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $specialites], Response::HTTP_OK);

    }


    /**
     * @Rest\View(serializerGroups={"detailSpecialite"})
     * @Rest\Put(
     *     path = "/{id}",
     *     name = "app_specialite_Edit",
     *     options={ "method_prefix" = false },
     *     requirements = {"specialite"="\d+"}
     * )
     * @SWG\Put(
     *  tags={"Specialité"},
     *  summary="edit Specialité",
     *  description ="<span style='color: red;'>Specialité has a field 'type' who take two value :
    &nbsp;&nbsp; true: Specialité for module 2
    &nbsp;&nbsp; false : Specialité for module de formation
    </span>",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="specialité",
     *     in="path",
     *     description="specialité id",
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
     *                  property="secteur_activite",
     *                  title="secteur d'activite",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="13"),
     *              ),
     *              @SWG\Property(
     *                  property="sousSecteur",
     *                  title="sous secteur d'activite",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="5"),
     *              ),
     *              @SWG\Property(property="intitule_ar", type="string", example="تربية النحل"),
     *              @SWG\Property(property="intitule_fr", type="string", example="Apiculture"),
     *              @SWG\Property(property="code_specialite", type="string", example="BOUl-44"),
     *              @SWG\Property(property="enable", type="string", example="true"),
     *              @SWG\Property(property="frais_specialite_exam", type="string", example="140"),
     *              @SWG\Property(
     *                  property="niveau_diplome",
     *                  title="niveau du diplome",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="63"),
     *              ),
     *              @SWG\Property(
     *                  property="niveau_etude",
     *                  title="Niveau d'etude",
     *                  type="object",
     *                  @SWG\Property(property="id", type="string", example="66"),
     *              ),
     *          )
     *
     *      ),
     * @SWG\Response(response="200", description="Returned when Resource modified",@SWG\Schema(type="array", @Model(type=UniteRegionale::class, groups={"uniteRegional"}))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     *
     */
    public function updateAction(?Specialite $specialite, Request $request)
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
            $error_global = ApiProblem::MESSAGE_GLOBAL;
            $em = $this->getDoctrine()->getManager();
            $validator = New ValidateCreateSpecialite($em);
            $errors = $validator->validateCreateSpecialite($data);
            if ($errors) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                // return $this->createApiResponse($errors, 400);
            } else {
                $em = $this->getDoctrine()->getManager();
                if (isset($data["secteur_activite"]["id"])) {
                    $secteur = $em->getRepository('MfpeReferencielBundle:RefSecteur')->find($data["secteur_activite"]["id"]);
                    $specialite->setSecteur($secteur);
                }
                if (isset($data["sousSecteur"]["id"])) {
                    $sousSecteur = $em->getRepository('MfpeReferencielBundle:RefSousSecteur')->find($data["sousSecteur"]["id"]);
                    $specialite->setSousSecteur($sousSecteur);
                }
                if (isset($data["intitule_ar"]))
                    $specialite->setIntituleAr($data["intitule_ar"]);
                if (isset($data["intitule_fr"]))
                    $specialite->setIntituleFr($data["intitule_fr"]);
                if (isset($data["code_specialite"]))
                    $specialite->setCodeSpecialite($data["code_specialite"]);
                if (isset($data["frais_specialite_exam"]))
                    $specialite->setFraisSpecialiteExam($data["frais_specialite_exam"]);
                if (isset($data["niveau_diplome"]["id"])) {
                    $niveauDiplome = $em->getRepository('MfpeReferencielBundle:RefNiveauDiplome')->find($data["niveau_diplome"]["id"]);
                    $specialite->setNiveauDiplome($niveauDiplome);
                }
                if (isset($data["niveau_etude"]["id"])) {
                    $niveauEtude = $em->getRepository('MfpeReferencielBundle:RefNiveauEtude')->find($data["niveau_etude"]["id"]);
                    $specialite->setNatureFormation($niveauEtude);
                }
                if (isset($data["enable"])) {
                    //  dd($paramFetcher->get('enable'));
                    $testEnable = $data["enable"] === 'true' ? true : false;
                    $specialite->setEnable($testEnable);
                }
//                if (!empty($data["type"])) {
//                    $testFormation = $data["type"] === 'true' ? true : false;
//                    $specialite->setType($testFormation);
//                }
                $em->flush();
                $specialite = $this->get('jms_serializer')->serialize($specialite, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailSpecialite')));
                $specialite = json_decode($specialite, JSON_UNESCAPED_UNICODE);
                return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $specialite], Response::HTTP_OK);
            }
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }


    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailSpecialite"})
     * @Rest\Delete(
     *     path = "/{id}",
     *     name="app_specialite_Delete",
     *     options={ "method_prefix" = false },
     *     requirements = {"id"="\d+"}
     * )
     * @SWG\Delete(
     *  tags={"Specialité"},
     *  summary="delete specialité",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Specialite id",
     *     required=true,
     *     type="integer"
     * ),
     * @SWG\Response(response="200", description="Returned when Resource deleted",@SWG\Schema(type="array", @Model(type=Specialite::class))),
     * @SWG\Response(response="400", description="Returned when invalid data posted"),
     * @SWG\Response(response="401", description="Returned when not authenticated"),
     * @SWG\Response(response="403", description="Returned when token not valid or expired"),
     * )
     */
    public function deleteSpecialiteAction($id)
    {
        try {
            $specialite = $this->em()->getRepository('MfpeCentreFormationBundle:Specialite')->find($id);
            // dd($specialite);
            //Check if the user exist. Return 404 if not.
            if ($specialite === null) {
                $message = ApiProblem::SPECIALITE_NOT_EXIST;
                $errors['specialite'] = $message;
                $errors = json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_NOT_FOUND, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            //Remove the role from the database
            $this->em()->remove($specialite);
            //dd($this->em()->remove($specialite));
            $this->em()->flush();

            //return 200 success response with all the users
            $specialites = $this->em()->getRepository('MfpeCentreFormationBundle:Specialite')->findAll();

            $specialites = $this->get('jms_serializer')->serialize($specialites, 'json', SerializationContext::create()->setSerializeNull(true)->setGroups(array('detailSpecialite')));
            $specialites = json_decode($specialites, JSON_UNESCAPED_UNICODE);
            return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $specialites], Response::HTTP_OK);
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_UNPROCESSABLE_ENTITY, 'data' => ApiProblem::MESSAGE_EXCEPTION, 'message' => ApiProblem::MESSAGE_EXCEPTION], Response::HTTP_UNPROCESSABLE_ENTITY);

        }

    }

}