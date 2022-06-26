<?php

namespace BlogAPI\Infrastructure\Formatters;

use BlogAPI\Domain\Articles\Article;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\String\Slugger\AsciiSlugger;

class YoutubePlaylistVideoFormatter implements FormatterInterface
{
    private Collection $tags;

    public function __construct(
        private YoutubeVideoTagFormatter $tagFormatter
    ) {
    }

    /**
     * @param object $data
     *
     * @return \BlogAPI\Domain\Articles\Article
     * @throws \Exception
     */
    public function formatted(object $data): Article
    {
        $slug = strtolower((new AsciiSlugger())->slug($data->getSnippet()->getTitle())->toString());

        $article = new Article();
        $article->setTitle($data->getSnippet()->getTitle());
        $article->setSlug($slug);
        $article->setDescription($data->getSnippet()->getDescription());
        $article->setYoutubeVideoId($data->getId());
        $article->setImage($data->getSnippet()->getThumbnails()->getHigh()->getUrl());
        $article->setActive(true);
        $article->setPublishAt(new DateTimeImmutable($data->getSnippet()->getPublishedAt()));

        $this->tags = new ArrayCollection();
        foreach ($data->getSnippet()->getTags() as $tag) {
            $this->tags->add($this->tagFormatter->formatted((object)['tag' => $tag]));
        }
        $article->setTags($this->tags);

        return $article;
    }
}
