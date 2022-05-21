<?php

namespace BlogAPI\Application\Handler\Category;

use BlogAPI\Domain\Categories\Category;
use BlogAPI\Domain\Categories\CategoryRepositoryInterface;
use DateTimeImmutable;
use RuntimeException;

class CreateCategoryHandler
{
	public function __construct(
		private CategoryRepositoryInterface $categoryRepository
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
		if ($this->categoryRepository->findOneBy(['slug' => $category['slug']])) {
			throw new RuntimeException('Category already saved');
		}

		$createdAt = new DateTimeImmutable($category['publish_at']);

		$categoryObj = new Category();
		$categoryObj->setTitle($category['title']);
		$categoryObj->setSlug($category['slug']);
		$categoryObj->setDescription($category['description']);
		$categoryObj->setYoutubePlaylistId($category['youtube_playlist_id']);
		$categoryObj->setActive($category['active']);
		$categoryObj->setCreatedAt($createdAt);

		$this->categoryRepository->save(
			$categoryObj
		);
	}
}
