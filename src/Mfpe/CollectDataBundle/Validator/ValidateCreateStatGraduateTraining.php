<?php


namespace Mfpe\CollectDataBundle\Validator;


use Doctrine\ORM\EntityManager;
use Mfpe\ConfigBundle\Exception\ApiProblem;

class ValidateCreateStatGraduateTraining
{
    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function validateCreateStatGraduateTraining($data)
    {
        $errors = [];
        //Validate training center
        if (is_null($data["training_center"]["id"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['training_center'] = $message;
        }
        if (isset($data["training_center"]["id"])) {
            if (empty($data["training_center"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['training_center'] = $message;
            } else {
                $training_center = $this->em->getRepository('MfpeCentreFormationBundle:CentreFormation')->find($data["training_center"]["id"]);
                if (!$training_center) {
                    $message = ApiProblem::CENTRE_FORMATION_DOES_NOT_EXIST;
                    $errors['training_center'] = $message;
                }
            }
        }
        //Validate sector
        if (is_null($data["sector"]["id"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['sector'] = $message;
        }
        if (isset($data["sector"]["id"])) {
            if (empty($data["sector"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['sector'] = $message;
            } else {
                $secteur = $this->em->getRepository('MfpeReferencielBundle:RefSecteur')->find($data["sector"]["id"]);
                if (!$secteur) {
                    $message = ApiProblem::SECTEUR_DOES_NOT_EXIST;
                    $errors['sector'] = $message;
                }
            }
        }

        //Validate subsector
        if (is_null($data["subsector"]["id"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['subsector'] = $message;
        }
        if (isset($data["subsector"]["id"])) {
            if (empty($data["subsector"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['subsector'] = $message;
            } else {
                $secteur = $this->em->getRepository('MfpeReferencielBundle:RefSousSecteur')->find($data["subsector"]["id"]);
                if (!$secteur) {
                    $message = ApiProblem::SOUS_SECTEUR_DOES_NOT_EXIST;
                    $errors['subsector'] = $message;
                }
            }
        }

        //Validate speciality
        if (is_null($data["speciality"]["id"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['speciality'] = $message;
        }
        if (isset($data["speciality"]["id"])) {
            if (empty($data["speciality"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['speciality'] = $message;
            } else {
                //validate specialite DOES NOT EXIST IN DATABASE
                $specialite = $this->em->getRepository('MfpeCentreFormationBundle:Specialite')->find($data["speciality"]["id"]);
                if (!$specialite) {
                    $message = ApiProblem::SPECIALITE_NOT_EXIST;
                    $errors['speciality'] = $message;
                }
            }
        }

        //Validate approved
        if (is_null($data["approved"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['approved'] = $message;
        }
        if (isset($data["approved"])) {
            if (is_bool($data["approved"]) === false) {
                $message = ApiProblem::FIELD_NOT_VALID;
                $errors['approved'] = $message;
            }
        }

        //Validate approved
        if (is_null($data["administrative_year"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['administrative_year'] = $message;
        }
        if (isset($data["administrative_year"])) {
            if (empty($data["administrative_year"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['administrative_year'] = $message;
            } else {
                if (!is_numeric($data["administrative_year"])) {
                    $message = ApiProblem::YEAR_NOT_NUMERIC;
                    $errors['administrative_year'] = $message;
                } else {
                    $length = strlen((string)$data["administrative_year"]);
                    if ($length != 4) {
                        $message = ApiProblem::YEAR_EQUAL_4;
                        $errors['administrative_year'] = $message;
                    }
                }
            }
        }

        //Validate month
        if (is_null($data["month"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['month'] = $message;
        }
        if (isset($data["month"])) {
            if (empty($data["month"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['month'] = $message;
            } elseif (!is_numeric($data["month"])) {
                $message = ApiProblem::FIELD_NOT_VALID;
                $errors['month'] = $message;
            } elseif ($data["month"] > 12 || $data["month"] < 1) {
                $message = ApiProblem::FIELD_NOT_VALID;
                $errors['month'] = $message;
            }
        }

        //Validate sector_type
        if (is_null($data["sector_type"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['sector_type'] = $message;
        }
//        if (isset($data["sector_type"])) {
//            if (is_bool($data["sector_type"]) === false) {
//                $message = ApiProblem::FIELD_NOT_VALID;
//                $errors['sector_type'] = $message;
//            }
//        }
        $countLevel = count($data["level_study"]);
        $index = 0;
        foreach ($data["level_study"] as $key => $level) {

            $index = $data["level_study"][$key]["level"];
            //Validate nbr_trained_h
            if (is_null($data["level_study"][$key]["nbr_trained_h"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nbr_trained_h_' . $index] = $message;
            }
            if (isset($level["nbr_trained_h"])) {
                if ($level["nbr_trained_h"] === 0 || $level["nbr_trained_h"] === "0") {
                    //continue;
                } else {
                    if (empty($level["nbr_trained_h"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['nbr_trained_h_' . $index] = $message;
                    } else {
                        if (!is_numeric($level["nbr_trained_h"])) {
                            $message = ApiProblem::FIELD_NOT_NUMERIC;
                            $errors['nbr_trained_h_' . $index] = $message;
                        }
                    }
                }
            }

            //Validate nbr_trained_f
            if (is_null($data["level_study"][$key]["nbr_trained_f"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nbr_trained_f_' . $index] = $message;
            }
            if (isset($level["nbr_trained_f"])) {
                if (isset($level["nbr_trained_f"])) {
                    if ($level["nbr_trained_f"] === 0 || $level["nbr_trained_f"] === "0") {
                        //continue;
                    } else {
                        if (empty($level["nbr_trained_f"])) {
                            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                            $errors['nbr_trained_f_' . $index] = $message;
                        } else {
                            if (!is_numeric($level["nbr_trained_f"])) {
                                $message = ApiProblem::FIELD_NOT_NUMERIC;
                                $errors['nbr_trained_f_' . $index] = $message;
                            }
                        }
                    }
                }
            }

            //Validate nbr_foreigner
            if (is_null($data["level_study"][$key]["nbr_foreigner"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nbr_foreigner_' . $index] = $message;
            }
            if (isset($level["nbr_foreigner"])) {
                if ($level["nbr_foreigner"] === 0 || $level["nbr_foreigner"] === "0") {
                    //continue;
                } else {
                    if (empty($level["nbr_foreigner"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['nbr_foreigner_' . $index] = $message;
                    } else {
                        if (!is_numeric($level["nbr_foreigner"])) {
                            $message = ApiProblem::FIELD_NOT_NUMERIC;
                            $errors['nbr_foreigner_' . $index] = $message;
                        }
                    }
                }
            }
            if (in_array($data["level_study"][$key]["level"], array(1, 2))) {
                //Validate nbr_abundant
                if (array_key_exists("nbr_abundant", $data)) {
                    if (is_null($data["level_study"][$key]["nbr_abundant"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['nbr_abundant_' . $index] = $message;
                    }
                    if (isset($data["level_study"][$key]["nbr_abundant"])) {
                        if ($data["level_study"][$key]["nbr_abundant"] === 0 || $data["level_study"][$key]["nbr_abundant"] === "0") {
                            //continue;
                        } else {
                            if (empty($data["level_study"][$key]["nbr_abundant"])) {
                                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                $errors['nbr_abundant_' . $index] = $message;
                            } else {
                                if (!is_numeric($data["level_study"][$key]["nbr_abundant"])) {

                                    $message = ApiProblem::FIELD_NOT_NUMERIC;
                                    $errors['nbr_abundant_' . $index] = $message;
                                }
                            }
                        }
                    }
                }
            }

            //Validate nbr_total
//            if (is_null($data["level_study"][$key]["nbr_total"])) {
//                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//                $errors['nbr_total_' . $key] = $message;
//            }
//            if (isset($level["nbr_total"])) {
//                if (empty($level["nbr_total"])) {
//                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//                    $errors['nbr_total_' . $key] = $message;
//                } else {
//                if (!is_numeric($level["nbr_total"])) {
//                    $message = ApiProblem::FIELD_NOT_NUMERIC;
//                    $errors['nbr_total_' . $key] = $message;
////                    }
//                }
//            }
            //Validate nbr_total
            if (is_null($data["level_study"][$key]["level"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['level_' . $key] = $message;
            }
            //validate level
            if (isset($data["level_study"][$key]["level"])) {
                if ($data["level_study"][$key]["level"] == 0) {
                    //continue;
                } else {
                    if (empty($data["level_study"][$key]["level"]) || is_null($data["level_study"][$key]["level"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['level' . $key] = $message;
                    } else {
                        if (!in_array($data["level_study"][$key]["level"], array(0, 1, 2))) {
                            $message = ApiProblem::FIELD_NOT_VALID;
                            $errors['level' . $key] = $message;
                        }
                    }
                }
            }

        }

        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }

}