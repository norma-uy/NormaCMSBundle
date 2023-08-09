<?php

namespace NormaUy\Bundle\NormaCMSBundle\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
interface PostInterface
{
    public function getId(): ?int;

    public function getTitle(): ?string;

    public function setTitle(string $title): self;

    public function getSlug(): ?string;

    public function setSlug(string $slug): self;

    public function getSummary(): ?string;

    public function setSummary(?string $summary): self;

    public function getContent(): ?string;

    public function setContent(?string $content): self;

    public function getCreatedAt(): ?\DateTimeImmutable;

    public function setCreatedAt(\DateTimeImmutable $createdAt): self;

    public function getPublishedAt(): ?\DateTimeImmutable;

    public function setPublishedAt(\DateTimeImmutable $publishedAt): self;

    public function getAuthor(): ?User;

    public function setAuthor(?User $author): self;

    public function getThumbnailPhoto(): ?Media;

    public function setThumbnailPhoto(?Media $thumbnailPhoto): self;

    public function isFeatured(): bool;

    public function setFeatured(bool $featured): self;

    /**
     * @return Collection<int, PostCategory>
     */
    public function getPostCategories(): Collection;

    public function addPostCategory(PostCategory $postCategory): self;

    public function removePostCategory(PostCategory $postCategory): self;
}
