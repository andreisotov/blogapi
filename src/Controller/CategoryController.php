<?php

namespace BlogAPI\Controller;

use BlogAPI\Application\Handler\Category\ItemCategoryHandler;
use BlogAPI\Application\Handler\Category\ListCategoryHandler;
use BlogAPI\Domain\Articles\Article;
use BlogAPI\Infrastructure\Doctrine\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use BlogAPI\Domain\Categories\Category;

class CategoryController extends AbstractController
{
	public function __construct(
		private ListCategoryHandler $listCategoryHandler,
		private ItemCategoryHandler $itemCategoryHandler,
		private CategoryRepository $categoryRepository
	) {

	}

	#[Route('/api/categories', methods: ['GET'])]
	public function index(): JsonResponse
	{
		$categories = $this->listCategoryHandler->handle();

		$allCategories = [];

		/** @var Category $categories */
		foreach ($categories as $category) {

			$allCategories[] = [
				'id'          => $category->getId(),
				'title'       => $category->getTitle(),
				'slug'        => $category->getSlug(),
				'description' => $category->getDescription() ?? '',
				'articles'    => $this->categoryRepository->getArticles($category),
				'created_at'  => $category->getCreatedAt(),
			];
		}

		return new JsonResponse($allCategories);
	}

	#[Route('/api/category/{id}', methods: ['GET'])]
	public function article(int $id): JsonResponse
	{
		/** @var Article $article */
		$article = $this->itemCategoryHandler->handle($id);

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
