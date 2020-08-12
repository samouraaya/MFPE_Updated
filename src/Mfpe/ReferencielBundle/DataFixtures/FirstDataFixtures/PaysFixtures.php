<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;


use Mfpe\ReferencielBundle\Entity\RefPays;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class PaysFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefStatut ******************************/
        $faker = Faker\Factory::create('fr_FR');
        for ($i = 0; $i < 10; $i++) {
            $referenciel = New RefPays();
            $faker = Faker\Factory::create('ar_SA');
            $referenciel->setIntituleAr($faker->country);
            $faker = Faker\Factory::create('fr_FR');
            $referenciel->setIntituleFr($faker->country);
            $referenciel->setCreatedAt(new \DateTime());
            $referenciel->setEnable(true);
            $manager->persist($referenciel);
        }

        $manager->flush();
    }
}