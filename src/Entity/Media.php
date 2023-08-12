<?php

namespace NormaUy\Bundle\NormaCMSBundle\Entity;

use App\Repository\MediaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
#[ORM\Entity(repositoryClass: MediaRepository::class)]
#[Vich\Uploadable]
abstract class Media implements MediaInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    protected ?string $title = null;

    #[ORM\Column(length: 255)]
    protected ?string $slug = null;

    #[ORM\Column]
    protected ?\DateTimeImmutable $createdAt = null;

    #[
        Vich\UploadableField(
            mapping: 'media.original',
            fileNameProperty: 'originalFileName',
            size: 'size',
            mimeType: 'mimeType',
            originalName: 'originalName',
            dimensions: 'dimensions',
        ),
    ]
    protected ?File $originalFile = null;

    #[ORM\Column(length: 255)]
    protected ?string $originalFileName = null;

    #[ORM\Column(length: 255)]
    protected ?string $originalName = null;

    #[ORM\Column]
    protected ?int $size = null;

    #[ORM\Column(length: 100)]
    protected ?string $mimeType = null;

    #[ORM\Column(nullable: true)]
    protected ?array $dimensions = [];

    #[ORM\Column(length: 255, nullable: true)]
    protected ?string $altText = null;

    #[ORM\Column(length: 255, nullable: true)]
    protected ?string $caption = null;

    #[Vich\UploadableField(mapping: 'media.450w', fileNameProperty: 'imageFileName450w')]
    public ?File $imageFile450w = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $imageFileName450w = null;

    #[Vich\UploadableField(mapping: 'media.800w', fileNameProperty: 'imageFileName800w')]
    public ?File $imageFile800w = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $imageFileName800w = null;

    #[Vich\UploadableField(mapping: 'media.1920w', fileNameProperty: 'imageFileName1920w')]
    public ?File $imageFile1920w = null;

    #[ORM\Column(length: 255, nullable: true)]
    public ?string $imageFileName1920w = null;

    #[ORM\ManyToMany(targetEntity: MediaCategory::class, mappedBy: 'medias')]
    protected Collection $mediaCategories;

    #[ORM\ManyToOne(inversedBy: 'media')]
    #[ORM\JoinColumn(nullable: false)]
    protected ?User $author = null;

    public function __construct()
    {
        $this->mediaCategories = new ArrayCollection();
        $this->title = '';
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
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

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getOriginalFile(): ?File
    {
        return $this->originalFile;
    }

    public function setOriginalFile(?File $originalFile = null): self
    {
        $this->originalFile = $originalFile;

        return $this;
    }

    public function getOriginalFileName(): ?string
    {
        return $this->originalFileName;
    }

    public function setOriginalFileName(?string $originalFileName): self
    {
        $this->originalFileName = $originalFileName;

        return $this;
    }

    public function getOriginalName(): ?string
    {
        return $this->originalName;
    }

    public function setOriginalName(?string $originalName): self
    {
        $this->originalName = $originalName;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(?int $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getMimeType(): ?string
    {
        return $this->mimeType;
    }

    public function setMimeType(?string $mimeType): self
    {
        $this->mimeType = $mimeType;

        return $this;
    }

    public function getDimensions(): array
    {
        return $this->dimensions;
    }

    public function setDimensions(?array $dimensions): self
    {
        $this->dimensions = $dimensions;

        return $this;
    }

    public function getAltText(): ?string
    {
        return $this->altText;
    }

    public function setAltText(?string $altText): self
    {
        $this->altText = $altText;

        return $this;
    }

    public function getCaption(): ?string
    {
        return $this->caption;
    }

    public function setCaption(?string $caption): static
    {
        $this->caption = $caption;

        return $this;
    }

    public function getMedia(): self
    {
        return $this;
    }

    /**
     * @return Collection<int, MediaCategory>
     */
    public function getMediaCategories(): Collection
    {
        return $this->mediaCategories;
    }

    public function addMediaCategory(MediaCategory $mediaCategory): self
    {
        if (!$this->mediaCategories->contains($mediaCategory)) {
            $this->mediaCategories->add($mediaCategory);
            $mediaCategory->addMedia($this);
        }

        return $this;
    }

    public function removeMediaCategory(MediaCategory $mediaCategory): self
    {
        if ($this->mediaCategories->removeElement($mediaCategory)) {
            $mediaCategory->removeMedia($this);
        }

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

    public function __toString(): string
    {
        return !empty($this->title) ? $this->title : (string) $this->originalFileName ?? '';
    }
}
