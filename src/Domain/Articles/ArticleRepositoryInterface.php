<?php

namespace BlogAPI\Domain\Articles;

interface ArticleRepositoryInterface
{
	public function article(string $slug): ?Article;

	public function articles(): array;
}
