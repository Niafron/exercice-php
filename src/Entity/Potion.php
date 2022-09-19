<?php

/**
 * Entite pour gérer les potions
 */

namespace App\Entity;

use App\Repository\PotionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PotionRepository::class)]
class Potion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $bonus = null;

    #[ORM\ManyToOne(inversedBy: 'potions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Hero $Hero = null;

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

    public function getBonus(): ?int
    {
        return $this->bonus;
    }

    public function setBonus(int $bonus): self
    {
        $this->bonus = $bonus;

        return $this;
    }

    public function getHero(): ?Hero
    {
        return $this->Hero;
    }

    public function setHero(?Hero $Hero): self
    {
        $this->Hero = $Hero;

        return $this;
    }
}
