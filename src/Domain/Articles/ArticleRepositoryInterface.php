<?php

namespace BlogAPI\Domain\Articles;

interface ArticleRepositoryInterface
{
	public function article(int $id): ?Article;

	public function articles(): array;
}
