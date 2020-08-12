<?php

namespace Mfpe\DataSocioEconomicBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MfpeDataSocioEconomicBundle:Default:index.html.twig');
    }
}
