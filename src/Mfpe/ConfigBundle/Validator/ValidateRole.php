<?php

namespace Mfpe\ConfigBundle\Validator;


use Doctrine\ORM\EntityManager;
use Mfpe\ReferencielBundle\Services\ReferencielService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\DependencyInjection\Container;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Mfpe\ConfigBundle\Entity\Role;

class ValidateRole
{

    private $em;
    private $container;

    // We need to inject this variables later.
    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    //fonction de validation formulaire region
    public function validateRole($data)
    {
        $errors = [];
        //validate nom directeur AR
        if (isset($data["role"])) {
            if (empty($data["role"])) {
                $errors['role'] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
            }
        }
        if (count($data["users"]) != 0) {
            foreach ($data["users"] as $key=>$identifiant) {
                if (empty($identifiant["id"])) {
                    $errors['users_'.$key] = ApiProblem::FIELD_REQUIRED_IS_EMPTY;
                } else {
                    $user = $this->em->getRepository('MfpeConfigBundle:AppUser')->find($identifiant["id"]);
                    if (!is_object($user)) {
                        $errors['users_'.$key] = ApiProblem::USER_DOES_NOT_EXIST;
                    }
                }
            }
        }
        if (isset($data["frontInterfaces"])) {
            if (!is_array($data["frontInterfaces"])) {
                $errors['frontInterfaces'] = ApiProblem::FIELD_NOT_COMPATIBLE;
            }
        }
        if (isset($data["status"])) {
            if (!is_array($data["status"])) {
                $errors['status'] = ApiProblem::FIELD_NOT_COMPATIBLE;
            }
        }
        if (isset($data["stateExecute"])) {
            if (!is_array($data["stateExecute"])) {
                $errors['stateExecute'] = ApiProblem::FIELD_NOT_COMPATIBLE;
            }
        }


        //validate intitule ar
        //$role = $this->em->getRepository(Role::class)->findBy(["intituleAr" =>$data["intitule_ar"]]);
//        $role = $this->em->getRepository('MfpeConfigBundle:Role')->findOneBy(["intituleAr" =>$data["intitule_ar"]]);
//        if($role instanceof Role){
//            $message = ApiProblem::ROLE_EXIST;
//            $errors['intitule_ar'] = $message;
//        }
//        //validate intitule fr
//        //$role = $this->em->getRepository(Role::class)->findBy(["intituleFr" =>$data["intitule_fr"]]);
//        $role = $this->em->getRepository('MfpeConfigBundle:Role')->findOneBy(["intituleFr" =>$data["intitule_fr"]]);
//        if($role instanceof Role){
//            $message = ApiProblem::ROLE_EXIST;
//            $errors['intitule_fr'] = $message;
//        }
        //validate role
        //$role = $this->em->getRepository(Role::class)->findBy(["role" =>$data["role"]]);
        $role = $this->em->getRepository('MfpeConfigBundle:Role')->findOneBy(["role" => $data["role"]]);

        if ($role instanceof Role) {
            $message = ApiProblem::ROLE_EXIST;
            $errors['role'] = $message;
        }

        return json_decode(json_encode($errors, JSON_UNESCAPED_UNICODE), true);
    }

}