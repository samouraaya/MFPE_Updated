<?php
namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Mfpe\ReferencielBundle\Entity\RefNiveauEtude;


class NiveauEtudeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefMotif ******************************/
        $faker = Faker\Factory::create('fr_FR');
        $referenciel = New RefNiveauEtude();
        $referenciel->setIntituleAr("التاسعة تعليم أساسي ");
        $referenciel->setIntituleFr("9ème année de base");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefNiveauEtude();
        $referenciel->setIntituleAr("بكالوريا + سنة جامعية");
        $referenciel->setIntituleFr("Baccalauréat + année universitaire");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefNiveauEtude();
        $referenciel->setIntituleAr("بكالوريا + 3 سنوات جامعية");
        $referenciel->setIntituleFr("Baccalauréat + 3 années universitaires");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefNiveauEtude();
        $referenciel->setIntituleAr("بكالوريا + 5 سنوات جامعية");
        $referenciel->setIntituleFr("Baccalauréat + 5 années universitaires");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefNiveauEtude();
        $referenciel->setIntituleAr("بكالوريا + 6 سنوات جامعية");
        $referenciel->setIntituleFr("Baccalauréat + 6 années universitaires");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $manager->flush();
    }
}