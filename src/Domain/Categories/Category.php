<?php

namespace BlogAPI\Domain\Categories;

use DateTimeInterface;
use Doctrine\Common\Collections\Collection;

class Category
{
	private int $id;
	private string $title;
	private string $slug;
	private ?string $description;
	private ?string $youtubePlaylistId;
	private bool $active;
	private ?DateTimeInterface $createdAt;
	private ?DateTimeInterface $updatedAt;
	private Collection $articles;

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
	 * @return string|null
	 */
	public function getDescription(): ?string
	{
		return $this->description;
	}

	/**
	 * @param string|null $description
	 */
	public function setDescription(?string $description): void
	{
		$this->description = $description;
	}

	/**
	 * @return string|null
	 */
	public function getYoutubePlaylistId(): ?string
	{
		return $this->youtubePlaylistId;
	}

	/**
	 * @param string|null $youtubePlaylistId
	 */
	public function setYoutubePlaylistId(?string $youtubePlaylistId): void
	{
		$this->youtubePlaylistId = $youtubePlaylistId;
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
	 * @return \DateTimeInterface|null
	 */
	public function getCreatedAt(): ?DateTimeInterface
	{
		return $this->createdAt;
	}

	/**
	 * @param \DateTimeInterface|null $createdAt
	 */
	public function setCreatedAt(?DateTimeInterface $createdAt): void
	{
		$this->createdAt = $createdAt;
	}

	/**
	 * @return \DateTimeInterface|null
	 */
	public function getUpdatedAt(): ?DateTimeInterface
	{
		return $this->updatedAt;
	}

	/**
	 * @param \DateTimeInterface|null $updatedAt
	 */
	public function setUpdatedAt(?DateTimeInterface $updatedAt): void
	{
		$this->updatedAt = $updatedAt;
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getArticles(): Collection
	{
		return $this->articles;
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection $articles
	 */
	public function setArticles(Collection $articles): void
	{
		$this->articles = $articles;
	}

}
