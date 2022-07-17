<?php

namespace BlogAPI\Controller;

use BlogAPI\Application\Handler\Category\ItemCategoryHandler;
use BlogAPI\Application\Handler\Category\ListCategoryHandler;
use BlogAPI\Domain\Articles\Article;
use BlogAPI\Infrastructure\Doctrine\ArticleRepository;
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

	#[Route('/api/category/{slug}', methods: ['GET'])]
	public function category(string $slug): JsonResponse
	{
		/** @var Category $category */
		$category = $this->itemCategoryHandler->handle($slug);

		if (is_null($category)) {
			return new JsonResponse(null, 404);
		}

		$categoryItem = [
			'id'          => $category->getId(),
			'title'       => $category->getTitle(),
			'description' => $category->getDescription() ?? '',
			'youtubeCode' => $category->getYoutubePlaylistId() ?? '',
			'articles'  => $this->categoryRepository->getArticles($category),
			'created_at'  => $category->getCreatedAt(),
		];

		return new JsonResponse($categoryItem);
	}
}
