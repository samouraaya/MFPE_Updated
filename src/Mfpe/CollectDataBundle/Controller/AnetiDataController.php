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

use Mfpe\CollectDataBundle\Entity\AnetiTable1;
use Mfpe\CollectDataBundle\Entity\AnetiTable2;
use Mfpe\CollectDataBundle\Validator\ValidateEmploi;


/**
 * Description of ProjectDataController
 *
 * @author wiem hadiji
 */
class AnetiDataController extends BaseController
{
    use ControllerTrait;


    /**
     * @Rest\Post(
     *     path = "/file1 ",
     *     name = "app_AnetiFile1_Add"
     * )
     * @SWG\Post(
     *  tags={"Aneti"},
     *  summary="Create Aneti data",
     *  description ="Create Aneti data",
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
     *          )
     *      ),
     * )
     */
    public function postFile1Action(Request $request)
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

                $response = $this->parsingFile1Txt();
                //Response
                if ($response === true) {
                    return new JsonResponse(['status' => Response::HTTP_OK, 'code' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);
                } elseif (is_array($response)) {
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $response, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                } else {
                    return new JsonResponse(['status' => Response::HTTP_BAD_REQUEST, 'code' => Response::HTTP_BAD_REQUEST, 'data' => $response->getMessage(), 'message' => $response->getMessage()], Response::HTTP_BAD_REQUEST);
                }


        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }
    /**
     * @Rest\Post(
     *     path = "/file2 ",
     *     name = "app_AnetiFile2_Add"
     * )
     * @SWG\Post(
     *  tags={"Aneti"},
     *  summary="Create Aneti data",
     *  description ="Create Aneti data",
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
     *          )
     *      ),
     * )
     */
    public function postFile2Action(Request $request)
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

            $response = $this->parsingFile2Txt();

            //Response
            if ($response === true) {
                return new JsonResponse(['status' => Response::HTTP_OK, 'code' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);
            } elseif (is_array($response)) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $response, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            } else {
                return new JsonResponse(['status' => Response::HTTP_BAD_REQUEST, 'code' => Response::HTTP_BAD_REQUEST, 'data' => $response->getMessage(), 'message' => $response->getMessage()], Response::HTTP_BAD_REQUEST);
            }


        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    private function parsingFile1Txt()
    {
       try {
            $errors = array();
            $fileName = "aneti" . '.' . 'txt';
            $fileNom = "perr_1.txt";
            $fileAnetiFtp = $this->container->getParameter('ftp_path_aneti') . $fileNom;
            $txtFile = $this->container->getParameter('txt_aneti_directory') . $fileName;
            $var = copy($fileAnetiFtp, $txtFile);
            if (file_exists($txtFile)) {
                if (false !== $handle = @fopen($txtFile, 'r')) {
                    while (($word = fgets($handle)) !== false) {
                        $value = explode("|", $word);

                       if(count($value)==13){
                           $aneti = new AnetiTable1();
                           $aneti->setAnnee($value[0]);
                           $aneti->setMois($value[1]);
                           $date='01'.'-'.$value[1].'-'.$value[0];
                           $dateAneti = new \DateTime($date);
                           $aneti->setDateAneti($dateAneti);
                           $aneti->setIdGouvernorat($value[2]);
                           $aneti->setLibGouvernorat($value[3]);
                           $libgouvernorat = $value[3];
                           $em = $this->getDoctrine()->getManager();
                           $gouvernorat = $em->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(['intituleFr' => $libgouvernorat]);
                           $aneti->setGouvernorat($gouvernorat);
                           $aneti->setIdDelegation($value[4]);
                           $libDelegation = $value[5];
                           $delegation = $em->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(['intituleFr' => $libDelegation]);
                           $aneti->setDelegation($delegation);
                           $aneti->setLibDelegation($libDelegation);
                           $aneti->setBureau($value[6]);
                           $aneti->setLibBureau($value[7]);
                           $aneti->setGenre($value[8]);
                           $aneti->setDipSup($value[9]);
                           $aneti->setIndicateur($value[10]);
                           $aneti->setNombre($value[11]);
                           $em->persist($aneti);

                       }

                    }

                    $em->flush();
                }
                fclose($handle);
                unlink($txtFile);
                return true;
            }
        } catch (\Throwable $e) {
            return $e;
            //echo "Captured Throwable: " . $e->getMessage() . 'status:' . $e->getCode();
            //return new JsonResponse(['status' => "error", 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }
    public function parsingFile2Txt()
    {
        try {
            $errors = array();
            $fileName = "aneti2" . '.' . 'txt';
            $fileNom = "perr_2.txt";
            $fileAnetiFtp = $this->container->getParameter('ftp_path_aneti') . $fileNom;
            $txtFile = $this->container->getParameter('txt_aneti_directory') . $fileName;
            $var = copy($fileAnetiFtp, $txtFile);
            if (file_exists($txtFile)) {
                if (false !== $handle = @fopen($txtFile, 'r')) {
                    while (($word = fgets($handle)) !== false) {
                        $value = explode("|", $word);
                        if(count($value)==14){
                            $aneti = new AnetiTable2();
                            $aneti->setAnnee($value[0]);
                            $aneti->setMois($value[1]);
                            $date='01'.'-'.$value[1].'-'.$value[0];
                            $dateAneti = new \DateTime($date);
                            $aneti->setDateAneti($dateAneti);
                            $aneti->setIdGouvernorat($value[2]);
                            $aneti->setLibGouvernorat($value[3]);
                            $libgouvernorat = $value[3];
                            $em = $this->getDoctrine()->getManager();
                            $gouvernorat = $em->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(['intituleFr' => $libgouvernorat]);
                            $aneti->setGouvernorat($gouvernorat);
                            $aneti->setIdDelegation($value[4]);
                            $libDelegation = $value[5];
                            $delegation = $em->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(['intituleFr' => $libDelegation]);
                            $aneti->setDelegation($delegation);
                            $aneti->setLibDelegation($libDelegation);
                            $aneti->setBureau($value[6]);
                            $aneti->setLibBureau($value[7]);
                            $aneti->setIdSector($value[8]);
                            $aneti->setLibSector($value[9]);
                            $libSecteur=$value[9];
                            $secteur = $em->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(['intituleFr' => $libSecteur]);
                            $aneti->setSector($secteur);
                            $aneti->setTaille($value[10]);
                            $aneti->setLibTaille($value[11]);
                            $aneti->setNombre($value[12]);
                            $em->persist($aneti);

                        }

                    }
                    $em->flush();
                }
                fclose($handle);
                unlink($txtFile);
                return true;
            }
        } catch (\Throwable $e) {
            return $e;
            //echo "Captured Throwable: " . $e->getMessage() . 'status:' . $e->getCode();
            //return new JsonResponse(['status' => "error", 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }



}