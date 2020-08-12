<?php

namespace Mfpe\DataSocioEconomicBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\ControllerTrait;
use Mfpe\DataSocioEconomicBundle\Entity\CsvSocioEconomicData;
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
use \PDO;
use Mfpe\ConfigBundle\Controller\BaseController;

/**
 * Description of UploadCsvController
 *
 * @author Lamine Mansouri
 */
class UploadCsvController extends BaseController
{

    use ControllerTrait;

    /**
     * @Rest\Post(
     *     path = "/economic_data",
     *     name = "app_csv-socio-economic_Add"
     * )
     * @SWG\Post(
     *  tags={"Socio Economic data"},
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
            $fileName = "csvSocioEcenomic" . '.' . $extension;
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


    private function parsingFileCsv($file, $date)
    {
        try {
            $errors = array();
            $extension = $file->getClientOriginalExtension();
            $fileName = "csvSocioEcenomic" . '.' . $extension;
            $file->move($this->container->getParameter('csv_socio_economic_directory'), $fileName);
            $csvFile = $this->container->getParameter('csv_socio_economic_directory') . '/' . $fileName;
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
            foreach ($lines[0] as $key => $line) {
                $rows = explode(",", $line);
                if (count(array_filter($rows)) != 8) {
                    $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                    return $errors;
                }
                if ($key != 0) {
                    $rows = explode(",", $line);
                    $rows = array_map('trim', $rows);
                    $csvSocioEconomicData = New CsvSocioEconomicData();
                    //Validate
                    if (empty($rows[0])) {
                        $errors["governorat"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } else {
                        $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->getGouvernoratByIntitule($rows[0]);
                        if ($gouvernorat) {
                            $idGouvernorat = $gouvernorat[0]["id"];
                            $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($idGouvernorat);
                            $csvSocioEconomicData->setGovernoratId($gouvernorat);
                            $csvSocioEconomicData->setCodeGovernorat($gouvernorat->getCode());
                        }
                        $csvSocioEconomicData->setGovernorat($rows[0]);
                    }
                    //Validate population size
                    if (empty($rows[1])) {
                        $errors["population_size"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } elseif ((int)$rows[1] == 0) {
                        $errors["population_size"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                    } elseif (strlen($rows[1]) > 15) {
                        $errors["population_size"] = ApiProblem::FIELD_LONG;
                    } else {
                        $csvSocioEconomicData->setPopulationSize($rows[1]);
                    }
                    //Validate population in age activity
                    if (empty($rows[2])) {
                        $errors["population_age_activity"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } elseif ((int)$rows[2] == 0) {
                        $errors["population_age_activity"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                    } elseif (strlen($rows[2]) > 15) {
                        $errors["population_age_activity"] = ApiProblem::FIELD_LONG;
                    } else {
                        $csvSocioEconomicData->setPopulationAgeActivity($rows[2]);
                    }

                    //Validate active population
                    if (empty($rows[3])) {
                        $errors["active_population"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } elseif ((int)$rows[3] == 0) {
                        $errors["active_population"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                    } elseif (strlen($rows[3]) > 15) {
                        $errors["active_population"] = ApiProblem::FIELD_LONG;
                    } else {
                        $csvSocioEconomicData->setActivePopulation($rows[3]);
                    }

                    //Validate active population occupied
                    if (empty($rows[4])) {
                        $errors["active_population_occupied"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } elseif ((int)$rows[4] == 0) {
                        $errors["active_population_occupied"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                    } elseif (strlen($rows[4]) > 15) {
                        $errors["active_population_occupied"] = ApiProblem::FIELD_LONG;
                    } else {
                        $csvSocioEconomicData->setActivePopulationOccupied($rows[4]);
                    }

                    //Validate unemployed population
                    if (empty($rows[5])) {
                        $errors["unemployed_population"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } elseif ((int)$rows[5] == 0) {
                        $errors["unemployed_population"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                    } elseif (strlen($rows[5]) > 15) {
                        $errors["unemployed_population"] = ApiProblem::FIELD_LONG;
                    } else {
                        $csvSocioEconomicData->setUnemployedPopulation($rows[5]);
                    }

                    //Validate unemployment rate
                    if (empty($rows[6])) {
                        $errors["unemployment_rate"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } elseif ((int)$rows[6] == 0) {
                        $errors["unemployment_rate"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                    } elseif (strlen($rows[6]) > 15) {
                        $errors["unemployment_rate"] = ApiProblem::FIELD_LONG;
                    } else {
                        $csvSocioEconomicData->setUnemploymentRate($rows[6]);
                    }

                    //Validate number company
                    if (empty($rows[7])) {
                        $errors["number_company"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } elseif ((int)$rows[7] == 0) {
                        $errors["number_company"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                    } elseif (strlen($rows[7]) > 15) {
                        $errors["number_company"] = ApiProblem::FIELD_LONG;
                    } else {
                        $csvSocioEconomicData->setNumberCompany($rows[7]);
                    }
                    if (count($rows) != 8) {
                        $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                    }
                    if ($errors) {
                        return $errors;
                    } else {
                        $this->em()->persist($csvSocioEconomicData);
                    }
                }
                $year = $date->format("Y");
                $csvSocioEconomicData->setAnnee($year);
                $mois = $date->format("m");
                $csvSocioEconomicData->setMois($mois);
                $fileOriginalName = $file->getClientOriginalName();
                $csvSocioEconomicData->setFileName($fileOriginalName);
                $date = new\ DateTime();
                $temps = $date->getTimestamp();
                $csvSocioEconomicData->setFileId($temps);
            }

            $this->em()->flush();
            return true;
        } catch (\Throwable $e) {
            return $e;
            //return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    private function parsingFileExcel($file, $date)
    {
        try {
            $errors = array();
            $extension = $file->getClientOriginalExtension();
            $fileName = "excelSocioEcenomic" . '.' . $extension;
            $file->move($this->container->getParameter('csv_socio_economic_directory'), $fileName);
            $excelFile = $this->container->getParameter('csv_socio_economic_directory') . '/' . $fileName;
            $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($excelFile);
            $datasets = $phpExcelObject->setActiveSheetIndex(0)->toArray();
            foreach ($datasets as $key => $dataset) {
                if ($key != 0) {
                    if (count(array_filter($dataset)) != 8) {
                        $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                        return $errors;
                    }
                }
            }
            foreach ($phpExcelObject->getWorksheetIterator() as $worksheet) {
                //echo 'Worksheet - ', $worksheet->getTitle();
                foreach ($worksheet->getRowIterator() as $index => $row) {
                    //dd("indexxxxxxxxxx",$index,"rowwwwwwww::::::",$row);
                    $csvSocioEconomicData = New CsvSocioEconomicData();
                    if ($row->getRowIndex() != 1) {
                        //echo '    Row number - ', $row->getRowIndex();
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
                        foreach ($cellIterator as $key => $cell) {
                            $keysValidate = array(
                                "A" => "governorat",
                                "B" => "population_size",
                                "C" => "population_age_activity",
                                "D" => "population_age_activity",
                                "E" => "active_population_occupied",
                                "F" => "unemployed_population",
                                "G" => "unemployment_rate",
                                "H" => "number_company",
                            );

                            if (array_key_exists($key, $keysValidate)) {
                                if (is_null($cell) || is_null($cell->getCalculatedValue()) || empty($cell->getCalculatedValue())) {
                                    $errors[$keysValidate[$key]] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                }
                            }
                            if (!is_null($cell) && !is_null($cell->getCalculatedValue())) {
                                //echo '<pre> Cell - ', $cell->getCoordinate(), ' - ', $cell->getCalculatedValue().'key'. $key;
                                $arrayColonnes = array("A", "B", "C", "D", "E", "F", "G", "H");
                                if (!in_array($key, $arrayColonnes)) {
                                    $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                                }
                                if ($key == "A") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["governorat"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } else {
                                        $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->getGouvernoratByIntitule($cell->getCalculatedValue());
                                        if ($gouvernorat) {
                                            $idGouvernorat = $gouvernorat[0]["id"];
                                            $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($idGouvernorat);
                                            $csvSocioEconomicData->setGovernoratId($gouvernorat);
                                            $csvSocioEconomicData->setCodeGovernorat($gouvernorat->getCode());
                                        }
                                        $csvSocioEconomicData->setGovernorat($cell->getCalculatedValue());
                                    }
                                }
                                //Validate population size
                                if ($key == "B") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["population_size"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["population_size"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                        $errors["population_size"] = ApiProblem::FIELD_LONG;
                                    } else {
                                        $csvSocioEconomicData->setPopulationSize($cell->getCalculatedValue());
                                    }
                                }
                                //Validate population in age activity
                                if ($key == "C") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["population_age_activity"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["population_age_activity"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                        $errors["population_age_activity"] = ApiProblem::FIELD_LONG;
                                    } else {
                                        $csvSocioEconomicData->setPopulationAgeActivity($cell->getCalculatedValue());
                                    }
                                }
                                //Validate active population
                                if ($key == "D") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["active_population"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["active_population"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                        $errors["active_population"] = ApiProblem::FIELD_LONG;
                                    } else {
                                        $csvSocioEconomicData->setActivePopulation($cell->getCalculatedValue());
                                    }
                                }
                                //Validate active population occupied
                                if ($key == "E") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["active_population_occupied"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["active_population_occupied"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                        $errors["active_population_occupied"] = ApiProblem::FIELD_LONG;
                                    } else {
                                        $csvSocioEconomicData->setActivePopulationOccupied($cell->getCalculatedValue());
                                    }
                                }
                                //Validate unemployed population
                                if ($key == "F") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["unemployed_population"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["unemployed_population"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                        $errors["unemployed_population"] = ApiProblem::FIELD_LONG;
                                    } else {
                                        $csvSocioEconomicData->setUnemployedPopulation($cell->getCalculatedValue());
                                    }
                                }
                                //Validate unemployment rate
                                if ($key == "G") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["unemployment_rate"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["unemployment_rate"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                        $errors["unemployment_rate"] = ApiProblem::FIELD_LONG;
                                    } else {
                                        $csvSocioEconomicData->setUnemploymentRate($cell->getCalculatedValue());
                                    }
                                }
                                //Validate number company
                                if ($key == "H") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["number_company"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } elseif (!is_numeric($cell->getCalculatedValue())) {
                                        $errors["number_company"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                    } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                        $errors["number_company"] = ApiProblem::FIELD_LONG;
                                    } else {
                                        $csvSocioEconomicData->setNumberCompany($cell->getCalculatedValue());
                                    }
                                }


                            }
                        }

                        if ($errors) {
                            return $errors;
                        } else {
                            $this->em()->persist($csvSocioEconomicData);
                        }
                    }
                    $year = $date->format("Y");
                    $csvSocioEconomicData->setAnnee($year);
                    $mois = $date->format("m");
                    $csvSocioEconomicData->setMois($mois);
                    $fileOriginalName = $file->getClientOriginalName();
                    $csvSocioEconomicData->setFileName($fileOriginalName);
                    $date = new\ DateTime();
                    $temps = $date->getTimestamp();
                    $csvSocioEconomicData->setFileId($temps);
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
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "/bts_data",
     *     name="app_csv-bts_Get",
     *     options={ "method_prefix" = false },
     * )
     * @Rest\QueryParam(
     *     name="type",
     *     nullable=true,
     *     description="type de file"
     * )
     * @SWG\Get(
     *  tags={"Socio Economic data"},
     *  summary="Get All csv BTS data",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=CsvBTSData::class, groups={"detailsBTS"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getAllBtsAction(Request $request)
    {
        $data = json_decode(json_encode($request->query->all()), true);
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
        $values_type = [1, 2, 3, 4, 5];
        if (!in_array($data['type'], $values_type)) {
            $message = ApiProblem::FIELD_NOT_VALID;
            $errors['type'] = $message;
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
        }
        $response = self::getAllBtsData($data);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);

    }

    private function getAllBtsData($data)
    {
        $em = $this->getDoctrine()->getManager();
        $btsData = $em->getRepository('MfpeDataSocioEconomicBundle:CsvBTSData')->findByTypeFile($data['type']);
        $btsData = $this->get('jms_serializer')->serialize($btsData, 'json', SerializationContext::create()->setGroups(array('detailsBTS')));
        $btsData = json_decode($btsData, JSON_UNESCAPED_UNICODE);
        return $btsData;
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "economic_data/historique_file",
     *     name="app_historique-file_Get",
     *     options={ "method_prefix" = false },
     * )
     * @SWG\Get(
     *  tags={"Socio Economic data"},
     *  summary="Get All file socio economic data",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=CsvSocioEconomicData::class, groups={"detailsBTS"}))),
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

        $response = self::getHistoricalSocioFile();
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);

    }

    private function getHistoricalSocioFile()
    {
        $stmt = $this->getDoctrine()->getManager()->getConnection();
        $req = $stmt->prepare("SELECT distinct (csv_socio_economic_data.file_id) ,csv_socio_economic_data.file_name,csv_socio_economic_data.created_at, csv_socio_economic_data.created_by,csv_socio_economic_data.mois,csv_socio_economic_data.annee from csv_socio_economic_data ;");
        $req->execute();
        $Result = $req->fetchAll();
        $historique = $this->get('jms_serializer')->serialize($Result, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData')));
        $historique = json_decode($historique, JSON_UNESCAPED_UNICODE);
        return $historique;
    }

    /**
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "bts_data/historique_file",
     *     name="app_historique-file-bts_Get",
     *     options={ "method_prefix" = false },
     * )
     * @SWG\Get(
     *  tags={"Socio Economic data"},
     *  summary="Get All file socio economic data",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=CsvBTSData::class, groups={"detailsBTS"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getHistoricalFileBtsAction(Request $request)
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
        $response = self::getHistoricalBtsFile();
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);

    }

    private function getHistoricalBtsFile()
    {
        $stmt = $this->getDoctrine()->getManager()->getConnection();
        $req = $stmt->prepare("SELECT distinct (csv_bts_data.file_id) ,csv_bts_data.file_name,csv_bts_data.created_at, csv_bts_data.created_by,csv_bts_data.mois,csv_bts_data.annee,csv_bts_data.type_file from csv_bts_data ORDER BY csv_bts_data.created_at DESC;");
        $req->execute();
        $Result = $req->fetchAll();
        $historique = $this->get('jms_serializer')->serialize($Result, 'json', SerializationContext::create()->setGroups(array('detailsEconomicData')));
        $historique = json_decode($historique, JSON_UNESCAPED_UNICODE);
        return $historique;
    }


    /**
     * @Rest\Post(
     *     path = "/bts_data",
     *     name = "app_csv-bts-data_Add"
     * )
     * @SWG\Post(
     *  tags={"Socio Economic data"},
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
     *   description ="<span style='color: red;'>Field Type take three values :
    &nbsp;&nbsp; 1: Agence
    &nbsp;&nbsp; 2: Projet
    &nbsp;&nbsp; 3: libelle
    &nbsp;&nbsp; 4: niveau instruction
    &nbsp;&nbsp; 5: secteur
    </span>",
     *          required=true,
     *          format="application/json",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(property="doc", type="string", example="File CSV ou XLS ou XLSX"),
     *              @SWG\Property(property="type", type="intger", example=1),
     *              @SWG\Property(property="date", type="date", example="01-05-2015"),
     *          )
     *      ),
     * )
     */
    public function postBTSDataAction(Request $request)
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
            $doc = $request->files->get("doc");
            if (empty($doc)) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::FIELD_REQUIRED_IS_EMPTY, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            } elseif (!is_file($doc)) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::FIELD_REQUIRED_IS_EMPTY, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $type = $request->request->get('type');
            $date = $request->request->get('date');
            if (empty($date)) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::FIELD_REQUIRED_IS_EMPTY, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            } elseif ($this->is_date($date) === false) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::FIELD_REQUIRED_IS_EMPTY, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            $date1 = new \DateTime($date);


            $values_type = [1, 2, 3, 4, 5];
            if (!is_numeric($type)) {
                $message = ApiProblem::FIELD_NOT_VALID;
                $errors['type'] = $message;
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            } elseif (!in_array($type, $values_type)) {
                $message = ApiProblem::FIELD_NOT_VALID;
                $errors['type'] = $message;
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $errors, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);

            }

            $extension = $doc->getClientOriginalExtension();
            $fileName = "csvBTS" . '.' . $extension;
            $allExtensions = array("csv", "xls", "xlsx");
            if (!in_array($extension, $allExtensions)) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => ApiProblem::EXTENSION_FILE_NOT_VALID, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            }
            //file CSV
            if ($extension == "csv") {

                $response = $this->parsingBTSFileCsv($doc, $type, $date1);
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
                $response = $this->parsingXLSFileExcel($doc, $type, $date1);
            }
            //Response
            if ($response === true) {
                return new JsonResponse(['status' => Response::HTTP_OK, 'code' => Response::HTTP_OK, 'message' => 'success', 'data' => $response], Response::HTTP_OK);
            } elseif (is_array($response)) {
                return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $response, 'message' => ApiProblem::MESSAGE_GLOBAL], Response::HTTP_BAD_REQUEST);
            } else {
                return new JsonResponse(['status' => Response::HTTP_BAD_REQUEST, 'code' => Response::HTTP_BAD_REQUEST, 'data' => $response->getMessage(), 'message' => $response->getMessage()], Response::HTTP_BAD_REQUEST);
            }
        } catch (\Throwable $e) {
            return new JsonResponse(['status' => 'error', 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::MESSAGE_GLOBAL_ERREUR], Response::HTTP_BAD_REQUEST);
        }
    }

    private function is_date($date)
    {
        if (date_create($date) === false) {
            return false;
        } else
            return true;
    }

    private function parsingBTSFileCsv($file, $type, $date)
    {
        try {
            $errors = array();
            $extension = $file->getClientOriginalExtension();
            $fileName = "csvBTS" . '.' . $extension;
            $file->move($this->container->getParameter('csv_socio_economic_directory'), $fileName);
            $csvFile = $this->container->getParameter('csv_socio_economic_directory') . '/' . $fileName;
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
            foreach ($lines[0] as $key => $line) {
                $rows = explode(",", $line);
                if (count(array_filter($rows)) != 5) {
                    $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                    return $errors;
                }
                if ($key != 0) {
                    $rows = explode(",", $line);
                    $rows = array_map('trim', $rows);
                    $csvBTSData = New CsvBTSData();
                    //Validate
                    if (empty($rows[0])) {
                        $errors["libelle"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } else {
                        $secteur = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->getSecteurByIntitule($rows[0]);
                        if ($secteur) {
                            $idSecteur = $secteur[0]["id"];
                            $secteur = $this->em()->getRepository('MfpeReferencielBundle:RefSecteur')->find($idSecteur);
                            $csvBTSData->setlibelle($secteur);
                        }
                        $csvBTSData->setlibelle($rows[0]);
                    }
                    //Validate row gouvernorat 1

                    if (empty($rows[1])) {
                        $errors["governorat"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } else {
                        $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->getGouvernoratByIntitule($rows[1]);
                        if ($gouvernorat) {
                            $idGouvernorat = $gouvernorat[0]["id"];
                            $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($idGouvernorat);
                            $csvBTSData->setGovernoratId($gouvernorat);

                        }
                        $csvBTSData->setGouvernorat($rows[0]);

                    }

                    //Validate nb_cred
                    if (empty($rows[2])) {
                        $errors["nb_cred"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } elseif ((int)$rows[2] == 0) {
                        $errors["nb_cred"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                    } elseif (strlen($rows[2]) > 15) {
                        $errors["nb_cred"] = ApiProblem::FIELD_LONG;
                    } else {
                        $csvBTSData->setNbCred((int)$rows[2]);
                    }
                    //Validate mt_cred
                    if (empty($rows[3])) {
                        $errors["mt_cred"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } elseif ((int)$rows[3] == 0) {
                        $errors["mt_cred"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                    } elseif (strlen($rows[3]) > 15) {
                        $errors["mt_cred"] = ApiProblem::FIELD_LONG;
                    } else {
                        $csvBTSData->setMtCred((float)$rows[3]);
                    }
                    //Validate cout_tot_inv
                    if (empty($rows[4])) {
                        $errors["cout_tot_inv"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } elseif ((int)$rows[4] == 0) {
                        $errors["cout_tot_inv"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                    } elseif (strlen($rows[4]) > 15) {
                        $errors["cout_tot_inv"] = ApiProblem::FIELD_LONG;
                    } else {
                        $csvBTSData->setCoutTotalInvs((float)$rows[4]);
                    }
                    //Validate nb_emploi_creer
                    if (empty($rows[5])) {
                        $errors["nb_emploi_creer"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    } elseif ((int)$rows[5] == 0) {
                        $errors["nb_emploi_creer"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                    } elseif (strlen($rows[5]) > 15) {
                        $errors["nb_emploi_creer"] = ApiProblem::FIELD_LONG;
                    } else {
                        $csvBTSData->setNbEmploiCreer((int)$rows[5]);
                    }
                    $csvBTSData->setTypeFile($type);
                    $year = $date->format("Y");
                    $csvBTSData->setAnnee($year);
                    $mois = $date->format("m");
                    $csvBTSData->setMois($mois);
                    $fileOriginalName = $file->getClientOriginalName();
                    $csvBTSData->setFileName($fileOriginalName);
                    $date = new\ DateTime();
                    $temps = $date->getTimestamp();
                    $csvBTSData->setFileId($temps);

                    if (count($rows) != 5) {
                        $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                    }
                    if ($errors) {
                        return $errors;
                    } else {
                        $this->em()->persist($csvBTSData);
                    }
                }
            }
            $this->em()->flush();
            return true;
        } catch (\Throwable $e) {
            return $e;
            //echo "Captured Throwable: " . $e->getMessage() . 'status:' . $e->getCode();
            //return new JsonResponse(['status' => "error", 'code' => Response::HTTP_BAD_REQUEST, 'data' => $e->getMessage(), 'message' => ApiProblem::FIELD_REQUIRED_IS_EMPTY], Response::HTTP_BAD_REQUEST);
        }
    }

    private function parsingXLSFileExcel($file, $type, $date)
    {
        try {
            $errors = array();
            $extension = $file->getClientOriginalExtension();
            $fileName = "excelBTS" . '.' . $extension;
            $file->move($this->container->getParameter('csv_socio_economic_directory'), $fileName);
            $excelFile = $this->container->getParameter('csv_socio_economic_directory') . '/' . $fileName;
            $phpExcelObject = $this->get('phpexcel')->createPHPExcelObject($excelFile);
            $datasets = $phpExcelObject->setActiveSheetIndex(0)->toArray();
            foreach ($datasets as $key => $dataset) {
                if ($key != 0) {
                    if ($type == 1) {
                        if (count(array_filter($dataset)) != 6) {
                            $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                            return $errors;
                        }
                    } elseif (count(array_filter($dataset)) != 5) {
                        $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                        return $errors;
                    }
                }
            }
            foreach ($phpExcelObject->getWorksheetIterator() as $worksheet) {
                //echo 'Worksheet - ', $worksheet->getTitle();
                foreach ($worksheet->getRowIterator() as $index => $row) {
                    //dd("indexxxxxxxxxx",$index,"rowwwwwwww::::::",$row);
                    $csvBTSData = New CsvBTSData();
                    if ($row->getRowIndex() != 1) {
                        //echo '    Row number - ', $row->getRowIndex();die;
                        $cellIterator = $row->getCellIterator();
                        $cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set
                        foreach ($cellIterator as $key => $cell) {
                            $keysValidate = array(
                                "A" => "libelle",
                                "B" => "gouvernorat",
                                "C" => "nb_cred",
                                "D" => "mt_cred",
                                "E" => "cout_total_invs",
                                "F" => "nb_emploi_creer"
                            );

                            if (array_key_exists($key, $keysValidate)) {
                                if (is_null($cell) || is_null($cell->getCalculatedValue()) || empty($cell->getCalculatedValue())) {
                                    $errors[$keysValidate[$key]] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                }
                            }
                            if (!is_null($cell) && !is_null($cell->getCalculatedValue())) {
                                if ($type == 1) {
                                    $arrayColonnes = array("A", "B", "C", "D", "E", "F");
                                    if (!in_array($key, $arrayColonnes)) {
                                        $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                                    }
                                } else {
                                    $arrayColonnes = array("A", "B", "C", "D", "E");
                                    if (!in_array($key, $arrayColonnes)) {
                                        $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
                                    }
                                }

                                //echo '<pre> Cell - ', $cell->getCoordinate(), ' - ', $cell->getCalculatedValue().'key'. $key;
                                if ($key == "A") {
                                    if (empty($cell->getCalculatedValue())) {
                                        $errors["libelle"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    } else {
                                        $secteur = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->getSectorByIntitule($cell->getCalculatedValue());
                                        //dd("111111111111",$cell->getCalculatedValue(),"2222222222",$secteur);
                                        if ($secteur) {
                                            $idSecteur = $secteur[0]["id"];
                                            $secteur = $this->em()->getRepository('MfpeReferencielBundle:RefSecteur')->find($idSecteur);
                                            $csvBTSData->setSecteur($secteur);
                                        }
                                        $csvBTSData->setlibelle($cell->getCalculatedValue());
                                    }
                                }
                                if ($type == 1) {
                                    if ($key == "B") {
                                        if (empty($cell->getCalculatedValue())) {
                                            $errors["gouvernorat"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                        } else {
                                            $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:Referenciel')->getGouvernoratByIntitule($cell->getCalculatedValue());
                                            if ($gouvernorat) {
                                                $idGouvernorat = $gouvernorat[0]["id"];
                                                $gouvernorat = $this->em()->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($idGouvernorat);
                                                $csvBTSData->setGovernoratId($gouvernorat);
                                            }
                                            $csvBTSData->setGouvernorat($cell->getCalculatedValue());
                                        }
                                    }

                                    if ($key == "C") {

                                        if (empty($cell->getCalculatedValue())) {
                                            $errors["nb_cred"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                        } elseif (!is_numeric($cell->getCalculatedValue())) {
                                            $errors["nb_cred"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                        } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                            $errors["nb_cred"] = ApiProblem::FIELD_LONG;
                                        } else {
                                            $csvBTSData->setNbCred((int)$cell->getCalculatedValue());
                                        }
                                    }
                                    if ($key == "D") {
                                        if (empty($cell->getCalculatedValue())) {
                                            $errors["mt_cred"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                        } elseif (!is_numeric($cell->getCalculatedValue())) {
                                            $errors["mt_cred"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                        } elseif (strlen($cell->getCalculatedValue()) > 15) {
                                            $errors["mt_cred"] = ApiProblem::FIELD_LONG;
                                        } else {
                                            $csvBTSData->setMtCred((float)$cell->getCalculatedValue());
                                        }
                                    }
                                    //Validate cout d'investissment total
                                    if ($key == "E") {
                                        if (empty($cell->getCalculatedValue())) {
                                            $errors["cout_total_invs"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                        } elseif (!is_numeric($cell->getCalculatedValue())) {
                                            $errors["cout_total_invs"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                        } elseif (strlen($cell->getCalculatedValue()) > 15) {
                                            $errors["cout_total_invs"] = ApiProblem::FIELD_LONG;
                                        } else {
                                            $csvBTSData->setCoutTotalInvs((float)$cell->getCalculatedValue());
                                        }
                                    }
                                    //Validate nbre emploi creer
                                    if ($key == "F") {
                                        if (empty($cell->getCalculatedValue())) {
                                            $errors["nb_emploi_creer"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                        } elseif (!is_numeric($cell->getCalculatedValue())) {
                                            $errors["nb_emploi_creer"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                        } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                            $errors["nb_emploi_creer"] = ApiProblem::FIELD_LONG;
                                        } else {
                                            $csvBTSData->setNbEmploiCreer((int)$cell->getCalculatedValue());
                                        }
                                    }
                                } else //Validate Nbre credit
                                {
                                    if ($key == "B") {

                                        if (empty($cell->getCalculatedValue())) {
                                            $errors["nb_cred"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                        } elseif (!is_numeric($cell->getCalculatedValue())) {
                                            $errors["nb_cred"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                        } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                            $errors["nb_cred"] = ApiProblem::FIELD_LONG;
                                        } else {
                                            $csvBTSData->setNbCred((int)$cell->getCalculatedValue());
                                        }
                                    }

                                    //Validate Mt de crédit
                                    if ($key == "C") {
                                        if (empty($cell->getCalculatedValue())) {
                                            $errors["mt_cred"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                        } elseif (!is_numeric($cell->getCalculatedValue())) {
                                            $errors["mt_cred"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                        } elseif (strlen($cell->getCalculatedValue()) > 15) {
                                            $errors["mt_cred"] = ApiProblem::FIELD_LONG;
                                        } else {
                                            $csvBTSData->setMtCred((float)$cell->getCalculatedValue());
                                        }
                                    }
                                    //Validate cout d'investissment total
                                    if ($key == "D") {
                                        if (empty($cell->getCalculatedValue())) {
                                            $errors["cout_total_invs"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                        } elseif (!is_numeric($cell->getCalculatedValue())) {
                                            $errors["cout_total_invs"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                        } elseif (strlen($cell->getCalculatedValue()) > 15) {
                                            $errors["cout_total_invs"] = ApiProblem::FIELD_LONG;
                                        } else {
                                            $csvBTSData->setCoutTotalInvs((float)$cell->getCalculatedValue());
                                        }
                                    }
                                    //Validate nbre emploi creer
                                    if ($key == "E") {
                                        if (empty($cell->getCalculatedValue())) {
                                            $errors["nb_emploi_creer"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                        } elseif (!is_numeric($cell->getCalculatedValue())) {
                                            $errors["nb_emploi_creer"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                                        } elseif ((int)(log($cell->getCalculatedValue(), 10) + 1) > 15) {
                                            $errors["nb_emploi_creer"] = ApiProblem::FIELD_LONG;
                                        } else {
                                            $csvBTSData->setNbEmploiCreer((int)$cell->getCalculatedValue());
                                        }
                                    }
                                }
                            }
                            $csvBTSData->setTypeFile($type);
                            $year = $date->format("Y");
                            $csvBTSData->setAnnee($year);
                            $mois = $date->format("m");
                            $csvBTSData->setMois($mois);
                            $fileOriginalName = $file->getClientOriginalName();
                            $csvBTSData->setFileName($fileOriginalName);
                            $date = new\ DateTime();
                            $temps = $date->getTimestamp();
                            $csvBTSData->setFileId($temps);
                        }
                        if ($errors) {
                            return $errors;
                        } else {
                            $this->em()->persist($csvBTSData);
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
     * @Rest\View(StatusCode = 200, serializerGroups={"detailsEconomicData"})
     * @Rest\Get(
     *     path = "/economic_data",
     *     name="app_csv-socio-economic_Get",
     *     options={ "method_prefix" = false },
     * )
     * @SWG\Get(
     *  tags={"Socio Economic data"},
     *  summary="Get data by gouvernorat from csv/excel files",
     *  consumes={"application/json"},
     *  produces={"application/json"},
     * @SWG\Response(response="200", description="Returned when successful",@SWG\Schema(type="array", @Model(type=CsvSocioEconomicData::class, groups={"detailsEconomicData","ReferencielGroup"}))),
     * @SWG\Response(response="404", description="Returned when user not found"),
     * )
     */
    public function getDataCsvExcelAction(Request $request)
    {
        $data = json_decode(json_encode($request->query->all()), true);
        $csvSocioEconomicData = $this->em()->getRepository("MfpeDataSocioEconomicBundle:CsvSocioEconomicData")->findAll();
        $csvSocioEconomicData = $this->get('jms_serializer')->serialize($csvSocioEconomicData, 'json', SerializationContext::create()->setGroups(array("detailsEconomicData", "ReferencielGroup")));
        $csvSocioEconomicData = json_decode($csvSocioEconomicData, JSON_UNESCAPED_UNICODE);
        return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $csvSocioEconomicData], Response::HTTP_OK);


        //return new JsonResponse(['status' => Response::HTTP_OK, 'message' => 'success', 'data' => $csvSocioEconomicData], Response::HTTP_OK);


    }


    /**
     * @Rest\Delete(
     *     path = "/economic_data/{id}",
     *     name = "app_csv-socio_Delete",
     *     requirements = {"id"="\d+"},
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Delete(
     *  tags={"Socio Economic data"},
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
     * @SWG\Response(response="201", description="Returned when socio economic deleted"),
     * @SWG\Response(response="400", description="Returned when invalid data"),
     * )
     */
    public function deleteAction($id)
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
        $socioFile = $this->em()->getRepository('MfpeDataSocioEconomicBundle:CsvSocioEconomicData')->findBy(array("fileId" => $id));

        if ($socioFile === null) {
            return new JsonResponse(['status' => Response::HTTP_BAD_REQUEST, 'code' => Response::HTTP_BAD_REQUEST, 'data' => '', 'message' => ApiProblem::SOCIO_ECONOMIC_CSV_DOES_NOT_EXIST], Response::HTTP_BAD_REQUEST);
        }
        //Remove the file from the database
        foreach ($socioFile as $file) {
            $this->em()->remove($file);
            $remove = true;
        }
        if ($remove == true) {
            $this->em()->flush();
            $historiqueFile = $this->getHistoricalSocioFile();
            return new JsonResponse(['status' => Response::HTTP_OK, 'code' => Response::HTTP_OK, 'message' => 'success', 'data' => $historiqueFile], Response::HTTP_OK);

        }
        return new JsonResponse(['status' => Response::HTTP_BAD_REQUEST, 'code' => Response::HTTP_BAD_REQUEST, 'message' => ApiProblem::SOCIO_ECONOMIC_CSV_DOES_NOT_EXIST, 'data' => ''], Response::HTTP_OK);

    }


    /**
     * @Rest\Delete(
     *     path = "/bts_data/{id}",
     *     name = "app_csv-socio-Delete",
     *     requirements = {"id"="\d+"},
     *     options={ "method_prefix" = false }
     * )
     * @SWG\Delete(
     *  tags={"Socio Economic data"},
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
        $btsFile = $this->em()->getRepository('MfpeDataSocioEconomicBundle:CsvBTSData')->findBy(array("fileId" => $id));

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
            $historiqueFile = $this->getHistoricalBtsFile();
            return new JsonResponse(['status' => Response::HTTP_OK, 'code' => Response::HTTP_OK, 'message' => 'success', 'data' => $historiqueFile], Response::HTTP_OK);
        }

        return new JsonResponse(['status' => Response::HTTP_BAD_REQUEST, 'code' => Response::HTTP_BAD_REQUEST, 'message' => ApiProblem::SOCIO_ECONOMIC_CSV_DOES_NOT_EXIST, 'data' => ''], Response::HTTP_OK);

    }


}
