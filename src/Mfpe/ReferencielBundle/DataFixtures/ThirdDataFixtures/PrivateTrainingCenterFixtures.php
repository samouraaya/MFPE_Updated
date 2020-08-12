<?php

namespace Mfpe\ReferencielBundle\DataFixtures\ThirdDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

//Entity
use Mfpe\collectDataBundle\Entity\PrivateTrainnigCenter;

class PrivateTrainingCenterFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


        //Ariana
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ariana"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("20");
        $privateCenter->setContinusNumber("70");
        $privateCenter->setInitialContiusNumber("50");
        $privateCenter->setChangeNumber("15");
        $privateCenter->setClosedTrainingCenterNumber("10");
        $privateCenter->setYear("2020");
        $privateCenter->setMonth("1");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("18-01-2020"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);


        //Beja
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Beja"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("10");
        $privateCenter->setContinusNumber("40");
        $privateCenter->setInitialContiusNumber("53");
        $privateCenter->setChangeNumber("20");
        $privateCenter->setClosedTrainingCenterNumber("16");
        $privateCenter->setYear("2020");
        $privateCenter->setMonth("3");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("08-03-2020"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);


        //Ben Arous
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ben Arous"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("30");
        $privateCenter->setContinusNumber("55");
        $privateCenter->setInitialContiusNumber("65");
        $privateCenter->setChangeNumber("52");
        $privateCenter->setClosedTrainingCenterNumber("12");
        $privateCenter->setYear("2020");
        $privateCenter->setMonth("2");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("11-02-2020"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);

        //Bizerte
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Bizerte"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("25");
        $privateCenter->setContinusNumber("50");
        $privateCenter->setInitialContiusNumber("56");
        $privateCenter->setChangeNumber("25");
        $privateCenter->setClosedTrainingCenterNumber("21");
        $privateCenter->setYear("2019");
        $privateCenter->setMonth("5");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("03-05-2019"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);


        //Gabès
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gabès"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("60");
        $privateCenter->setContinusNumber("45");
        $privateCenter->setInitialContiusNumber("49");
        $privateCenter->setChangeNumber("35");
        $privateCenter->setClosedTrainingCenterNumber("20");
        $privateCenter->setYear("2019");
        $privateCenter->setMonth("10");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("21-10-2019"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);

        //Gafsa
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gafsa"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("35");
        $privateCenter->setContinusNumber("49");
        $privateCenter->setInitialContiusNumber("45");
        $privateCenter->setChangeNumber("19");
        $privateCenter->setClosedTrainingCenterNumber("13");
        $privateCenter->setYear("2019");
        $privateCenter->setMonth("8");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("13-08-2019"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);


        //Jendouba
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Jendouba"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("28");
        $privateCenter->setContinusNumber("56");
        $privateCenter->setInitialContiusNumber("51");
        $privateCenter->setChangeNumber("51");
        $privateCenter->setClosedTrainingCenterNumber("33");
        $privateCenter->setYear("2016");
        $privateCenter->setMonth("7");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("30-07-2016"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);


        //Kairouan
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kairouan"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("10");
        $privateCenter->setContinusNumber("15");
        $privateCenter->setInitialContiusNumber("27");
        $privateCenter->setChangeNumber("21");
        $privateCenter->setClosedTrainingCenterNumber("10");
        $privateCenter->setYear("2018");
        $privateCenter->setMonth("1");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("26-01-2018"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);

        //Kasserine
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("54");
        $privateCenter->setContinusNumber("44");
        $privateCenter->setInitialContiusNumber("60");
        $privateCenter->setChangeNumber("18");
        $privateCenter->setClosedTrainingCenterNumber("15");
        $privateCenter->setYear("2018");
        $privateCenter->setMonth("6");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("18-06-2018"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);

        //Kébili
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kébili"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("25");
        $privateCenter->setContinusNumber("30");
        $privateCenter->setInitialContiusNumber("42");
        $privateCenter->setChangeNumber("30");
        $privateCenter->setClosedTrainingCenterNumber("20");
        $privateCenter->setYear("2020");
        $privateCenter->setMonth("4");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("15-04-2020"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);


        //El Kef
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "El Kef"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("20");
        $privateCenter->setContinusNumber("50");
        $privateCenter->setInitialContiusNumber("50");
        $privateCenter->setChangeNumber("50");
        $privateCenter->setClosedTrainingCenterNumber("30");
        $privateCenter->setYear("2019");
        $privateCenter->setMonth("11");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("01-11-2019"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);

        //Mahdia
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Mahdia"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("17");
        $privateCenter->setContinusNumber("42");
        $privateCenter->setInitialContiusNumber("41");
        $privateCenter->setChangeNumber("15");
        $privateCenter->setClosedTrainingCenterNumber("32");
        $privateCenter->setYear("2017");
        $privateCenter->setMonth("4");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("12-04-2017"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);

        //La Manouba
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "La Manouba"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("23");
        $privateCenter->setContinusNumber("55");
        $privateCenter->setInitialContiusNumber("56");
        $privateCenter->setChangeNumber("66");
        $privateCenter->setClosedTrainingCenterNumber("28");
        $privateCenter->setYear("2016");
        $privateCenter->setMonth("11");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("18-11-2016"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);


        //Médnine
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Médnine"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("66");
        $privateCenter->setContinusNumber("55");
        $privateCenter->setInitialContiusNumber("51");
        $privateCenter->setChangeNumber("20");
        $privateCenter->setClosedTrainingCenterNumber("30");
        $privateCenter->setYear("2015");
        $privateCenter->setMonth("12");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("28-12-2015"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);

        //Monastir
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Monastir"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("20");
        $privateCenter->setContinusNumber("30");
        $privateCenter->setInitialContiusNumber("10");
        $privateCenter->setChangeNumber("40");
        $privateCenter->setClosedTrainingCenterNumber("5");
        $privateCenter->setYear("2016");
        $privateCenter->setMonth("1");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("07-01-2016"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);

        //Nabeul
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Nabeul"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("24");
        $privateCenter->setContinusNumber("42");
        $privateCenter->setInitialContiusNumber("29");
        $privateCenter->setChangeNumber("15");
        $privateCenter->setClosedTrainingCenterNumber("11");
        $privateCenter->setYear("2020");
        $privateCenter->setMonth("5");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("02-05-2020"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);

        //Sfax
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("33");
        $privateCenter->setContinusNumber("60");
        $privateCenter->setInitialContiusNumber("67");
        $privateCenter->setChangeNumber("50");
        $privateCenter->setClosedTrainingCenterNumber("33");
        $privateCenter->setYear("2015");
        $privateCenter->setMonth("4");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("14-04-2015"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);


        //Sidi Bouzid
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sidi Bouzid"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("20");
        $privateCenter->setContinusNumber("50");
        $privateCenter->setInitialContiusNumber("50");
        $privateCenter->setChangeNumber("50");
        $privateCenter->setClosedTrainingCenterNumber("30");
        $privateCenter->setYear("2015");
        $privateCenter->setMonth("10");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("19-10-2015"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);


        //Siliana
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Siliana"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("25");
        $privateCenter->setContinusNumber("55");
        $privateCenter->setInitialContiusNumber("55");
        $privateCenter->setChangeNumber("55");
        $privateCenter->setClosedTrainingCenterNumber("35");
        $privateCenter->setYear("2020");
        $privateCenter->setMonth("4");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("10-04-2020"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);


        //Sousse
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sousse"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("27");
        $privateCenter->setContinusNumber("50");
        $privateCenter->setInitialContiusNumber("50");
        $privateCenter->setChangeNumber("50");
        $privateCenter->setClosedTrainingCenterNumber("23");
        $privateCenter->setYear("2019");
        $privateCenter->setMonth("9");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("18-09-2019"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);

        //Tataouine
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tataouine"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("10");
        $privateCenter->setContinusNumber("20");
        $privateCenter->setInitialContiusNumber("20");
        $privateCenter->setChangeNumber("20");
        $privateCenter->setClosedTrainingCenterNumber("10");
        $privateCenter->setYear("2017");
        $privateCenter->setMonth("11");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("25-11-2017"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);

        //Tozeur
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("40");
        $privateCenter->setContinusNumber("70");
        $privateCenter->setInitialContiusNumber("70");
        $privateCenter->setChangeNumber("70");
        $privateCenter->setClosedTrainingCenterNumber("30");
        $privateCenter->setYear("2015");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("20-03-2015"));
        $privateCenter->setMonth("3");
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);

        //Tunis
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("15");
        $privateCenter->setContinusNumber("32");
        $privateCenter->setInitialContiusNumber("37");
        $privateCenter->setChangeNumber("10");
        $privateCenter->setClosedTrainingCenterNumber("17");
        $privateCenter->setYear("2019");
        $privateCenter->setMonth("12");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("13-12-2019"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);

        //Zaghouan
        $privateCenter = new PrivateTrainnigCenter();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Zaghouan"));
        $privateCenter->setGovernorat($gouvernorat);
        $privateCenter->setInitialNumber("20");
        $privateCenter->setContinusNumber("50");
        $privateCenter->setInitialContiusNumber("50");
        $privateCenter->setChangeNumber("50");
        $privateCenter->setClosedTrainingCenterNumber("30");
        $privateCenter->setYear("2019");
        $privateCenter->setMonth("11");
        $privateCenter->setDatePrivateTrainingCenter(new \DateTime("23-11-2019"));
        $privateCenter->setCreatedAt(new \DateTime());
        $privateCenter->setEnable(true);
        $manager->persist($privateCenter);


        $manager->flush();



    }



}