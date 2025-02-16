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
use Psr\Log\LoggerInterface;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/exercice')]
final class ExerciceController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route('/', name: 'app_exercice_index', methods: ['GET'])]
    public function index(ExerciceRepository $exerciceRepository): Response
    {
        return $this->redirectToRoute('app_exercice_new');
    }

    #[Route('/list', name: 'app_exercice_list', methods: ['GET'])]
    public function list(ExerciceRepository $exerciceRepository): Response
    {
        return $this->render('exercice/list.html.twig', [
            'exercices' => $exerciceRepository->findAll(),
        ]);
    }

    #[Route('/admin/exercice/new', name: 'app_exercice_new', methods: ['GET', 'POST'])]
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
                    $this->addFlash('error', 'Une erreur est survenue lors du téléchargement du fichier');
                }
            }

            $entityManager->persist($exercice);
            $entityManager->flush();

            $this->addFlash('success', 'L\'exercice a été créé avec succès');
            return $this->redirectToRoute('app_exercice_list');
        }

        return $this->render('exercice/new.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_exercice_show', methods: ['GET'])]
    public function show(Exercice $exercice): Response
    {
        return $this->render('exercice/show.html.twig', [
            'exercice' => $exercice,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_exercice_edit', methods: ['GET', 'POST'])]
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
                    $oldFilename = $exercice->getFichierPdf();
                    if ($oldFilename) {
                        $oldFilePath = $this->getParameter('exercices_directory').'/'.$oldFilename;
                        if (file_exists($oldFilePath)) {
                            unlink($oldFilePath);
                        }
                    }
                    
                    $exercice->setFichierPdf($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors du téléchargement du fichier');
                }
            }

            $entityManager->flush();

            $this->addFlash('success', 'L\'exercice a été modifié avec succès');
            return $this->redirectToRoute('app_exercice_list');
        }

        return $this->render('exercice/edit.html.twig', [
            'exercice' => $exercice,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_exercice_delete', methods: ['POST'])]
    public function delete(Request $request, Exercice $exercice, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exercice->getId(), $request->request->get('_token'))) {
            // Supprimer le fichier PDF associé s'il existe
            $filename = $exercice->getFichierPdf();
            if ($filename) {
                $filePath = $this->getParameter('exercices_directory').'/'.$filename;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $entityManager->remove($exercice);
            $entityManager->flush();
            
            $this->addFlash('success', 'L\'exercice a été supprimé avec succès');
        }

        return $this->redirectToRoute('app_exercice_list');
    }

    #[Route('/admin/dashboard', name: 'app_admin_dashboard', methods: ['GET'])]
    public function dashboard(ExerciceRepository $exerciceRepository): Response
    {
        return $this->render('admin/dashboard/index.html.twig', [
            'exercices' => $exerciceRepository->findAll(),
        ]);
    }

    #[Route('/admin', name: 'admin_dashboard', methods: ['GET'])]
    public function adminDashboard(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    #[Route('/exercices', name: 'app_exercice_user_list', methods: ['GET'])]
    public function userList(ExerciceRepository $exerciceRepository): Response
    {
        return $this->render('exercice/user_list.html.twig', [
            'exercices' => $exerciceRepository->findAll(),
        ]);
    }
}
