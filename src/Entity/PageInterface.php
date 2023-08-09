<?php

namespace NormaUy\Bundle\NormaCMSBundle\Entity;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
interface PageInterface
{
    public function getId(): ?int;

    public function getTitle(): ?string;

    public function setTitle(string $title): self;

    public function getSlug(): ?string;

    public function setSlug(string $slug): self;

    public function getContent(): ?array;

    public function setContent(?array $content): self;
}
