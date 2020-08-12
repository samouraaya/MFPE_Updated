<?php

namespace Mfpe\ReferencielBundle\DataFixtures\SecondDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

use Mfpe\DataSocioEconomicBundle\Entity\CsvBTSData;

Class CsvBtsDataFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


        //Ariana
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Femmes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2760");
        $csvBtsData->setMtCred("26707");
        $csvBtsData->setCoutTotalInvs("41011");
        $csvBtsData->setNbEmploiCreer("4344");
        $csvBtsData->setTypeFile("1");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ariana"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Ariana");
        $csvBtsData->setAnnee("2020");
        $csvBtsData->setMois("5");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113980");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);


        //Beja
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Hommes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2830");
        $csvBtsData->setMtCred("61070");
        $csvBtsData->setCoutTotalInvs("84288");
        $csvBtsData->setNbEmploiCreer("4899");
        $csvBtsData->setTypeFile("2");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Beja"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Beja");
        $csvBtsData->setAnnee("2019");
        $csvBtsData->setMois("4");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113981");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);


        //Ben Arous
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Femmes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2760");
        $csvBtsData->setMtCred("26707");
        $csvBtsData->setCoutTotalInvs("41011");
        $csvBtsData->setNbEmploiCreer("4344");
        $csvBtsData->setTypeFile("1");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ben Arous"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Ben Arous");
        $csvBtsData->setAnnee("2020");
        $csvBtsData->setMois("1");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113982");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //Bizerte
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Hommes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2830");
        $csvBtsData->setMtCred("61070");
        $csvBtsData->setCoutTotalInvs("84288");
        $csvBtsData->setNbEmploiCreer("4899");
        $csvBtsData->setTypeFile("2");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Bizerte"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Bizerte");
        $csvBtsData->setAnnee("2020");
        $csvBtsData->setMois("2");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113983");
        $csvBtsData->setCreatedAt(new \DateTime());
        $csvBtsData->setEnable(true);
        $manager->persist($csvBtsData);


        //Gabès
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Femmes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2760");
        $csvBtsData->setMtCred("26707");
        $csvBtsData->setCoutTotalInvs("41011");
        $csvBtsData->setNbEmploiCreer("4344");
        $csvBtsData->setTypeFile("1");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gabès"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Gabès");
        $csvBtsData->setAnnee("2019");
        $csvBtsData->setMois("3");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113984");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //Gafsa
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Hommes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2830");
        $csvBtsData->setMtCred("61070");
        $csvBtsData->setCoutTotalInvs("84288");
        $csvBtsData->setNbEmploiCreer("4899");
        $csvBtsData->setTypeFile("2");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gafsa"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Gafsa");
        $csvBtsData->setAnnee("2018");
        $csvBtsData->setMois("5");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113985");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);


        //Jendouba
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Femmes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2760");
        $csvBtsData->setMtCred("26707");
        $csvBtsData->setCoutTotalInvs("41011");
        $csvBtsData->setNbEmploiCreer("4344");
        $csvBtsData->setTypeFile("1");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Jendouba"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Jendouba");
        $csvBtsData->setAnnee("2017");
        $csvBtsData->setMois("7");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113986");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);


        //Kairouan
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Hommes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2830");
        $csvBtsData->setMtCred("61070");
        $csvBtsData->setCoutTotalInvs("84288");
        $csvBtsData->setNbEmploiCreer("4899");
        $csvBtsData->setTypeFile("2");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kairouan"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Kairouan");
        $csvBtsData->setAnnee("2016");
        $csvBtsData->setMois("2");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113987");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //Kasserine
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Femmes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2760");
        $csvBtsData->setMtCred("26707");
        $csvBtsData->setCoutTotalInvs("41011");
        $csvBtsData->setNbEmploiCreer("4344");
        $csvBtsData->setTypeFile("1");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("kasserine");
        $csvBtsData->setAnnee("2019");
        $csvBtsData->setMois("6");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113988");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //Kébili
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Hommes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2830");
        $csvBtsData->setMtCred("61070");
        $csvBtsData->setCoutTotalInvs("84288");
        $csvBtsData->setNbEmploiCreer("4899");
        $csvBtsData->setTypeFile("2");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kébili"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Kébili");
        $csvBtsData->setAnnee("2019");
        $csvBtsData->setMois("8");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113989");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);
        //El Kef
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Femmes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2760");
        $csvBtsData->setMtCred("26707");
        $csvBtsData->setCoutTotalInvs("41011");
        $csvBtsData->setNbEmploiCreer("4344");
        $csvBtsData->setTypeFile("1");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "El Kef"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("El kef");
        $csvBtsData->setAnnee("2018");
        $csvBtsData->setMois("9");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113990");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //Mahdia
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Hommes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2830");
        $csvBtsData->setMtCred("61070");
        $csvBtsData->setCoutTotalInvs("84288");
        $csvBtsData->setNbEmploiCreer("4899");
        $csvBtsData->setTypeFile("2");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Mahdia"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Mahdia");
        $csvBtsData->setAnnee("2020");
        $csvBtsData->setMois("10");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113991");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //La Manouba
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Femmes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2760");
        $csvBtsData->setMtCred("26707");
        $csvBtsData->setCoutTotalInvs("41011");
        $csvBtsData->setNbEmploiCreer("4344");
        $csvBtsData->setTypeFile("1");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "La Manouba"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("La Manouba");
        $csvBtsData->setAnnee("2016");
        $csvBtsData->setMois("11");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113992");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);


        //Médnine
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Femmes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2760");
        $csvBtsData->setMtCred("26707");
        $csvBtsData->setCoutTotalInvs("41011");
        $csvBtsData->setNbEmploiCreer("4344");
        $csvBtsData->setTypeFile("1");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Médnine"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Médnine");
        $csvBtsData->setAnnee("2015");
        $csvBtsData->setMois("1");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113993");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //Monastir
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Hommes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2830");
        $csvBtsData->setMtCred("61070");
        $csvBtsData->setCoutTotalInvs("84288");
        $csvBtsData->setNbEmploiCreer("4899");
        $csvBtsData->setTypeFile("2");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Monastir"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Monastir");
        $csvBtsData->setAnnee("2015");
        $csvBtsData->setMois("3");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113994");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //Nabeul
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Femmes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2760");
        $csvBtsData->setMtCred("26707");
        $csvBtsData->setCoutTotalInvs("41011");
        $csvBtsData->setNbEmploiCreer("4344");
        $csvBtsData->setTypeFile("1");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Nabeul"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Nabeul");
        $csvBtsData->setAnnee("2019");
        $csvBtsData->setMois("12");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113995");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //Sfax
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Hommes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2830");
        $csvBtsData->setMtCred("61070");
        $csvBtsData->setCoutTotalInvs("84288");
        $csvBtsData->setNbEmploiCreer("4899");
        $csvBtsData->setTypeFile("2");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Sfax");
        $csvBtsData->setAnnee("2018");
        $csvBtsData->setMois("12");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113996");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);


        //Sidi Bouzid
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Femmes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2760");
        $csvBtsData->setMtCred("26707");
        $csvBtsData->setCoutTotalInvs("41011");
        $csvBtsData->setNbEmploiCreer("4344");
        $csvBtsData->setTypeFile("1");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sidi Bouzid"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Sidi Bouzid");
        $csvBtsData->setAnnee("2017");
        $csvBtsData->setMois("12");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113997");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);


        //Siliana
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Hommes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2830");
        $csvBtsData->setMtCred("61070");
        $csvBtsData->setCoutTotalInvs("84288");
        $csvBtsData->setNbEmploiCreer("4899");
        $csvBtsData->setTypeFile("2");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Siliana"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Siliana");
        $csvBtsData->setAnnee("2014");
        $csvBtsData->setMois("5");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113998");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //Sousse
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Femmes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2760");
        $csvBtsData->setMtCred("26707");
        $csvBtsData->setCoutTotalInvs("41011");
        $csvBtsData->setNbEmploiCreer("4344");
        $csvBtsData->setTypeFile("1");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sousse"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Sousse");
        $csvBtsData->setAnnee("2014");
        $csvBtsData->setMois("2");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589113999");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //Tataouine
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Hommes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2830");
        $csvBtsData->setMtCred("61070");
        $csvBtsData->setCoutTotalInvs("84288");
        $csvBtsData->setNbEmploiCreer("4899");
        $csvBtsData->setTypeFile("2");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tataouine"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Tataouine");
        $csvBtsData->setAnnee("2020");
        $csvBtsData->setMois("9");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589114000");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //Tozeur
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Femmes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2760");
        $csvBtsData->setMtCred("26707");
        $csvBtsData->setCoutTotalInvs("41011");
        $csvBtsData->setNbEmploiCreer("4344");
        $csvBtsData->setTypeFile("1");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Tozeur");
        $csvBtsData->setAnnee("2029");
        $csvBtsData->setMois("10");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589114001");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //Tunis
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Hommes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2830");
        $csvBtsData->setMtCred("61070");
        $csvBtsData->setCoutTotalInvs("84288");
        $csvBtsData->setNbEmploiCreer("4899");
        $csvBtsData->setTypeFile("2");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Tunis");
        $csvBtsData->setAnnee("2018");
        $csvBtsData->setMois("7");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589114002");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);

        //Zaghouan
        $csvBtsData = new csvBtsData();
        $csvBtsData->setLibelle("Femmes");
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $csvBtsData->setSecteur($secteur);
        $csvBtsData->setNbCred("2760");
        $csvBtsData->setMtCred("26707");
        $csvBtsData->setCoutTotalInvs("41011");
        $csvBtsData->setNbEmploiCreer("4344");
        $csvBtsData->setTypeFile("1");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Zaghouan"));
        $csvBtsData->setGovernoratId($gouvernorat);
        $csvBtsData->setGouvernorat("Zaghouan");
        $csvBtsData->setAnnee("2020");
        $csvBtsData->setMois("4");
        $csvBtsData->setFileName("excel_projet.xlsx");
        $csvBtsData->setFileId("1589114003");
        $csvBtsData->setEnable(true);
        $csvBtsData->setCreatedAt(new \DateTime());
        $manager->persist($csvBtsData);
        $manager->flush();



    }
}
