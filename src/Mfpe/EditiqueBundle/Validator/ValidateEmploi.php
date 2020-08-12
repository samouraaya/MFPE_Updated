<?php


namespace Mfpe\EditiqueBundle\Validator;

use Doctrine\ORM\EntityManager;
use Mfpe\ConfigBundle\Exception\ApiProblem;

class ValidateEmploi
{
    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }


    public function validateGouvernorat($data)
    {
//        $errors = [];
//        //validate gouvernorat
//        if (!isset($data["governorate"])) {
//            if (empty($data["governorate"])) {
//                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//                $errors['governorate'] = $message;
//            }
//        } else {
//            $governorate = $this->em->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["governorate"]);
//            if (!$governorate) {
//                $governorate = $this->em->getRepository('MfpeReferencielBundle:RefGouvernorat')->findByCode($data["governorate"]);
//                if (!$governorate) {
//                    $message = ApiProblem::GOUVERNERAT_DOES_NOT_EXIST;
//                    $errors['governorate'] = $message;
//                }
//            }
//        }

//        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }

    public function validateYear($data)
    {
        $errors = [];

        if (isset($data["month"]) && !empty($data["month"])) {
            if (empty($data["year"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['year'] = $message;
            }
        }
        if (isset($data["monthSecondary"]) && !empty($data["monthSecondary"])) {
            if (empty($data["yearSecondary"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['yearSecondary'] = $message;
            }
        }
        //validate gouvernorat
        if (isset($data["year"]) && !empty($data["year"]) && isset($data["yearSecondary"]) && !empty($data["yearSecondary"]) || (isset($data["monthSecondary"]) && !empty($data["monthSecondary"]))) {
            {
                if (!isset($data["governorate"])) {
                    if (empty($data["governorate"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['governorate'] = $message;
                    }
                } else {
                    $governorate = $this->em->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["governorate"]);
                    if (!$governorate) {
                        $governorate = $this->em->getRepository('MfpeReferencielBundle:RefGouvernorat')->findByCode($data["governorate"]);
                        if (!$governorate) {
                            $message = ApiProblem::GOUVERNERAT_DOES_NOT_EXIST;
                            $errors['governorate'] = $message;
                        }
                    }
                }
            }
        }
        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }

    public function validateQualification($data)
    {
        $errors = [];
        if (!isset($data["gouvernorat"])) {
            if (empty($data["gouvernorat"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['gouvernorat'] = $message;
            }
        } else {
            $governorate = $this->em->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["gouvernorat"]);
            if (!$governorate) {
                $governorate = $this->em->getRepository('MfpeReferencielBundle:RefGouvernorat')->findByCode($data["gouvernorat"]);
                if (!$governorate) {
                    $message = ApiProblem::GOUVERNERAT_DOES_NOT_EXIST;
                    $errors['gouvernorat'] = $message;
                }
            }
        }
        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }
}