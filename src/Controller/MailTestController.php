<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailTestController extends AbstractController
{
    #[Route('/test-mail', name: 'app_test_mail')]
    public function testMail(MailerInterface $mailer): Response
    {
        try {
            $email = (new Email())
                ->from('arifaanas83@gmail.com')
                ->to('arifaanas83@gmail.com')
                ->subject('Test email from DevSphere')
                ->text('This is a test email to verify the mailer configuration.')
                ->html('<p>This is a test email to verify the mailer configuration.</p>');

            $mailer->send($email);

            return new Response('Email sent successfully! Check your inbox.');
        } catch (\Exception $e) {
            return new Response('Error sending email: ' . $e->getMessage());
        }
    }
}
