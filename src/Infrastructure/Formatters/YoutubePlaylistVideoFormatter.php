<?php

namespace BlogAPI\Infrastructure\Formatters;

use BlogAPI\Domain\Articles\Article;
use DateTimeImmutable;
use Symfony\Component\String\Slugger\AsciiSlugger;

class YoutubePlaylistVideoFormatter implements FormatterInterface
{
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
		$article->setYoutubeVideoId($data->getSnippet()->getResourceId()->getVideoId());
		$article->setImage($data->getSnippet()->getThumbnails()->getHigh()->getUrl());
		$article->setActive(true);
		$article->setPublishAt(new DateTimeImmutable($data->getSnippet()->getPublishedAt()));

		return $article;
	}
}
