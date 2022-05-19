<?php

namespace BlogAPI\Infrastructure\Doctrine;

use BlogAPI\Domain\Tags\Tag;
use BlogAPI\Domain\Tags\TagRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class TagRepository extends ServiceEntityRepository implements TagRepositoryInterface
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, Tag::class);
	}

	public function tags(): array
	{
		return $this->findAll();
	}
}
