<?php


namespace Mfpe\DataSocioEconomicBundle\Validator;


use Doctrine\ORM\EntityManager;
use Mfpe\ConfigBundle\Exception\ApiProblem;

class ValidateProjectInvestmentData
{
    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function validateProjectInvestmentData($data)
    {
        $errors = [];
        //validate gouvernerat
        if (array_key_exists("governorat", $data)) {
            if (is_null($data["governorat"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['governorat'] = $message;
            }
            if (isset($data["governorat"]["id"])) {
                if (empty($data["governorat"]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['governorat'] = $message;
                } else {
                    //validate gouvernorat DOES NOT EXIST IN DATABASE
                    $gouvernorat = $this->em->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["governorat"]["id"]);
                    if (!$gouvernorat) {
                        $message = ApiProblem::GOUVERNERAT_DOES_NOT_EXIST;
                        $errors['governorat'] = $message;
                    }
                }
            }
        }
        //validate delegation
        if (array_key_exists("delegation", $data)) {
            if (is_null($data["delegation"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['delegation'] = $message;
            }
            if (isset($data["delegation"]["id"])) {
                if (empty($data["delegation"]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['delegation'] = $message;
                } else {
                    //validate delegation DOES NOT EXIST	IN DATABASE
                    $delegation = $this->em->getRepository('MfpeReferencielBundle:RefDelegation')->find($data["delegation"]);
                    if (!$delegation) {
                        $message = ApiProblem::DELEGATION_DOES_NOT_EXIST;
                        $errors['delegation_not_exist'] = $message;
                    }
                }
            }
        }
        //validate secteur
        if (array_key_exists("sector_economic", $data)) {
            if (is_null($data["sector_economic"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['sector_economic'] = $message;
            }
            if (is_null($data["sector_economic"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['sector_economic'] = $message;
            }
            if (isset($data["sector_economic"]["id"])) {
                if (empty($data["sector_economic"]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['sector_economic'] = $message;
                } else {
                    //validate secteur DOES NOT EXIST IN DATABASE
                    $secteur = $this->em->getRepository('MfpeReferencielBundle:RefSecteurEconomic')->find($data["sector_economic"]["id"]);
                    if (!$secteur) {
                        $message = ApiProblem::SECTEUR_DOES_NOT_EXIST;
                        $errors['sector_economic'] = $message;
                    }
                }
            }
        }

        //validate object_economic
        if ($data["type"] === 1 || $data["type"] === 2) {
            if (array_key_exists("object_economic", $data)) {
                if (is_null($data["object_economic"]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['object_economic'] = $message;
                }
                if (is_null($data["object_economic"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['object_economic'] = $message;
                }
                if (isset($data["object_economic"]["id"])) {
                    if (empty($data["object_economic"]["id"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['object_economic'] = $message;
                    } else {
                        //validate secteur DOES NOT EXIST IN DATABASE
                        $object = $this->em->getRepository('MfpeReferencielBundle:RefObjetEconomic')->find($data["object_economic"]["id"]);
                        if (!$object) {
                            $message = ApiProblem::OBJECT_DOES_NOT_EXIST;
                            $errors['object_economic'] = $message;
                        }
                    }
                }
            }
        }
        //validate regime
        if ($data["type"] === 1) {
            if (array_key_exists("regime", $data)) {
                if (is_null($data["regime"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['regime'] = $message;
                }
                if (is_null($data["regime"]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['regime'] = $message;
                }
                if (isset($data["regime"]["id"])) {
                    if (empty($data["regime"]["id"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['regime'] = $message;
                    } else {
                        //validate secteur DOES NOT EXIST IN DATABASE
                        $regime = $this->em->getRepository('MfpeReferencielBundle:RefRegime')->find($data["regime"]["id"]);
                        if (!$regime) {
                            $message = ApiProblem::REGIME_DOES_NOT_EXIST;
                            $errors['regime'] = $message;
                        }
                    }
                }
            }
        }
        //validate date
        if ($data["type"] === 2) {
            if (array_key_exists("date", $data)) {
                if (is_null($data["date"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['date'] = $message;
                }
                if (isset($data["date"])) {
                    if (empty($data["date"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors["date"] = $message;
                    }
                }
            }
        }

        //Validate job_estimed
        if (array_key_exists("job_estimed", $data)) {
            if (is_null($data["job_estimed"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['job_estimed'] = $message;
            }
            if (isset($data["job_estimed"])) {
                if (empty($data["job_estimed"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['job_estimed'] = $message;
                } else {
                    if (!is_numeric($data["job_estimed"])) {
                        $message = ApiProblem::INITIAL_NUMBER_NOT_NUMERIC;
                        $errors['job_estimed'] = $message;
                    }
                }
            }
        }

        //Validate investment_cost
        if (array_key_exists("investment_cost", $data)) {
            if (is_null($data["investment_cost"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['investment_cost'] = $message;
            }
            if (isset($data["investment_cost"])) {
                if (empty($data["investment_cost"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['investment_cost'] = $message;
                } else {
                    if (!is_numeric($data["investment_cost"])) {
                        $message = ApiProblem::INITIAL_NUMBER_NOT_NUMERIC;
                        $errors['investment_cost'] = $message;
                    }
                }
            }
        }

        //Validate year
        if (array_key_exists("year", $data)) {
            if (is_null($data["year"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['year'] = $message;
            }
            if (isset($data["year"])) {
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

        //validate activiry_cessation

        if ($data["type"] == 3) {
            if (array_key_exists("activiry_cessation", $data)) {
                if (is_null($data["activiry_cessation"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['activiry_cessation'] = $message;
                }
                if (isset($data["activiry_cessation"])) {
                    if (empty($data["activiry_cessation"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['activiry_cessation'] = $message;
                    }
                }
            }


            //Validate investment_cost
            if (array_key_exists("duration", $data)) {
                if (is_null($data["duration"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['duration'] = $message;
                }
                if (isset($data["duration"])) {
                    if (empty($data["duration"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['duration'] = $message;
                    } else {
                        if (!is_numeric($data["duration"])) {
                            $message = ApiProblem::INITIAL_NUMBER_NOT_NUMERIC;
                            $errors['duration'] = $message;
                        }
                    }
                }
            }

            //Validate number_job_lost
            if (array_key_exists("number_job_lost", $data)) {
                if (is_null($data["number_job_lost"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['number_job_lost'] = $message;
                }
                if (isset($data["number_job_lost"])) {
                    if (empty($data["number_job_lost"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['number_job_lost'] = $message;
                    } else {
                        if (!is_numeric($data["number_job_lost"])) {
                            $message = ApiProblem::INITIAL_NUMBER_NOT_NUMERIC;
                            $errors['number_job_lost'] = $message;
                        }
                    }
                }
            }
        }

        //Validate type
        if (array_key_exists("type", $data)) {
            if (is_null($data["type"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['type'] = $message;
            }
            if (isset($data["type"])) {
                if (empty($data["type"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['type'] = $message;
                } else {
                    if (!is_numeric($data["type"])) {
                        $message = ApiProblem::INITIAL_NUMBER_NOT_NUMERIC;
                        $errors['type'] = $message;
                    }
                }
            }
        }

        //return
        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }

}