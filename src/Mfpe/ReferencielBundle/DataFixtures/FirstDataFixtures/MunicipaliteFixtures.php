<?php
namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
use Mfpe\ReferencielBundle\Entity\RefMunicipalite;


class MunicipaliteFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefMotif ******************************/
        $faker = Faker\Factory::create('fr_FR');

        $referenciel = New RefMunicipalite();
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(['intituleFr' => 'Carthage']);
        $referenciel->setIntituleAr("بلدية قرطاج");
        $referenciel->setIntituleFr("Municipalité Carthage");
        $referenciel->setCode($faker->countryCode);
        $referenciel->setParent($delegation);
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefMunicipalite();
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(['intituleFr' => 'Carthage']);
        $referenciel->setIntituleAr("بلدية الكرم");
        $referenciel->setIntituleFr("Municipalité El-Kram");
        $referenciel->setCode($faker->countryCode);
        $referenciel->setParent($delegation);
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefMunicipalite();
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(['intituleFr' => 'Bab-El-Bhar']);
        $referenciel->setIntituleAr("بلدية باب بحر");
        $referenciel->setIntituleFr("Municipalité Bab-El-Bhar");
        $referenciel->setCode($faker->countryCode);
        $referenciel->setParent($delegation);
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefMunicipalite();
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(['intituleFr' => 'Bab-El-Bhar']);
        $referenciel->setIntituleAr("بلدية تونس وسط المدينة");
        $referenciel->setIntituleFr("Municipalité Tunis centre ville");
        $referenciel->setCode($faker->countryCode);
        $referenciel->setParent($delegation);
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefMunicipalite();
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(['intituleFr' => 'Kasserine Nord']);
        $referenciel->setIntituleAr("بلدية المدينة الاولمبية");
        $referenciel->setIntituleFr("Municipalité Cité Olympique");
        $referenciel->setCode($faker->countryCode);
        $referenciel->setParent($delegation);
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefMunicipalite();
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(['intituleFr' => 'Foussana']);
        $referenciel->setIntituleAr("بلدية فوسانة");
        $referenciel->setIntituleFr("Municipalité Foussana");
        $referenciel->setCode($faker->countryCode);
        $referenciel->setParent($delegation);
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $referenciel = New RefMunicipalite();
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(['intituleFr' => 'Sfax Ville']);
        $referenciel->setIntituleAr("بلدية صفاقس وسط المدينة");
        $referenciel->setIntituleFr("Municipalité Sfax centre Ville");
        $referenciel->setCode($faker->countryCode);
        $referenciel->setParent($delegation);
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);


        $referenciel = New RefMunicipalite();
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(['intituleFr' => 'Tozeur']);
        $referenciel->setIntituleAr("بلدية توزر وسط المدينة");
        $referenciel->setIntituleFr("Municipalité Tozeur centre ville");
        $referenciel->setCode($faker->countryCode);
        $referenciel->setParent($delegation);
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $manager->persist($referenciel);

        $manager->flush();
    }
}