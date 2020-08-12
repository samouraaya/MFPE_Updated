<?php

namespace Mfpe\EditiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MfpeEditiqueBundle:Default:index.html.twig');
    }
}
