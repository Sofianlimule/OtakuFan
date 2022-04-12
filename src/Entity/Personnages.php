<?php

namespace App\Entity;

use App\Entity\Skills;
use App\Entity\Univers;
use App\Entity\Pouvoirs;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Personnages
 *
 * @ORM\Table(name="personnages")
 * @ORM\Entity
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks()
 */
class Personnages
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
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="occupation", type="string", length=255, nullable=false)
     */
    private $occupation;

    /**
     * @var string
     *
     * @ORM\Column(name="ranks_cultivations", type="string", length=255, nullable=false)
     */
    private $ranksCultivations;

    /**
     * @var string
     *
     * @ORM\Column(name="alias", type="string", length=255, nullable=false)
     */
    private $alias;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="genre", type="string", length=255, nullable=false)
     */
    private $genre;

    /**
     * @var string
     *
     * @ORM\Column(name="race", type="string", length=255, nullable=false)
     */
    private $race;

    /**
     * @var string
     *
     * @ORM\Column(name="proches", type="string", length=255, nullable=false)
     */
    private $proches;

    /**
     * @var string
     *
     * @ORM\Column(name="amis", type="string", length=255, nullable=false)
     */
    private $amis;

    /**
     * @var string
     *
     * @ORM\Column(name="ennemies", type="string", length=255, nullable=false)
     */
    private $ennemies;

    /**
     * @var string
     *
     * @ORM\Column(name="profession", type="string", length=255, nullable=false)
     */
    private $profession;

    /**
     * @var string
     *
     * @ORM\Column(name="premier_apparition", type="string", length=255, nullable=false)
     */
    private $premierApparition;

    /**
     * @var string
     *
     * @ORM\Column(name="histoire", type="text", length=0, nullable=false)
     */
    private $histoire;

    /**
     * @var string|null
     *
     * @ORM\Column(name="image_name", type="string", length=255, nullable=true)
     */
    private $imageName;

        /**
     * @Vich\UploadableField(mapping="personnages_image", fileNameProperty="imageName")
     */
    private $imageFile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Pouvoirs", inversedBy="personnages")
     * @ORM\JoinTable(name="personnages_pouvoirs",
     *   joinColumns={
     *     @ORM\JoinColumn(name="personnages_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="pouvoirs_id", referencedColumnName="id")
     *   }
     * )
     */
    private $pouvoirs;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Skills", inversedBy="personnages")
     * @ORM\JoinTable(name="personnages_skills",
     *   joinColumns={
     *     @ORM\JoinColumn(name="personnages_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="skills_id", referencedColumnName="id")
     *   }
     * )
     */
    private $skills;

    /**
     * @ORM\ManyToOne(targetEntity=Univers::class, inversedBy="personnages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $univers;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->pouvoirs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOccupation(): ?string
    {
        return $this->occupation;
    }

    public function setOccupation(string $occupation): self
    {
        $this->occupation = $occupation;

        return $this;
    }

    public function getRanksCultivations(): ?string
    {
        return $this->ranksCultivations;
    }

    public function setRanksCultivations(string $ranksCultivations): self
    {
        $this->ranksCultivations = $ranksCultivations;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getProches(): ?string
    {
        return $this->proches;
    }

    public function setProches(string $proches): self
    {
        $this->proches = $proches;

        return $this;
    }

    public function getAmis(): ?string
    {
        return $this->amis;
    }

    public function setAmis(string $amis): self
    {
        $this->amis = $amis;

        return $this;
    }

    public function getEnnemies(): ?string
    {
        return $this->ennemies;
    }

    public function setEnnemies(string $ennemies): self
    {
        $this->ennemies = $ennemies;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getPremierApparition(): ?string
    {
        return $this->premierApparition;
    }

    public function setPremierApparition(string $premierApparition): self
    {
        $this->premierApparition = $premierApparition;

        return $this;
    }

    public function getHistoire(): ?string
    {
        return $this->histoire;
    }

    public function setHistoire(string $histoire): self
    {
        $this->histoire = $histoire;

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

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, Pouvoirs>
     */
    public function getPouvoirs(): Collection
    {
        return $this->pouvoirs;
    }

    public function addPouvoir(Pouvoirs $pouvoir): self
    {
        if (!$this->pouvoirs->contains($pouvoir)) {
            $this->pouvoirs[] = $pouvoir;
        }

        return $this;
    }

    public function removePouvoir(Pouvoirs $pouvoir): self
    {
        $this->pouvoirs->removeElement($pouvoir);

        return $this;
    }

    /**
     * @return Collection<int, Skills>
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(Skills $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
        }

        return $this;
    }

    public function removeSkill(Skills $skill): self
    {
        $this->skills->removeElement($skill);

        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function defaultUpdatedAt(): self
    {
        $this->updatedAt = new \DateTime();

        return $this;
    }

    public function getUnivers(): ?Univers
    {
        return $this->univers;
    }

    public function setUnivers(?Univers $univers): self
    {
        $this->univers = $univers;

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
}
