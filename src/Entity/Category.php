<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategoryRepository::class)
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Pub::class, mappedBy="category")
     */
    private $pubs;

    public function __construct()
    {
        $this->pubs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Pub[]
     */
    public function getPubs(): Collection
    {
        return $this->pubs;
    }

    public function addPub(Pub $pub): self
    {
        if (!$this->pubs->contains($pub)) {
            $this->pubs[] = $pub;
            $pub->setCategory($this);
        }

        return $this;
    }

    public function removePub(Pub $pub): self
    {
        if ($this->pubs->removeElement($pub)) {
            // set the owning side to null (unless already changed)
            if ($pub->getCategory() === $this) {
                $pub->setCategory(null);
            }
        }

        return $this;
    }
}
