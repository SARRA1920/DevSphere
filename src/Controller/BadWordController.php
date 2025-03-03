<?php

namespace App\Controller;

use App\Entity\BadWord;
use App\Repository\BadWordRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/bad-words')]
#[IsGranted('ROLE_ADMIN')]
class BadWordController extends AbstractController
{
    #[Route('/', name: 'app_bad_word_index', methods: ['GET'])]
    public function index(BadWordRepository $badWordRepository): Response
    {
        return $this->render('bad_word/index.html.twig', [
            'bad_words' => $badWordRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_bad_word_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $word = $request->request->get('word');
            $severity = $request->request->get('severity', 5);

            if (!empty($word)) {
                $badWord = new BadWord();
                $badWord->setWord($word);
                $badWord->setSeverity((int)$severity);
                $badWord->setIsActive(true);

                $entityManager->persist($badWord);
                $entityManager->flush();

                $this->addFlash('success', 'Le mot a été ajouté avec succès.');
                return $this->redirectToRoute('app_bad_word_index');
            }

            $this->addFlash('error', 'Le mot ne peut pas être vide.');
        }

        return $this->render('bad_word/new.html.twig');
    }

    #[Route('/{id}/edit', name: 'app_bad_word_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, BadWord $badWord, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $word = $request->request->get('word');
            $severity = $request->request->get('severity');
            $isActive = $request->request->get('is_active');

            if (!empty($word)) {
                $badWord->setWord($word);
                $badWord->setSeverity((int)$severity);
                $badWord->setIsActive((bool)$isActive);

                $entityManager->flush();

                $this->addFlash('success', 'Le mot a été mis à jour avec succès.');
                return $this->redirectToRoute('app_bad_word_index');
            }

            $this->addFlash('error', 'Le mot ne peut pas être vide.');
        }

        return $this->render('bad_word/edit.html.twig', [
            'bad_word' => $badWord,
        ]);
    }

    #[Route('/{id}/delete', name: 'app_bad_word_delete', methods: ['POST'])]
    public function delete(Request $request, BadWord $badWord, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$badWord->getId(), $request->request->get('_token'))) {
            $entityManager->remove($badWord);
            $entityManager->flush();
            $this->addFlash('success', 'Le mot a été supprimé avec succès.');
        }

        return $this->redirectToRoute('app_bad_word_index');
    }

    #[Route('/{id}/toggle', name: 'app_bad_word_toggle', methods: ['POST'])]
    public function toggle(BadWord $badWord, EntityManagerInterface $entityManager): Response
    {
        $badWord->setIsActive(!$badWord->isActive());
        $entityManager->flush();

        return $this->json([
            'success' => true,
            'isActive' => $badWord->isActive()
        ]);
    }
}
