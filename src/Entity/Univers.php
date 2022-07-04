<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Univers
 *
 * @ORM\Table(name="univers")
 * @ORM\Entity
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class Univers
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=false)
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Personnages::class, mappedBy="univers", orphanRemoval=true)
     */
    private $personnages;

    /**
     * @ORM\Column(type="text")
     */
    private $Description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image_name", type="string", length=255, nullable=true)
     */
    private $imageName;

        /**
     * @Vich\UploadableField(mapping="univers_image", fileNameProperty="imageName")
     */
    private $imageFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updatedAt;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="univers")
     */
    private $comment;

    public function __construct()
    {
        $this->personnages = new ArrayCollection();
        $this->comment = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->nom;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Personnages>
     */
    public function getPersonnages(): Collection
    {
        return $this->personnages;
    }

    public function addPersonnage(Personnages $personnage): self
    {
        if (!$this->personnages->contains($personnage)) {
            $this->personnages[] = $personnage;
            $personnage->setUnivers($this);
        }

        return $this;
    }

    public function removePersonnage(Personnages $personnage): self
    {
        if ($this->personnages->removeElement($personnage)) {
            // set the owning side to null (unless already changed)
            if ($personnage->getUnivers() === $this) {
                $personnage->setUnivers(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): self
    {
        $this->Description = $Description;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function defaultUpdatedAt(): self
    {
        $this->updatedAt = new \DateTime();

        return $this;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            $this->updatedAt = new \DateTime();
        }

        return;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComment(): Collection
    {
        return $this->comment;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comment->contains($comment)) {
            $this->comment[] = $comment;
            $comment->setUnivers($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getUnivers() === $this) {
                $comment->setUnivers(null);
            }
        }

        return $this;
    }


}
