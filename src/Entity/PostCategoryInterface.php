<?php

namespace NormaUy\Bundle\NormaCMSBundle\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
interface PostCategoryInterface
{
    public function getId(): ?int;

    public function getTitle(): ?string;

    public function setTitle(string $title): self;

    public function getSlug(): ?string;

    public function setSlug(string $slug): self;

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection;

    public function addPost(Post $post): self;

    public function removePost(Post $post): self;

    public function __toString(): string;

    public function isEnableMenu(): ?bool;

    public function setEnableMenu(bool $enableMenu): self;
}
