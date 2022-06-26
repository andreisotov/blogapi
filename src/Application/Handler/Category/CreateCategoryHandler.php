<?php

namespace BlogAPI\Application\Handler\Category;

use BlogAPI\Application\Handler\Article\CreateArticleHandler;
use BlogAPI\Domain\Categories\Category;
use BlogAPI\Domain\Categories\CategoryRepositoryInterface;
use BlogAPI\Infrastructure\Formatters\YoutubeVideoFormatter;
use BlogAPI\Infrastructure\Services\FetchYoutubeVideoService;
use DateTimeImmutable;

class CreateCategoryHandler
{
	public function __construct(
		private CategoryRepositoryInterface $categoryRepository,
		private CreateArticleHandler $articleHandler,
		private YoutubeVideoFormatter $videoFormatter,
        private FetchYoutubeVideoService $fetchYoutubeVideoService
	) {
	}

	/**
	 * @param array $category
	 *
	 * @return void
	 * @throws \Exception
	 */
	public function handle(array $category): void
	{
		$createdAt = new DateTimeImmutable($category['publish_at']);

		$categoryObj = new Category();
		$categoryObj->setTitle($category['title']);
		$categoryObj->setSlug($category['slug']);
		$categoryObj->setDescription($category['description']);
		$categoryObj->setYoutubePlaylistId($category['youtube_playlist_id']);
		$categoryObj->setActive($category['active']);
		$categoryObj->setCreatedAt($createdAt);

        $issetCategory = $this->categoryRepository->getCategoryByYoutubeVideoId($category['youtube_playlist_id']);

        if (is_null($issetCategory)) {
            $this->categoryRepository->save($categoryObj);
            $categoryId = $categoryObj->getId();
        } else {
            $categoryId = $issetCategory->getId();
        }

		/** Save articles */
		if ($category['articles']) {
			foreach ($category['articles'] as $article) {
                $articleItem = $this->fetchYoutubeVideoService->fetch(['id' => $article->getYoutubeVideoId()]);
				$this->articleHandler->handle($this->videoFormatter->formatted($articleItem), $categoryId);
			}
		}
	}
}
