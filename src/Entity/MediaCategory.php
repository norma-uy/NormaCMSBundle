<?php

namespace NormaUy\Bundle\NormaCMSBundle\Entity;

use NormaUy\Bundle\NormaCMSBundle\Repository\MediaCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
#[ORM\Entity(repositoryClass: MediaCategoryRepository::class)]
abstract class MediaCategory implements MediaCategoryInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    protected ?string $title = null;

    #[ORM\Column(length: 255)]
    protected ?string $slug = null;

    #[ORM\ManyToMany(targetEntity: Media::class, inversedBy: 'mediaCategories')]
    protected Collection $medias;

    public function __construct()
    {
        $this->medias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection<int, Media>
     */
    public function getMedias(): Collection
    {
        return $this->medias;
    }

    public function addMedia(Media $media): self
    {
        if (!$this->medias->contains($media)) {
            $this->medias->add($media);
        }

        return $this;
    }

    public function removeMedia(Media $media): self
    {
        $this->medias->removeElement($media);

        return $this;
    }

    public function __toString(): string
    {
        return $this->title ?? '';
    }
}
