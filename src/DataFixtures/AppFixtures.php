<?php

namespace BlogAPI\DataFixtures;

use BlogAPI\Domain\Users\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
	public function __construct(
		private UserPasswordHasherInterface $encoder
	) {

	}

	public function load(ObjectManager $manager): void
	{
		$user = new User();
		$user->setUsername('ansotov');
		$user->setEmail('test@test.com');
		$user->setPassword($this->encoder->hashPassword($user, '12345'));

		$manager->persist($user);

		$manager->flush();
	}
}
