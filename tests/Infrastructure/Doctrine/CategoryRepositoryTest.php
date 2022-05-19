<?php
/**
 * Created by site-town.com
 * User: ansotov
 * Date: 19.05.2022
 * Time: 7:38 PM
 */
namespace Infrastructure\Doctrine;

use BlogAPI\Domain\Categories\Category;
use BlogAPI\Infrastructure\Doctrine\CategoryRepository;
use PHPUnit\Framework\TestCase;

class CategoryRepositoryTest extends TestCase
{

	public function testCategory()
	{
		$id = 1;

		$category = new Category();
		$category->setId($id);
		$category->setTitle('Category');
		$category->setSlug('category');
		$category->setDescription('Category description');
		$category->setActive(true);

		$categoryRepository = $this->createMock(CategoryRepository::class);

		$categoryRepository->expects($this->any())
			->method('category')
			->willReturn($category);

		$this->assertEquals('category', $categoryRepository->category($id)->getSlug());
	}

	public function testCategories()
	{
		$categories = [];

		for ($i = 1; $i <= 5; $i++) {
			$category = new Category();
			$category->setId($i);
			$category->setTitle('Category' . $i);
			$category->setSlug('category' . $i);
			$category->setDescription('Category description' . $i);
			$category->setActive(true);

			$categories[] = $category;
		}

		$categoryRepository = $this->createMock(CategoryRepository::class);

		$categoryRepository->expects($this->any())
			->method('categories')
			->willReturn($categories);

		$this->assertCount(5, $categoryRepository->categories());
	}
}
