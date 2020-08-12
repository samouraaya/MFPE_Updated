<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;


use Mfpe\ReferencielBundle\Entity\RefNatureBesoinSpecifique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class NatureBesoinSpecifiqueFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefNatureBesoinSpecifiqueFixtures ******************************/
        $referenciel = New RefNatureBesoinSpecifique();
        $referenciel->setIntituleAr("إعاقة بصرية");
        $referenciel->setIntituleFr("Déficience visuelle");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefNatureBesoinSpecifique();
        $referenciel->setIntituleAr("إعاقة على مستوى السمع");
        $referenciel->setIntituleFr("Déficience auditive");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefNatureBesoinSpecifique();
        $referenciel->setIntituleAr("إعاقة على مستوى النطق");
        $referenciel->setIntituleFr("Trouble de la parole");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $manager->flush();
    }
}