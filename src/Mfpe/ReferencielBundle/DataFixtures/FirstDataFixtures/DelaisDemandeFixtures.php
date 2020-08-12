<?php
namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;

use Mfpe\ReferencielBundle\Entity\RefDelaisDemande;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Mfpe\ReferencielBundle\Entity\RefDomaine;

class DelaisDemandeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefDomaine ******************************/
        $faker = Faker\Factory::create('fr_FR');
        $delaisDemande  = New RefDelaisDemande();
        $delaisDemande->setIntituleAr("6 أشهر");
        $delaisDemande->setIntituleFr("6 mois");
        $delaisDemande->setCode(6);
        $delaisDemande->setCreatedAt(new \DateTime());
        $delaisDemande->setEnable(true);
        $manager->persist($delaisDemande);
        $manager->flush();
    }

}