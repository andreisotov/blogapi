<?php

namespace BlogAPI\Domain\Categories;

interface CategoryRepositoryInterface
{
	public function category(int $id): ?Category;

	public function categories(): array;
}
