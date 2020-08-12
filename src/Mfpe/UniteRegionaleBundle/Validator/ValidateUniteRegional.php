<?php


namespace Mfpe\UniteRegionaleBundle\Validator;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use Mfpe\ConfigBundle\Exception\ApiProblem;

class ValidateUniteRegional
{

    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }


    //fonction de validation formulaire uniteRegional
    public function validateUniteRegional($data,$uniteRegionale)
    {
        $errors = [];
        //validate code unite
        if (isset($data["code_unite"])) {
            if (empty($data["code_unite"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['code_unite'] = $message;
            } else {
                if($uniteRegionale->getCodeUnite()!=$data["code_unite"])
                {  $uniteRegional = $this->em->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array('codeUnite' => $data["code_unite"]));
                    if ($uniteRegional) {
                        $message = ApiProblem::UNITE_REGIONAL_EXIST_DEJA;
                        $errors['code_unite'] = $message;
                    }

                }

            }
        }
        if (isset($data["titre_ar"])) {
            if (empty($data["titre_ar"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['titre_ar'] = $message;
            }
        }

        if (isset($data["titre_fr"])) {
            if (empty($data["titre_fr"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['titre_fr'] = $message;
            }
        }

        if (isset($data["nom"])) {
            if (empty($data["nom"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nom'] = $message;
            }
        }

        if (isset($data["prenom"])) {
            if (empty($data["prenom"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['prenom'] = $message;
            }
        }

        if (isset($data["identifiant"])) {
            if (empty($data["identifiant"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['identifiant'] = $message;
            }
        }


        if (isset($data["grade"])) {
            if (empty($data["grade"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['grade'] = $message;
            }
        }

        //validate gouvernorat DOES NOT EXIST IN DATABASE
        if (isset($data['gouvernorat']['id'])) {
            if (empty($data['gouvernorat']['id'])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['gouvernorat'] = $message;
            } else {
                $gouvernorat = $this->em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["gouvernorat"]["id"]);
                if (!$gouvernorat) {
                    $message = ApiProblem::GOUVERNERAT_DOES_NOT_EXIST;
                    $errors['gouvernorat'] = $message;
                }
            }
        }
        if (isset($data['direction_regionale']['id'])) {
            if (empty($data['direction_regionale']['id'])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['direction_regionale'] = $message;
            } else {
                $direction_Regionale = $this->em->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->find($data['direction_regionale']['id']);
                if (!$direction_Regionale) {
                    $message = ApiProblem::UNIITE_REGIONAL_DOES_NOT_EXIST;
                    $errors['direction_regionale'] = $message;
                }
            }
        }
        if (isset($data['direction_regionale'])) {
            if (empty($data['direction_regionale'])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['direction_regionale'] = $message;
            }
        }

        if (isset($data['centre_formation']['id'])) {
            if (empty($data['centre_formation']['id'])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['centre_formation'] = $message;
            } else {
                $centreFormation = $this->em->getRepository('MfpeCentreFormationBundle:CentreFormation')->find($data["centre_formation"]["id"]);
                if (!$centreFormation) {
                    $message = ApiProblem::CENTRE_FORMATION_DOES_NOT_EXIST;
                    $errors['centre_formation'] = $message;
                }
            }
        }
        if (isset($data['centre_formation'])) {
            if (empty($data['centre_formation'])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['centre_formation'] = $message;
            }
        }


        if (isset($data['premier_responsable'])) {
            if (empty($data["premier_responsable"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['premier_responsable'] = $message;
            }

        }

        //validate Code country NOT EMPTY
        if (empty($data["tel"]["dialCode"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['tel'] = $message;
        } else {

            if (!is_numeric($data["tel"]["dialCode"])) {
                $message = ApiProblem::TEL_NUMERIQUE;
                $errors['tel'] = $message;
            }

        }

        //validate number phone NOT EMPTY
        if (empty($data["tel"]["number"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['tel'] = $message;
        } else {
            if (!is_numeric($data["tel"]["number"])) {
                $message = ApiProblem::TEL_NUMERIQUE;
                $errors['tel'] = $message;
            } else {
                //validate num tel is 13 caractere
                if ($data["tel"]["dialCode"] === '216') {
                    if ($data["tel"]["number"] && strlen($data["tel"]["number"]) != 8) {
                        $message = ApiProblem::TEL_EQUAL_8;
                        $errors['tel'] = $message;
                    }
                }

            }
        }

        if (isset($data['email'])) {
            if (empty($data['email'])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['email'] = $message;
            } else {
                if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                    $message = ApiProblem::EMAIL_FALSE;
                    $errors['email'] = $message;
                }
            }
        }
        //validate fonction
        if (isset($data["fonction"])) {
            if (empty($data["fonction"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['fonction'] = $message;
            } else {
                $fonction = $this->em->getRepository('MfpeReferencielBundle:RefFonction')->find($data["fonction"]["id"]);
                if (!$fonction) {
                    $message = ApiProblem::FONCTION_DOES_NOT_EXIST;
                    $errors['fonction'] = $message;
                }
            }
        }
        //validate fonction
        if (isset($data["fonction"]["id"])) {
            if (empty($data["fonction"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['fonction'] = $message;
            } else {
                $fonction = $this->em->getRepository('MfpeReferencielBundle:RefFonction')->find($data["fonction"]["id"]);
                if (!$fonction) {
                    $message = ApiProblem::FONCTION_DOES_NOT_EXIST;
                    $errors['fonction'] = $message;
                }
            }
        }
        //validate structure
        if (isset($data["structure"])) {
            if (empty($data["structure"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['structure'] = $message;
            } else {
                $structure = $this->em->getRepository('MfpeReferencielBundle:RefStructure')->find($data["structure"]["id"]);
                if (!$structure) {
                    $message = ApiProblem::STRUCTURE_NOT_EXIST;
                    $errors['structure'] = $message;
                }
            }
        }

        //validate structure
        if (isset($data["structure"]["id"])) {
            if (empty($data["structure"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['structure'] = $message;
            } else {
                $structure = $this->em->getRepository('MfpeReferencielBundle:RefStructure')->find($data["structure"]["id"]);
                if (!$structure) {
                    $message = ApiProblem::STRUCTURE_NOT_EXIST;
                    $errors['structure'] = $message;
                }
            }
        }
        //Validate $role
        if (isset($data["roles"])) {
            if ($data["roles"] === 0 || $data["roles"] === "0") {
                //continue;
            } else {
                if (empty($data["roles"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors["roles"] = $message;
                }
                else
                {
                    foreach ($data["roles"] as $role) {
                        $roleExist = $this->em->getRepository('MfpeConfigBundle:Role')->find($role);
                        if (!is_object($roleExist)) {
                            // e.g. anonymous authentication
                            $message = ApiProblem::ROLES_DOES_NOT_EXIST;
                            $errors['role'] = $message;
                        }

                    }

                }
            }
        }


        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }
}