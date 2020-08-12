<?php


namespace Mfpe\AttestationBundle\Validator;

use Doctrine\ORM\EntityManager;
use Mfpe\ReferencielBundle\Services\ReferencielService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use \DateTime;

class ValidateCreateDemande
{

    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }


    public function validateCreateDemande($data)
    {
        $errors = [];
        //validate secteur
        if (array_key_exists("secteur", $data)) {
            if (is_null($data["secteur"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['secteur'] = $message;
            }
            if (isset($data["secteur"]["id"])) {
                if (empty($data["secteur"]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['secteur'] = $message;
                } else {
                    //validate secteur DOES NOT EXIST IN DATABASE
                    $secteur = $this->em->getRepository('MfpeReferencielBundle:RefSecteur')->find($data["secteur"]["id"]);
                    if (!$secteur) {
                        $message = ApiProblem::SECTEUR_DOES_NOT_EXIST;
                        $errors['secteur'] = $message;
                    }
                }
            }
        }
        //validate sous  secteur
        if (array_key_exists("sousSecteur", $data)) {
            if (is_null($data["sousSecteur"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['sousSecteur'] = $message;
            }
            if (isset($data["sousSecteur"]["id"])) {
                if (empty($data["sousSecteur"]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['sousSecteur'] = $message;
                } else {
                    //validate sous secteur DOES NOT EXIST IN DATABASE
                    $sousSecteur = $this->em->getRepository('MfpeReferencielBundle:RefSousSecteur')->find($data["sousSecteur"]["id"]);
                    if (!$sousSecteur) {
                        $message = ApiProblem::SOUS_SECTEUR_DOES_NOT_EXIST;
                        $errors['sousSecteur'] = $message;
                    }
                }
            }
        }
        //validate specialite centre formation
        if (array_key_exists("specialite", $data)) {
            if (is_null($data["specialite"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['specialite'] = $message;
            }
            if (isset($data["specialite"]["id"])) {
                if (empty($data["specialite"]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['specialite'] = $message;
                } else {
                    //validate specialite DOES NOT EXIST IN DATABASE
                    $specialite = $this->em->getRepository('MfpeCentreFormationBundle:Specialite')->findOneBy(array('id' => $data["specialite"]["id"]));
                    if (!$specialite) {
                        $message = ApiProblem::SPECIALITE_NOT_EXIST;
                        $errors['specialite'] = $message;
                    }
                }
            }
        }
        //validate specialite citoyen
        if (isset($data["specialite_citoyen"])) {
            if (empty($data["specialite_citoyen"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['specialite_citoyen'] = $message;
            }
        }
        //validate  justifs experiences
        $justifExperience = ["ATTESTATION_TRAVAIL", "DEUX_TEMOINS", "ATTESTATION_TEMOINS"];
        if (isset($data["justificatif_experience"])) {
            if (empty($data["justificatif_experience"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['justificatif_experience'] = $message;
            } else {
                if (!in_array($data["justificatif_experience"], $justifExperience)) {
                    $message = ApiProblem::FIELD_NOT_VALID;
                    $errors['justificatif_experience'] = $message;
                }
            }
//            if (in_array($data["justificatif_experience"], $justifExperience)) {
//                if (isset($data["nom_employeur"])) {
//                    if (empty($data["nom_employeur"])) {
//                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//                        $errors['nom_employeur'] = $message;
//                    }
//                }
//                if (isset($data["adresse_entreprise"])) {
//                    if (empty($data["adresse_entreprise"])) {
//                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//                        $errors['adresse_entreprise'] = $message;
//                    }
//                }
//
//            }

        }

        //attestation de formation
        if (isset($data["attestation_formation"])) {
            if ($data["attestation_formation"] === 0) {
                //continue;
            } else {
                if (empty($data["attestation_formation"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['attestation_formation'] = $message;
                } else {
                    if (!in_array($data["attestation_formation"], array(0, 1))) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['attestation_formation'] = $message;
                    } else {
                        if ($data["attestation_formation"] = 1) {
                            if (isset($data["nom_employeur"])) {
                                if (empty($data["nom_employeur"])) {
                                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    $errors['nom_employeur'] = $message;
                                }
                            }
                            if (isset($data["adresse_entreprise"])) {
                                if (empty($data["adresse_entreprise"])) {
                                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                    $errors['adresse_entreprise'] = $message;
                                }
                            }
                        }

                    }
                }
            }
        }
        //validate attestation formation NOT EMPTY
//            if (isset($data["attestation_formation"])) {
//                if ($data["attestation_formation"] == 1) {
//                    if (isset($data["nom_employeur"])) {
//                        if (empty($data["nom_employeur"])) {
//                            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//                            $errors['nom_employeur'] = $message;
//                        }
//                    }
//                    //validate adresse entreprise de l'attestation
//                    if (isset($data["adresse_entreprise"])) {
//                        if (empty($data["adresse_entreprise"])) {
//                            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
//                            $errors['adresse_entreprise'] = $message;
//                        }
//                    }
//                }
//            }
        //validate adresse residence actuelle
        if (isset($data["adresse_residence_actuelle"])) {
            if (empty($data["adresse_residence_actuelle"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['adresse_residence_actuelle'] = $message;
            }
        }
        //validate gouvernerat
        if (array_key_exists("gouvernorat", $data)) {
            if (is_null($data["gouvernorat"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['gouvernorat'] = $message;
            }
            if (isset($data["gouvernorat"]["id"])) {
                if (empty($data["gouvernorat"]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['gouvernorat'] = $message;
                } else {
                    //validate gouvernorat DOES NOT EXIST IN DATABASE
                    $gouvernorat = $this->em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["gouvernorat"]["id"]);
                    if (!$gouvernorat) {
                        $message = ApiProblem::GOUVERNERAT_DOES_NOT_EXIST;
                        $errors['gouvernorat'] = $message;
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
                    $delegation = $this->em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["delegation"]);
                    if (!$delegation) {
                        $message = ApiProblem::DELEGATION_DOES_NOT_EXIST;
                        $errors['delegation_not_exist'] = $message;
                    }
                }
            }
        }


        //validate gouvernerat residence
        if (array_key_exists("gouvernorat_residence", $data)) {
            if (is_null($data["gouvernorat_residence"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['gouvernorat_residence'] = $message;
            }
            if (isset($data["gouvernorat_residence"]["id"])) {
                if (empty($data["gouvernorat_residence"]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['gouvernorat_residence'] = $message;
                } else {
                    //validate gouvernorat DOES NOT EXIST IN DATABASE
                    $gouvernorat = $this->em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["gouvernorat_residence"]["id"]);
                    if (!$gouvernorat) {
                        $message = ApiProblem::GOUVERNERAT_DOES_NOT_EXIST;
                        $errors['gouvernorat_residence'] = $message;
                    }
                }
            }
        }
        //validate delegation residence
        if (array_key_exists("delegation_residence", $data)) {
            if (is_null($data["delegation_residence"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['delegatio_residencen'] = $message;
            }
            if (isset($data["delegation_residence"]["id"])) {
                if (empty($data["delegation_residence"]["id"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['delegation_residence'] = $message;
                } else {
                    //validate delegation DOES NOT EXIST	IN DATABASE
                    $delegation = $this->em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["delegation_residence"]);
                    if (!$delegation) {
                        $message = ApiProblem::DELEGATION_DOES_NOT_EXIST;
                        $errors['delegation_residence'] = $message;
                    }
                }
            }
        }
        //validate current statut
        if (isset($data["current_statut"])) {
            if (empty($data["current_statut"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['current_statut'] = $message;
            } else {
                //validate status DOES NOT EXIST	IN DATABASE
                $currentStatus = $this->em->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array('code' => $data["current_statut"]));
                if (!$currentStatus) {
                    $message = ApiProblem::STATUT_NOT_VALID;
                    $errors['current_statut'] = $message;
                }
            }
        }
        //validation projet
        if (isset($data["projet"])) {
            if ($data["projet"] === 0) {
                //continue;
            } else {
                if (empty($data["projet"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['projet'] = $message;
                } else {
                    if (!in_array($data["projet"], array(0, 1))) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['projet'] = $message;
                    }
                }
            }
        }
        //validate adresse projet  NOT EMPTY
        if (isset($data["projet"])) {
            if ($data["projet"] == 1) {
                //validate adresse projet  NOT EMPTY
                if (isset($data["adresse_projet"])) {
                    if (empty($data["adresse_projet"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['adresse_projet'] = $message;
                    }
                }
                //validate gouvernorat projet  NOT EMPTY
                if (array_key_exists("gouvernorat_projet", $data)) {
                    if (is_null($data["gouvernorat_projet"]["id"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['gouvernorat_projet'] = $message;
                    }
                    if (isset($data["gouvernorat_projet"]["id"])) {
                        if (empty($data["gouvernorat_projet"]["id"])) {
                            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                            $errors['gouvernorat_projet'] = $message;
                        } else {
                            $gouvernorat = $this->em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["gouvernorat_projet"]["id"]);
                            if (!$gouvernorat) {
                                $message = ApiProblem::GOUVERNERAT_DOES_NOT_EXIST;
                                $errors['gouvernorat_projet'] = $message;
                            }
                        }
                    }
                }
                //validate delegation projet  NOT EMPTY
                if (array_key_exists("delegation_projet", $data)) {
                    if (is_null($data["delegation_projet"]["id"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['delegation_projet'] = $message;
                    }
                    if (isset($data["delegation_projet"]["id"])) {
                        if (empty($data["delegation_projet"]["id"])) {
                            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                            $errors['delegation_projet'] = $message;
                        } else {
                            $delegation = $this->em->getRepository('MfpeReferencielBundle:Referenciel')->find($data["delegation_projet"]["id"]);
                            if (!$delegation) {
                                $message = ApiProblem::DELEGATION_DOES_NOT_EXIST;
                                $errors['delegation_projet'] = $message;
                            }
                        }
                    }
                }
            }
            //validate direction regionale projet  NOT EMPTY
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
        }
        if (isset($data["action"])) {
            $action_value = array(0, 1);
            if (!array_key_exists($data['action'], $action_value)) {
                $message = ApiProblem::ACTION_NOT_EXIST;
                $errors['action'] = $message;
            }
            $all_status = array();
            $refStatuts = $this->em->getRepository('MfpeReferencielBundle:RefStatut')->findAll();
            foreach ($refStatuts as $statut) {
                array_push($all_status, $statut->getCode());
            }

            if (isset($data["statut"]) && empty($data["statut"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['statut'] = $message;
            } elseif (!in_array($data['statut'], $all_status)) {
                $message = ApiProblem::STATUT_DOES_NOT_EXIST;
                $errors['statut'] = $message;
            }
            // validate accept demande
            if ($data['action'] == 1) {
                $value_accept = array("ATTENTE_DR", "SPECIALITE_CHOISIE", "SCAN_OK", "CENTRE_OK", "ATTENTE_PAIEMENT", "PAIEMENT_OK", "DATE_EXAM_OK", "RE_DATE_EXAM_OK", "PV_UPLOAD", "PV_ACCEPTE", "ATTESTATION_OK");
                if (isset($data["statut"]) && empty($data["statut"])) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['statut'] = $message;
                } elseif (!in_array($data['statut'], $value_accept)) {
                    $message = ApiProblem::STATUT_DOES_NOT_EXIST;
                    $errors['statut'] = $message;
                }
                if (in_array($data['statut'], $value_accept)) {
                    //validate centre formation  NOT EMPTY
                    if (array_key_exists("centre_formation", $data)) {
                        if (is_null($data["centre_formation"]["id"])) {
                            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                            $errors['centre_formation'] = $message;
                        }
                        if (isset($data["centre_formation"]["id"])) {
                            if (empty($data["centre_formation"]["id"])) {
                                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                $errors['centre_formation'] = $message;
                            } else {
                                $centre_formation = $this->em->getRepository('MfpeCentreFormationBundle:CentreFormation')->find($data["centre_formation"]["id"]);
                                if (!is_object($centre_formation)) {
                                    $message = ApiProblem::CENTRE_FORMATION_DOES_NOT_EXIST;
                                    $errors['centre_formation'] = $message;
                                }
                            }
                        }
                    }
                    //validate specialite centre formation  NOT EMPTY
                    if (array_key_exists("specialite", $data)) {
                        if (is_null($data["specialite"]["id"])) {
                            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                            $errors['specialite'] = $message;
                        }
                        if (isset($data["specialite"]["id"])) {
                            if (empty($data["specialite"]["id"])) {
                                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                $errors['specialite'] = $message;
                            } else {
                                $specialite = $this->em->getRepository('MfpeCentreFormationBundle:Specialite')->find($data["specialite"]["id"]);
                                if (!$specialite) {
                                    $message = ApiProblem::SPECIALITE_NOT_EXIST;
                                    $errors['specialite'] = $message;
                                }
                            }
                        }
                    }
                }
            } else {
                // validate refus demande
                if ($data['action'] == 0) {
                    $value_refuse = array("REFUSE_DR", "REFUS_CENTRE", "PAIEMENT_KO", "PV_REFUSE", "ATTESTATION_KO", "CONDIDAT_ABSENT");
                    if (isset($data["statut"]) && empty($data["statut"])) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['statut'] = $message;
                    } elseif (!in_array($data['statut'], $value_refuse)) {
                        $message = ApiProblem::STATUT_DOES_NOT_EXIST;
                        $errors['statut'] = $message;
                    }
                    if (in_array($data['statut'], $value_refuse)) {
                        if (isset($data['motif']['id'])) {
                            if (empty($data['motif']['id'])) {
                                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                                $errors['motif'] = $message;
                            }
                        }
                    }
                }
            }
        }
        if (isset($data['date_exam'])) {
            if (empty($data['date_exam'])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['date_exam'] = $message;
            } else {
                if ($this->is_date($data['date_exam']) === false) {
                    $message = ApiProblem::DATE_NOT_VALID;
                    $errors['date_exam'] = $message;
                }
            }
//            else {
//                $dateExam = $this->em->getRepository('MfpeAttestationBundle:DateExam')->findOneBy(array('id' => $data["date_exam"]["id"]));
//                if (!$dateExam) {
//                    $message = ApiProblem::DATE_EXAMIN_NOT_EXIST;
//                    $errors['date_exam'] = $message;
//                }
//            }
        }


        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }

    public function validateExportAttestation($data)
    {
        $errors = [];

        if (isset($data['date_naissance'])) {
            if (empty($data["date_naissance"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['date_naissance'] = $message;
            } else {
                if (!strtotime($data["date_naissance"])) {
                    $message = ApiProblem::DATE_NAISSANCE_NOT_VALID;
                    $errors['date_naissance'] = $message;
                }
            }
        }
        if (isset($data['numero_cin'])) {
            if (empty($data["numero_cin"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['numero_cin'] = $message;
            }
            if ($data["numero_cin"] && !is_numeric($data["numero_cin"])) {
                $message = ApiProblem::CIN_NOT_NUMERIC;
                $errors['numero_cin'] = $message;
            }
            //validate num cin is 8 caractere
            if ($data["numero_cin"] && is_numeric($data["numero_cin"]) && strlen($data["numero_cin"]) != 8) {
                $message = ApiProblem::CIN_EQUAL_8;
                $errors['numero_cin'] = $message;
            }
        }

        if (isset($data['numero_attestation'])) {
            if (empty($data["numero_attestation"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['numero_attestation'] = $message;
            }
        }
        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }

    private function is_date($date)
    {
        if (date_create($date) === false) {
            return false;
        } else
            return true;
    }


    public function validatePatchDemande($demande, $specialite)

    {
        $statusEncours = array(
            'ATTENTE_DR',
            'SPECIALITE_CHOISIE',
            'SCAN_OK',
            'CENTRE_OK',
            'ATTENTE_PAIEMENT',
            'DATE_EXAM_OK',
            'RE_DATE_EXAM_OK',
            'PV_UPLOAD',
            'PV_ACCEPTE',
            'REFUS_CENTRE'
        );
        $statusClotures = array(
            'REFUSE_DR',
            'ATTESTATION_KO',
            'ATTESTATION_OK',
            'PAIEMENT_OK'
        );
        $refStatutsEncours = $this->em->getRepository('MfpeReferencielBundle:RefStatut')->findBy(
            array('code' => $statusEncours)
        );
        $refStatutsCloture = $this->em->getRepository('MfpeReferencielBundle:RefStatut')->findBy(
            array('code' => $statusClotures)
        );
        $specialiteChoisi = $this->em->getRepository('MfpeCentreFormationBundle:Specialite')->find($specialite);
        $demandesEncours = $this->em->getRepository('MfpeAttestationBundle:Demande')->findOneBy(
            array('user' => $demande->getUser(), 'specialite' => $specialiteChoisi, 'currentStatut' => $refStatutsEncours)
        );
        $demandesClotures = $this->em->getRepository('MfpeAttestationBundle:Demande')->findBy(
            array('user' => $demande->getUser(), 'specialite' => $specialiteChoisi, 'currentStatut' => $refStatutsCloture)
        );
        $errors = [];
        if (is_object($demandesEncours)) {
            $message = ApiProblem::SPECIALITE_FOUND;
            $errors['specialite'] = $message;
        }
        if ($demandesClotures) {
            foreach ($demandesClotures as $ddeCloture) {
                $dateCreationdde = $ddeCloture->getCreatedAt();
                $dateJour = new DateTime();
                $interval = $dateJour->diff($dateCreationdde);
                $nbMonth = $interval->format('%m');
                $categorie = 'RefDelaisDemande';
                $entityname = "MfpeReferencielBundle:" . $categorie;
                $referencielsDelais = $this->em->getRepository($entityname)->findOneBy(array(), array('createdAt' => 'DESC'));;
                if (is_object($referencielsDelais)) {
                    $delaisRef = $referencielsDelais->getCode();
                    if ($nbMonth < $delaisRef) {
                        $message = ApiProblem::SPECIALITE_FOUND_PERIODE;
                        $errors['specialite'] = $message;
                    }
                }
            }
        }
        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }


    public function validateTransfertDemande($data, $demande)
    {
        $errors = [];
        $statuts = ['SPECIALITE_CHOISIE', 'ATTENTE_DR'];
        $arrayStatuts=[];
        foreach ($statuts as $statut) {
            $refstatut = $this->em->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array('code' => $statut));
            array_push($arrayStatuts, $refstatut);
        }
        if (!in_array($demande->getCurrentStatut(), $arrayStatuts))
        {
                $message = ApiProblem::DEMANDE_NOT_UPDATE;
                $errors['statut'] = $message;

        }
        //validate direction regionale projet  NOT EMPTY
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


        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }
}
