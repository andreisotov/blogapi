<?php

namespace BlogAPI\Application\Handler\Article;

use BlogAPI\Domain\Articles\Article;
use BlogAPI\Infrastructure\Doctrine\ArticleRepository;

class CreateArticleHandler
{
    public function __construct(
        private ArticleRepository $articleRepository
    ) {
    }

    /**
     * @param array    $article
     * @param int|null $categoryId
     *
     * @return void
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function handle(array $article, int $categoryId = null): void
    {
        $articleObj = new Article();
        $articleObj->setTitle($article['title']);
        $articleObj->setSlug($article['slug']);
        $articleObj->setDescription($article['description']);
        $articleObj->setYoutubeVideoId($article['youtube_video_id']);
        $articleObj->setImage($article['image']);
        $articleObj->setActive($article['active']);
        $articleObj->setPublishAt($article['publish_at']);
        $articleObj->setCreatedAt($article['publish_at']);

        $issetArticle = $this->articleRepository->getArticleByYoutubeVideoId($article['youtube_video_id']);

        if (is_null($issetArticle)) {
            $this->articleRepository->save($articleObj);
            $articleId = $articleObj->getId();
        } else {
            $articleId = $issetArticle->getId();
        }

        if ($categoryId) {
            $this->articleRepository->saveRelations($articleId, $categoryId);
        }
    }
}
