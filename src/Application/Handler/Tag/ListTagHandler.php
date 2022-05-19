<?php

namespace BlogAPI\Application\Handler\Tag;

use BlogAPI\Domain\Tags\TagRepositoryInterface;

class ListTagHandler
{
	public function __construct(
		private TagRepositoryInterface $tagRepository
	) {

	}

	public function handle(): array
	{
		return $this->tagRepository->tags();
	}
}
