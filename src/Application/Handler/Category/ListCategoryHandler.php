<?php

namespace BlogAPI\Application\Handler\Category;

use BlogAPI\Domain\Categories\CategoryRepositoryInterface;

/**
 *
 */
class ListCategoryHandler
{
	public function __construct(
		private CategoryRepositoryInterface $categoryRepository
	) {

	}

	public function handle(): array
	{
		return $this->categoryRepository->categories();
	}
}
