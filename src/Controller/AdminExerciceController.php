<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin/exercice')]
#[IsGranted('ROLE_ADMIN')]
class AdminExerciceController extends AbstractController
{
    #[Route('/', name: 'admin_exercice_index', methods: ['GET'])]
    public function index(ExerciceRepository $exerciceRepository): Response
    {
        return $this->render('admin/exercice/index.html.twig', [
            'exercices' => $exerciceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_exercice_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $exercice = new Exercice();
        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pdfFile = $form->get('fichier_pdf')->getData();
            
            if ($pdfFile) {
                $originalFilename = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pdfFile->guessExtension();

                try {
                    $pdfFile->move(
                        $this->getParameter('exercices_directory'),
                        $newFilename
                    );
                    $exercice->setFichierPdf($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors du téléchargement du fichier PDF');
                    return $this->redirectToRoute('admin_exercice_new');
                }
            }

            $entityManager->persist($exercice);
            $entityManager->flush();

            $this->addFlash('success', 'L\'exercice a été créé avec succès.');
            return $this->redirectToRoute('admin_exercice_index');
        }

        return $this->render('admin/exercice/new.html.twig', [
            'exercice' => $exercice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_exercice_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Exercice $exercice, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pdfFile = $form->get('fichier_pdf')->getData();
            
            if ($pdfFile) {
                $originalFilename = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pdfFile->guessExtension();

                try {
                    $pdfFile->move(
                        $this->getParameter('exercices_directory'),
                        $newFilename
                    );
                    
                    // Supprimer l'ancien fichier s'il existe
                    if ($exercice->getFichierPdf()) {
                        $oldFile = $this->getParameter('exercices_directory').'/'.$exercice->getFichierPdf();
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }
                    
                    $exercice->setFichierPdf($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors du téléchargement du fichier PDF');
                    return $this->redirectToRoute('admin_exercice_edit', ['id' => $exercice->getId()]);
                }
            }

            $entityManager->flush();

            $this->addFlash('success', 'L\'exercice a été modifié avec succès.');
            return $this->redirectToRoute('admin_exercice_index');
        }

        return $this->render('admin/exercice/edit.html.twig', [
            'exercice' => $exercice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_exercice_delete', methods: ['POST'])]
    public function delete(Request $request, Exercice $exercice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exercice->getId(), $request->request->get('_token'))) {
            // Supprimer le fichier PDF s'il existe
            if ($exercice->getFichierPdf()) {
                $file = $this->getParameter('exercices_directory').'/'.$exercice->getFichierPdf();
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            $entityManager->remove($exercice);
            $entityManager->flush();
            
            $this->addFlash('success', 'L\'exercice a été supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_exercice_index');
    }
}
