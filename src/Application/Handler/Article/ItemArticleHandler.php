<?php

namespace BlogAPI\Application\Handler\Article;

use BlogAPI\Domain\Articles\Article;
use BlogAPI\Domain\Articles\ArticleRepositoryInterface;

/**
 *
 */
class ItemArticleHandler
{
    public function __construct(
        private ArticleRepositoryInterface $articleRepository
    ) {
    }

    public function handle(string $slug): ?Article
    {
        return $this->articleRepository->article($slug);
    }
}
