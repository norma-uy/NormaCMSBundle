<?php

namespace NormaUy\Bundle\NormaCMSBundle\Entity;

use NormaUy\Bundle\NormaCMSBundle\Repository\PostCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
#[ORM\Entity(repositoryClass: PostCategoryRepository::class)]
abstract class PostCategory implements PostCategoryInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    protected ?string $title = null;

    #[ORM\Column(length: 255)]
    protected ?string $slug = null;

    #[ORM\ManyToMany(targetEntity: Post::class, inversedBy: 'postCategories')]
    protected Collection $posts;

    #[ORM\Column]
    protected ?bool $enableMenu = false;

    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->enableMenu = false;
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
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection
    {
        return $this->posts;
    }

    public function addPost(Post $post): self
    {
        if (!$this->posts->contains($post)) {
            $this->posts->add($post);
        }

        return $this;
    }

    public function removePost(Post $post): self
    {
        $this->posts->removeElement($post);

        return $this;
    }

    public function __toString(): string
    {
        return $this->title ?? '';
    }

    public function isEnableMenu(): ?bool
    {
        return $this->enableMenu;
    }

    public function setEnableMenu(bool $enableMenu): self
    {
        $this->enableMenu = $enableMenu;

        return $this;
    }
}
