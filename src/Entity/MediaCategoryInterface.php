<?php

namespace NormaUy\Bundle\NormaCMSBundle\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
interface MediaCategoryInterface
{
    public function getId(): ?int;

    public function getTitle(): ?string;

    public function setTitle(string $title): self;

    public function getSlug(): ?string;

    public function setSlug(string $slug): self;

    /**
     * @return Collection<int, Media>
     */
    public function getMedias(): Collection;

    public function addMedia(Media $media): self;

    public function removeMedia(Media $media): self;

    public function __toString(): string;
}
