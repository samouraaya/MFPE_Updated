<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;


use Mfpe\ReferencielBundle\Entity\RefStructure;
use Mfpe\ReferencielBundle\Entity\RefFonction;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class StructureFonctionFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefStructure ******************************/
        $faker = Faker\Factory::create('fr_FR');
        $referenciel = New RefStructure();
        $referenciel->setIntituleAr("وزارة");
        $referenciel->setIntituleFr("Ministere");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefStructure();
        $referenciel->setIntituleAr("الإدارة الإقليمية");
        $referenciel->setIntituleFr("Direction regionale");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefStructure();
        $referenciel->setIntituleAr("مركز تكوين");
        $referenciel->setIntituleFr("Centre de formation");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $manager->flush();

        /****************************** Insert data RefFonction ******************************/
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(['intituleFr' => 'Ministere']);
        if (is_object($structure)) {
            $referenciel = New RefFonction();
            $referenciel->setIntituleAr("ROLE_AGENT_MFPE");
            $referenciel->setIntituleFr("ROLE_AGENT_MFPE");
            $referenciel->setParent($structure);
            $referenciel->setCreatedAt(new \DateTime());
            $referenciel->setEnable(true);
            $manager->persist($referenciel);
        }

        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(['intituleFr' => 'Direction regionale']);
        if (is_object($structure)) {
            $referenciel = New RefFonction();
            $referenciel->setIntituleAr("ROLE_AGENT_DR1");
            $referenciel->setIntituleFr("ROLE_AGENT_DR1");
            $referenciel->setParent($structure);
            $referenciel->setCreatedAt(new \DateTime());
            $referenciel->setEnable(true);
            $manager->persist($referenciel);

            $referenciel = New RefFonction();
            $referenciel->setIntituleAr("ROLE_AGENT_DR2");
            $referenciel->setIntituleFr("ROLE_AGENT_DR2");
            $referenciel->setParent($structure);
            $referenciel->setCreatedAt(new \DateTime());
            $referenciel->setEnable(true);
            $manager->persist($referenciel);

            $referenciel = New RefFonction();
            $referenciel->setIntituleAr("ROLE_AGENT_DR3");
            $referenciel->setIntituleFr("ROLE_AGENT_DR3");
            $referenciel->setParent($structure);
            $referenciel->setCreatedAt(new \DateTime());
            $referenciel->setEnable(true);
            $manager->persist($referenciel);

            $referenciel = New RefFonction();
            $referenciel->setIntituleAr("ROLE_AGENT_DR4");
            $referenciel->setIntituleFr("ROLE_AGENT_DR4");
            $referenciel->setParent($structure);
            $referenciel->setCreatedAt(new \DateTime());
            $referenciel->setEnable(true);
            $manager->persist($referenciel);

            $referenciel = New RefFonction();
            $referenciel->setIntituleAr("ROLE_DIRECTEUR_DR");
            $referenciel->setIntituleFr("ROLE_DIRECTEUR_DR");
            $referenciel->setParent($structure);
            $referenciel->setCreatedAt(new \DateTime());
            $referenciel->setEnable(true);
            $manager->persist($referenciel);
        }

        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(['intituleFr' => 'Centre de formation']);
        if (is_object($structure)) {
            $referenciel = New RefFonction();
            $referenciel->setIntituleAr("ROLE_AGENT_CENTRE_FORMATION");
            $referenciel->setIntituleFr("ROLE_AGENT_CENTRE_FORMATION");
            $referenciel->setParent($structure);
            $referenciel->setCreatedAt(new \DateTime());
            $referenciel->setEnable(true);
            $manager->persist($referenciel);
        }

        $manager->flush();
    }
}