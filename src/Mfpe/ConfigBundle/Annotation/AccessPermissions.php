<?php


namespace Mfpe\ConfigBundle\Annotation;


/**
 * @Annotation
 */
class AccessPermissions
{
    public $message = "Access denied";
    const ACCESS_FORBIDDEN = array('fr' => 'Accès interdit QQQQQ', 'ar' => 'QQQQQ ممنوع الدخول');
    public $accessPermissions = array('fr' => 'Accès interdit QQQQQ', 'ar' => 'QQQQQ ممنوع الدخول');

}