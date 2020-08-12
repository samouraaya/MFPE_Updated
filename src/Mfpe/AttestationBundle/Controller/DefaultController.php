<?php

namespace Mfpe\AttestationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MfpeAttestationBundle:Default:index.html.twig');
    }
}
