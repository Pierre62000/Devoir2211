<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[ApiResource()]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'idCategorie', targetEntity: Bijou::class)]
    private Collection $bijous;

    public function __construct()
    {
        $this->bijous = new ArrayCollection();
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
     * @return Collection<int, Bijou>
     */
    public function getBijous(): Collection
    {
        return $this->bijous;
    }

    public function addBijou(Bijou $bijou): self
    {
        if (!$this->bijous->contains($bijou)) {
            $this->bijous->add($bijou);
            $bijou->setIdCategorie($this);
        }

        return $this;
    }

    public function removeBijou(Bijou $bijou): self
    {
        if ($this->bijous->removeElement($bijou)) {
            // set the owning side to null (unless already changed)
            if ($bijou->getIdCategorie() === $this) {
                $bijou->setIdCategorie(null);
            }
        }

        return $this;
    }
}
