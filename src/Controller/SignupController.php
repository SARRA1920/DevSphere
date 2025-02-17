<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

final class SignupController extends AbstractController
{
    public function __construct(
        private TokenStorageInterface $tokenStorage
    ) {
    }

    #[Route('/signup', name: 'app_signup')]
    public function index(
        Request $request, 
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response {
        // Only handle POST requests for form submission
        if ($request->isMethod('POST')) {
            try {
                // Create a new User entity
                $user = new User();
                
                // Set basic user information
                $user->setName($request->request->get('name'));
                $user->setEmail($request->request->get('email'));
                $user->setPhone((int)$request->request->get('phone'));
                $user->setCin((int)$request->request->get('cin'));
                
                // Force role to be 'user' for security
                $user->setRole('user');

                // Handle password
                $plaintextPassword = $request->request->get('password');
                $hashedPassword = $passwordHasher->hashPassword(
                    $user,
                    $plaintextPassword
                );
                $user->setPassword($hashedPassword);

                // Handle file upload
                $imageFile = $request->files->get('image');
                if ($imageFile) {
                    $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                    try {
                        $imageFile->move(
                            $this->getParameter('profile_images_directory'),
                            $newFilename
                        );
                    } catch (\Exception $e) {
                        $this->addFlash('error', 'Erreur lors du téléchargement de l\'image');
                        return $this->redirectToRoute('app_signup');
                    }

                    $user->setImage($newFilename);
                }

                // Save to database
                $entityManager->persist($user);
                $entityManager->flush();

                // Add success message with user's name and role-specific information
                if (in_array('ROLE_ADMIN', $user->getRoles())) {
                    $this->addFlash('success', 'Bienvenue ' . $user->getName() . ' ! Votre compte administrateur a été créé avec succès.');
                    
                    // Log in the user programmatically
                    $token = new UsernamePasswordToken(
                        $user,
                        'main', // Firewall name
                        $user->getRoles()
                    );
                    
                    $this->tokenStorage->setToken($token);
                    
                    // Update the session
                    $request->getSession()->set('_security_main', serialize($token));
                    
                    // Redirect to admin dashboard
                    return $this->redirectToRoute('admin_dashboard');
                } else {
                    $this->addFlash('success', 'Bienvenue ' . $user->getName() . ' ! Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.');
                    // Redirect to login page for regular users
                    return $this->redirectToRoute('app_login');
                }
                
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur s\'est produite lors de la création de votre compte. Veuillez vérifier vos informations et réessayer.');
                return $this->redirectToRoute('app_signup');
            }
        }

        // Display the signup form for GET requests
        return $this->render('signup/index.html.twig', [
            'controller_name' => 'SignupController',
        ]);
    }
}
