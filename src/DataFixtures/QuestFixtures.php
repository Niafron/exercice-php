<?php

namespace App\DataFixtures;

use App\Entity\Hero;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Potion;

class QuestFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $manager->persist((new Hero())
            ->setName('Radagast le Brun')
            ->setStrength(10)
            ->setVitality(5)
            ->setAgility(4)
            ->setLevel(6));

        $manager->persist((new Hero())
            ->setName('Beowulf')
            ->setStrength(18)
            ->setVitality(9)
            ->setAgility(6)
            ->setLevel(4));

        $manager->persist((new Hero())
            ->setName('Diane')
            ->setStrength(12)
            ->setVitality(4)
            ->setAgility(17)
            ->setLevel(5));

        $manager->flush();


        
        $beowulf = $manager->getRepository(Hero::class)->find(2);
        $diane = $manager->getRepository(Hero::class)->find(3);

        $manager->persist((new Potion())
            ->setName('Potion1')
            ->setBonus(1)
            ->setHero($beowulf)
            );


            $manager->persist((new Potion())
            ->setName('Potion2')
            ->setBonus(1)
            ->setHero($diane)
            );


            $manager->persist((new Potion())
            ->setName('Potion3')
            ->setBonus(1)
            ->setHero($diane)
            );

            $manager->flush();

    }
}
