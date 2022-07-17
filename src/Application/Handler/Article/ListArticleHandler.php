<?php

namespace BlogAPI\Application\Handler\Article;

use BlogAPI\Domain\Articles\ArticleRepositoryInterface;

/**
 *
 */
class ListArticleHandler
{
	public function __construct(
		private ArticleRepositoryInterface $articleRepository
	) {
	}

	public function handle(): array
	{
		return $this->articleRepository->articles();
	}
}
