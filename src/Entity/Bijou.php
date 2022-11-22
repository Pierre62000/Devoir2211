<?php

namespace App\Entity;

use App\Repository\BijouRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BijouRepository::class)]
#[ApiResource(normalizationContext:['groups' => ['read']],
  itemOperations: ['put', 'delete', "patch", "GET"=>["security"=>"is_granted('ROLE_ADMIN')"]],
  collectionOperations:['post', 'GET'=>["security"=>"is_granted('ROLE_ADMIN')"]])]
class Bijou
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["read"])]
    private ?string $description = null;

    #[ORM\Column]
    #[Groups(["read"])]
    private ?float $prixVente = null;

    #[ORM\Column]
    private ?float $prixLocation = null;

    #[ORM\ManyToOne(inversedBy: 'bijous')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(["read"])]
    private ?Categorie $idCategorie = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixVente(): ?float
    {
        return $this->prixVente;
    }

    public function setPrixVente(float $prixVente): self
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    public function getPrixLocation(): ?float
    {
        return $this->prixLocation;
    }

    public function setPrixLocation(float $prixLocation): self
    {
        $this->prixLocation = $prixLocation;

        return $this;
    }

    public function getIdCategorie(): ?Categorie
    {
        return $this->idCategorie;
    }

    public function setIdCategorie(?Categorie $idCategorie): self
    {
        $this->idCategorie = $idCategorie;

        return $this;
    }
}
