<?php

namespace BlogAPI\Application\Handler\Article;

use BlogAPI\Application\Services\FileUploaderInterface;
use BlogAPI\Domain\Articles\Article;
use BlogAPI\Infrastructure\Doctrine\ArticleRepository;
use BlogAPI\Infrastructure\Doctrine\TagRepository;
use BlogAPI\Infrastructure\Formatters\YoutubeVideoTagFormatter;
use DateTimeImmutable;
use Exception;

class CreateArticleHandler
{
    private const BUCKET_NAME = 'ansotov';

    public function __construct(
        private ArticleRepository $articleRepository,
        private TagRepository $tagRepository,
        private YoutubeVideoTagFormatter $tagFormatter,
        private FileUploaderInterface $fileUploader
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
        $publishAt = new DateTimeImmutable($article['publish_at']);

        try {
            $this->fileUploader->upload(self::BUCKET_NAME, $article['title'], $article['image']);
        } catch (Exception $exception) {
            throw new Exception('Can`t upload the logo: ' . $exception->getMessage());
        }

        $articleObj = new Article();
        $articleObj->setTitle($article['title']);
        $articleObj->setSlug($article['slug']);
        $articleObj->setDescription($article['description']);
        $articleObj->setYoutubeVideoId($article['youtube_video_id']);
        $articleObj->setImage($this->fileUploader->getImageUrl());
        $articleObj->setActive($article['active']);
        $articleObj->setPublishAt($publishAt);
        $articleObj->setCreatedAt(new DateTimeImmutable(date('Y-m-d H:i:s')));

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

        // Tags
        if (isset($article['tags'])) {
            foreach ($article['tags'] as $tagItem) {
                $tag      = $this->tagFormatter->formatted((object)['tag' => $tagItem]);
                $issetTag = $this->tagRepository->getTagBySlug($tag->getSlug());

                if (is_null($issetTag)) {
                    $this->tagRepository->save($tag);
                    $tagId = $tag->getId();
                } else {
                    $tagId = $issetTag->getId();
                }

                $this->tagRepository->saveRelations($tagId, $articleId);
            }
        }
    }
}
