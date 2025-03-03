<?php

namespace App\Controller;

use App\Entity\Publication;
use App\Entity\Commentaire;
use App\Entity\Reaction;
use App\Form\PublicationType;
use App\Repository\PublicationRepository;
use App\Repository\CommentaireRepository;
use App\Repository\ReactionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Service\EmojiConverter;
use App\Service\TranslationService;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Enum\PublicationCategory;

#[Route('/forum', name: 'app_forum_')]
final class ForumController extends AbstractController
{
    private TranslationService $translationService;
    private LoggerInterface $logger;
    private TranslatorInterface $translator;
    
    public function __construct(
        TranslationService $translationService,
        LoggerInterface $logger,
        TranslatorInterface $translator
    ) {
        $this->translationService = $translationService;
        $this->logger = $logger;
        $this->translator = $translator;
    }
    
    #[Route('/', name: 'index', methods: ['GET'])]
    public function index(PublicationRepository $publicationRepository): Response
    {
        $this->logger->info('Forum controller: Displaying index page');
        
        $supportedLanguages = $this->translationService->getSupportedLanguages();
        $categories = $publicationRepository->getCategoriesWithCount();
        
        return $this->render('forum/index.html.twig', [
            'publications' => $publicationRepository->findBy([], ['date' => 'DESC']),
            'supportedLanguages' => $supportedLanguages,
            'categories' => $categories
        ]);
    }

    #[Route('/new', name: 'new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, EmojiConverter $emojiConverter): Response
    {
        $publication = new Publication();
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $publication->setUser($this->getUser());
            $publication->setDate(new \DateTime());
            
            // Convert text emoticons to emojis
            $publication->setTitre($emojiConverter->convertToEmojis($publication->getTitre()));
            $publication->setContenu($emojiConverter->convertToEmojis($publication->getContenu()));
            
            $entityManager->persist($publication);
            $entityManager->flush();

            return $this->redirectToRoute('app_forum_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('forum/new.html.twig', [
            'publication' => $publication,
            'form' => $form,
            'supportedLanguages' => $this->translationService->getSupportedLanguages(),
        ]);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(Publication $publication): Response
    {
        return $this->render('forum/show.html.twig', [
            'publication' => $publication,
            'supportedLanguages' => $this->translationService->getSupportedLanguages(),
        ]);
    }

