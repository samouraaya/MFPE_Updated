<?php
namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Mfpe\ReferencielBundle\Entity\RefNiveauDiplome;


class NiveauDiplomeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefMotif ******************************/
        $faker = Faker\Factory::create('fr_FR');
        $referenciel = New RefNiveauDiplome();
        $referenciel->setIntituleAr("تقني");
        $referenciel->setIntituleFr("Technicien");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefNiveauDiplome();
        $referenciel->setIntituleAr("تقني سامي");
        $referenciel->setIntituleFr("Technicien Supérieur");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefNiveauDiplome();
        $referenciel->setIntituleAr("بكالوريا");
        $referenciel->setIntituleFr("Baccalauréat");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $manager->flush();
    }
}