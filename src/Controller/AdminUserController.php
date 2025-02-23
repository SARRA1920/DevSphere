<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin')]
#[IsGranted('ROLE_ADMIN')]
class AdminUserController extends AbstractController
{
    #[Route('/users', name: 'admin_users_index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->render('admin/users/index.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/users/{id}/delete', name: 'admin_users_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            // Empêcher la suppression de son propre compte
            if ($user === $this->getUser()) {
                $this->addFlash('error', 'Vous ne pouvez pas supprimer votre propre compte.');
                return $this->redirectToRoute('admin_users_index');
            }

            try {
                $entityManager->remove($user);
                $entityManager->flush();
                $this->addFlash('success', 'L\'utilisateur a été supprimé avec succès.');
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de la suppression de l\'utilisateur.');
            }
        }

        return $this->redirectToRoute('admin_users_index');
    }

    #[Route('/users/{id}/toggle-admin', name: 'admin_users_toggle_admin', methods: ['POST'])]
    public function toggleAdmin(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('toggle-admin'.$user->getId(), $request->request->get('_token'))) {
            // Empêcher la modification de son propre rôle
            if ($user === $this->getUser()) {
                $this->addFlash('error', 'Vous ne pouvez pas modifier votre propre rôle.');
                return $this->redirectToRoute('admin_users_index');
            }

            try {
                $currentRole = $user->getRole();
                $newRole = $currentRole === 'admin' ? 'user' : 'admin';
                $user->setRole($newRole);
                
                $entityManager->flush();
                
                $this->addFlash(
                    'success',
                    $newRole === 'admin' 
                        ? 'Les droits administrateur ont été accordés avec succès.'
                        : 'Les droits administrateur ont été retirés avec succès.'
                );
            } catch (\Exception $e) {
                $this->addFlash('error', 'Une erreur est survenue lors de la modification des droits.');
            }
        }

        return $this->redirectToRoute('admin_users_index');
    }
}
