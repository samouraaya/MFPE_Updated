<?php

namespace Mfpe\CollectDataBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use Mfpe\CollectDataBundle\Entity\ProjectDataCsv;
use Mfpe\DataSocioEconomicBundle\Entity\CsvBTSData;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Mfpe\DataSocioEconomicBundle\Validator\ValidateSocioEconomicData;
use Swagger\Annotations as SWG;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\Serializer\SerializationContext;

use Mfpe\ConfigBundle\Controller\BaseController;

/**
 * Description of UploadCsvController
 *
 * @author Wiem Hadiji
 */
class UploadCsvController extends BaseController
{

    use ControllerTrait;

    /**
     * @Rest\Post(
     *     path = "/project_data",
     *     name = "app_csv-project-data_Add"
     * )
     * @SWG\Post(
     *  tags={"Project Data"},
     *  summary="Upload File CSV ou XLS ou XLSX  Socio Economic Data",
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
     *              @SWG\Property(property="document", type="string", example="File CSV ou XLS ou XLSX"),
     *              @SWG\Property(property="date", type="date", example="01-05-2015"),
     *          )
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
            $file = $request->files->get("document");

            if (empty($file)) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::FIELD_REQUIRED_IS_EMPTY, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            } elseif (!is_file($file)) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::FIELD_REQUIRED_IS_EMPTY, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $date = $request->request->get('date');
            if (empty($date)) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::FIELD_REQUIRED_IS_EMPTY, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            } elseif ($this->is_date($date) === false) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::FIELD_REQUIRED_IS_EMPTY, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $date = new \DateTime($date);
            $extension = $file->getClientOriginalExtension();
            $fileName = "csvProject" . '.' . $extension;
            $allExtensions = array("csv", "xls", "xlsx");
            if (!in_array($extension, $allExtensions)) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::EXTENSION_FILE_NOT_VALID, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            //file CSV
            if ($extension == "csv") {
                $response = $this->parsingFileCsv($file, $date);
                //Response
                if ($response === true) {
                    return new JsonResponse(['status' => Response::HTTP_OK, 'code' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);
                } elseif (is_array($response)) {
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $response, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                } else {
                    return new JsonResponse(['status' => Response::HTTP_BAD_REQUEST, 'code' => Response::HTTP_BAD_REQUEST, 'data' => $response->getMessage(), 'message' => $response->getMessage()], Response::HTTP_BAD_REQUEST);
                }
            }
            //file Excel
            if ($extension == "xls" || $extension == "xlsx") {
                $response = $this->parsingFileExcel($file, $date);
                //Response
                if ($response === true) {
                    return new JsonResponse(['status' => Response::HTTP_OK, 'code' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);
                } elseif (is_array($response)) {
                    return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $response, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
                } else {
                    return new JsonResponse(['status' => Response::HTTP_BAD_REQUEST, 'code' => Response::HTTP_BAD_REQUEST, 'data' => $response->getMessage(), 'message' => $response->getMessage()], Response::HTTP_BAD_REQUEST);
                }
            }
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"projetCsv"})
     * @Rest\Get(
     *     path = "/project-upload",
     *     name="app_csv-projectData_Get",
     *     options={ "method_prefix" = false },
     * )
     * @SWG\Get(
     *  tags={"Project Data"},
     *  summary="Get  all Data upload",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=ProjectDataCsv::class, groups={"projetCsv"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getProjectDataAction()
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

        $projectDataCsv = $this->getDoctrine()->getRepository('MfpeCollectDataBundle:ProjectDataCsv')->findAll();
        $projectDataCsv = $this->get('jms_serializer')->serialize($projectDataCsv, 'json', SerializationContext::create()->setGroups(array('projetCsv', 'ReferencielGroup')));
        $projectDataCsv = json_decode($projectDataCsv, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $projectDataCsv], Response::HTTP_OK);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $specialites], Response::HTTP_OK);

    }

    private function is_date($date)
    {
        if (date_create($date) === false) {
            return false;
        } else
            return true;
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "project_data/historique_file",
     *     name="app_historique-file-project_Get",
     *     options={ "method_prefix" = false },
     * )
     * @SWG\Get(
     *  tags={"Project Data"},
     *  summary="Get All file Project data",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=ProjectDataCsv::class, groups={"publicProjectCsv"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getHistoricalFileSocioAction(Request $request)
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

        $response = self::getHistoricalProjetFile();
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);

    }

    private function getHistoricalProjetFile()
    {
        $stmt = $this->getDoctrine()->getManager()->getConnection();
        $req = $stmt->prepare("SELECT distinct (csv_project_data.file_id) ,csv_project_data.file_name,csv_project_data.created_at, csv_project_data.created_by,csv_project_data.mois,csv_project_data.annee from csv_project_data ;");
        $req->execute();
        $Result = $req->fetchAll();
        $historique = $this->get('jms_serializer')->serialize($Result, 'json', SerializationContext::create()->setGroups(array('publicProjectCsv')));
        $historique = json_decode($historique, JSON_UNESCAPED_UNICODE);
        return $historique;
    }

    private function parsingFileCsv($file, $date1)
    {
        try {
            $errors = array();
            $extension = $file->getClientOriginalExtension();
            $fileName = "csvProject" . '.' . $extension;
            $file->move($this->container->getParameter('csv_project_directory'), $fileName);
            $csvFile = $this->container->getParameter('csv_project_directory') . '/' . $fileName;
            $lines = [];
            // Open the file for reading
            if (($h = fopen($csvFile, "r")) !== FALSE) {
                // Each line in the file is converted into an individual array that we call $data
                // The items of the array are comma separated
                while (($data = fgetcsv($h, '', "\r")) !== FALSE) {
                    // Each individual array is being pushed into the nested array
                    $lines[] = $data;
                }
                // Close the file
                fclose($h);
            }

            // Display the code in a readable format
            foreach ($lines as $key => $linee) {
                foreach ($linee as $k => $line) {
                    $rows = explode(";", $line);

                    if (count(array_filter($rows)) != 19) {
                        $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                        return $errors;
                    }

                    $csvProjectDataCsv = New ProjectDataCsv();
                    if ($key != 0) {
                        $rows = explode(";", $line);
                        $rows = array_map('trim', $rows);

                        //Validate gouvernorat
                        if (empty($rows[0])) {
                            $errors["governorat"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } else {
                            // $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->getGouvernoratByIntitule($rows[0]);
//                            if ($gouvernorat) {
//                                $idGouvernorat = $gouvernorat[0]["id"];
                            $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->findByIntituleFr($rows[0]);

                            if ($gouvernorat) {
                                $csvProjectDataCsv->setGovernorat($gouvernorat[0]);
                            }


//                            }
                            $csvProjectDataCsv->setGovernoratTitle($rows[0]);
                        }

                        //Validate delegation
                        if (empty($rows[1])) {
                            $errors["Delegation"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } else {
//                            $delegation = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->getDelegationByIntitule($rows[1]);
//
//                                $idDelegation = $delegation[0]["id"];

                            $delegation = $this->em()->getRepository('MfpeReferencielBundle:RefDelegation')->findByIntituleFr($rows[1]);
                            if ($delegation) {
                                $csvProjectDataCsv->setDelegation($delegation[0]);
                            }
                            $csvProjectDataCsv->setDelegationTitle($rows[1]);
                        }

                        //Validate Nom du projet

                        if (empty($rows[2])) {
                            $errors["nom_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } else {
                            $csvProjectDataCsv->setTitleProject($rows[2]);
                        }

                        //Validate Type du projet

                        if (empty($rows[3])) {
                            $errors["type_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } else {
                            $csvProjectDataCsv->setTypeProject($rows[3]);
                        }

                        //Validate secteur du projet

                        if (empty($rows[4])) {
                            $errors["secteur_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } else {
                            // $secteur = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->getSectorByIntitule($rows[4]);


                            $secteur = $this->em()->getRepository('MfpeReferencielBundle:RefSecteur')->findByIntituleFr($rows[4]);

                            if ($secteur) {

                                $csvProjectDataCsv->setSector($secteur[0]);
                            }
                            $csvProjectDataCsv->setSectorTitle($rows[4]);

                        }


                        //Validate chef du projet

                        if (empty($rows[5])) {
                            $errors["chef_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } else {
                            $csvProjectDataCsv->setProjectLeader($rows[5]);
                        }

                        //Validate Année d'inscription du projet

                        if (empty($rows[6])) {
                            $errors["annee_inscription_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } elseif (!is_numeric($rows[6])) {
                            $errors["annee_inscription_projet"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                        } else {
                            $csvProjectDataCsv->setRegistrationProjectYear($rows[6]);
                        }

                        //Validate Cout initial du projet

                        if (empty($rows[7])) {
                            $errors["cout_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } elseif (!is_numeric($rows[7])) {
                            $errors["cout_projet"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                        } elseif ((int)(log($rows[7], 10) + 1) > 15) {
                            $errors["cout_projet"] = ApiProblem::FIELD_LONG;
                        } else {
                            $csvProjectDataCsv->setProjectCost((int)$rows[7]);
                        }

                        //Validate Composantes du projet

                        if (empty($rows[8])) {
                            $errors["composantes_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } else {
                            $csvProjectDataCsv->setProjectComponent($rows[8]);
                        }

                        //Validate Date d'achèvement du projet

                        if (empty($rows[9])) {
                            $errors["date_achevement_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } else {
                            $date = date("Y-m-d H:i:s", strtotime($rows[9]));
                            $csvProjectDataCsv->setProjectCompletionDate(new \DateTime($date));
                        }

                        //Validate type de finance
                        if (empty($rows[10])) {
                            $errors["type_finance"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } else {
                            $csvProjectDataCsv->setTypeFinance($rows[10]);
                        }


                        //Validate Bailleurs de fond

                        if (empty($rows[11])) {
                            $errors["bailleurs_fond"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } else {
                            $csvProjectDataCsv->setFunders($rows[11]);
                        }

                        //Validate Cout actualisé du projet (mille DT)

                        if (empty($rows[12])) {
                            $errors["cout_actualise_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } elseif (!is_numeric($rows[12])) {
                            $errors["cout_actualise_projet"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                        } elseif ((int)(log($rows[12], 10) + 1) > 15) {
                            $errors["cout_actualise_projet"] = ApiProblem::FIELD_LONG;
                        } else {
                            $csvProjectDataCsv->setProjectCostUpdated($rows[12]);
                        }

                        //Validate Date d'ctualistation du cout

                        if (empty($rows[13])) {
                            $errors["date_actualistation_cout_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } else {
                            $date = date("Y-m-d H:i:s", strtotime($rows[13]));
                            $csvProjectDataCsv->setProjectCostUpdatedDate(new \DateTime($date));
                        }

                        //Validate Date de suivit du projet
                        if (empty($rows[14])) {
                            $errors["date_suivit_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;

                        } else {
                            $date = date("Y-m-d H:i:s", strtotime($rows[14]));
                            $csvProjectDataCsv->setProjectFollowUpDate(new \DateTime($date));
                        }

                        //Validate dépenses réelles
                        if (empty($rows[15])) {
                            $errors["depenses_reelles"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } elseif (!is_numeric($rows[15])) {
                            $errors["depenses_reelles"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                        } elseif ((int)(log($rows[15], 10) + 1) > 15) {
                            $errors["depenses_reelles"] = ApiProblem::FIELD_LONG;
                        } else {
                            $csvProjectDataCsv->setExpenseReal($rows[15]);
                        }

                        //Validate Suivi physique du projet

                        if (empty($rows[16])) {
                            $errors["suivit_physique"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } else {
                            $csvProjectDataCsv->setPhysicalProjectProgress($rows[16]);
                        }

                        //Validate % d'avancement du projet
                        if (empty($rows[17])) {
                            $errors["avancement_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } elseif ((int)$rows[17] == 0) {
                            $errors["avancement_projet"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                        } elseif (strlen($rows[17]) > 15) {
                            $errors["avancement_projet"] = ApiProblem::FIELD_LONG;
                        } else {
                            $csvProjectDataCsv->setProjectProgressPercent((int)$rows[17]);
                        }


                        //Validate Remarques
                        if (empty($rows[18])) {
                            $errors["remarques"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        } else {
                            $csvProjectDataCsv->setObservation($rows[18]);
                        }


                    }

                }
                $year = $date1->format("Y");
                $csvProjectDataCsv->setAnnee($year);
                $mois = $date1->format("m");
                $csvProjectDataCsv->setMois($mois);
                $fileOriginalName = $file->getClientOriginalName();
                $csvProjectDataCsv->setFileName($fileOriginalName);
                $date = new\ DateTime();
                $temps = $date->getTimestamp();
                $csvProjectDataCsv->setFileId($temps);
                if (count($rows) != 19) {
                    $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                }
                if ($errors) {
                    return $errors;
                } else {
                    $this->em()->persist($csvProjectDataCsv);
                }
            }

            $this->em()->flush();
            return true;


        } catch (\Throwable $e) {
            return $e;
            //return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    private function parsingFileExcel($file, $date1)
    {
        try {
            $errors = array();
            $extension = $file->getClientOriginalExtension();
            $fileName = "excelProject" . '.' . $extension;
            $file->move($this->container->getParameter('csv_project_directory'), $fileName);
            $excelFile = $this->container->getParameter('csv_project_directory') . '/' . $fileName;
            $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($excelFile);
            $datasets = $phpExcelObject->setActiveSheetIndex(0)->toArray();
            foreach ($datasets as $key => $dataset) {
                if ($key != 0) {
                    if (count(array_filter($dataset)) != 19) {
                        $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                        return $errors;
                    }
                }
            }

            foreach ($phpExcelObject->getWorksheetIterator() as $worksheet) {
                //echo 'Worksheet - ', $worksheet->getTitle();
                foreach ($worksheet->getRowIterator() as $index => $row) {
                    //dd("indexxxxxxxxxx",$index,"rowwwwwwww::::::",$row);
                    $csvProjectDataCsv = New ProjectDataCsv();
                    if ($row->getRowIndex() != 1) {

                        //echo '    Row number - ', $row->getRowIndex();
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
                        foreach ($cellIterator as $key => $cell) {
                            $keysValidate = array(
                                "A" => "Gouvernorat",
                                "B" => "Délégation",
                                "C" => "Nom du projet",
                                "D" => "Type du projet",
                                "E" => "Secteur du projet",
                                "F" => "Chef de projet",
                                "G" => "Année d'inscription du projet",
                                "H" => "Cout initial du projet (mille DT)",
                                "I" => "Composantes du projet",
                                "J" => "Date d'achèvement du projet",
                                "K" => "Type de financement",
                                "L" => "Bailleurs de fond",
                                "M" => "Cout actualisé du projet (mille DT)",
                                "N" => "Date d'ctualistation du cout",
                                "O" => "Date de suivit du projet",
                                "P" => "Suivi financier \"Dépenses réelles \" (mille DT)",
                                "Q" => "Suivi physique du projet",
                                "R" => "% d'avancement du projet",
                                "S" => "Remarques",
                            );

                            if (array_key_exists($key, $keysValidate)) {
                                if (is_null($cell) || is_null($cell->getCalculatedValue()) || empty($cell->getCalculatedValue())) {
                                    $errors[$keysValidate[$key]] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                }
                            }
                            if (!is_null($cell) && !is_null($cell->getCalculatedValue())) {
                                //echo '<pre> Cell - ', $cell->getCoordinate(), ' - ', $cell->getCalculatedValue().'key'. $key;
                                $arrayColonnes = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S");
                                if (!in_array($key, $arrayColonnes)) {
                                    $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                                }


                                //Validate gouvernorat
                                if ($key == "A") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["governorat"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } else {
                                        $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->findByIntituleFr($cell->getCalculatedValue());
                                        if ($gouvernorat) {
                                            $csvProjectDataCsv->setGovernorat($gouvernorat[0]);

                                        }
                                        $csvProjectDataCsv->setGovernoratTitle($cell->getCalculatedValue());
                                    }
                                }
                                //Validate delegation
                                if ($key == "B") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["Delegation"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } else {
                                        // $delegation = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->getDelegationByIntitule($cell->getCalculatedValue());
                                        $delegation = $this->em()->getRepository('MfpeReferencielBundle:RefDelegation')->findByIntituleFr($cell->getCalculatedValue());
                                        if ($delegation) {
                                            $csvProjectDataCsv->setDelegation($delegation[0]);
                                        }
                                        $csvProjectDataCsv->setDelegationTitle($cell->getCalculatedValue());
                                    }
                                }
                                //Validate Nom du projet
                                if ($key == "C") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["nom_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } else {
                                        $csvProjectDataCsv->setTitleProject($cell->getCalculatedValue());
                                    }
                                }
                                //Validate Type du projet
                                if ($key == "D") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["type_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } else {
                                        $csvProjectDataCsv->setTypeProject($cell->getCalculatedValue());
                                    }
                                }
                                //Validate secteur du projet
                                if ($key == "E") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["secteur_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } else {
                                        $secteur = $this->em()->getRepository('MfpeReferencielBundle:RefSecteur')->findByIntituleFr($cell->getCalculatedValue());
                                        if ($secteur) {
                                            $csvProjectDataCsv->setSector($secteur[0]);
                                        }
                                        $csvProjectDataCsv->setSectorTitle($cell->getCalculatedValue());
                                    }
                                }

                                //Validate chef du projet
                                if ($key == "F") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["chef_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } else {
                                        $csvProjectDataCsv->setProjectLeader($cell->getCalculatedValue());
                                    }
                                }
                                //Validate Année d'inscription du projet
                                if ($key == "G") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["annee_inscription_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["annee_inscription_projet"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } else {
                                        $csvProjectDataCsv->setRegistrationProjectYear($cell->getCalculatedValue());
                                    }
                                }
                                //Validate Cout initial du projet
                                if ($key == "H") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["cout_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["cout_projet"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                        $errors["cout_projet"] = ApiProblem::FIELD_LONG;
                                    } else {
                                        $csvProjectDataCsv->setProjectCost($cell->getCalculatedValue());
                                    }
                                }
                                //Validate Composantes du projet
                                if ($key == "I") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["composantes_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } else {
                                        $csvProjectDataCsv->setProjectComponent($cell->getCalculatedValue());
                                    }
                                }
                                //Validate Date d'achèvement du projet
                                if ($key == "J") {
                                    if (empty($cell->getFormattedValue())) {
                                        $errors["date_achevement_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["date_achevement_projet"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } else {
                                        $dateAchev = date("Y-m-d H:i:s", strtotime($cell->getFormattedValue()));
                                        $csvProjectDataCsv->setProjectCompletionDate(new \DateTime($dateAchev));
                                    }
                                }
                                //Validate type de finance
                                if ($key == "K") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["type_finance"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } else {
                                        $csvProjectDataCsv->setTypeFinance($cell->getCalculatedValue());
                                    }
                                }

                                //Validate Bailleurs de fond
                                if ($key == "L") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["bailleurs_fond"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } else {
                                        $csvProjectDataCsv->setFunders($cell->getCalculatedValue());
                                    }
                                }
                                //Validate Cout actualisé du projet (mille DT)
                                if ($key == "M") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["cout_actualise_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["cout_actualise_projet"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                        $errors["cout_actualise_projet"] = ApiProblem::FIELD_LONG;
                                    } else {
                                        $csvProjectDataCsv->setProjectCostUpdated($cell->getCalculatedValue());
                                    }
                                }
                                //Validate Date d'ctualistation du cout
                                if ($key == "N") {
                                    if (empty($cell->getFormattedValue())) {
                                        $errors["date_actualistation_cout_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["date_actualistation_cout_projet"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } else {
                                        $dateActua = date("Y-m-d H:i:s", strtotime($cell->getFormattedValue()));

                                        $csvProjectDataCsv->setProjectCostUpdatedDate(new \DateTime($dateActua));
                                    }
                                }


                                //Validate Date de suivit du projet
                                if ($key == "O") {
                                    if (empty($cell->getFormattedValue())) {
                                        $errors["date_suivit_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["date_suivit_projet"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } else {
                                        $dateSuiv = date("Y-m-d", strtotime($cell->getFormattedValue()));
                                        $csvProjectDataCsv->setProjectFollowUpDate(new \DateTime($dateSuiv));
                                    }
                                }

                                //Validate dépenses réelles
                                if ($key == "P") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["depenses_reelles"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["depenses_reelles"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                        $errors["depenses_reelles"] = ApiProblem::FIELD_LONG;
                                    } else {
                                        $csvProjectDataCsv->setExpenseReal($cell->getCalculatedValue());
                                    }
                                }
                                //Validate Suivi physique du projet
                                if ($key == "Q") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["suivit_physique"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } else {
                                        $csvProjectDataCsv->setPhysicalProjectProgress($cell->getCalculatedValue());
                                    }
                                }
                                //Validate % d'avancement du projet
                                if ($key == "R") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["avancement_projet"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["avancement_projet"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } else {
                                        $csvProjectDataCsv->setProjectProgressPercent($cell->getCalculatedValue());
                                    }
                                }
                                //Validate Remarques
                                if ($key == "S") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["remarques"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } else {
                                        $csvProjectDataCsv->setObservation($cell->getCalculatedValue());
                                    }
                                }

                            }
                        }
                        $year = $date1->format("Y");
                        $csvProjectDataCsv->setAnnee($year);
                        $mois = $date1->format("m");
                        $csvProjectDataCsv->setMois($mois);
                        $fileOriginalName = $file->getClientOriginalName();
                        $csvProjectDataCsv->setFileName($fileOriginalName);
                        $date = new\ DateTime();
                        $temps = $date->getTimestamp();
                        $csvProjectDataCsv->setFileId($temps);

                        if ($errors) {
                            return $errors;
                        } else {
                            $this->em()->persist($csvProjectDataCsv);
                        }
                    }
                }

                $this->em()->flush();
                return true;
            }
        } catch (\Throwable $e) {
            return $e;
            //echo "Captured Throwable: " . $e->getMessage() . 'status:' . $e->getCode();
            //return new JsonResponse(['status' => "error", 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * @Rest\Delete(
     *     path = "/project_data/{id}",
     *     name = "app_csv-project_Delete",
     *     requirements = {"id"="\d+"},
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Delete(
     *  tags={"Project Data"},
     *  summary="delete  File by id",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="File id",
     *     type="integer",
     *     required=true
     * ),
     * @SWG\Response(response="201", description="Returned when file bts is deleted"),
     * @SWG\Response(response="400", description="Returned when invalid data"),
     * )
     */
    public function deleteFileBtsAction($id)
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
        $remove = false;
        $btsFile = $this->em()->getRepository('MfpeCollectDataBundle:ProjectDataCsv')->findBy(array("fileId" => $id));

        if ($btsFile === null) {
            return new JsonResponse(['status' => Response::HTTP_BAD_REQUEST, 'code' => Response::HTTP_BAD_REQUEST, 'data' => '', 'message' => ApiProblem::SOCIO_ECONOMIC_CSV_DOES_NOT_EXIST], Response::HTTP_BAD_REQUEST);
        }
        //Remove the file from the database
        foreach ($btsFile as $file) {
            $this->em()->remove($file);
            $remove = true;
        }

        $this->em()->flush();
        if ($remove == true) {
            $historiqueFile = $this->getHistoricalProjetFile();
            return new JsonResponse(['status' => Response::HTTP_OK, 'code' => Response::HTTP_OK, 'message' => 'success', 'data' => $historiqueFile], Response::HTTP_OK);
        }

        return new JsonResponse(['status' => Response::HTTP_BAD_REQUEST, 'code' => Response::HTTP_BAD_REQUEST, 'message' => ApiProblem::SOCIO_ECONOMIC_CSV_DOES_NOT_EXIST, 'data' => ''], Response::HTTP_OK);

    }

}
