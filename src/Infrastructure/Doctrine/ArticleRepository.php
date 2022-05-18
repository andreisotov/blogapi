<?php

namespace BlogAPI\Infrastructure\Doctrine;

use BlogAPI\Domain\Articles\Article;
use BlogAPI\Domain\Articles\ArticleRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 *
 */
class ArticleRepository extends ServiceEntityRepository implements ArticleRepositoryInterface
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Article::class);
	}

	public function article(int $id): ?Article
	{
		$qb = $this->createQueryBuilder("a");
		$qb->where("a.id = :id and a.active = 1")
			->setParameter('id', $id);

		return $qb->getQuery()->getOneOrNullResult();
	}

	public function articles(): array
	{
		$qb = $this->createQueryBuilder("a");
		$qb->where("a.active = 1");

		return $qb->getQuery()->getResult();
	}

	public function getTags(Article $article): array
	{
		$tags = [];

		foreach ($article->getTags() as $key => $tag) {
			$tags[$key]['id']    = $tag->getId();
			$tags[$key]['title'] = $tag->getTitle();
			$tags[$key]['slug']  = $tag->getSlug();
		}

		return $tags;
	}

	public function getCategories(Article $article): array
	{
		$categories = [];

		foreach ($article->getCategories() as $key => $category) {
			if ( ! $category->isActive()) {
				continue;
			}
			$categories[$key]['id']          = $category->getId();
			$categories[$key]['title']       = $category->getTitle();
			$categories[$key]['slug']        = $category->getSlug();
			$categories[$key]['description'] = $category->getSlug() ?? '';
			$categories[$key]['created_at']  = $category->getCreatedAt() ?? '';
			$categories[$key]['updated_at']  = $category->getUpdatedAt() ?? '';
		}

		return $categories;
	}
}
