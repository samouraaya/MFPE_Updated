<?php

namespace Mfpe\ReferencielBundle\DataFixtures\SecondDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

use Mfpe\DataSocioEconomicBundle\Entity\CsvSocioEconomicData;

Class CsvSocioEconomicDataFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        //Ariana 2020
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ariana"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Ariana");
        $csvEconomicData->setCodeGovernorat("TN-12");
        $csvEconomicData->setPopulationSize("629056 ");
        $csvEconomicData->setPopulationAgeActivity("39");
        $csvEconomicData->setActivePopulation("439378");
        $csvEconomicData->setActivePopulationOccupied("400874");
        $csvEconomicData->setUnemployedPopulation("26252 ");
        $csvEconomicData->setUnemploymentRate("11.6");
        $csvEconomicData->setNumberCompany("1620");
        $csvEconomicData->setAnnee("2020");
        $csvEconomicData->setMois("1");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113980");
        $csvEconomicData->setCreatedAt(new \DateTime("09-10-2016"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Ariana 2019
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ariana"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Ariana");
        $csvEconomicData->setCodeGovernorat("TN-12");
        $csvEconomicData->setPopulationSize("629856 ");
        $csvEconomicData->setPopulationAgeActivity("33");
        $csvEconomicData->setActivePopulation("439348");
        $csvEconomicData->setActivePopulationOccupied("400874");
        $csvEconomicData->setUnemployedPopulation("263252 ");
        $csvEconomicData->setUnemploymentRate("11.6");
        $csvEconomicData->setNumberCompany("1660");
        $csvEconomicData->setAnnee("2019");
        $csvEconomicData->setMois("1");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113980");
        $csvEconomicData->setCreatedAt(new \DateTime("09-10-2016"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);


        //Beja
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Béja"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Béja");
        $csvEconomicData->setCodeGovernorat("TN-31");
        $csvEconomicData->setPopulationSize("306591");
        $csvEconomicData->setPopulationAgeActivity("45");
        $csvEconomicData->setActivePopulation("234922");
        $csvEconomicData->setActivePopulationOccupied("203789");
        $csvEconomicData->setUnemployedPopulation("18344");
        $csvEconomicData->setUnemploymentRate("16.8");
        $csvEconomicData->setNumberCompany("162");
        $csvEconomicData->setAnnee("2020");
        $csvEconomicData->setMois("2");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113981");
        $csvEconomicData->setCreatedAt(new \DateTime("15-04-2016"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);


        //Ben Arous
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ben Arous"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Ben Arous");
        $csvEconomicData->setCodeGovernorat("TN-13");
        $csvEconomicData->setPopulationSize("678326");
        $csvEconomicData->setPopulationAgeActivity("50");
        $csvEconomicData->setActivePopulation("484240");
        $csvEconomicData->setActivePopulationOccupied("462874");
        $csvEconomicData->setUnemployedPopulation("32566");
        $csvEconomicData->setUnemploymentRate("13.1");
        $csvEconomicData->setNumberCompany("1620");
        $csvEconomicData->setAnnee("2020");
        $csvEconomicData->setMois("4");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113982");
        $csvEconomicData->setCreatedAt(new \DateTime("31-07-2017"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Bizerte
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Bizerte"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Bizerte");
        $csvEconomicData->setCodeGovernorat("TN-23");
        $csvEconomicData->setPopulationSize("586032");
        $csvEconomicData->setPopulationAgeActivity("49");
        $csvEconomicData->setActivePopulation("433289");
        $csvEconomicData->setActivePopulationOccupied("408985");
        $csvEconomicData->setUnemployedPopulation("25893");
        $csvEconomicData->setUnemploymentRate("10.0");
        $csvEconomicData->setNumberCompany("486");
        $csvEconomicData->setAnnee("2018");
        $csvEconomicData->setMois("5");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setCreatedAt(new \DateTime("07-09-2017"));
        $csvEconomicData->setFileId("1589113983");
        $csvEconomicData->setEnable(true);
        $manager->persist( $csvEconomicData);


        //Gabès
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gabès"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Gabès");
        $csvEconomicData->setCodeGovernorat("TN-81");
        $csvEconomicData->setPopulationSize("391478");
        $csvEconomicData->setPopulationAgeActivity("38");
        $csvEconomicData->setActivePopulation("283098");
        $csvEconomicData->setActivePopulationOccupied("108547");
        $csvEconomicData->setUnemployedPopulation("22506");
        $csvEconomicData->setUnemploymentRate("24.4");
        $csvEconomicData->setNumberCompany("243");
        $csvEconomicData->setAnnee("2018");
        $csvEconomicData->setMois("6");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setCreatedAt(new \DateTime("07-09-2017"));
        $csvEconomicData->setFileId("1589113984");
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Gafsa
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gafsa"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Gafsa");
        $csvEconomicData->setCodeGovernorat("TN-71");
        $csvEconomicData->setPopulationSize("347717 ");
        $csvEconomicData->setPopulationAgeActivity("42");
        $csvEconomicData->setActivePopulation("255819");
        $csvEconomicData->setActivePopulationOccupied("155452");
        $csvEconomicData->setUnemployedPopulation("29369");
        $csvEconomicData->setUnemploymentRate("28.2");
        $csvEconomicData->setNumberCompany("162");
        $csvEconomicData->setAnnee("2018");
        $csvEconomicData->setMois("11");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113985");
        $csvEconomicData->setCreatedAt(new \DateTime("07-09-2017"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);


        //Jendouba
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Jendouba"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Jendouba");
        $csvEconomicData->setCodeGovernorat("TN-32");
        $csvEconomicData->setPopulationSize("404203");
        $csvEconomicData->setPopulationAgeActivity("37");
        $csvEconomicData->setActivePopulation("311827");
        $csvEconomicData->setActivePopulationOccupied("211854");
        $csvEconomicData->setUnemployedPopulation("29785");
        $csvEconomicData->setUnemploymentRate("18.9");
        $csvEconomicData->setNumberCompany("162");
        $csvEconomicData->setAnnee("2017");
        $csvEconomicData->setMois("5");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113986");
        $csvEconomicData->setCreatedAt(new \DateTime("07-09-2017"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);


        //Kairouan
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kairouan"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Kairouan");
        $csvEconomicData->setCodeGovernorat("TN-41");
        $csvEconomicData->setPopulationSize("586612");
        $csvEconomicData->setPopulationAgeActivity("30");
        $csvEconomicData->setActivePopulation("414094");
        $csvEconomicData->setActivePopulationOccupied("303874");
        $csvEconomicData->setUnemployedPopulation("28229");
        $csvEconomicData->setUnemploymentRate("15.1");
        $csvEconomicData->setNumberCompany("243");
        $csvEconomicData->setAnnee("2017");
        $csvEconomicData->setMois("1");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113987");
        $csvEconomicData->setCreatedAt(new \DateTime("25-06-2018"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Kasserine
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Kasserine");
        $csvEconomicData->setCodeGovernorat("TN-42");
        $csvEconomicData->setPopulationSize("452391");
        $csvEconomicData->setPopulationAgeActivity("28");
        $csvEconomicData->setActivePopulation("318062");
        $csvEconomicData->setActivePopulationOccupied("118742");
        $csvEconomicData->setUnemployedPopulation("28311");
        $csvEconomicData->setUnemploymentRate("30.0");
        $csvEconomicData->setNumberCompany("163");
        $csvEconomicData->setAnnee("2017");
        $csvEconomicData->setMois("8");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113988");
        $csvEconomicData->setCreatedAt(new \DateTime("07-09-2014"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Kébili
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kébili"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Kébili");
        $csvEconomicData->setCodeGovernorat("TN-73");
        $csvEconomicData->setPopulationSize("164500");
        $csvEconomicData->setPopulationAgeActivity("40");
        $csvEconomicData->setActivePopulation("118261");
        $csvEconomicData->setActivePopulationOccupied("90475");
        $csvEconomicData->setUnemployedPopulation("10835");
        $csvEconomicData->setUnemploymentRate("24.9");
        $csvEconomicData->setNumberCompany("52");
        $csvEconomicData->setAnnee("2017");
        $csvEconomicData->setMois("10");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113989");
        $csvEconomicData->setCreatedAt(new \DateTime("04-04-2020"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);
        //El Kef
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "El Kef"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("El Kef");
        $csvEconomicData->setCodeGovernorat("TN-33");
        $csvEconomicData->setPopulationSize("246867");
        $csvEconomicData->setPopulationAgeActivity("48");
        $csvEconomicData->setActivePopulation("190564");
        $csvEconomicData->setActivePopulationOccupied("60488");
        $csvEconomicData->setUnemployedPopulation("15529");
        $csvEconomicData->setUnemploymentRate("14.9");
        $csvEconomicData->setNumberCompany("38");
        $csvEconomicData->setAnnee("2017");
        $csvEconomicData->setMois("12");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113990");
        $csvEconomicData->setCreatedAt(new \DateTime("09-11-2016"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Mahdia
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Mahdia"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Mahdia");
        $csvEconomicData->setCodeGovernorat("TN-53");
        $csvEconomicData->setPopulationSize("431205");
        $csvEconomicData->setPopulationAgeActivity("43");
        $csvEconomicData->setActivePopulation("297933");
        $csvEconomicData->setActivePopulationOccupied("301658");
        $csvEconomicData->setUnemployedPopulation("14846");
        $csvEconomicData->setUnemploymentRate("15.48");
        $csvEconomicData->setNumberCompany("243");
        $csvEconomicData->setAnnee("2019");
        $csvEconomicData->setMois("5");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113991");
        $csvEconomicData->setCreatedAt(new \DateTime("02-09-2015"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //La Manouba
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "La Manouba"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("La Manouba");
        $csvEconomicData->setCodeGovernorat("TN-44");
        $csvEconomicData->setPopulationSize("402617");
        $csvEconomicData->setPopulationAgeActivity("52");
        $csvEconomicData->setActivePopulation("292810");
        $csvEconomicData->setActivePopulationOccupied("369547");
        $csvEconomicData->setUnemployedPopulation("25310");
        $csvEconomicData->setUnemploymentRate("22.4");
        $csvEconomicData->setNumberCompany("363");
        $csvEconomicData->setAnnee("2019");
        $csvEconomicData->setMois("1");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113992");
        $csvEconomicData->setCreatedAt(new \DateTime("11-01-2015"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);


        //Médnine
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Médnine"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Médnine");
        $csvEconomicData->setCodeGovernorat("TN-82");
        $csvEconomicData->setPopulationSize("502318");
        $csvEconomicData->setPopulationAgeActivity("39");
        $csvEconomicData->setActivePopulation("358126");
        $csvEconomicData->setActivePopulationOccupied("406874");
        $csvEconomicData->setUnemployedPopulation("23244");
        $csvEconomicData->setUnemploymentRate("18.3");
        $csvEconomicData->setNumberCompany("264");
        $csvEconomicData->setAnnee("2019");
        $csvEconomicData->setMois("2");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113993");
        $csvEconomicData->setCreatedAt(new \DateTime("14-04-2014"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Monastir
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Monastir"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Monastir");
        $csvEconomicData->setCodeGovernorat("TN-52");
        $csvEconomicData->setPopulationSize("581291");
        $csvEconomicData->setPopulationAgeActivity("33");
        $csvEconomicData->setActivePopulation("403251");
        $csvEconomicData->setActivePopulationOccupied("508947");
        $csvEconomicData->setUnemployedPopulation("18806");
        $csvEconomicData->setUnemploymentRate("6.6");
        $csvEconomicData->setNumberCompany("1172");
        $csvEconomicData->setAnnee("2019");
        $csvEconomicData->setMois("8");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113994");
        $csvEconomicData->setCreatedAt(new \DateTime("07-11-2019"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Nabeul
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Nabeul"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Nabeul");
        $csvEconomicData->setCodeGovernorat("TN-21");
        $csvEconomicData->setPopulationSize("831860");
        $csvEconomicData->setPopulationAgeActivity("23");
        $csvEconomicData->setActivePopulation("596412");
        $csvEconomicData->setActivePopulationOccupied("707894");
        $csvEconomicData->setUnemployedPopulation("31884");
        $csvEconomicData->setUnemploymentRate("10.4");
        $csvEconomicData->setNumberCompany("1252");
        $csvEconomicData->setAnnee("2014");
        $csvEconomicData->setMois("1");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113995");
        $csvEconomicData->setCreatedAt(new \DateTime("01-04-2015"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Sfax 2020
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Sfax");
        $csvEconomicData->setCodeGovernorat("TN-61");
        $csvEconomicData->setPopulationSize("995261");
        $csvEconomicData->setPopulationAgeActivity("35");
        $csvEconomicData->setActivePopulation("724678");
        $csvEconomicData->setActivePopulationOccupied("880714");
        $csvEconomicData->setUnemployedPopulation("39123");
        $csvEconomicData->setUnemploymentRate("9.8");
        $csvEconomicData->setNumberCompany("1630");
        $csvEconomicData->setAnnee("2020");
        $csvEconomicData->setMois("5");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113996");
        $csvEconomicData->setCreatedAt(new \DateTime("07-11-2016"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Sfax 2019
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Sfax");
        $csvEconomicData->setCodeGovernorat("TN-61");
        $csvEconomicData->setPopulationSize("995261");
        $csvEconomicData->setPopulationAgeActivity("35");
        $csvEconomicData->setActivePopulation("724678");
        $csvEconomicData->setActivePopulationOccupied("880714");
        $csvEconomicData->setUnemployedPopulation("39123");
        $csvEconomicData->setUnemploymentRate("9.8");
        $csvEconomicData->setNumberCompany("1630");
        $csvEconomicData->setAnnee("2019");
        $csvEconomicData->setMois("5");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113996");
        $csvEconomicData->setCreatedAt(new \DateTime("07-11-2016"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);


        //Sidi Bouzid 2020
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sidi Bouzid"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Sidi Bouzid");
        $csvEconomicData->setCodeGovernorat("TN-43");
        $csvEconomicData->setPopulationSize("443178 ");
        $csvEconomicData->setPopulationAgeActivity("38");
        $csvEconomicData->setActivePopulation("313933");
        $csvEconomicData->setActivePopulationOccupied("203741");
        $csvEconomicData->setUnemployedPopulation("23613");
        $csvEconomicData->setUnemploymentRate("19.4");
        $csvEconomicData->setNumberCompany("42");
        $csvEconomicData->setAnnee("2020");
        $csvEconomicData->setMois("5");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113997");
        $csvEconomicData->setCreatedAt(new \DateTime("24-11-2018"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Sidi Bouzid 2019
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sidi Bouzid"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Sidi Bouzid");
        $csvEconomicData->setCodeGovernorat("TN-43");
        $csvEconomicData->setPopulationSize("446178 ");
        $csvEconomicData->setPopulationAgeActivity("38");
        $csvEconomicData->setActivePopulation("319933");
        $csvEconomicData->setActivePopulationOccupied("203741");
        $csvEconomicData->setUnemployedPopulation("23213");
        $csvEconomicData->setUnemploymentRate("15.4");
        $csvEconomicData->setNumberCompany("43");
        $csvEconomicData->setAnnee("2019");
        $csvEconomicData->setMois("5");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113997");
        $csvEconomicData->setCreatedAt(new \DateTime("24-11-2018"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Siliana
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Siliana"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Siliana");
        $csvEconomicData->setCodeGovernorat("TN-34");
        $csvEconomicData->setPopulationSize("227477");
        $csvEconomicData->setPopulationAgeActivity("43");
        $csvEconomicData->setActivePopulation("167706");
        $csvEconomicData->setActivePopulationOccupied("107851");
        $csvEconomicData->setUnemployedPopulation("12598");
        $csvEconomicData->setUnemploymentRate("15.51");
        $csvEconomicData->setNumberCompany("64");
        $csvEconomicData->setAnnee("2015");
        $csvEconomicData->setMois("8");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113998");
        $csvEconomicData->setCreatedAt(new \DateTime("09-09-2019"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Sousse
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sousse"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Sousse");
        $csvEconomicData->setCodeGovernorat("TN-51");
        $csvEconomicData->setPopulationSize("716577");
        $csvEconomicData->setPopulationAgeActivity("39");
        $csvEconomicData->setActivePopulation("505579");
        $csvEconomicData->setActivePopulationOccupied("616789");
        $csvEconomicData->setUnemployedPopulation("29126");
        $csvEconomicData->setUnemploymentRate("14.9");
        $csvEconomicData->setNumberCompany("1539");
        $csvEconomicData->setAnnee("2015");
        $csvEconomicData->setMois("10");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589113999");
        $csvEconomicData->setCreatedAt(new \DateTime("13-12-2016"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Tataouine
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tataouine"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Tataouine");
        $csvEconomicData->setCodeGovernorat("TN-83");
        $csvEconomicData->setPopulationSize("150526");
        $csvEconomicData->setPopulationAgeActivity("42");
        $csvEconomicData->setActivePopulation("112146");
        $csvEconomicData->setActivePopulationOccupied("79886");
        $csvEconomicData->setUnemployedPopulation("12085");
        $csvEconomicData->setUnemploymentRate("12.4");
        $csvEconomicData->setNumberCompany("42");
        $csvEconomicData->setAnnee("2015");
        $csvEconomicData->setMois("11");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589114000");
        $csvEconomicData->setCreatedAt(new \DateTime("07-02-2020"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Tozeur
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Tozeur");
        $csvEconomicData->setCodeGovernorat("TN-72");
        $csvEconomicData->setPopulationSize("112458");
        $csvEconomicData->setPopulationAgeActivity("45");
        $csvEconomicData->setActivePopulation("80157");
        $csvEconomicData->setActivePopulationOccupied("50741");
        $csvEconomicData->setUnemployedPopulation("5743");
        $csvEconomicData->setUnemploymentRate("15.51");
        $csvEconomicData->setNumberCompany("60");
        $csvEconomicData->setAnnee("2015");
        $csvEconomicData->setMois("12");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589114001");
        $csvEconomicData->setCreatedAt(new \DateTime("19-09-2016"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Tunis 2020
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Tunis");
        $csvEconomicData->setCodeGovernorat("TN-11");
        $csvEconomicData->setPopulationSize("1070374");
        $csvEconomicData->setPopulationAgeActivity("45");
        $csvEconomicData->setActivePopulation("837597");
        $csvEconomicData->setActivePopulationOccupied("808742");
        $csvEconomicData->setUnemployedPopulation("58525");
        $csvEconomicData->setUnemploymentRate("13.9");
        $csvEconomicData->setNumberCompany("1730");
        $csvEconomicData->setAnnee("2020");
        $csvEconomicData->setMois("3");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589114002");
        $csvEconomicData->setCreatedAt(new \DateTime("19-10-2014"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);


        //Tunis 2019
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Tunis");
        $csvEconomicData->setCodeGovernorat("TN-11");
        $csvEconomicData->setPopulationSize("1077485");
        $csvEconomicData->setPopulationAgeActivity("48");
        $csvEconomicData->setActivePopulation("837097");
        $csvEconomicData->setActivePopulationOccupied("800742");
        $csvEconomicData->setUnemployedPopulation("587525");
        $csvEconomicData->setUnemploymentRate("12.9");
        $csvEconomicData->setNumberCompany("1330");
        $csvEconomicData->setAnnee("2019");
        $csvEconomicData->setMois("3");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589114002");
        $csvEconomicData->setCreatedAt(new \DateTime("19-10-2014"));
        $csvEconomicData->setEnable(true);
        $manager->persist($csvEconomicData);

        //Zaghouan
        $csvEconomicData = new CsvSocioEconomicData();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Zaghouan"));
        $csvEconomicData->setGovernoratId($gouvernorat);
        $csvEconomicData->setGovernorat("Zaghouan");
        $csvEconomicData->setCodeGovernorat("TN-22");
        $csvEconomicData->setPopulationSize("184402");
        $csvEconomicData->setPopulationAgeActivity("39");
        $csvEconomicData->setActivePopulation("132349");
        $csvEconomicData->setActivePopulationOccupied("110854");
        $csvEconomicData->setUnemployedPopulation("11193");
        $csvEconomicData->setUnemploymentRate("14.9");
        $csvEconomicData->setNumberCompany("251");
        $csvEconomicData->setAnnee("2020");
        $csvEconomicData->setMois("12");
        $csvEconomicData->setFileName("excel_projet.xlsx");
        $csvEconomicData->setFileId("1589114003");
        $csvEconomicData->setEnable(true);
        $csvEconomicData->setCreatedAt(new \DateTime("12-11-2017"));
        $manager->persist($csvEconomicData);


        $manager->flush();





    }



}