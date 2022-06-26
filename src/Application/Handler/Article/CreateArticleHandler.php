<?php

namespace BlogAPI\Application\Handler\Article;

use BlogAPI\Domain\Articles\Article;
use BlogAPI\Infrastructure\Doctrine\ArticleRepository;
use BlogAPI\Infrastructure\Doctrine\TagRepository;
use BlogAPI\Infrastructure\Formatters\YoutubeVideoTagFormatter;
use DateTimeImmutable;
use Symfony\Component\String\Slugger\AsciiSlugger;

class CreateArticleHandler
{
    public function __construct(
        private ArticleRepository $articleRepository,
        private TagRepository $tagRepository,
        private YoutubeVideoTagFormatter $tagFormatter
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
        $articleObj->setPublishAt(new DateTimeImmutable($article['publish_at']));

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
