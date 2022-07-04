<?php

namespace App\Entity;

use App\Repository\CommentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommentRepository::class)
 */

#[ORM\HasLifecycleCallbacks]
 class Comment
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Text;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="comments")
     */
    private $author;

    /**
     * @ORM\ManyToOne(targetEntity=Personnages::class, inversedBy="commentaires")
     */
    private $personnages;

    /**
     * @ORM\ManyToOne(targetEntity=Univers::class, inversedBy="comment")
     */
    private $univers;

    /**
     * @ORM\Column(type="datetime")
     */
  //  private $CreatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getText(): ?string
    {
        return $this->Text;
    }

    public function setText(?string $Text): self
    {
        $this->Text = $Text;

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

    public function getPersonnages(): ?Personnages
    {
        return $this->personnages;
    }

    public function setPersonnages(?Personnages $personnages): self
    {
        $this->personnages = $personnages;

        return $this;
    }

    // public function getCreatedAt(): ?\DateTimeInterface
    // {
    //     return $this->CreatedAt;
    // }

    // public function setCreatedAt(\DateTimeInterface $CreatedAt): self
    // {
    //     $this->CreatedAt = $CreatedAt;

    //     return $this;
    // }

    // // DEFAULT DATETIMES

    // #[ORM\PrePersist]
    // public function defaultCreatedAt(): self

    // {

    //     $this->CreatedAt = new \DateTime();



    //     return $this;

    // }

    public function getUnivers(): ?Univers
    {
        return $this->univers;
    }

    public function setUnivers(?Univers $univers): self
    {
        $this->univers = $univers;

        return $this;
    }

}
