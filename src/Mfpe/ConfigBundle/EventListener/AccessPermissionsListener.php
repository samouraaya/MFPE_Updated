<?php


namespace Mfpe\ConfigBundle\EventListener;

use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\EntityManagerInterface;
use Mfpe\ConfigBundle\Entity\FrontInterface;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\Response;// For example I will throw 403, if access denied
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


class AccessPermissionsListener
{

    private $tokenStorage;
    private $em;

    //private $container;

    public function __construct(TokenStorageInterface $tokenStorage, EntityManagerInterface $entityManager)
    {
        $this->tokenStorage = $tokenStorage;
        $this->em = $entityManager;
        //$this->container = $container;
    }


    /**
     * {@inheritdoc}
     */
    public function onKernelRequest(GetResponseEvent $event)
    {
//        $permission = "";
//        $tabMethod = array('POST', 'PUT');
//        $tabUrlAllowedGet = array("/api/user/auth/login","/api/users/change_password","/api/identityRegion", "/api/referenciel/filtre/RefGouvernorat", "/api/users/all-agents", "/api/users/", "/api/doc", "/api/home/roues", "/api/specialite", "/api/centreFormation", "/api/users/all", "/api/uniteRegionale", "/api/region", "/api/referenciel/all", "/api/notification", "/api/user/roles/front-interface", "/api/doc", "/api/home/detail-region","/api/editique/professional_qualification","/api/editique/socio_economic/statistic_general","/api/editique/bts-bypage","/api/editique/BTS/csv");
//        $tabUrlAllowedPost = array("/api/doc", "/api/users/", "/api/identityRegion","/api/users/change_password", "/api/users/reset_password", "/api/user/auth/login", "/api/users/inscription", "/api/demande/export-attestation_pdf", "/api/demande/export_pdf", "/api/demande/export-convocation_pdf", "/api/users/export_pdf", "/api/doc");
//        $request = $event->getRequest();
//        $tabUrlBakend = array();
//        $tabParams = array();
//        $tabParamsPost = array();
//        //récupérer l'url du request
//        $path = $request->getPathInfo();
//        //eliminer le le du path
//        $path = rtrim($path, '/');
//        //recupérer la method de la request
//        $method = $request->getMethod();
//        //récupérer les paramétres de la requetes Get
//        $params = $event->getRequest()->query->all();
//        //return les interfaces du users connecté
//        $frontInterface = $this->interfaceUsersConnecte();
//        foreach ($frontInterface as $frontInterf) {
//            $frontInterface = $this->em->getRepository(FrontInterface::class)->findOneBy(['code' => $frontInterf]);
//            if (is_object($frontInterface)) {
//                //  mettre les urlBakend et les les parametres dans un tableau
//                array_push($tabUrlBakend, $frontInterface->geturlBackEnd());
//                if ($frontInterface->getParametres() != null) {
//                    //mettre les params du post dans un tableau
//                    $paramInterface = $frontInterface->getParametres();
//
//                    if ($method == 'POST' || $method == 'PUT' || $method == 'PATCH') {
//                        //récupérer le json de l'api Post
//                        $data = json_decode($request->getContent(), true);
//                        //convertir les params  de l'interface en array
//                        $params = $this->convertParamPostOnArray($paramInterface);
//                        //  mettre les params du post de l'interface dans un tableau
//                        array_push($tabParamsPost, $params);
//                    }
//                    array_push($tabParams, $paramInterface);
//                }
//            }
//
//
//        }
////        dump($tabUrlBakend);
////        dump($path);
////        dump($tabParams);
//
//
//        //traitement de la request selon la methode
//        //tester si l'url est authorisé ou nn
//        $economicDAta = '/api/csv/economic_data';
//        if ($method == 'GET' && !in_array($path, $tabUrlAllowedGet)) {
//            if ((strpos($path, "/api/demande/archive") === false) && (strpos($path, "/api/users/") === false) && (strpos($path, "/api/referenciel/filtre/") === false)) {
//
//                $permission = $this->checkPermissionMehodGet($path, $tabUrlBakend, $tabParams, $params, $method);
//            }
//        } else if (in_array($method, $tabMethod) && !in_array($path, $tabUrlAllowedPost) && (strpos($path, "/api/paper/upload-pv/") === false)) {
//
//            if (strpos($path, "/api/paper/upload/") === false) {
//
//                if (in_array($economicDAta, $tabUrlAllowedPost) && strpos($path, "/api/csv/economic_data") === false) {
//
//                    $permission = $this->checkPermissionMehodPost($path, $tabUrlBakend, $tabParamsPost, $data, $method);
//
//                }
//
//            }
//        }
//        if ($permission === false) {
//            $event->setResponse(new JsonResponse(['status' => 'error', 'code' => Response::HTTP_FORBIDDEN, 'data' => ApiProblem::ACCESS_FORBIDDEN, 'message' => ApiProblem::ACCESS_FORBIDDEN], Response::HTTP_FORBIDDEN));
//            return;
//        }

    }

