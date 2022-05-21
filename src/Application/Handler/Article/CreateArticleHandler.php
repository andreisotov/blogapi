<?php

namespace BlogAPI\Application\Handler\Article;

use BlogAPI\Domain\Articles\Article;
use BlogAPI\Domain\Articles\ArticleRepositoryInterface;
use DateTimeImmutable;
use Exception;

class CreateArticleHandler
{
	public function __construct(
		private ArticleRepositoryInterface $articleRepository
	) {
	}

	/**
	 * @param array $article
	 *
	 * @return void
	 * @throws Exception
	 */
	public function handle(array $article): void
	{
		if ($this->articleRepository->findOneBy(['slug' => $article['slug']])) {
			throw new Exception('Article already saved');
		}

		$createdAt = new DateTimeImmutable($article['publish_at']);

		$articleObj = new Article();
		$articleObj->setTitle($article['title']);
		$articleObj->setSlug($article['slug']);
		$articleObj->setDescription($article['description']);
		$articleObj->setYoutubeVideoId($article['youtube_video_id']);
		$articleObj->setImage($article['image']);
		$articleObj->setActive($article['active']);
		$articleObj->setPublishAt($createdAt);

		$this->articleRepository->save(
			$articleObj
		);
	}
}