    #[Route('/{id}/edit', name: 'edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Publication $publication, EntityManagerInterface $entityManager, EmojiConverter $emojiConverter): Response
    {
        $form = $this->createForm(PublicationType::class, $publication);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Convert text emoticons to emojis
            $publication->setTitre($emojiConverter->convertToEmojis($publication->getTitre()));
            $publication->setContenu($emojiConverter->convertToEmojis($publication->getContenu()));
            
            $entityManager->flush();

            return $this->redirectToRoute('app_forum_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('forum/edit.html.twig', [
            'publication' => $publication,
            'form' => $form,
            'supportedLanguages' => $this->translationService->getSupportedLanguages(),
        ]);
    }

    #[Route('/{id}', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Publication $publication, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$publication->getId(), $request->request->get('_token'))) {
            $entityManager->remove($publication);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_forum_index');
    }

    #[Route('/{id}/comment', name: 'comment', methods: ['POST'])]
    public function comment(Request $request, Publication $publication, EntityManagerInterface $entityManager, EmojiConverter $emojiConverter): Response
    {
        $commentaire = new Commentaire();
        $commentaire->setPublication($publication);
        $commentaire->setDate(new \DateTime());
        $commentaire->setContenu($request->request->get('comment'));
        $commentaire->setUser($this->getUser());
        
        // Convert text emoticons to emojis
        $commentaire->setContenu($emojiConverter->convertToEmojis($commentaire->getContenu()));
        
        $entityManager->persist($commentaire);
        $entityManager->flush();

        return $this->redirectToRoute('app_forum_show', ['id' => $publication->getId()]);
    }

    #[Route('/comment/{id}/delete', name: 'comment_delete', methods: ['POST'])]
    public function deleteComment(Request $request, Commentaire $comment, EntityManagerInterface $entityManager): Response
    {
        $publicationId = $comment->getPublication()->getId();
        
        if ($this->isCsrfTokenValid('delete'.$comment->getId(), $request->request->get('_token'))) {
            $entityManager->remove($comment);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_forum_show', ['id' => $publicationId]);
    }
    
    #[Route('/translate/publication/{id}/{targetLang}', name: 'app_forum_translate_publication', methods: ['GET'])]
    public function translatePublication(
        Publication $publication, 
        string $targetLang, 
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('Forum controller: Translating publication', [
            'id' => $publication->getId(),
            'targetLang' => $targetLang,
            'title' => $publication->getTitre(),
            'contentLength' => strlen($publication->getContenu()),
            'requestPath' => $this->generateUrl('app_forum_translate_publication', ['id' => $publication->getId(), 'targetLang' => $targetLang]),
            'requestMethod' => 'GET'
        ]);
        
        try {
            // Validate target language
            if (!in_array($targetLang, array_keys($this->translationService->getSupportedLanguages()))) {
                throw new \InvalidArgumentException("Unsupported language: $targetLang");
            }
            
            // First try to translate the title using Symfony's translation bundle
            $translatedTitle = $this->translator->trans($publication->getTitre(), [], 'forum', $targetLang);
            
            // If the title wasn't translated (same as original), use our translation service
            if ($translatedTitle === $publication->getTitre()) {
                $translatedTitle = $this->translationService->translate($publication->getTitre(), $targetLang);
            }
            
            // Then try to translate the content
            $translatedContent = $this->translationService->translate($publication->getContenu(), $targetLang);
            
            // Check if translation was successful
            if (empty($translatedTitle) || empty($translatedContent)) {
                throw new \Exception('Translation failed - empty result');
            }
            
            return new JsonResponse([
                'success' => true,
                'title' => $translatedTitle,
                'content' => $translatedContent,
                'source' => [
                    'title' => $publication->getTitre(),
                    'content' => $publication->getContenu()
                ],
                'language' => $targetLang
            ]);
        } catch (\Exception $e) {
            $logger->error('Forum controller: Error translating publication', [
                'id' => $publication->getId(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return new JsonResponse([
                'success' => false,
                'error' => 'Error translating publication: ' . $e->getMessage()
            ]);
        }
    }
    
    #[Route('/translate/comment/{id}/{targetLang}', name: 'app_forum_translate_comment', methods: ['GET'])]
    public function translateComment(
        Commentaire $comment, 
        string $targetLang,
        LoggerInterface $logger
    ): JsonResponse {
        $logger->info('Forum controller: Translating comment', [
            'id' => $comment->getId(),
            'targetLang' => $targetLang,
            'content' => $comment->getContenu(),
            'requestPath' => $this->generateUrl('app_forum_translate_comment', ['id' => $comment->getId(), 'targetLang' => $targetLang]),
            'requestMethod' => 'GET'
        ]);
        
        try {
            // Validate target language
            if (!in_array($targetLang, array_keys($this->translationService->getSupportedLanguages()))) {
                throw new \InvalidArgumentException("Unsupported language: $targetLang");
            }
            
            // First try to use the Symfony translator directly
            $translatedContent = $this->translator->trans($comment->getContenu(), [], 'forum', $targetLang);
            
            // If still no translation, use the translation service
            if ($translatedContent === $comment->getContenu()) {
                $translatedContent = $this->translationService->translate($comment->getContenu(), $targetLang);
            }
            
            // Validate the translation result
            if (empty($translatedContent)) {
                throw new \RuntimeException("Empty translation result received");
            }
            
            return new JsonResponse([
                'success' => true,
                'comment' => [
                    'id' => $comment->getId(),
                    'original' => [
                        'content' => $comment->getContenu()
                    ],
                    'translated' => [
                        'content' => $translatedContent
                    ],
                    'targetLang' => $targetLang
                ]
            ]);
        } catch (\Exception $e) {
            $logger->error('Forum controller: Error translating comment', [
                'id' => $comment->getId(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return new JsonResponse([
                'success' => false,
                'error' => 'Translation failed: ' . $e->getMessage(),
                'comment' => [
                    'id' => $comment->getId(),
                    'original' => [
                        'content' => $comment->getContenu()
                    ]
                ]
            ], 500);
        }
    }
    
    #[Route('/languages', name: 'languages', methods: ['GET'])]
    public function getSupportedLanguages(): JsonResponse
    {
        $this->logger->info('Forum controller: Getting supported languages');
        
        return new JsonResponse([
            'success' => true,
            'languages' => $this->translationService->getSupportedLanguages()
        ]);
    }

    #[Route('/ajax-search', name: 'forum_search', methods: ['GET'])]
    public function search(Request $request, PublicationRepository $publicationRepository, LoggerInterface $logger): JsonResponse
    {
        try {
            $keyword = $request->query->get('keyword');
            $category = $request->query->get('category');
            
            $logger->info('Forum search request', [
                'keyword' => $keyword,
                'category' => $category
            ]);
            
            // Pass the category directly to the repository - it will handle both string and enum
            $publications = $publicationRepository->searchPublications($keyword, $category);
            $currentUser = $this->getUser();
            
            $result = [
                'success' => true,
                'publications' => []
            ];
            
            foreach ($publications as $publication) {
                $isOwner = false;
                if ($currentUser && $publication->getUser() && $publication->getUser()->getId() === $currentUser->getId()) {
                    $isOwner = true;
                }
                
                $publicationData = [
                    'id' => $publication->getId(),
                    'title' => $publication->getTitre(),
                    'content' => $publication->getContenu(),
                    'date' => $publication->getDate()->format('d/m/Y H:i'),
                    'url' => $this->generateUrl('app_forum_show', ['id' => $publication->getId()]),
                    'editUrl' => $this->generateUrl('app_forum_edit', ['id' => $publication->getId()]),
                    'deleteUrl' => $this->generateUrl('app_forum_delete', ['id' => $publication->getId()]),
                    'isOwner' => $isOwner,
                    'user' => $publication->getUser() ? $publication->getUser()->getUsername() : 'Unknown',
                    'category' => $publication->getCategory() ? $publication->getCategory()->getCategory()->value : 'Uncategorized',
                    'commentCount' => count($publication->getCommentaires())
                ];
                
                $result['publications'][] = $publicationData;
            }
            
            return new JsonResponse($result);
        } catch (\Exception $e) {
            $logger->error('Error in search endpoint', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return new JsonResponse([
                'success' => false,
                'error' => 'An error occurred while searching: ' . $e->getMessage()
            ]);
        }
    }

    #[Route('/csrf-token/{action}/{id}', name: 'forum_csrf_token', methods: ['GET'])]
    public function getCsrfToken(string $action, Publication $publication): JsonResponse
    {
        // Generate a CSRF token for the specified action on the publication
        $token = $this->container->get('security.csrf.token_manager')
            ->getToken($action . $publication->getId())
            ->getValue();
        
        return new JsonResponse(['token' => $token]);
    }

    #[Route('/test', name: 'test')]
    public function test(): Response
    {
        return new Response('ForumController test route is working!');
    }

    #[Route('/test-route', name: 'test_route')]
    public function testRoute(): Response
    {
        return new Response('Test route is working!');
    }
}
