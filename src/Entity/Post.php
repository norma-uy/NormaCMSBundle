<?php

namespace NormaUy\Bundle\NormaCMSBundle\Entity;

use NormaUy\Bundle\NormaCMSBundle\Repository\PostRepository;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
#[ORM\Entity(repositoryClass: PostRepository::class)]
abstract class Post implements PostInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    protected ?string $title = null;

    #[ORM\Column(length: 255)]
    protected ?string $slug = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    protected ?string $summary = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    protected ?string $content = null;

    #[ORM\Column]
    protected ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    protected ?\DateTimeImmutable $publishedAt = null;

    #[ORM\ManyToOne(inversedBy: 'posts')]
    #[ORM\JoinColumn(nullable: false)]
    protected ?User $author = null;

    #[ORM\ManyToOne]
    protected ?Media $thumbnailPhoto = null;

    #[ORM\Column]
    protected ?bool $featured = false;

    #[ORM\ManyToMany(targetEntity: PostCategory::class, mappedBy: 'posts')]
    protected Collection $postCategories;

    public function __construct()
    {
        $this->postCategories = new ArrayCollection();
        $this->createdAt = new DateTimeImmutable('now');
        $this->featured = false;
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

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPublishedAt(): ?\DateTimeImmutable
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(\DateTimeImmutable $publishedAt): self
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getThumbnailPhoto(): ?Media
    {
        return $this->thumbnailPhoto;
    }

    public function setThumbnailPhoto(?Media $thumbnailPhoto): self
    {
        $this->thumbnailPhoto = $thumbnailPhoto;

        return $this;
    }

    public function isFeatured(): bool
    {
        return $this->featured;
    }

    public function setFeatured(bool $featured): self
    {
        $this->featured = $featured;

        return $this;
    }

    /**
     * @return Collection<int, PostCategory>
     */
    public function getPostCategories(): Collection
    {
        return $this->postCategories;
    }

    public function addPostCategory(PostCategory $postCategory): self
    {
        if (!$this->postCategories->contains($postCategory)) {
            $this->postCategories->add($postCategory);
            $postCategory->addPost($this);
        }

        return $this;
    }

    public function removePostCategory(PostCategory $postCategory): self
    {
        if ($this->postCategories->removeElement($postCategory)) {
            $postCategory->removePost($this);
        }

        return $this;
    }
}
