<?php

namespace App\Controller\Admin;

use App\Entity\Exercice;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/exercice')]
#[IsGranted('ROLE_ADMIN')]
class ExerciceController extends AbstractAdminController
{
    public function __construct(
        private ExerciceRepository $exerciceRepository,
        private EntityManagerInterface $entityManager,
        private LoggerInterface $logger
    ) {
    }

    #[Route('/', name: 'admin_exercice_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('admin/exercice/index.html.twig', [
            'exercices' => $this->exerciceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'admin_exercice_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger): Response
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
                    $this->logger->error('Erreur lors du téléchargement du fichier: ' . $e->getMessage());
                    $this->addFlash('error', 'Une erreur est survenue lors du téléchargement du fichier.');
                    return $this->redirectToRoute('admin_exercice_new');
                }
            }

            $this->entityManager->persist($exercice);
            $this->entityManager->flush();

            $this->addFlash('success', 'L\'exercice a été créé avec succès.');
            return $this->redirectToRoute('admin_exercice_index');
        }

        return $this->render('admin/exercice/new.html.twig', [
            'exercice' => $exercice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'admin_exercice_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(int $id): Response
    {
        $exercice = $this->exerciceRepository->find($id);

        if (!$exercice) {
            throw $this->createNotFoundException('L\'exercice demandé n\'existe pas.');
        }

        return $this->render('admin/exercice/show.html.twig', [
            'exercice' => $exercice,
        ]);
    }

    #[Route('/{id}/edit', name: 'admin_exercice_edit', methods: ['GET', 'POST'], requirements: ['id' => '\d+'])]
    public function edit(Request $request, int $id, SluggerInterface $slugger): Response
    {
        $exercice = $this->exerciceRepository->find($id);

        if (!$exercice) {
            throw $this->createNotFoundException('L\'exercice demandé n\'existe pas.');
        }

        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pdfFile = $form->get('fichier_pdf')->getData();

            if ($pdfFile) {
                $originalFilename = pathinfo($pdfFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$pdfFile->guessExtension();

                try {
                    // Supprimer l'ancien fichier s'il existe
                    if ($exercice->getFichierPdf()) {
                        $oldFile = $this->getParameter('exercices_directory').'/'.$exercice->getFichierPdf();
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }

                    $pdfFile->move(
                        $this->getParameter('exercices_directory'),
                        $newFilename
                    );
                    $exercice->setFichierPdf($newFilename);
                } catch (FileException $e) {
                    $this->logger->error('Erreur lors du téléchargement du fichier: ' . $e->getMessage());
                    $this->addFlash('error', 'Une erreur est survenue lors du téléchargement du fichier.');
                    return $this->redirectToRoute('admin_exercice_edit', ['id' => $id]);
                }
            }

            $this->entityManager->flush();
            $this->addFlash('success', 'L\'exercice a été modifié avec succès.');
            return $this->redirectToRoute('admin_exercice_index');
        }

        return $this->render('admin/exercice/edit.html.twig', [
            'exercice' => $exercice,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'admin_exercice_delete', methods: ['POST'], requirements: ['id' => '\d+'])]
    public function delete(Request $request, int $id): Response
    {
        $exercice = $this->exerciceRepository->find($id);

        if (!$exercice) {
            throw $this->createNotFoundException('L\'exercice demandé n\'existe pas.');
        }

        if ($this->isCsrfTokenValid('delete'.$exercice->getId(), $request->request->get('_token'))) {
            if ($exercice->getFichierPdf()) {
                $file = $this->getParameter('exercices_directory').'/'.$exercice->getFichierPdf();
                if (file_exists($file)) {
                    unlink($file);
                }
            }

            $this->entityManager->remove($exercice);
            $this->entityManager->flush();
            $this->addFlash('success', 'L\'exercice a été supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_exercice_index');
    }
}
