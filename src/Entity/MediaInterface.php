<?php

namespace NormaUy\Bundle\NormaCMSBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
interface MediaInterface
{
    public function getId(): ?int;

    public function getTitle(): ?string;

    public function setTitle(?string $title): self;

    public function getSlug(): ?string;

    public function setSlug(string $slug): self;

    public function getAltText(): ?string;

    public function setAltText(?string $altText): self;

    public function getCreatedAt(): ?\DateTimeImmutable;

    public function setCreatedAt(\DateTimeImmutable $createdAt): self;

    public function getAuthor(): ?User;

    public function setAuthor(?User $author): self;

    public function getOriginalFile(): ?File;

    public function setOriginalFile(?File $originalFile = null): self;

    public function getOriginalFileName(): ?string;

    public function setOriginalFileName(?string $originalFileName): self;

    public function getOriginalName(): ?string;

    public function setOriginalName(?string $originalName): self;

    public function getSize(): ?int;

    public function setSize(?int $size): self;

    public function getMimeType(): ?string;

    public function setMimeType(?string $mimeType): self;

    public function getDimensions(): array;

    public function setDimensions(?array $dimensions): self;

    public function __toString(): string;

    public function getMedia(): self;

    /**
     * @return Collection<int, MediaCategory>
     */
    public function getMediaCategories(): Collection;

    public function addMediaCategory(MediaCategory $mediaCategory): self;

    public function removeMediaCategory(MediaCategory $mediaCategory): self;

    public function getCaption(): ?string;

    public function setCaption(?string $caption): static;
}
