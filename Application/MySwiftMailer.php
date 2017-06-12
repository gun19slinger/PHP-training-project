<?php

namespace Application;

class MySwiftMailer
{

    public $message;
    public $attachment;
    public $filename;
    public $transport;
    public $mailer;

    // message
    public function __construct(string $subject, string $body, string $filename = '')
    {
        $config = Config::instance();
        $data = $config->getData('mailer');

        $this->message = new \Swift_Message($subject, $body);
        $this->message->setFrom($data['user_name']);
        $this->message->setTo('gun19slinger@gmail.com');
        if ($filename) {
            $this->attachment = \Swift_Attachment::fromPath($filename, 'text/plain');
            $this->message->attach($this->attachment);
        }

        $this->transport = new \Swift_SmtpTransport(
            $data['SMTP_server'],
            $data['port'],
            $data['security']
        );
        $this->transport->setUsername($data['user_name']);
        $this->transport->setPassword($data['user_password']);

        $this->mailer = new \Swift_Mailer($this->transport);
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function send()
    {
        return $this->mailer->send($this->message);
    }

}