    //return permission path
    public function permissionPathWithoutParam($path, $tabUrlBakend)
    {
        $permissionPath = false;
        foreach ($tabUrlBakend as $urlBackend) {
            if (!empty($urlBackend)) {
                $pos = strpos($path, $urlBackend);
                if ($pos !== false) {
                    $permissionPath = true;
                }
            }
        }

        return $permissionPath;
    }

    //return permission tab parametres Get (l'intersection entre $tabParams et $keyValues)
    public function permissionTabParamGet($tabParams, $keyValues)
    {
        $valueKey = array();
        $permission = false;
        foreach ($tabParams as $key => $value) {
            $valueKey = $this->convertParamPostOnArray($value);
            $result = array_intersect_assoc($keyValues, $valueKey);
            if (count($result) == count($keyValues)) {
                $permission = true;
                break;
            }
        }
        return $permission;
    }

    //return permission tab parametres Post (l'intersection entre $tabParams et $keyValues)
    public function permissionTabParamPost($tabParams, $keyValues)
    {
        $permission = false;
        foreach ($tabParams as $key => $value) {
            $result = array_intersect_assoc($keyValues, $value);
            if ($result) {
                $permission = true;
                break;
            }
        }
        return $permission;
    }

    //return les interfaces du users connecté
    public function interfaceUsersConnecte()
    {
        $frontInterface = array();
        $frontI = array();
        if ($this->tokenStorage->getToken() != null && $this->tokenStorage->getToken()->getUser() != "anon.") {
            //récupérer le user connecté à partir du tocken
            $user = $this->tokenStorage->getToken()->getUser();
            //récupérer les roles du user connecté à partir du tocken
            $roles = $user->getUserRoles();
            foreach ($roles as $role) {
                //stocker les frontInterfaces du user connecté
                array_push($frontInterface, $role->getFrontInterfaces());
            }
            //faire le merge des interface et éliminer les niveaux
            $allFrontToSee = array_merge([], ...$frontInterface);
            //eliminer les doublon du tableau
            $frontI = array_unique($allFrontToSee);
        }
        return $frontI;
    }

//convertir le params en un tableau php  de param
    public function convertParamRequestOnArray($params)
    {
        $keyValues = array();
        foreach ($params as $key => $value) {
            $keyValues = array($key => $value);
        }
        return $keyValues;
    }

//return permission path avec params
    public function permissionPathWithParam($path, $tabUrlBakend, $keyValues, $tabParams, $method)
    {
        $permissionPAth = $this->permissionPathWithoutParam($path, $tabUrlBakend);
        $result = false;
        if ($method == 'GET') {
            $permissionParam = $this->permissionTabParamGet($tabParams, $keyValues);
        } else {

            $permissionParam = $this->permissionTabParamPost($tabParams, $keyValues);
        }
        if ($permissionPAth == true && $permissionParam == true) {
            $result = true;
        }
        return $result;
    }

//convertir les params de l'intreface des API en tableau php
    public function convertParamPostOnArray($paramInterface)
    {
        $param = array();
        $tabP = array();
        foreach ($paramInterface as $item) {
            $pos = strpos($item, "=");
            if ($pos) {
                $tabParam = explode("=", $item);
                $param = array($tabParam[0] => $tabParam[1]);
                $tabP[] = $param;
            }
        }
        $param = array_merge([], ...$tabP);
        return $param;
    }

//check permission with method get
    public function checkPermissionMehodGet($path, $tabUrlBakend, $tabParams, $params, $method)
    {
        if ($params) {
            $permission = $this->permissionPathWithParam($path, $tabUrlBakend, $params, $tabParams, $method);
        } else {
            //return permission path without param

            $permission = $this->permissionPathWithoutParam($path, $tabUrlBakend);
        }
        return $permission;
    }

//check permission with method Post
    public function checkPermissionMehodPost($path, $tabUrlBakend, $tabParamsPost, $data, $method)
    {
        //check tabParam in data Json
        if ($data['type'] = !"" || $data['sector_type'] = !"") {
            $permission = $this->permissionPathWithParam($path, $tabUrlBakend, $data, $tabParamsPost, $method);
        } else {
            //return permission path without param
            $permission = $this->permissionPathWithoutParam($path, $tabUrlBakend);

        }

        return $permission;
    }

}


