<?php

namespace Mfpe\CollectDataBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MfpeCollectDataBundle:Default:index.html.twig');
    }
}
