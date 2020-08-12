<?php


namespace Mfpe\ConfigBundle\EventListener;

use Doctrine\Common\Annotations\Reader;
use Doctrine\ORM\EntityManagerInterface;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpFoundation\Response;// For example I will throw 403, if access denied
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;


class AccessPermissionsDemandeListener
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
        //First Partie
//        $request = $event->getRequest();
//        $content = $request->getContent();
//        $data = json_decode($content, true);
//        $route = $request->get('_route');
//        //if PATCH demande
//        if ($route == "app_demande-patch_Edit" || $route == "app_files-upload-demande_Add" || $route == "app_upload-pv-demande_Add") {
//            if ($this->tokenStorage->getToken() != null && $this->tokenStorage->getToken()->getUser() != "anon.") {
//                $user = $this->tokenStorage->getToken()->getUser();
//                $roles = $user->getUserRoles();
//                $statesToSee = array();
//                $statesToExecute = array();
//                $allStatesToExecute = array();
//                foreach ($roles as $role) {
//                    array_push($statesToSee, $role->getStatus());
//                    array_push($statesToExecute, $role->getStateExecute());
//                }
//                $allStatesToSee = array_merge([], ...$statesToSee);
//                $allStatesToExecute = array_merge([], ...$statesToExecute);
//                $allStatesToExecute = array_unique($allStatesToExecute);
//             //   dd($allStatesToExecute);
//                if (isset($data["statut"])) {
//                    if (!in_array($data["statut"], $allStatesToExecute)) {
//                        $event->setResponse(new JsonResponse(['status' => 'error', 'code' => Response::HTTP_FORBIDDEN, 'data' => ApiProblem::ACCESS_FORBIDDEN, 'message' => ApiProblem::ACCESS_FORBIDDEN], Response::HTTP_FORBIDDEN));
//                        return;
//                    }
//                }
//            }
//        }
   }
}