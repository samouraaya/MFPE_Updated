<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;


use Mfpe\ReferencielBundle\Entity\RefNationalite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class NationaliteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefStatut ******************************/
        $referenciel = New RefNationalite();
        $referenciel->setIntituleAr("تونسية");
        $referenciel->setIntituleFr("Tunisienne");
        $referenciel->setCode("TUN");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefNationalite();
        $referenciel->setIntituleAr("جزائري");
        $referenciel->setIntituleFr("Algérienne");
        $referenciel->setCode("ALG");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefNationalite();
        $referenciel->setIntituleAr("ليبيا");
        $referenciel->setIntituleFr("Libye ");
        $referenciel->setCode("LBN");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefNationalite();
        $referenciel->setIntituleAr("فرنسية");
        $referenciel->setIntituleFr("Française ");
        $referenciel->setCode("FRA");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $manager->flush();
    }
}