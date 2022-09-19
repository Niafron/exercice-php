<?php

namespace App\Entity;

use App\Repository\HeroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HeroRepository::class)]
class Hero
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $strength = null;

    #[ORM\Column]
    private ?int $vitality = null;

    #[ORM\Column]
    private ?int $agility = null;

    #[ORM\Column]
    private ?int $level = null;

    private ?int $power = null;

    #[ORM\OneToMany(mappedBy: 'Hero', targetEntity: Potion::class)]
    private Collection $potions;

    public function __construct()
    {
        $this->potions = new ArrayCollection();
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

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): self
    {
        $this->strength = $strength;

        return $this;
    }

    public function getVitality(): ?int
    {
        return $this->vitality;
    }

    public function setVitality(int $vitality): self
    {
        $this->vitality = $vitality;

        return $this;
    }

    public function getAgility(): ?int
    {
        return $this->agility;
    }

    public function setAgility(int $agility): self
    {
        $this->agility = $agility;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function getPower(): int
    {
        return ($this->getLevel() *
            ($this->getStrength() + $this->getVitality() + $this->getAgility()));
    }

    /**
     * @return Collection<int, Potion>
     */
    public function getPotions(): Collection
    {
        return $this->potions;
    }

    public function addPotion(Potion $potion): self
    {
        if (!$this->potions->contains($potion)) {
            $this->potions->add($potion);
            $potion->setHero($this);
        }

        return $this;
    }

    public function removePotion(Potion $potion): self
    {
        if ($this->potions->removeElement($potion)) {
            // set the owning side to null (unless already changed)
            if ($potion->getHero() === $this) {
                $potion->setHero(null);
            }
        }

        return $this;
    }

   /**
    * calcul du "power" en prenant en compte le boost des potions
    */
   public function getBoostedPower(): int
   {
    $boostedPower = $this->getPower();
    //recuperation potions
    foreach($this->getPotions() as $potion){
        $boostedPower += $potion->getBonus();
        //consommation potions
        $this->removePotion($potion);
    }

    return $boostedPower;

   } 
}
