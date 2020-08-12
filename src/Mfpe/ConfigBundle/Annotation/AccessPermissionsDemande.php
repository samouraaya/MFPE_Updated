<?php


namespace Mfpe\ConfigBundle\Annotation;


/**
 * @Annotation
 */
class AccessPermissionsDemande
{
    public $message = "Access denied";
    const ACCESS_FORBIDDEN = array('fr' => 'Accès interdit QQQQQ', 'ar' => 'QQQQQ ممنوع الدخول');
    public $accessPermissionsDemande = array('fr' => 'Accès interdit QQQQQ', 'ar' => 'QQQQQ ممنوع الدخول');

}