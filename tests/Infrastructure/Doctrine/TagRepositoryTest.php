<?php
/**
 * Created by site-town.com
 * User: ansotov
 * Date: 19.05.2022
 * Time: 8:00 PM
 */
namespace Infrastructure\Doctrine;

use BlogAPI\Domain\Tags\Tag;
use BlogAPI\Infrastructure\Doctrine\TagRepository;
use PHPUnit\Framework\TestCase;

class TagRepositoryTest extends TestCase
{

	public function testTags()
	{
		$tags = [];

		for ($i = 1; $i <= 5; $i++) {
			$tag = new Tag();
			$tag->setId($i);
			$tag->setTitle('Tag' . $i);
			$tag->setSlug('tag' . $i);

			$tags[] = $tag;
		}

		$tagRepository = $this->createMock(TagRepository::class);

		$tagRepository->expects($this->any())
			->method('tags')
			->willReturn($tags);

		$this->assertCount(5, $tagRepository->tags());
	}
}
