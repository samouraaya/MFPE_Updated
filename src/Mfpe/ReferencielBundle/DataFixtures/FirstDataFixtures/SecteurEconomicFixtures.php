<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;

use Mfpe\ReferencielBundle\Entity\RefSecteurEconomic;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class SecteurEconomicFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefRegime ******************************/
        $faker = Faker\Factory::create('fr_FR');

        $secteurEconomic = New RefSecteurEconomic();
        $secteurEconomic->setIntituleAr("قطاع البناء");
        $secteurEconomic->setIntituleFr("Secteur du bâtiment");
        $secteurEconomic->setCreatedAt(new \DateTime());
        $secteurEconomic->setEnable(true);
        $manager->persist($secteurEconomic);

        $secteurEconomic = New RefSecteurEconomic();
        $secteurEconomic->setIntituleAr("قطاع الغزل والنسيج");
        $secteurEconomic->setIntituleFr("Secteur textile");
        $secteurEconomic->setCreatedAt(new \DateTime());
        $secteurEconomic->setEnable(true);
        $manager->persist($secteurEconomic);

        $secteurEconomic = New RefSecteurEconomic();
        $secteurEconomic->setIntituleAr("قطاع الالكترونيات");
        $secteurEconomic->setIntituleFr("Secteur électronique");
        $secteurEconomic->setCreatedAt(new \DateTime());
        $secteurEconomic->setEnable(true);
        $manager->persist($secteurEconomic);


        $manager->flush();
    }
}