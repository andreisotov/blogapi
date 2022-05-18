<?php

namespace BlogAPI\Infrastructure\Doctrine;

use BlogAPI\Domain\Users\User;
use BlogAPI\Domain\Users\UserRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class UserRepository extends ServiceEntityRepository implements UserRepositoryInterface
{
	public function __construct(ManagerRegistry $registry)
	{
		parent::__construct($registry, User::class);
	}
}
