<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class TestMailerController extends AbstractController
{
    #[Route('/test/email', name: 'app_test_email')]
    public function testEmail(MailerInterface $mailer): Response
    {
        try {
            $email = (new Email())
                ->from('arifaanas83@gmail.com')
                ->to('arifaanas83@gmail.com')
                ->subject('Test email from Symfony')
                ->text('This is a test email from your Symfony application.')
                ->html('<p>This is a test email from your Symfony application.</p>');

            $mailer->send($email);

            return new Response('Email sent successfully!');
        } catch (\Exception $e) {
            return new Response('Error sending email: ' . $e->getMessage(), 500);
        }
    }
}
