<?php

namespace BlogAPI\Domain\Tags;

interface TagRepositoryInterface
{
	public function tags(): array;
}
