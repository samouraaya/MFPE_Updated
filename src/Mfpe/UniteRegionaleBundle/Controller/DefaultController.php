<?php

namespace Mfpe\UniteRegionaleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MfpeUniteRegionaleBundle:Default:index.html.twig');
    }
}
