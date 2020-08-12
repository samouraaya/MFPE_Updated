<?php

namespace Mfpe\ConfigBundle\Services;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sendMailer
 *
 * @author lamine.mansouri
 */

use Symfony\Component\Templating\EngineInterface;

class Mailer
{

    protected $mailer;
    protected $templating;

    public function __construct(\Swift_Mailer $mailer, EngineInterface $templating)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }

    public function sendMailer($template, $parameters, $from, $to, $subject, $attachement)
    {
        $body = $this->templating->render($template, $parameters);
        $response = $this->sendMessage($from, $to, $subject, $body, $attachement);
        return $response;
    }

    protected function sendMessage($from, $to, $subject, $body, $attachement)
    {
        $mail = \Swift_Message::newInstance();
        $mail
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subject)
            ->setBody($body)
            ->setContentType('text/html');
        if (!empty($attachement)) {
            $mail->attach(\Swift_Attachment::fromPath($attachement));
        }
        $response = $this->mailer->send($mail);
        return $response;
    }

}