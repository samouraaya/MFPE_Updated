<?php


namespace Mfpe\CentreFormationBundle\Validator;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use Mfpe\ConfigBundle\Exception\ApiProblem;

class ValidateCreateSpecialite
{

    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function validateCreateSpecialite($data)
    {

        $errors = [];
        //validate secteur d'activite
        if (isset($data["secteur_activite"]["id"])) {
            if (empty($data["secteur_activite"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['secteur_activite'] = $message;
            } else {
                //validate domaine DOES NOT EXIST IN DATABASE
                $secteur = $this->em->getRepository('MfpeReferencielBundle:RefSecteur')->find($data["secteur_activite"]["id"]);
                if (!$secteur) {
                    $message = ApiProblem::SECTEUR_DOES_NOT_EXIST;
                    $errors['secteur_activite'] = $message;
                }
            }
        }
        //validate sous secteur d'activite
        if (isset($data["sousSecteur"]["id"])) {
            if (empty($data["sousSecteur"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['sousSecteur'] = $message;
            } else {
                //validate secteur DOES NOT EXIST IN DATABASE
                $sous_secteur = $this->em->getRepository('MfpeReferencielBundle:RefSousSecteur')->find($data["sousSecteur"]["id"]);
                if (!$sous_secteur) {
                    $message = ApiProblem::SOUS_SECTEUR_DOES_NOT_EXIST;
                    $errors['sous_secteur'] = $message;
                }
            }
        }
        //validate intitule_ar
        if (isset($data["intitule_ar"])) {
            if (empty($data["intitule_ar"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['intitule_ar'] = $message;
            }
        }
          //validate type
        if (isset($data["type"])) {
            if (empty($data["type"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['type'] = $message;
            }
        }
        //validate intitule_fr
        if (isset($data["intitule_fr"])) {
            if (empty($data["intitule_fr"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['intitule_fr'] = $message;
            }
        }
        //validate code specilite
        if (isset($data["code_specialite"])) {
            if (empty($data["code_specialite"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['code_specialite'] = $message;
            }
        }
        //validate frais specialite exam
        if (isset($data["frais_specialite_exam"])) {
            if (empty($data["frais_specialite_exam"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['frais_specialite_exam'] = $message;
            }
        }

        //validate niveau diplome
        if (isset($data["niveau_diplome"]["id"])) {
            if (empty($data["niveau_diplome"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['niveau_diplome'] = $message;
            } else {
                //validate niveau diplome DOES NOT EXIST IN DATABASE
                $niveau_diplome = $this->em->getRepository('MfpeReferencielBundle:RefNiveauDiplome')->find($data["niveau_diplome"]["id"]);
                if (!$niveau_diplome) {
                    $message = ApiProblem::NIVEAU_DIPLOME_DOES_NOT_EXIST;
                    $errors['niveau_diplome'] = $message;
                }
            }
        }
        //validate niveau etude
        if (isset($data["niveau_etude"]["id"])) {
            if (empty($data["niveau_etude"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['niveau_etude'] = $message;
            } else {
                //validate niveau etude DOES NOT EXIST IN DATABASE
                $niveau_etude = $this->em->getRepository('MfpeReferencielBundle:RefNiveauEtude')->find($data["niveau_etude"]["id"]);
                if (!$niveau_etude) {
                    $message = ApiProblem::NIVEAU_ETUDE_DOES_NOT_EXIST;
                    $errors['niveau_etude'] = $message;
                }
            }
        }


        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }
}