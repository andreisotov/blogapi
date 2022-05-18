<?php

namespace BlogAPI\Infrastructure\Doctrine;

use BlogAPI\Domain\Articles\Article;
use BlogAPI\Domain\Categories\Category;
use BlogAPI\Domain\Categories\CategoryRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 */
class CategoryRepository extends ServiceEntityRepository implements CategoryRepositoryInterface
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Category::class);
	}

	public function getArticles(Category $category): array
	{
		$categories = [];

		foreach ($category->getArticles() as $key => $categoryItem) {
			if ( ! $categoryItem->isActive()) {
				continue;
			}
			$categories[$key]['id']           = $categoryItem->getId();
			$categories[$key]['title']        = $categoryItem->getTitle();
			$categories[$key]['slug']         = $categoryItem->getSlug();
			$categories[$key]['description']  = $categoryItem->getDescription() ?? '';
			$categories[$key]['youtube_code'] = $categoryItem->getYoutubeCode() ?? '';
			$categories[$key]['image']        = $categoryItem->getImage() ?? '';
			$categories[$key]['created_at']   = $categoryItem->getCreatedAt() ?? '';
			$categories[$key]['updated_at']   = $categoryItem->getUpdatedAt() ?? '';
		}

		return $categories;
	}

	public function category(int $id): ?Category
	{
		$qb = $this->createQueryBuilder("c");
		$qb->where("c.id = :id and c.active = 1")
			->setParameter('id', $id);

		return $qb->getQuery()->getOneOrNullResult();
	}

	public function categories(): array
	{
		$qb = $this->createQueryBuilder("c");
		$qb->where("c.active = 1");

		return $qb->getQuery()->getResult();
	}
}
