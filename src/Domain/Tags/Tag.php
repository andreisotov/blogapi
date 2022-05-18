<?php

namespace BlogAPI\Domain\Tags;

use DateTimeInterface;
use Symfony\Component\Security\Core\User\UserInterface;


class Tag
{
	private int $id;
	private string $title;
	private string $slug;
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
	public function getTitle(): string
	{
		return $this->title;
	}

	/**
	 * @param string $title
	 */
	public function setTitle(string $title): void
	{
		$this->title = $title;
	}

	/**
	 * @return string
	 */
	public function getSlug(): string
	{
		return $this->slug;
	}

	/**
	 * @param string $slug
	 */
	public function setSlug(string $slug): void
	{
		$this->slug = $slug;
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

}
