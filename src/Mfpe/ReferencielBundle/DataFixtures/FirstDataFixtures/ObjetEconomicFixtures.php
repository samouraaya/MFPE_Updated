<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;

use Mfpe\ReferencielBundle\Entity\RefObjetEconomic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class ObjetEconomicFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefRegime ******************************/
        $faker = Faker\Factory::create('fr_FR');

        $objetEconomic = New RefObjetEconomic();
        $objetEconomic->setIntituleAr("إحداث");
        $objetEconomic->setIntituleFr("Création");
        $objetEconomic->setCreatedAt(new \DateTime());
        $objetEconomic->setEnable(true);
        $manager->persist($objetEconomic);

        $objetEconomic = New RefObjetEconomic();
        $objetEconomic->setIntituleAr("توسعة");
        $objetEconomic->setIntituleFr("Extension");
        $objetEconomic->setCreatedAt(new \DateTime());
        $objetEconomic->setEnable(true);
        $manager->persist($objetEconomic);

        $objetEconomic = New RefObjetEconomic();
        $objetEconomic->setIntituleAr("تجديد");
        $objetEconomic->setIntituleFr("Renouvellement");
        $objetEconomic->setCreatedAt(new \DateTime());
        $objetEconomic->setEnable(true);
        $manager->persist($objetEconomic);


        $manager->flush();
    }
}