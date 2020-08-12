<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;

use Mfpe\ReferencielBundle\Entity\RefRegime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class RegimeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefRegime ******************************/
        $faker = Faker\Factory::create('fr_FR');

        $regime = New RefRegime();
        $regime->setIntituleAr("مصدرة كلية");
        $regime->setIntituleFr("Totalement exportatrice");
        $regime->setCreatedAt(new \DateTime());
        $regime->setEnable(true);
        $manager->persist($regime);

        $regime = New RefRegime();
        $regime->setIntituleAr("مصدرة جزئية");
        $regime->setIntituleFr("Partiellement exportatrice");
        $regime->setCreatedAt(new \DateTime());
        $regime->setEnable(true);
        $manager->persist($regime);

        $regime = New RefRegime();
        $regime->setIntituleAr("محلية");
        $regime->setIntituleFr("Locale");
        $regime->setCreatedAt(new \DateTime());
        $regime->setEnable(true);
        $manager->persist($regime);


        $manager->flush();
    }
}