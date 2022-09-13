<?php

namespace Tests\Unit\App\Entity;

use App\Entity\Hero;
use PHPUnit\Framework\TestCase;

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
        $this->assertEquals(24  , $hero->getPower());
    }
}
