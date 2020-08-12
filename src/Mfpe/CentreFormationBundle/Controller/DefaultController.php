<?php

namespace Mfpe\CentreFormationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MfpeCentreFormationBundle:Default:index.html.twig');
    }
}
