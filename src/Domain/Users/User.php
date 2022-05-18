<?php

namespace BlogAPI\Domain\Users;

use DateTimeInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class User implements UserInterface
{
	private int $id;
	private string $username;
	private string $email;
	private string $password;
	private bool $active;
	private DateTimeInterface $createdAt;
	private DateTimeInterface $updatedAt;

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @param int $id
	 */
	public function setId(int $id): void
	{
		$this->id = $id;
	}

	/**
	 * @return string
	 */
	public function getUsername(): string
	{
		return $this->username;
	}

	/**
	 * @param string $username
	 */
	public function setUsername(string $username): void
	{
		$this->username = $username;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string
	{
		return $this->password;
	}

	/**
	 * @param string $password
	 */
	public function setPassword(string $password): void
	{
		$this->password = $password;
	}

	/**
	 * @return bool
	 */
	public function isActive(): bool
	{
		return $this->active;
	}

	/**
	 * @param bool $active
	 */
	public function setActive(bool $active): void
	{
		$this->active = $active;
	}

	/**
	 * @return \DateTimeInterface
	 */
	public function getCreatedAt(): DateTimeInterface
	{
		return $this->createdAt;
	}

	/**
	 * @param \DateTimeInterface $createdAt
	 */
	public function setCreatedAt(DateTimeInterface $createdAt): void
	{
		$this->createdAt = $createdAt;
	}

	/**
	 * @return \DateTimeInterface
	 */
	public function getUpdatedAt(): DateTimeInterface
	{
		return $this->updatedAt;
	}

	/**
	 * @param \DateTimeInterface $updatedAt
	 */
	public function setUpdatedAt(DateTimeInterface $updatedAt): void
	{
		$this->updatedAt = $updatedAt;
	}

	/**
	 * @return string[]
	 */
	public function getRoles()
	{
		return ['IS_AUTHENTICATED_ANONYMOUSLY'];
	}

	public function getSalt(): ?string
	{
		return null;
	}

	public function eraseCredentials()
	{
		// TODO: Implement eraseCredentials() method.
	}

	public function getUserIdentifier(): string
	{
		return $this->getUsername();
	}
}
