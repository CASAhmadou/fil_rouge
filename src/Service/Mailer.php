<?php

namespace App\Service;

use App\Entity\User;
use Twig\Environment;
use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class Mailer {
    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendEmail($email, $token)
    {
        $email = (new TemplatedEmail())
            ->from('cas@brasilburger.sn')
            ->to(new Address($email))
            ->subject('BRASIL BURGER: terminer l activation de votre compte')

            ->htmlTemplate('mailer/index.html.twig')

            ->context([
                'token' => $token,
                'expiration_date' => new \DateTime('+2 minutes'),
            ])
        ;

        $this->mailer->send($email);
    }
}
