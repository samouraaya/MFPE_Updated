<?php


namespace Mfpe\UniteRegionaleBundle\Validator;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use Mfpe\ConfigBundle\Exception\ApiProblem;

class ValidateIdentiteRegion
{

    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }


    //fonction de validation formulaire region
    public function validateIdentiteRegion($data)
    {
        $errors = [];

        //validate gouvernorate
        if (isset($data["gouvernorat"]["id"])) {
            if (empty($data["gouvernorat"]["id"])) {
                $message = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                $errors['gouvernorat'] = $message;
            } else {
                //validate gouvernorat DOES NOT EXIST IN DATABASE
                $gouvernorate = $this->em->getRepository('MfpeReferencielBundle:RefGouvernorat')->find($data["gouvernorat"]["id"]);
                if (!$gouvernorate) {
                    $message = ApiProblem::GOUVERNERAT_DOES_NOT_EXIST;
                    $errors['gouvernorat'] = $message;
                }
            }
        }
        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }

}