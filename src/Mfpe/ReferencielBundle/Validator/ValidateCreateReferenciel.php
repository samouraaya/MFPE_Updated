<?php


namespace Mfpe\ReferencielBundle\Validator;

use Doctrine\ORM\EntityManager;
use Mfpe\ReferencielBundle\Entity\RefDelaisDemande;
use Mfpe\ReferencielBundle\Entity\Referenciel;
use Mfpe\ReferencielBundle\Services\ReferencielService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use Mfpe\ConfigBundle\Exception\ApiProblem;

class ValidateCreateReferenciel
{

    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public function validateCreateReferenciel($paramFetcher)
    {
        $errors = [];
        //check if the intituleAr  is not empty
        if (empty($paramFetcher->get('intituleAr'))) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['intituleAr'] = $message;
        }
        //check if the intituleFr  is not empty
        if (empty($paramFetcher->get('intituleFr'))) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['intituleFr'] = $message;
        }
        //check if the referenciel categorie is not empty
        if (empty($paramFetcher->get('categorie'))) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['categorie'] = $message;
        }
        if ($paramFetcher->get('categorie') == 'RefSecteur') {

              if (empty($paramFetcher->get('typeSecteur'))) {
                  $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                  $errors['typeSecteur'] = $message;

          }

        }
        //check if the referenciel categorie is valid
        if (!Referenciel::checkIfValidCategorie($paramFetcher->get('categorie'))) {
            $message = ApiProblem::CATEGORIE_NOT_EXIST;
            $errors['categorie'] = $message;
        } else {
            //check if the referenciel categorie is not empty
            $ReferencielCode = ['RefDelaisDemande', 'RefDelegation', 'RefGouvernorat', 'RefLocalite', 'RefMunicipalite', 'RefNationalite', 'RefStatut'];
            $ReferencielParent = ['RefFonction', 'RefDelegation', 'RefMotif', 'RefLocalite', 'RefSousSecteur'];

            if (in_array($paramFetcher->get('categorie'), $ReferencielCode)) {
                if ($paramFetcher->get('code')) {
                    if (empty($paramFetcher->get('code'))) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['code'] = $message;
                    }
                }
            }
            if (in_array($paramFetcher->get('categorie'), $ReferencielParent)) {
                if (empty($paramFetcher->get('parent'))) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['parent'] = $message;
                }
            }
        }
        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }
    public function validateEditReferenciel($paramFetcher)
    {
        $errors = [];
        //check if the intituleAr  is not empty
        if (empty($paramFetcher->get('intituleAr'))) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['intituleAr'] = $message;
        }
        //check if the intituleFr  is not empty
        if (empty($paramFetcher->get('intituleFr'))) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['intituleFr'] = $message;
        }
        //check if the referenciel categorie is not empty
        if (empty($paramFetcher->get('categorie'))) {
            $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            $errors['categorie'] = $message;
        }
        //check if the referenciel categorie is valid
        if (!Referenciel::checkIfValidCategorie($paramFetcher->get('categorie'))) {
            $message = ApiProblem::CATEGORIE_NOT_EXIST;
            $errors['categorie'] = $message;
        } else {
            //check if the referenciel categorie is not empty
            $ReferencielCode = ['RefDelaisDemande', 'RefDelegation', 'RefGouvernorat', 'RefLocalite', 'RefMunicipalite', 'RefNationalite', 'RefStatut'];
            $ReferencielParent = ['RefFonction', 'RefDelegation', 'RefMotif', 'RefLocalite', 'RefSousSecteur'];

            if (in_array($paramFetcher->get('categorie'), $ReferencielCode)) {
                if ($paramFetcher->get('code')) {
                    if (empty($paramFetcher->get('code'))) {
                        $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                        $errors['code'] = $message;
                    }
                }
            }
            if (in_array($paramFetcher->get('categorie'), $ReferencielParent)) {
                if (empty($paramFetcher->get('parent'))) {
                    $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                    $errors['parent'] = $message;
                }
            }
        }
        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }
}