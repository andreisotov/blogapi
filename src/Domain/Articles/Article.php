<?php

namespace BlogAPI\Domain\Articles;

use BlogAPI\Domain\Tags\Tag;
use DateTimeInterface;
use Doctrine\Common\Collections\Collection;

class Article
{
	private int $id;
	private string $title;
	private string $slug;
	private ?string $description;
	private ?string $youtubeCode;
	private ?string $image;
	private bool $active;
	private DateTimeInterface $publishAt;
	private DateTimeInterface $createdAt;
	private ?DateTimeInterface $updatedAt;
	private Collection $tags;
	private Collection $categories;

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
	public function getYoutubeCode(): ?string
	{
		return $this->youtubeCode;
	}

	/**
	 * @param string|null $youtubeCode
	 */
	public function setYoutubeCode(?string $youtubeCode): void
	{
		$this->youtubeCode = $youtubeCode;
	}

	/**
	 * @return string|null
	 */
	public function getImage(): ?string
	{
		return $this->image;
	}

	/**
	 * @param string|null $image
	 */
	public function setImage(?string $image): void
	{
		$this->image = $image;
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
	public function getPublishAt(): DateTimeInterface
	{
		return $this->publishAt;
	}

	/**
	 * @param \DateTimeInterface $publishAt
	 */
	public function setPublishAt(DateTimeInterface $publishAt): void
	{
		$this->publishAt = $publishAt;
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
	 * @return \DateTimeInterface|null
	 */
	public function getUpdatedAt(): ?DateTimeInterface
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
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getTags(): Collection
	{
		return $this->tags;
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection $tags
	 */
	public function setTags(Collection $tags): void
	{
		$this->tags = $tags;
	}

	/**
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getCategories(): Collection
	{
		return $this->categories;
	}

	/**
	 * @param \Doctrine\Common\Collections\Collection $categories
	 */
	public function setCategories(Collection $categories): void
	{
		$this->categories = $categories;
	}

}
