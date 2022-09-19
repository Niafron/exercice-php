<?php

namespace Tests\Unit\App\Entity;

use App\Entity\Hero;
use PHPUnit\Framework\TestCase;
use App\Entity\Potion;


class HeroTest extends TestCase
{
    public function testBasicImplementation(): void
    {
        $hero = new Hero();
        $this->assertInstanceOf(Hero::class, $hero);
    }

    public function testPower(): void
    {
        $hero = new Hero();
        $this->assertInstanceOf(Hero::class, $hero->setStrength(10));
        $this->assertInstanceOf(Hero::class, $hero->setVitality(9));
        $this->assertInstanceOf(Hero::class, $hero->setAgility(5));
        $this->assertInstanceOf(Hero::class, $hero->setLevel(10));
        $this->assertIsInt($hero->getPower());
        $this->assertEquals(240, $hero->getPower());

        $hero = new Hero();
        $this->assertInstanceOf(Hero::class, $hero->setStrength(11));
        $this->assertInstanceOf(Hero::class, $hero->setVitality(12));
        $this->assertInstanceOf(Hero::class, $hero->setAgility(2));
        $this->assertInstanceOf(Hero::class, $hero->setLevel(1));
        $this->assertIsInt($hero->getPower());
        $this->assertEquals(25  , $hero->getPower());
    }

    public function testBoostedPower() :void{
     
        $hero = new Hero();
        $this->assertInstanceOf(Hero::class, $hero->setStrength(11));
        $this->assertInstanceOf(Hero::class, $hero->setVitality(12));
        $this->assertInstanceOf(Hero::class, $hero->setAgility(2));
        $this->assertInstanceOf(Hero::class, $hero->setLevel(1));
        $this->assertIsInt($hero->getPower());
        $this->assertEquals(25  , $hero->getPower());

        $potion = new Potion();
        $this->assertInstanceOf(Potion::class, $potion->setName('potion'));
        $this->assertInstanceOf(Potion::class, $potion->setBonus(1));
        $this->assertInstanceOf(Hero::class, $hero->addPotion($potion));
        $this->assertEquals(26  , $hero->getBoostedPower());


        


    }
}
