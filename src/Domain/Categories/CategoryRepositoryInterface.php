<?php

namespace BlogAPI\Domain\Categories;

interface CategoryRepositoryInterface
{
	public function category(string $slug): ?Category;

	public function categories(): array;
}
