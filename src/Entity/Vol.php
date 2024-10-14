<?php

namespace App\Entity;

use App\Repository\VolRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VolRepository::class)]
class Vol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $VilleDestination = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDeDepart = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDArrivee = null;

    #[ORM\ManyToOne(inversedBy: 'vols')]
    private ?Aeroport $aerop = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVilleDestination(): ?string
    {
        return $this->VilleDestination;
    }

    public function setVilleDestination(string $VilleDestination): static
    {
        $this->VilleDestination = $VilleDestination;

        return $this;
    }

    public function getDateDeDepart(): ?\DateTimeInterface
    {
        return $this->dateDeDepart;
    }

    public function setDateDeDepart(\DateTimeInterface $dateDeDepart): static
    {
        $this->dateDeDepart = $dateDeDepart;

        return $this;
    }

    public function getDateDArrivee(): ?\DateTimeInterface
    {
        return $this->dateDArrivee;
    }

    public function setDateDArrivee(\DateTimeInterface $dateDArrivee): static
    {
        $this->dateDArrivee = $dateDArrivee;

        return $this;
    }

    public function getAerop(): ?Aeroport
    {
        return $this->aerop;
    }

    public function setAerop(?Aeroport $aerop): static
    {
        $this->aerop = $aerop;

        return $this;
    }
}
