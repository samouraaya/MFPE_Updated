<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;


use Mfpe\ReferencielBundle\Entity\RefDelegation;
use Mfpe\ReferencielBundle\Entity\Referenciel;
use Mfpe\ReferencielBundle\Entity\RefGouvernorat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class GouvernoratDelegationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefGouvernorat ******************************/
        $faker = Faker\Factory::create('fr_FR');
        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("تونس");
        $gouvernorat->setIntituleFr("Tunis");
        $gouvernorat->setCode("TN-11");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("أريانة");
        $gouvernorat->setIntituleFr("Ariana");
        $gouvernorat->setCode("TN-12");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("باجة");
        $gouvernorat->setIntituleFr("Béja");
        $gouvernorat->setCode("TN-31");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("بن عروس");
        $gouvernorat->setIntituleFr("Ben Arous");
        $gouvernorat->setCode("TN-13");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("قابس");
        $gouvernorat->setIntituleFr("Gabès");
        $gouvernorat->setCode("TN-81");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("بنزرت");
        $gouvernorat->setIntituleFr("Bizerte");
        $gouvernorat->setCode("TN-23");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("قفصة");
        $gouvernorat->setIntituleFr("Gafsa");
        $gouvernorat->setCode("TN-71");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("القيروان");
        $gouvernorat->setIntituleFr("Kairouan");
        $gouvernorat->setCode("TN-41");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("القصرين ");
        $gouvernorat->setIntituleFr("Kasserine");
        $gouvernorat->setCode("TN-42");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("قبلي");
        $gouvernorat->setIntituleFr("Kébili");
        $gouvernorat->setCode("TN-73");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("الكاف");
        $gouvernorat->setIntituleFr("El Kef");
        $gouvernorat->setCode("TN-33");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("المهدية");
        $gouvernorat->setIntituleFr("Mahdia");
        $gouvernorat->setCode("TN-53");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("منوبة");
        $gouvernorat->setIntituleFr("La Manouba");
        $gouvernorat->setCode("TN-14");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("مدنين");
        $gouvernorat->setIntituleFr("Médnine");
        $gouvernorat->setCode("TN-82");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("المنستير");
        $gouvernorat->setIntituleFr("Monastir");
        $gouvernorat->setCode("TN-52");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("نابل");
        $gouvernorat->setIntituleFr("Nabeul");
        $gouvernorat->setCode("TN-21");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("سيدي بوزيد");
        $gouvernorat->setIntituleFr("Sidi Bouzid");
        $gouvernorat->setCode("TN-43");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("سليانة");
        $gouvernorat->setIntituleFr("Siliana");
        $gouvernorat->setCode("TN-34");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("توز ");
        $gouvernorat->setIntituleFr("Tozeur");
        $gouvernorat->setCode("TN-72");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("صفاقس ");
        $gouvernorat->setIntituleFr("Sfax");
        $gouvernorat->setCode("TN-61");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("سوسة");
        $gouvernorat->setIntituleFr("Sousse");
        $gouvernorat->setCode("TN-51");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("تطاوين");
        $gouvernorat->setIntituleFr("Tataouine");
        $gouvernorat->setCode("TN-83");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("زغوان");
        $gouvernorat->setIntituleFr("Zaghouan");
        $gouvernorat->setCode("TN-22");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $gouvernorat = New RefGouvernorat();
        $gouvernorat->setIntituleAr("جندوبة");
        $gouvernorat->setIntituleFr("Jendouba");
        $gouvernorat->setCode("TN-32");
        $gouvernorat->setCreatedAt(new \DateTime());
        $gouvernorat->setEnable(true);
        $manager->persist($gouvernorat);

        $manager->flush();

        /****************************** Insert data RefDelegation ******************************/
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(['intituleFr' => 'Tunis']);
        if (is_object($gouvernorat)) {
            $delegation = New RefDelegation();
            $delegation->setIntituleAr("باب  بحر");
            $delegation->setIntituleFr("Bab-El-Bhar");
            $delegation->setCode($faker->countryCode);
            $delegation->setParent($gouvernorat);
            $delegation->setCreatedAt(new \DateTime());
            $delegation->setEnable(true);
            $manager->persist($delegation);

            $delegation = New RefDelegation();
            $delegation->setIntituleAr("قرطاج");
            $delegation->setIntituleFr("Carthage");
            $delegation->setCode($faker->countryCode);
            $delegation->setParent($gouvernorat);
            $delegation->setCreatedAt(new \DateTime());
            $delegation->setEnable(true);
            $manager->persist($delegation);
        }

        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(['intituleFr' => 'Kasserine']);
        if (is_object($gouvernorat)) {
            $delegation = New RefDelegation();
            $delegation->setIntituleAr("القصرين الشمالية");
            $delegation->setIntituleFr("Kasserine Nord");
            $delegation->setCode($faker->countryCode);
            $delegation->setParent($gouvernorat);
            $delegation->setCreatedAt(new \DateTime());
            $delegation->setEnable(true);
            $manager->persist($delegation);

            $delegation = New RefDelegation();
            $delegation->setIntituleAr("فوسانة");
            $delegation->setIntituleFr("Foussana");
            $delegation->setCode($faker->countryCode);
            $delegation->setParent($gouvernorat);
            $delegation->setCreatedAt(new \DateTime());
            $delegation->setEnable(true);
            $manager->persist($delegation);

            $delegation = New RefDelegation();
            $delegation->setIntituleAr("سبيبة");
            $delegation->setIntituleFr("Sbiba");
            $delegation->setCode($faker->countryCode);
            $delegation->setParent($gouvernorat);
            $delegation->setCreatedAt(new \DateTime());
            $delegation->setEnable(true);
            $manager->persist($delegation);

            $delegation = New RefDelegation();
            $delegation->setIntituleAr("سبيطلة");
            $delegation->setIntituleFr("Sbeïtla");
            $delegation->setCode($faker->countryCode);
            $delegation->setParent($gouvernorat);
            $delegation->setCreatedAt(new \DateTime());
            $delegation->setEnable(true);
            $manager->persist($delegation);
        }

        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(['intituleFr' => 'Sfax']);
        if (is_object($gouvernorat)) {
            $delegation = New RefDelegation();
            $delegation->setIntituleAr("المحرس");
            $delegation->setIntituleFr("Mahrès");
            $delegation->setCode($faker->countryCode);
            $delegation->setParent($gouvernorat);
            $delegation->setCreatedAt(new \DateTime());
            $delegation->setEnable(true);
            $manager->persist($delegation);

            $delegation = New RefDelegation();
            $delegation->setIntituleAr("صفاقس المدينة");
            $delegation->setIntituleFr("Sfax Ville");
            $delegation->setCode($faker->countryCode);
            $delegation->setParent($gouvernorat);
            $delegation->setCreatedAt(new \DateTime());
            $delegation->setEnable(true);
            $manager->persist($delegation);

        }
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(['intituleFr' => 'Tozeur']);
        if (is_object($gouvernorat)) {
            $delegation = New RefDelegation();
            $delegation->setIntituleAr("توزر");
            $delegation->setIntituleFr("Tozeur");
            $delegation->setEnable(true);

            $delegation = New RefDelegation();
            $delegation->setIntituleAr("دقاش");
            $delegation->setIntituleFr("Degache");


            $delegation->setCode($faker->countryCode);
            $delegation->setParent($gouvernorat);
            $delegation->setCreatedAt(new \DateTime());
            $delegation->setEnable(true);
            $manager->persist($delegation);

            $delegation = New RefDelegation();
            $delegation->setIntituleAr("نفطة");
            $delegation->setIntituleFr("Nefta");
            $delegation->setCode($faker->countryCode);
            $delegation->setParent($gouvernorat);
            $delegation->setCreatedAt(new \DateTime());
            $delegation->setEnable(true);

            $manager->persist($delegation);

        }
        $manager->flush();
    }
}