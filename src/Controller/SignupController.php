<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

final class SignupController extends AbstractController
{
    #[Route('/signup', name: 'app_signup')]
    public function index(
        Request $request, 
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        SluggerInterface $slugger
    ): Response {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hasher le mot de passe
            $user->setPassword(
                $passwordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Définir le rôle par défaut
            $user->setRole('user');

            // Gérer l'upload de l'image
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
                    $user->setImage($newFilename);
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Erreur lors du téléchargement de l\'image');
                    return $this->redirectToRoute('app_signup');
                }
            } else {
                // Image par défaut si aucune image n'est téléchargée
                $user->setImage('default-profile.png');
            }

            // Sauvegarder l'utilisateur
            try {
                $entityManager->persist($user);
                $entityManager->flush();

                $this->addFlash('success', 'Votre compte a été créé avec succès. Vous pouvez maintenant vous connecter.');
                return $this->redirectToRoute('app_login');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de la création de votre compte. Veuillez réessayer.');
                return $this->redirectToRoute('app_signup');
            }
        }

        return $this->render('signup/index.html.twig', [
            'registrationForm' => $form,
        ]);
    }
}
