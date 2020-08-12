<?php


namespace Mfpe\CollectDataBundle\Validator;

use Doctrine\ORM\EntityManager;
use Mfpe\ConfigBundle\Exception\ApiProblem;

class ValidateCreateProjet
{
    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }


    public function validateCreateProjet($data)
    {
        $errors = [];
        //validate gouvernorat
        if (is_null($data["governorat"]["id"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['governorat']["id"] = $message;
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
        //validate delegation
        if (is_null($data["delegation"]["id"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['delegation']["id"] = $message;
        }
        if (isset($data["delegation"]["id"])) {
            if (empty($data["delegation"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['delegation'] = $message;
            } else {
                //validate delegation DOES NOT EXIST IN DATABASE
                $delegation = $this->em->getRepository('MfpeReferencielBundle:RefDelegation')->find($data["delegation"]["id"]);
                if (!$delegation) {
                    $message = ApiProblem::DELEGATION_DOES_NOT_EXIST;
                    $errors['delegation'] = $message;
                }
            }
        }
        //Validate title_project
        if (is_null($data["title_project"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['title_project'] = $message;
        }
        if (isset($data["title_project"])) {
            if (empty($data["title_project"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['title_project'] = $message;
            }
        }
        //Validate type_project
        if (is_null($data["type_project"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['type_project'] = $message;
        }
        if (isset($data["type_project"])) {
            if (empty($data["type_project"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['type_project'] = $message;
            }
        }

        //validate sector
        if (is_null($data["sector"]["id"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['sector']["id"] = $message;
        }
        if (isset($data["sector"]["id"])) {
            if (empty($data["sector"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['sector'] = $message;
            } else {
                //validate sector DOES NOT EXIST IN DATABASE
                $sector = $this->em->getRepository('MfpeReferencielBundle:RefSecteur')->find($data["sector"]["id"]);
                if (!$sector) {
                    $message = ApiProblem::SECTEUR_DOES_NOT_EXIST;
                    $errors['sector'] = $message;
                }
            }
        }
        //Validate target_population
//        if (is_null($data["target_population"])) {
//            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//            $errors['target_population'] = $message;
//        }
        if (isset($data["target_population"])) {
            if (empty($data["target_population"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['target_population'] = $message;
            }
        }
        //Validate number_beneficiarie
//        if (is_null($data["number_beneficiarie"])) {
//            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//            $errors['number_beneficiarie'] = $message;
//        }
        if (isset($data["number_beneficiarie"])) {
            if (empty($data["number_beneficiarie"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['number_beneficiarie'] = $message;
            }
        }

        //Validate project_manager
//        if (is_null($data["project_manager"])) {
//            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//            $errors['project_manager'] = $message;
//        }
//        if (isset($data["project_manager"])) {
//            if (empty($data["project_manager"])) {
//                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//                $errors['project_manager'] = $message;
//            }
//        }
        //Validate project_cost
        if (is_null($data["project_cost"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['project_cost'] = $message;
        }
        if (isset($data["project_cost"])) {
            if (empty($data["project_cost"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['project_cost'] = $message;
            } else {
                if (!is_numeric($data["project_cost"])) {
                    $message = ApiProblem::FIELD_NOT_NUMERIC;
                    $errors['project_cost'] = $message;
                }
            }
        }
        //Validate project_cost_updated
        if (is_null($data["project_cost_updated"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['project_cost_updated'] = $message;
        }
        if (isset($data["project_cost_updated"])) {
            if (empty($data["project_cost_updated"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['project_cost_updated'] = $message;
            } else {
                if (!is_numeric($data["project_cost_updated"])) {
                    $message = ApiProblem::FIELD_NOT_NUMERIC;
                    $errors['project_cost_updated'] = $message;
                }
            }
        }
        //Validate finance
        if (is_null($data["finance"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['finance'] = $message;
        }
        if (isset($data["finance"])) {
            if (empty($data["finance"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['finance'] = $message;
            }
        }
        //Validate expense_extimed
//        if (is_null($data["expense_extimed"])) {
//            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//            $errors['expense_extimed'] = $message;
//        }
        if (isset($data["expense_extimed"])) {
            if (empty($data["expense_extimed"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['expense_extimed'] = $message;
            } else {
                if (!is_numeric($data["expense_extimed"])) {
                    $message = ApiProblem::FIELD_NOT_NUMERIC;
                    $errors['expense_extimed'] = $message;
                }
            }
        }
        //Validate expense_real
//        if (is_null($data["expense_real"])) {
//            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//            $errors['expense_real'] = $message;
//        }
        if (isset($data["expense_real"])) {
            if (empty($data["expense_real"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['expense_real'] = $message;
            } else {
                if (!is_numeric($data["expense_real"])) {
                    $message = ApiProblem::FIELD_NOT_NUMERIC;
                    $errors['expense_real'] = $message;
                }
            }
        }

        //Validate type_finance
        if (is_null($data["type_finance"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['type_finance'] = $message;
        }
        if (isset($data["type_finance"])) {
            if (empty($data["type_finance"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['type_finance'] = $message;
            }
        }


        //Validate registration_project_year
        if (is_null($data["registration_project_year"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['registration_project_year'] = $message;
        }
        if (isset($data["registration_project_year"])) {
            if (empty($data["registration_project_year"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['registration_project_year'] = $message;
            } else {
                if (!is_numeric($data["registration_project_year"])) {
                    $message = ApiProblem::YEAR_NOT_NUMERIC;
                    $errors['registration_project_year'] = $message;
                } else {
                    $length = strlen((string)$data["registration_project_year"]);
                    if ($length != 4) {
                        $message = ApiProblem::YEAR_EQUAL_4;
                        $errors['registration_project_year'] = $message;
                    }
                }
            }
        }
        //Validate project_duration
        if (is_null($data["project_duration"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['project_duration'] = $message;
        }
        if (isset($data["project_duration"])) {
            if (empty($data["project_duration"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['project_duration'] = $message;
            } else {
                if (!is_numeric($data["project_duration"])) {
                    $message = ApiProblem::FIELD_NOT_NUMERIC;
                    $errors['project_duration'] = $message;
                }
            }
        }
        //Validate project_component
//        if (is_null($data["project_component"])) {
//            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//            $errors['project_component'] = $message;
//        }
//        if (isset($data["project_component"])) {
//            if (empty($data["project_component"])) {
//                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//                $errors['project_component'] = $message;
//            }
//        }
        //Validate project_progress_percent
            if (is_null($data["project_progress_percent"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['project_progress_percent'] = $message;
            }
            if (isset($data["project_progress_percent"])) {
                if (empty($data["project_progress_percent"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['project_progress_percent'] = $message;
                } else {
                    if (!is_numeric($data["project_progress_percent"])) {
                        $message = ApiProblem::FIELD_NOT_NUMERIC;
                        $errors['project_progress_percent'] = $message;
                    }
                }
            }
        //Validate project_progress
        if ($data["type"]==true) {
            if (is_null($data["project_progress"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['project_progress'] = $message;
            }
            if (isset($data["project_progress"])) {
                if (empty($data["project_progress"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['project_progress'] = $message;
                }
            }
        }
        //Validate observation
        if ($data["type"]=='true') {
            if (is_null($data["observation"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['observation'] = $message;
            }
            if (isset($data["observation"])) {
                if (empty($data["observation"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['observation'] = $message;
                }
            }
        }
//        //Validate type
//        if (is_bool($data["type"]) === false) {
//            $message = ApiProblem::FIELD_NOT_VALID;
//            $errors['type'] = $message;
//        }

        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }
}