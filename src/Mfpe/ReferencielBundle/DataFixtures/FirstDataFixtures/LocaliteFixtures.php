<?php
namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;


use Mfpe\ReferencielBundle\Entity\RefLocalite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class LocaliteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefLocalite ******************************/
        $faker = Faker\Factory::create('fr_FR');
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(['intituleFr' => 'Foussana']);
        if (is_object($delegation)) {
            $localite = New RefLocalite();
            $localite->setIntituleAr("عين الجنان");
            $localite->setIntituleFr("Ain-Jinen");
            $localite->setParent($delegation);
            $localite->setCode($faker->countryCode);
            $localite->setCreatedAt(new \DateTime());
            $localite->setEnable(true);
            $manager->persist($localite);

            $localite = New RefLocalite();
            $localite->setIntituleAr("المزيرعة");
            $localite->setIntituleFr("Al-Mziraa");
            $localite->setParent($delegation);
            $localite->setCode($faker->countryCode);
            $localite->setCreatedAt(new \DateTime());
            $localite->setEnable(true);
            $manager->persist($localite);

            $manager->flush();
        }
    }
}