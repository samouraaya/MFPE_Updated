<?php

namespace Mfpe\ConfigBundle\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTExpiredEvent;
use Lexik\Bundle\JWTAuthenticationBundle\Response\JWTAuthenticationFailureResponse;
use Mfpe\ConfigBundle\Exception\ApiProblem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Description of JWTExpiredListener
 *
 * @author Lamine Mansouri
 */
class JWTExpiredListener {

    /**
     * @param JWTExpiredEvent $event
     */
//    public function onJWTExpired(JWTExpiredEvent $event) {
//        $errors = array();
//        /** @var JWTAuthenticationFailureResponse */
//        $response = $event->getResponse();
//        $message = ApiProblem::TOKEN_JWT_EXPIRED;
//        $errors['token'] = $message;
//        $data = array(['status' => 'error', 'code' => Response::HTTP_UNAUTHORIZED , 'data' => $errors, 'message' => ApiProblem::TOKEN_JWT_EXPIRED ] );
//
//        $response->setMessage($data);
//    }

}
