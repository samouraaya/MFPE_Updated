<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;


use Mfpe\ReferencielBundle\Entity\RefGrade;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class GradeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefGrade ******************************/
        $referenciel = New RefGrade();
        $referenciel->setIntituleAr("GR1");
        $referenciel->setIntituleFr("GR1");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefGrade();
        $referenciel->setIntituleAr("GR2");
        $referenciel->setIntituleFr("GR2");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $manager->flush();
    }
}