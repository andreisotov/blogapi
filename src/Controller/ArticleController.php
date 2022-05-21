<?php

namespace BlogAPI\Controller;

use BlogAPI\Application\Handler\Article\ItemArticleHandler;
use BlogAPI\Application\Handler\Article\ListArticleHandler;
use BlogAPI\Domain\Articles\Article;
use BlogAPI\Domain\Articles\ArticleRepositoryInterface;
use BlogAPI\Infrastructure\Doctrine\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
	public function __construct(
		private ListArticleHandler $listArticleHandler,
		private ItemArticleHandler $itemArticleHandler,
		private ArticleRepository $articleRepository
	) {

	}

	#[Route('/api/articles', methods: ['GET'])]
	public function index(): JsonResponse
	{
		$articles = $this->listArticleHandler->handle();

		$allArticles = [];

		/** @var Article $articles */
		foreach ($articles as $article) {

			$allArticles[] = [
				'id'             => $article->getId(),
				'title'          => $article->getTitle(),
				'description'    => $article->getDescription() ?? '',
				'text'           => $article->getText() ?? '',
				'youtubeVideoId' => $article->getYoutubeVideoId() ?? '',
				'image'          => $article->getImage() ?? '',
				'categories'     => $this->articleRepository->getCategories($article),
				'tags'           => $this->articleRepository->getTags($article),
				'created_at'     => $article->getCreatedAt(),
			];
		}

		return new JsonResponse($allArticles);
	}

	#[Route('/api/article/{id}', methods: ['GET'])]
	public function article(int $id): JsonResponse
	{
		/** @var Article $article */
		$article = $this->itemArticleHandler->handle($id);

		if (is_null($article)) {
			return new JsonResponse(null, 404);
		}

		$articleItem = [
			'id'          => $article->getId(),
			'title'       => $article->getTitle(),
			'description' => $article->getDescription() ?? '',
			'youtubeCode' => $article->getYoutubeCode() ?? '',
			'image'       => $article->getImage() ?? '',
			'categories'  => $this->articleRepository->getCategories($article),
			'tags'        => $this->articleRepository->getTags($article),
			'created_at'  => $article->getCreatedAt(),
		];

		return new JsonResponse($articleItem);
	}
}
