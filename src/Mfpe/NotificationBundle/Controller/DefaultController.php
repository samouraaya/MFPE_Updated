<?php

namespace Mfpe\NotificationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MfpeNotificationBundle:Default:index.html.twig');
    }
}
