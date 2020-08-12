<?php


namespace Mfpe\DataSocioEconomicBundle\Validator;

use Doctrine\ORM\EntityManager;
use Mfpe\ConfigBundle\Exception\ApiProblem;

class ValidateSocioEconomicData
{
    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function validateSocioEconomicData($data)
    {
        $errors = [];


        //validate direction regionale  NOT EMPTY
        if (array_key_exists("direction_regionale", $data)) {
            if (is_null($data["direction_regionale"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['direction_regionale'] = $message;
            }
            if (isset($data["direction_regionale"]["id"])) {
                if (empty($data["direction_regionale"]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['direction_regionale'] = $message;
                } else {
                    $direction_regionale = $this->em->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array('id' => $data["direction_regionale"]["id"]));
                    if (!$direction_regionale) {
                        $message = ApiProblem::DIRECTION_REGIONAL_DOES_NOT_EXIST;
                        $errors['direction_regionale'] = $message;
                    }
                }
            }
        }

        //Validate health_institution_number
        if (array_key_exists("health_institution_number", $data)) {
            if (is_null($data["health_institution_number"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['health_institution_number'] = $message;
            }
            if (isset($data["health_institution_number"])) {
                if ($data["health_institution_number"] === 0) {
                    //continue;
                } else {
                    if (empty($data["health_institution_number"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['health_institution_number'] = $message;
                    } else {
                        if (!is_int($data["health_institution_number"])) {
                            $message = ApiProblem::INITIAL_NUMBER_NOT_NUMERIC;
                            $errors['health_institution_number'] = $message;
                        } else {
                            if ((int)(log($data["health_institution_number"], 10) + 1) > 10) {
                                $errors["health_institution_number"] = ApiProblem::FIELD_LONG;
                            }
                        }
                    }
                }
            }
        }


        //Validate health_institution_year
        if (array_key_exists("health_institution_year", $data)) {
            if (is_null($data["health_institution_year"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['health_institution_year'] = $message;
            }
            if (isset($data["health_institution_year"])) {
                if ($data["health_institution_year"] === 0) {
                    //continue;
                } else {
                    if (empty($data["health_institution_year"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['health_institution_year'] = $message;
                    } else {
                        if (!is_int($data["health_institution_year"])) {
                            $message = ApiProblem::YEAR_NOT_NUMERIC;
                            $errors['health_institution_year'] = $message;
                        } else {
                            $length = strlen((string)$data["health_institution_year"]);
                            if ($length != 4) {
                                $message = ApiProblem::YEAR_EQUAL_4;
                                $errors['health_institution_year'] = $message;
                            }
                        }
                    }
                }
            }
        }

        //Validate school_institution_number
        if (array_key_exists("school_institution_number", $data)) {
            if (is_null($data["school_institution_number"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['school_institution_number'] = $message;
            }
            if (isset($data["school_institution_number"])) {
                if ($data["school_institution_number"] === 0) {
                    //continue;
                } else {
                    if (empty($data["school_institution_number"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['school_institution_number'] = $message;
                    } else {
                        if (!is_int($data["school_institution_number"])) {
                            $message = ApiProblem::INITIAL_NUMBER_NOT_NUMERIC;
                            $errors['school_institution_number'] = $message;
                        } else {
                            if ((int)(log($data["school_institution_number"], 10) + 1) > 10) {
                                $errors["school_institution_number"] = ApiProblem::FIELD_LONG;
                            }
                        }
                    }
                }
            }
        }

        //Validate school_institution year
        if (array_key_exists("school_institution_year", $data)) {
            if (is_null(($data["school_institution_year"]))) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['school_institution_year'] = $message;
            }
            if (isset($data["school_institution_year"])) {
                if ($data["school_institution_year"] === 0) {
                    //continue;
                } else {
                    if (empty($data["school_institution_year"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['school_institution_year'] = $message;
                    } else {
                        if (!is_int($data["school_institution_year"])) {
                            $message = ApiProblem::YEAR_NOT_NUMERIC;
                            $errors['school_institution_year'] = $message;
                        } else {
                            $length = strlen((string)$data["school_institution_year"]);
                            if ($length != 4) {
                                $message = ApiProblem::YEAR_EQUAL_4;
                                $errors['school_institution_year'] = $message;
                            }
                        }
                    }
                }
            }
        }
        //Validate university_institution_number
        if (array_key_exists("university_institution_number", $data)) {
            if (is_null($data["university_institution_number"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['university_institution_number'] = $message;
            }
            if (isset($data["university_institution_number"])) {
                if ($data["university_institution_number"] === 0) {
                    //continue;
                } else {
                    if (empty(($data["university_institution_number"]))) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['university_institution_number'] = $message;

                    } else {
                        if (!is_int($data["university_institution_number"])) {
                            $message = ApiProblem::INITIAL_NUMBER_NOT_NUMERIC;
                            $errors['university_institution_number'] = $message;
                        } else {
                            if ((int)(log($data["university_institution_number"], 10) + 1) > 10) {
                                $errors["university_institution_number"] = ApiProblem::FIELD_LONG;
                            }
                        }
                    }
                }
            }
        }

        //Validate institution_university_year
        if (array_key_exists("institution_university_year", $data)) {
            if (is_null(($data["institution_university_year"]))) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['institution_university_year'] = $message;
            }
            if (isset($data["institution_university_year"])) {
                if ($data["institution_university_year"] === 0) {
                    //continue;
                } else {
                    if (empty($data["institution_university_year"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['institution_university_year'] = $message;
                    } else {
                        if (!is_int($data["institution_university_year"])) {
                            $message = ApiProblem::YEAR_NOT_NUMERIC;
                            $errors['institution_university_year'] = $message;
                        } else {
                            $length = strlen((string)$data["institution_university_year"]);
                            if ($length != 4) {
                                $message = ApiProblem::YEAR_EQUAL_4;
                                $errors['institution_university_year'] = $message;
                            }
                        }
                    }
                }
            }
        }

        //Validate dropout_school_number
        if (array_key_exists("dropout_school_number", $data)) {
            if (is_null(($data["dropout_school_number"]))) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['dropout_school_number'] = $message;
            }
            if (isset($data["dropout_school_number"])) {
                if ($data["dropout_school_number"] === 0) {
                    //continue;
                } else {
                    if (empty(($data["dropout_school_number"]))) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['dropout_school_number'] = $message;

                    } else {
                        if (!is_int($data["dropout_school_number"])) {
                            $message = ApiProblem::INITIAL_NUMBER_NOT_NUMERIC;
                            $errors['dropout_school_number'] = $message;
                        } else {
                            if ((int)(log($data["dropout_school_number"], 10) + 1) > 10) {
                                $errors["dropout_school_number"] = ApiProblem::FIELD_LONG;
                            }
                        }
                    }
                }
            }
        }
        //Validatedropout_school_year
        if (array_key_exists("dropout_school_year", $data)) {
            if (is_null(($data["dropout_school_year"]))) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['dropout_school_year'] = $message;
            }
            if (isset($data["dropout_school_year"])) {
                if ($data["dropout_school_year"] === 0) {
                    //continue;
                } else {
                    if (empty($data["dropout_school_year"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['dropout_school_year'] = $message;
                    } else {
                        if (!is_int($data["dropout_school_year"])) {
                            $message = ApiProblem::YEAR_NOT_NUMERIC;
                            $errors['dropout_school_year'] = $message;
                        } else {
                            $length = strlen((string)$data["dropout_school_year"]);
                            if ($length != 4) {
                                $message = ApiProblem::YEAR_EQUAL_4;
                                $errors['dropout_school_year'] = $message;
                            }
                        }
                    }
                }
            }
        }

        //Validate needy_family_number
        if (array_key_exists("needy_family_number", $data)) {
            if (is_null(($data["needy_family_number"]))) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['needy_family_number'] = $message;
            }
            if (isset($data["needy_family_number"])) {
                if ($data["needy_family_number"] === 0) {
                    //continue;
                } else {
                    if (empty(($data["needy_family_number"]))) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['needy_family_number'] = $message;

                    } else {
                        if (!is_int($data["needy_family_number"])) {
                            $message = ApiProblem::INITIAL_NUMBER_NOT_NUMERIC;
                            $errors['needy_family_number'] = $message;
                        } else {
                            if ((int)(log($data["needy_family_number"], 10) + 1) > 10) {
                                $errors["needy_family_number"] = ApiProblem::FIELD_LONG;
                            }
                        }
                    }
                }
            }
        }

        //Validatedropout_school_year
        if (array_key_exists("needy_family_year", $data)) {
            if (is_null(($data["needy_family_year"]))) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['needy_family_year'] = $message;
            }
            if (isset($data["needy_family_year"])) {
                if ($data["needy_family_year"] === 0) {
                    //continue;
                } else {
                    if (empty($data["needy_family_year"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['needy_family_year'] = $message;
                    } else {
                        if (!is_int($data["needy_family_year"])) {
                            $message = ApiProblem::YEAR_NOT_NUMERIC;
                            $errors['needy_family_year'] = $message;
                        } else {
                            $length = strlen((string)$data["needy_family_year"]);
                            if ($length != 4) {
                                $message = ApiProblem::YEAR_EQUAL_4;
                                $errors['needy_family_year'] = $message;
                            }
                        }
                    }
                }
            }
        }

        //Validate association_number
        if (array_key_exists("association_number", $data)) {
            if (is_null(($data["association_number"]))) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['association_number'] = $message;
            }
            if (isset($data["association_number"])) {
                if ($data["association_number"] === 0) {
                    //continue;
                } else {
                    if (empty(($data["association_number"]))) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['association_number'] = $message;

                    } else {
                        if (!is_int($data["association_number"])) {
                            $message = ApiProblem::INITIAL_NUMBER_NOT_NUMERIC;
                            $errors['association_number'] = $message;
                        } else {
                            if ((int)(log($data["association_number"], 10) + 1) > 10) {
                                $errors["association_number"] = ApiProblem::FIELD_LONG;
                            }
                        }
                    }
                }
            }
        }


        //Validate association_year
        if (array_key_exists("association_year", $data)) {
            if (is_null(($data["association_year"]))) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['association_year'] = $message;
            }
            if (isset($data["association_year"])) {
                if ($data["association_year"] === 0) {
                    //continue;
                } else {
                    if (empty($data["association_year"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['association_year'] = $message;
                    } else {
                        if (!is_int($data["association_year"])) {
                            $message = ApiProblem::YEAR_NOT_NUMERIC;
                            $errors['association_year'] = $message;
                        } else {
                            $length = strlen((string)$data["association_year"]);
                            if ($length != 4) {
                                $message = ApiProblem::YEAR_EQUAL_4;
                                $errors['association_year'] = $message;
                            }
                        }
                    }
                }
            }
        }

        //validate description
        if (array_key_exists("description", $data)) {
            if (is_null(($data["description"]))) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['description'] = $message;
            }
            if (isset($data["description"])) {
                if ($data["description"] === 0) {
                    //continue;
                } else {
                    if (empty($data["description"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['description'] = $message;
                    }
                }
            }
        }

        //validate CurrentProject
        if (array_key_exists("current_project", $data)) {
            if (is_null(($data["current_project"]))) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['current_project'] = $message;
            }
            if (isset($data["current_project"])) {
                if ($data["current_project"] === 0) {
                    //continue;
                } else {
                    if (empty($data["current_project"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['current_project'] = $message;
                    }
                }
            }
        }
        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }
}