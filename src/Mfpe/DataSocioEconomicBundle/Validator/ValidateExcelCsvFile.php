<?php

namespace Mfpe\DataSocioEconomicBundle\Validator;

use Doctrine\ORM\EntityManager;
use Mfpe\ConfigBundle\Exception\ApiProblem;


class ValidateExcelCsvFile
{
    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function validateExcelCsvFileSocioEconomicData($data)
    {
        $numberColumns = count(array_filter($data));
        $errors = array();
        if ($numberColumns != 8) {
            $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
        } else {
            //Validate field governorat
            if (empty($data["0"])) {
                $errors["governorat"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            }
            //Validate population_size
            if (empty($data["1"])) {
                $errors["population_size"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            } elseif (!is_numeric($data["1"])) {
                $errors["population_size"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
            } elseif ((int)(log($data[1], 10) + 1) > 11) {
                $errors["population_size"] = ApiProblem::FIELD_LONG;
            }
            //Validate population in age activity
            if (empty($data[2])) {
                $errors["population_age_activity"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            } elseif (!is_numeric($data[2])) {
                $errors["population_age_activity"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
            } elseif ((int)(log($data[2], 10) + 1) > 11) {
                $errors["population_age_activity"] = ApiProblem::FIELD_LONG;
            }
            //Validate active population
            if (empty($data[3])) {
                $errors["active_population"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            } elseif (!is_numeric($data[3])) {
                $errors["active_population"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
            } elseif ((int)(log($data[3], 10) + 1) > 11) {
                $errors["active_population"] = ApiProblem::FIELD_LONG;
            }
            //Validate active population occupied
            if (empty($data[4])) {
                $errors["active_population_occupied"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            } elseif (!is_numeric($data[4])) {
                $errors["active_population_occupied"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
            } elseif ((int)(log($data[4], 10) + 1) > 11) {
                $errors["active_population_occupied"] = ApiProblem::FIELD_LONG;
            }
            //Validate unemployed population
            if (empty($data[5])) {
                $errors["unemployed_population"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            } elseif (!is_numeric($data[5])) {
                $errors["unemployed_population"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
            } elseif ((int)(log($data[5], 10) + 1) > 11) {
                $errors["unemployed_population"] = ApiProblem::FIELD_LONG;
            }
            //Validate unemployment rate
            if (empty($data[6])) {
                $errors["unemployment_rate"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            } elseif (!is_numeric($data[6])) {
                $errors["unemployment_rate"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
            } elseif ((int)(log($data[6], 10) + 1) > 11) {
                $errors["unemployment_rate"] = ApiProblem::FIELD_LONG;
            }
            //Validate number company
            if (empty($data[7])) {
                $errors["number_company"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            } elseif (!is_numeric($data[7])) {
                $errors["number_company"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
            } elseif ((int)(log($data[7], 10) + 1) > 11) {
                $errors["number_company"] = ApiProblem::FIELD_LONG;
            }
        }
        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }

    public function validateExcelCsvFileBTS($data)
    {
        $numberColumns = count(array_filter($data));
        $errors = array();
        if ($numberColumns != 5) {
            $errors["number_fields"] = ApiProblem::NUMBER_FIELD_NOT_COMPATIBLE;
        } else {
            //Validate libelle
            if (empty(trim($data[0]))) {
                $errors["libelle"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            }
            //Validate population size
            if (empty(trim($data[1]))) {
                $errors["nb_cred"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            } elseif ((float)$data[1] == 0) {
                $errors["nb_cred"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
            }elseif ((int)(log($data[1], 10) + 1) > 11) {
                $errors["nb_cred"] = ApiProblem::FIELD_LONG;
            }
            //Validate population in age activity
            if (empty(trim($data[2]))) {
                $errors["mt_cred"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            } elseif ((float)$data[2] == 0) {
                $errors["mt_cred"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
            }elseif (strlen($data[2]) > 12) {
                $errors["mt_cred"] = ApiProblem::FIELD_LONG;
            }
            //Validate active population
            if (empty(trim($data[3]))) {
                $errors["cout_tot_inv"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            } elseif ((float)$data[3] == 0) {
                $errors["cout_tot_inv"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
            }elseif (strlen($data[3]) > 12) {
                $errors["cout_tot_inv"] = ApiProblem::FIELD_LONG;
            }
            //Validate active population occupied
            if (empty(trim($data[4]))) {
                $errors["nb_emploi_creer"] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            } elseif ((int)$data[4] == 0) {
                $errors["nb_emploi_creer"] = ApiProblem::CONTINUS_NUMBER_NOT_NUMERIC;
            }elseif ((int)(log($data[4], 10) + 1) > 11) {
                $errors["nb_emploi_creer"] = ApiProblem::FIELD_LONG;
            }
        }
        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }
}