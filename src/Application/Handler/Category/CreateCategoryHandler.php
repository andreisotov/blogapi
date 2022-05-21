<?php

namespace BlogAPI\Application\Handler\Category;

use BlogAPI\Domain\Categories\Category;
use BlogAPI\Domain\Categories\CategoryRepositoryInterface;
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

		$categoryObj = new Category();
		$categoryObj->setTitle($category['title']);
		$categoryObj->setSlug($category['slug']);
		$categoryObj->setDescription($category['description']);
		$categoryObj->setYoutubePlaylistId($category['youtube_playlist_id']);
		$categoryObj->setActive($category['active']);

		$this->categoryRepository->save(
			$categoryObj
		);
	}
}
