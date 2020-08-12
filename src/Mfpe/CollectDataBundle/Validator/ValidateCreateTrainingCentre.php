<?php


namespace Mfpe\CollectDataBundle\Validator;

use Doctrine\ORM\EntityManager;
use Mfpe\ConfigBundle\Exception\ApiProblem;

class ValidateCreateTrainingCentre
{
    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }


    public function validateCreateTrainingCentre($data)
    {
        $errors = [];

        //validate gouvernorat
        if (is_null($data["gouvernorat"]["id"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['gouvernorat']["id"] = $message;
        }
        if (isset($data["gouvernorat"]["id"])) {
            if (empty($data["gouvernorat"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['gouvernorat'] = $message;
            } else {
                //validate gouvernorat DOES NOT EXIST IN DATABASE
                $gouvernorat = $this->em->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["gouvernorat"]["id"]);
                if (!$gouvernorat) {
                    $message = ApiProblem::GOUVERNERAT_DOES_NOT_EXIST;
                    $errors['gouvernorat'] = $message;
                }
            }
        }
        //Validate month
        if (is_null($data["month"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['month'] = $message;
        }
        if ($data["month"] === 0) {
            //continue;
        } else {
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
        }

        //Validate year
        if (is_null($data["year"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['year'] = $message;
        }
        if (isset($data["year"])) {
            if ($data["year"] === 0) {
                //continue;
            } else {
                if (empty($data["year"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['year'] = $message;
                } else {
                    if (!is_numeric($data["year"])) {
                        $message = ApiProblem::YEAR_NOT_NUMERIC;
                        $errors['year'] = $message;
                    } else {
                        $length = strlen((string)$data["year"]);
                        if ($length != 4) {
                            $message = ApiProblem::YEAR_EQUAL_4;
                            $errors['year'] = $message;
                        }
                    }
                }
            }
        }

        //Validate initialNumber
        if (is_null($data["initial_number"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['initial_number'] = $message;
        }
        if (isset($data["initial_number"])) {
            if ($data["initial_number"] === 0) {
                //continue;
            } else {
                if (empty($data["initial_number"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['initial_number'] = $message;
                } else {
                    if (!is_numeric($data["initial_number"])) {
                        $message = ApiProblem::INITIAL_NUMBER_NOT_NUMERIC;
                        $errors['initial_number'] = $message;
                    }
                }
            }
        }
        //Validate CONTINUS_NUMBER_
        if (is_null($data["continus_number"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['continus_number'] = $message;
        }
        if (isset($data["continus_number"])) {
            if ($data["continus_number"] === 0) {
                //continue;
            } else {
                if (empty($data["continus_number"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['continus_number'] = $message;
                } else {
                    if (!is_numeric($data["continus_number"])) {
                        $message = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
                        $errors['continus_number'] = $message;
                    }
                }
            }
        }

        //Validate initial_continus_number
        if (is_null($data["initial_continus_number"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['initial_continus_number'] = $message;
        }
        if (isset($data["initial_continus_number"])) {
            if ($data["initial_continus_number"] === 0) {
                //continue;
            } else {
                if (empty($data["initial_continus_number"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['initial_continus_number'] = $message;
                } else {
                    if (!is_numeric($data["continus_number"])) {
                        $message = ApiProblem::INITIAL_CONTINUS_NUMBER_NOT_NUMERIC;
                        $errors['initial_continus_number'] = $message;
                    }
                }
            }
        }

        //Validate change_number
        if (is_null($data["change_number"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['change_number'] = $message;
        }
        if (isset($data["change_number"])) {
            if ($data["change_number"] === 0) {
                //continue;
            } else {
                if (empty($data["change_number"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['change_number'] = $message;
                } else {
                    if (!is_numeric($data["change_number"])) {
                        $message = ApiProblem::CHANGE_NUMBER_NOT_NUMERIC;
                        $errors['change_number'] = $message;
                    }
                }
            }
        }

        //Validate closed_training_center_number
        if (is_null($data["closed_training_center_number"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['closed_training_center_number'] = $message;
        }
        if (isset($data["closed_training_center_number"])) {
            if ($data["closed_training_center_number"] === 0) {
                //continue;
            } else {
                if (empty($data["closed_training_center_number"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['closed_training_center_number'] = $message;
                } else {
                    if (!is_numeric($data["closed_training_center_number"])) {
                        $message = ApiProblem::CLOSED_TTRAINIG_CENTER_NOT_NUMERIC;
                        $errors['closed_training_center_number'] = $message;
                    }
                }
            }
        }

        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }
}