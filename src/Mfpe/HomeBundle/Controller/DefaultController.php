<?php

namespace Mfpe\HomeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MfpeHomeBundle:Default:index.html.twig');
    }
}
