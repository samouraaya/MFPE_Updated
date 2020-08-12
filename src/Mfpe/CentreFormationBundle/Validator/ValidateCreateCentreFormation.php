<?php


namespace Mfpe\CentreFormationBundle\Validator;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use Mfpe\ConfigBundle\Exception\ApiProblem;

class ValidateCreateCentreFormation
{

    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function validateCreateCentreFormation($data, $centreFormation)
    {

        $errors = [];
        //validate intitule_ar
        if (isset($data["intitule_ar"])) {
            if (empty($data["intitule_ar"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['intitule_ar'] = $message;
            }
        }
        //validate intitule_fr
        if (isset($data["intitule_fr"])) {
            if (empty($data["intitule_fr"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['intitule_fr'] = $message;
            }
        }
        //validate adresse
        if (isset($data["adresse"])) {
            if (empty($data["adresse"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['adresse'] = $message;
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

        //validate fax
        if (empty($data["fax"]["dialCode"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['fax'] = $message;
        } else {
            if (!is_numeric($data["fax"]["dialCode"])) {
                $message = ApiProblem::FAX_NUMERIQUE;
                $errors['fax'] = $message;
            } else {
                //validate num fax is 8 caractere
                if ($data["fax"]["dialCode"] === '216') {
                    if ($data["fax"]["number"] && strlen($data["fax"]["number"]) != 8) {
                        $message = ApiProblem::FAX_EQUAL_8;
                        $errors['fax'] = $message;
                    }
                }
            }
        }

        if (isset($data['email'])) {
            if (empty($data['email'])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['email'] = $message;
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $message = ApiProblem::EMAIL_FALSE;
                $errors['email'] = $message;
            } else {
                if ($centreFormation) {
                    $centreFormationExist = $this->em->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("email" => $data["email"]));
                    if ($centreFormationExist) {
                        if ($centreFormation->getId() != $centreFormationExist->getId()) {
                            $message = ApiProblem::EMAIL_EXIST_IN_DATABASE;
                            $errors['email'] = $message;
                        }
                    }
                } else {
                    //Check if the email already exist to enforce the unique constraint for the attribute. Return 409 response
                    $EmailExist = $this->em->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => $data["email"]));
                    if ($EmailExist) {
                        $message = ApiProblem::EMAIL_EXIST_IN_DATABASE;
                        $errors['email'] = $message;
                    }
                }
            }
        }
        //validate nom directeur AR
        if (isset($data["nom_directeur_ar"])) {
            if (empty($data["nom_directeur_ar"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nom_directeur_ar'] = $message;
            }
        }

        //validate nom directeur FR
        if (isset($data["nom_directeur_fr"])) {
            if (empty($data["nom_directeur_fr"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nom_directeur_fr'] = $message;
            }
        }

        //validate annee creation
        if (isset($data["annee_creation"])) {
            if (empty($data["annee_creation"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['annee_creation'] = $message;
            }
        }
        //validate capacite acceuil
        if (isset($data["capacite_acceuil"])) {
            if (empty($data["capacite_acceuil"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['capacite_acceuil'] = $message;
            }
        }
        //validate gouvernorat
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

        //validate delegation
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
        //type
        if (isset($data["type"])) {
            if (!empty($data["type"])) {
                if (!in_array($data["type"], [1, 2, 3])) {
                    $message = ApiProblem::TYPES_DOES_NOT_EXIST;
                    $errors['type'] = $message;
                }

                if ($data["type"] == 1 || $data["type"] == 2) {
                    //validate organisme
                    if (isset($data["organisme"])) {
                        if (empty($data["organisme"])) {
                            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                            $errors['organisme'] = $message;
                        }
                    }
                } elseif ($data["type"] == 3) {
                    //validate numero enregistrement
                    if (isset($data["numero_enregistrement"])) {
                        if (empty($data["numero_enregistrement"])) {
                            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                            $errors['numero_enregistrement'] = $message;
                        }
                    }
                }
            }
        }
        //validate specialite
        if (count($data["specialites"]) == 0) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors["specialites"] = $message;
        } else {
            foreach ($data["specialites"] as $key => $specialite) {
                //Validate nbr_total
                if (is_null($data["specialites"][$key]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['specialite_' . $key] = $message;
                }
                if (isset($data["specialites"][$key]["id"])) {
                    if (empty($data["specialites"][$key]["id"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['specialite_' . $key] = $message;
                    } else {
                        //validate specialite DOES NOT EXIST IN DATABASE
                        $specialite = $this->em->getRepository('MfpeCentreFormationBundle:Specialite')->find($data["specialites"][$key]["id"]);

                        if (!$specialite) {
                            $message = ApiProblem::SPECIALITE_NOT_EXIST;
                            $errors['specialite_' . $key] = $message;
                        }
                    }
                }
            }
        }


        //validate nombre formateur
        if (isset($data["nombre_formateur"])) {
            if (empty($data["nombre_formateur"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nombre_formateur'] = $message;
            }
        }

        //validate nbre cadre administratif
        if (isset($data["nbre_cadre_administratif"])) {
            if (empty($data["nbre_cadre_administratif"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nbre_cadre_administratif'] = $message;
            }
        }
        //validate capacite hybergement
        if (isset($data["capacite_hybergement"])) {
            if (empty($data["capacite_hybergement"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['capacite_hybergement'] = $message;
            }
        }

        //validate capacite resto
        if (isset($data["capacite_resto"])) {
            if (empty($data["capacite_resto"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['capacite_resto'] = $message;
            }
        }

        $roles = $this->em->getRepository('MfpeConfigBundle:Role')->findByRole('ROLE_AGENT_CENTRE_FORMATION');
        //validate role ROLE_AGENT_CENTRE
        if (!$roles) {
            $message = ApiProblem::ROLE_DOES_NOT_EXIST;
            $errors['roles'] = $message;
        }
        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }

    public function validateEditCentreFormation($data, $centreFormation)
    {

        $errors = [];
        //validate intitule_ar
        if (isset($data["intitule_ar"])) {
            if (empty($data["intitule_ar"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['intitule_ar'] = $message;
            }
        }
        //validate intitule_fr
        if (isset($data["intitule_fr"])) {
            if (empty($data["intitule_fr"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['intitule_fr'] = $message;
            }
        }
        //validate adresse
        if (isset($data["adresse"])) {
            if (empty($data["adresse"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['adresse'] = $message;
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

        //validate fax
        if (empty($data["fax"]["dialCode"])) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['fax'] = $message;
        } else {
            if (!is_numeric($data["fax"]["dialCode"])) {
                $message = ApiProblem::FAX_NUMERIQUE;
                $errors['fax'] = $message;
            } else {
                //validate num fax is 8 caractere
                if ($data["fax"]["dialCode"] === '216') {
                    if ($data["fax"]["number"] && strlen($data["fax"]["number"]) != 8) {
                        $message = ApiProblem::FAX_EQUAL_8;
                        $errors['fax'] = $message;
                    }
                }
            }
        }

        if (isset($data['email'])) {
            if (empty($data['email'])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['email'] = $message;
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $message = ApiProblem::EMAIL_FALSE;
                $errors['email'] = $message;
            } else {
                if ($centreFormation) {
                    $centreFormationExist = $this->em->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("email" => $data["email"]));
                    if ($centreFormationExist) {
                        if ($centreFormation->getId() != $centreFormationExist->getId()) {
                            $message = ApiProblem::EMAIL_EXIST_IN_DATABASE;
                            $errors['email'] = $message;
                        }
                    }
                } else {
                    //Check if the email already exist to enforce the unique constraint for the attribute. Return 409 response
                    $EmailExist = $this->em->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => $data["email"]));
                    if ($EmailExist) {
                        $message = ApiProblem::EMAIL_EXIST_IN_DATABASE;
                        $errors['email'] = $message;
                    }
                }
            }
        }
        //validate nom directeur AR
        if (isset($data["nom_directeur_ar"])) {
            if (empty($data["nom_directeur_ar"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nom_directeur_ar'] = $message;
            }
        }

        //validate nom directeur FR
        if (isset($data["nom_directeur_fr"])) {
            if (empty($data["nom_directeur_fr"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nom_directeur_fr'] = $message;
            }
        }

        //validate annee creation
        if (isset($data["annee_creation"])) {
            if (empty($data["annee_creation"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['annee_creation'] = $message;
            }
        }
        //validate capacite acceuil
        if (isset($data["capacite_acceuil"])) {
            if (empty($data["capacite_acceuil"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['capacite_acceuil'] = $message;
            }
        }
        //validate gouvernorat
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

        //validate delegation
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
        //type
        if (isset($data["type"])) {
            if (!empty($data["type"])) {
                if (!in_array($data["type"], [1, 2, 3])) {
                    $message = ApiProblem::TYPES_DOES_NOT_EXIST;
                    $errors['type'] = $message;
                }
                if ($data["type"] == $centreFormation->getType()) {
                    if ($data["type"] == 1 || $data["type"] == 2) {
                        //validate organisme
                        if (isset($data["organisme"])) {
                            if (empty($data["organisme"])) {
                                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                $errors['organisme'] = $message;
                            }
                        }
                    } elseif ($data["type"] == 3) {
                        //validate numero enregistrement
                        if (isset($data["numero_enregistrement"])) {
                            if (empty($data["numero_enregistrement"])) {
                                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                $errors['numero_enregistrement'] = $message;
                            }
                        }
                    }
                }
            }
        }
        //validate specialite
        if (count($data["specialites"]) == 0) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors["specialites"] = $message;
        } else {
            foreach ($data["specialites"] as $key => $specialite) {
                //Validate nbr_total
                if (is_null($data["specialites"][$key]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['specialite_' . $key] = $message;
                }
                if (isset($data["specialites"][$key]["id"])) {
                    if (empty($data["specialites"][$key]["id"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['specialite_' . $key] = $message;
                    } else {
                        //validate specialite DOES NOT EXIST IN DATABASE
                        $specialite = $this->em->getRepository('MfpeCentreFormationBundle:Specialite')->find($data["specialites"][$key]["id"]);

                        if (!$specialite) {
                            $message = ApiProblem::SPECIALITE_NOT_EXIST;
                            $errors['specialite_' . $key] = $message;
                        }
                    }
                }
            }
        }


        //validate nombre formateur
        if (isset($data["nombre_formateur"])) {
            if (empty($data["nombre_formateur"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nombre_formateur'] = $message;
            }
        }

        //validate nbre cadre administratif
        if (isset($data["nbre_cadre_administratif"])) {
            if (empty($data["nbre_cadre_administratif"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['nbre_cadre_administratif'] = $message;
            }
        }
        //validate capacite hybergement
        if (isset($data["capacite_hybergement"])) {
            if (empty($data["capacite_hybergement"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['capacite_hybergement'] = $message;
            }
        }

        //validate capacite resto
        if (isset($data["capacite_resto"])) {
            if (empty($data["capacite_resto"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['capacite_resto'] = $message;
            }
        }

        $roles = $this->em->getRepository('MfpeConfigBundle:Role')->findByRole('ROLE_AGENT_CENTRE_FORMATION');
        //validate role ROLE_AGENT_CENTRE
        if (!$roles) {
            $message = ApiProblem::ROLE_DOES_NOT_EXIST;
            $errors['roles'] = $message;
        }
        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }
}