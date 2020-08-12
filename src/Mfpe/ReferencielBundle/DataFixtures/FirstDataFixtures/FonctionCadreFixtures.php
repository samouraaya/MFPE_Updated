<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;


use Mfpe\ReferencielBundle\Entity\RefFonctionCadreRegion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class FonctionCadreFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data in RefFonctionCadreFixtures ******************************/
        /****************************** Insert CONSEILLER in  RefFonctionCadreFixtures ******************************/
        $referenciel = New RefFonctionCadreRegion();
        $referenciel->setIntituleAr("والي");
        $referenciel->setIntituleFr("CONSEILLER");
        $referenciel->setDelegation(false);
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);
        /****************************** Insert maire in RefFonctionCadreFixtures ******************************/
        $referenciel1 = New RefFonctionCadreRegion();
        $referenciel1->setIntituleAr("المعتمد");
        $referenciel1->setIntituleFr("maire");
        $referenciel1->setDelegation(true);
        $referenciel1->setCreatedAt(new \DateTime());
        $referenciel1->setEnable(true);
        $manager->persist($referenciel1);
        $manager->flush();
    }
}