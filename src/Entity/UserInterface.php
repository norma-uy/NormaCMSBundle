<?php

namespace NormaUy\Bundle\NormaCMSBundle\Entity;

use Doctrine\Common\Collections\Collection;

/**
 * @author Samuel Alvarez <samale456uruguay@gmail.com>
 */
interface UserInterface
{
    public function getId(): ?int;

    public function getUsername(): ?string;

    public function setUsername(string $username): static;

    public function getEmail(): ?string;

    public function setEmail(string $email): static;

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string;

    /**
     * @see UserInterface
     */
    public function getRoles(): array;

    public function setRoles(array $roles): static;

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string;

    public function setPassword(string $password): static;

    public function getPlainPassword(): ?string;

    public function setPlainPassword(string $plainPassword): static;

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void;

    public function getName(): ?string;

    public function setName(?string $name): static;

    public function __toString(): string;

    /**
     * @return Collection<int, Post>
     */
    public function getPosts(): Collection;

    public function addPost(Post $post): static;

    public function removePost(Post $post): static;

    /**
     * @return Collection<int, Media>
     */
    public function getMedia(): Collection;

    public function addMedium(Media $medium): static;

    public function removeMedium(Media $medium): static;
}
