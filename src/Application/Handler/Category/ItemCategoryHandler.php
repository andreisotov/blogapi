<?php

namespace BlogAPI\Application\Handler\Category;

use BlogAPI\Domain\Articles\Article;
use BlogAPI\Domain\Articles\ArticleRepositoryInterface;
use BlogAPI\Domain\Categories\Category;
use BlogAPI\Domain\Categories\CategoryRepositoryInterface;

/**
 *
 */
class ItemCategoryHandler
{
	public function __construct(
		private CategoryRepositoryInterface $categoryRepository
	) {

	}

	public function handle(int $id): ?Category
	{
		return $this->categoryRepository->category($id);
	}
}
