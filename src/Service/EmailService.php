<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendReclamationConfirmation(string $to, string $type): void
    {
        $email = (new Email())
            ->from('devsphere@example.com')
            ->to($to)
            ->subject('Confirmation de votre réclamation')
            ->html("
                <h1>Confirmation de votre réclamation</h1>
                <p>Bonjour,</p>
                <p>Nous avons bien reçu votre réclamation concernant : {$type}</p>
                <p>Notre équipe va traiter votre demande dans les plus brefs délais.</p>
                <p>Merci de votre confiance,</p>
                <p>L'équipe DevSphere</p>
            ");

        $this->mailer->send($email);
    }
}
