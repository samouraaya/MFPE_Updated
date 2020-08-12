<?php
/**
 * Created by PhpStorm.
 * User: cynapsys
 * Date: 04/07/18
 * Time: 01:21 م
 */

namespace Mfpe\AttestationBundle\Services;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Swift_Events_SendEvent;
use Swift_Events_SendListener;

class MailLoggerWi implements Swift_Events_SendListener
{
    protected $logger;
    private $filename;

    /**
     * MailerLoggerUtil constructor.
     *
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger,$filename)
    {
        $this->logger = $logger;
        $this->filename = $filename;

    }
    public function getMessages()
    {
        return $this->read();
    }

    public function clear()
    {
        $this->write(array());
    }
    /**
     * @param Swift_Events_SendEvent $evt
     */
    public function beforeSendPerformed(Swift_Events_SendEvent $evt): void
    {
        $messages = $this->read();
        $messages[] = clone $evt->getMessage();

        $this->write($messages);
    }

    /**
     * @param Swift_Events_SendEvent $evt
     */
    public function sendPerformed(Swift_Events_SendEvent $evt): void
    {
        $level = $this->getLogLevel($evt);
        $message = $evt->getMessage();
        $transport = $evt->getTransport();
        $failed = $evt->getFailedRecipients();
        $result = $evt->getResult();

        //message
        $this->logger->log(
            $level,
            $message->getSubject() . ' - ' . $message->getId(),
            [
                'result' => $evt->getResult(),
                'subject' => $message->getSubject(),
                'to' => $message->getTo(),
                'cc' => $message->getCc(),
                'bcc' => $message->getBcc(),
            ]
        );
//        transport
        $this->logger->log( $level, 'transport',
            [
                'started'=> $transport->isStarted(),
                'stop'=> $transport->stop(),
                'start'=> $transport->start(),
                            ]
        );
        // failed
        $this->logger->log( $level, 'failed',
           [$failed]
        );
//        result
        $this->logger->log( $level,'result',
            [$result]
        );
    }
    private function read()
    {
        if (!file_exists($this->filename)) {
            return array();
        }

        return (array) unserialize(file_get_contents($this->filename));
    }

    private function write(array $messages)
    {
        file_put_contents($this->filename, serialize($messages));
    }


    /**
     * @param Swift_Events_SendEvent $evt
     *
     * @return string
     */
    private function getLogLevel(Swift_Events_SendEvent $evt): string
    {
        switch ($evt->getResult()) {
            // Sending has yet to occur
            case Swift_Events_SendEvent::RESULT_PENDING:
                return LogLevel::DEBUG;

            // Email is spooled, ready to be sent
            case Swift_Events_SendEvent::RESULT_SPOOLED:
                return LogLevel::DEBUG;

            // Sending failed
            default:
            case Swift_Events_SendEvent::RESULT_FAILED:
                return LogLevel::CRITICAL;

            // Sending worked, but there were some failures
            case Swift_Events_SendEvent::RESULT_TENTATIVE:
                return LogLevel::ERROR;

            // Sending was successful
            case Swift_Events_SendEvent::RESULT_SUCCESS:
                return LogLevel::INFO;
        }
    }
}

