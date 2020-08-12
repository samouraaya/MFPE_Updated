<?php

namespace Mfpe\ReferencielBundle\DataFixtures\SecondDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

use Mfpe\CollectDataBundle\Entity\ProjectDataCsv;

Class CsvProjectDataFixtures extends Fixture
{


    public function load(ObjectManager $manager)
    {
        //Tunis
        $projectData = new ProjectDataCsv();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $projectData->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $projectData->setDelegation($delegation);
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $projectData->setSector($secteur);
        $projectData->setGovernoratTitle("Tunis");
        $projectData->setDelegationTitle("Carthage");
        $projectData->setTitleProject("Projet a");
        $projectData->setTypeProject("public");
        $projectData->setSectorTitle("Agroalimentaire");
        $projectData->setProjectLeader("Lead 1");
        $projectData->setRegistrationProjectYear("2020");
        $projectData->setProjectCost("120000");
        $projectData->setProjectComponent("ac");
        $projectData->setProjectCompletionDate(new \DateTime("01-05-2020"));
        $projectData->setTypeFinance("espece");
        $projectData->setFunders("ab1");
        $projectData->setProjectCostUpdated("150000");
        $projectData->setProjectCostUpdatedDate(new \DateTime("2019-01-05"));
        $projectData->setProjectFollowUpDate(new \DateTime("01-01-1970"));
        $projectData->setExpenseReal("1400000");
        $projectData->setPhysicalProjectProgress("zz");
        $projectData->setProjectProgressPercent("1000");
        $projectData->setObservation("abc");
        $projectData->setAnnee("2015");
        $projectData->setMois("1");
        $projectData->setFileName("excel_projet.xlsx");
        $projectData->setFileId("1589113991");
        $projectData->setEnable(true);
        $manager->persist($projectData);



        //Tozeur
        $projectData = new ProjectDataCsv();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $projectData->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Nefta"));
        $projectData->setDelegation($delegation);
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $projectData->setSector($secteur);
        $projectData->setGovernoratTitle("Tozeur");
        $projectData->setDelegationTitle("Nefta");
        $projectData->setTitleProject("Projet b");
        $projectData->setTypeProject("public");
        $projectData->setSectorTitle("Agroalimentaire");
        $projectData->setProjectLeader("Lead 2");
        $projectData->setRegistrationProjectYear("2020");
        $projectData->setProjectCost("120000");
        $projectData->setProjectComponent("ac");
        $projectData->setProjectCompletionDate(new \DateTime("01-05-2020"));
        $projectData->setTypeFinance("espece");
        $projectData->setFunders("ab2");
        $projectData->setProjectCostUpdated("150000");
        $projectData->setProjectCostUpdatedDate(new \DateTime("2019-01-05"));
        $projectData->setProjectFollowUpDate(new \DateTime("01-01-1970"));
        $projectData->setExpenseReal("1400000");
        $projectData->setPhysicalProjectProgress("zz");
        $projectData->setProjectProgressPercent("1000");
        $projectData->setObservation("abc");
        $projectData->setAnnee("2015");
        $projectData->setMois("3");
        $projectData->setFileName("excel_projet.xlsx");
        $projectData->setFileId("1589113993");
        $projectData->setEnable(true);
        $manager->persist($projectData);


        //Tozeur
        $projectData = new ProjectDataCsv();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $projectData->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Degache"));
        $projectData->setDelegation($delegation);
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $projectData->setSector($secteur);
        $projectData->setGovernoratTitle("Tozeur");
        $projectData->setDelegationTitle("Degache");
        $projectData->setTitleProject("Projet c");
        $projectData->setTypeProject("public");
        $projectData->setSectorTitle("Agroalimentaire");
        $projectData->setProjectLeader("Lead 3");
        $projectData->setRegistrationProjectYear("2020");
        $projectData->setProjectCost("120000");
        $projectData->setProjectComponent("ac");
        $projectData->setProjectCompletionDate(new \DateTime("01-05-2020"));
        $projectData->setTypeFinance("espece");
        $projectData->setFunders("ab3");
        $projectData->setProjectCostUpdated("150000");
        $projectData->setProjectCostUpdatedDate(new \DateTime("2019-01-05"));
        $projectData->setProjectFollowUpDate(new \DateTime("01-01-1970"));
        $projectData->setExpenseReal("1400000");
        $projectData->setPhysicalProjectProgress("zz");
        $projectData->setProjectProgressPercent("1000");
        $projectData->setObservation("abc");
        $projectData->setAnnee("2016");
        $projectData->setMois("5");
        $projectData->setFileName("excel_projet.xlsx");
        $projectData->setFileId("1589113994");
        $projectData->setEnable(true);
        $manager->persist($projectData);


        //Sfax
        $projectData = new ProjectDataCsv();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $projectData->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Sfax Ville"));
        $projectData->setDelegation($delegation);
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $projectData->setSector($secteur);
        $projectData->setGovernoratTitle("Sfax");
        $projectData->setDelegationTitle("Sfax Ville");
        $projectData->setTitleProject("Projet d");
        $projectData->setTypeProject("public");
        $projectData->setSectorTitle("Transport");
        $projectData->setProjectLeader("Lead 4");
        $projectData->setRegistrationProjectYear("2020");
        $projectData->setProjectCost("120000");
        $projectData->setProjectComponent("ac");
        $projectData->setProjectCompletionDate(new \DateTime("01-05-2020"));
        $projectData->setTypeFinance("espece");
        $projectData->setFunders("ab4");
        $projectData->setProjectCostUpdated("150000");
        $projectData->setProjectCostUpdatedDate(new \DateTime("2019-01-05"));
        $projectData->setProjectFollowUpDate(new \DateTime("01-01-1970"));
        $projectData->setExpenseReal("1400000");
        $projectData->setPhysicalProjectProgress("zz");
        $projectData->setProjectProgressPercent("1000");
        $projectData->setObservation("abc");
        $projectData->setAnnee("2016");
        $projectData->setMois("7");
        $projectData->setFileName("excel_projet.xlsx");
        $projectData->setFileId("1589113995");
        $projectData->setEnable(true);
        $manager->persist($projectData);

        //Sfax
        $projectData = new ProjectDataCsv();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $projectData->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Mahrès"));
        $projectData->setDelegation($delegation);
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $projectData->setSector($secteur);
        $projectData->setGovernoratTitle("Sfax");
        $projectData->setDelegationTitle("Mahrès");
        $projectData->setTitleProject("Projet e");
        $projectData->setTypeProject("public");
        $projectData->setSectorTitle("Agroalimentaire");
        $projectData->setProjectLeader("Lead 5");
        $projectData->setRegistrationProjectYear("2020");
        $projectData->setProjectCost("120000");
        $projectData->setProjectComponent("ac");
        $projectData->setProjectCompletionDate(new \DateTime("01-05-2020"));
        $projectData->setTypeFinance("espece");
        $projectData->setFunders("ab5");
        $projectData->setProjectCostUpdated("150000");
        $projectData->setProjectCostUpdatedDate(new \DateTime("2019-01-05"));
        $projectData->setProjectFollowUpDate(new \DateTime("01-01-1970"));
        $projectData->setExpenseReal("1400000");
        $projectData->setPhysicalProjectProgress("zz");
        $projectData->setProjectProgressPercent("1000");
        $projectData->setObservation("abc");
        $projectData->setAnnee("2016");
        $projectData->setMois("10");
        $projectData->setFileName("excel_projet.xlsx");
        $projectData->setFileId("1589113996");
        $projectData->setEnable(true);
        $manager->persist($projectData);


        //Kasserine
        $projectData = new ProjectDataCsv();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectData->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Sbeïtla"));
        $projectData->setDelegation($delegation);
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $projectData->setSector($secteur);
        $projectData->setGovernoratTitle("Kasserine");
        $projectData->setDelegationTitle("Sbeitla");
        $projectData->setTitleProject("Projet f");
        $projectData->setTypeProject("public");
        $projectData->setSectorTitle("Transport");
        $projectData->setProjectLeader("Lead 6");
        $projectData->setRegistrationProjectYear("2020");
        $projectData->setProjectCost("120000");
        $projectData->setProjectComponent("ac");
        $projectData->setProjectCompletionDate(new \DateTime("01-05-2020"));
        $projectData->setTypeFinance("espece");
        $projectData->setFunders("ab6");
        $projectData->setProjectCostUpdated("150000");
        $projectData->setProjectCostUpdatedDate(new \DateTime("2019-01-05"));
        $projectData->setProjectFollowUpDate(new \DateTime("01-01-1970"));
        $projectData->setExpenseReal("1400000");
        $projectData->setPhysicalProjectProgress("zz");
        $projectData->setProjectProgressPercent("1000");
        $projectData->setObservation("abc");
        $projectData->setAnnee("2018");
        $projectData->setMois("5");
        $projectData->setFileName("excel_projet.xlsx");
        $projectData->setFileId("1589113997");
        $projectData->setEnable(true);
        $manager->persist($projectData);

        //Kasserine
        $projectData = new ProjectDataCsv();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectData->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Sbiba"));
        $projectData->setDelegation($delegation);
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $projectData->setSector($secteur);
        $projectData->setGovernoratTitle("Kasserine");
        $projectData->setDelegationTitle("Sbiba");
        $projectData->setTitleProject("Projet g");
        $projectData->setTypeProject("public");
        $projectData->setSectorTitle("Agroalimentaire");
        $projectData->setProjectLeader("Lead 7");
        $projectData->setRegistrationProjectYear("2020");
        $projectData->setProjectCost("120000");
        $projectData->setProjectComponent("ac");
        $projectData->setProjectCompletionDate(new \DateTime("01-05-2020"));
        $projectData->setTypeFinance("espece");
        $projectData->setFunders("ab7");
        $projectData->setProjectCostUpdated("150000");
        $projectData->setProjectCostUpdatedDate(new \DateTime("2019-01-05"));
        $projectData->setProjectFollowUpDate(new \DateTime("01-01-1970"));
        $projectData->setExpenseReal("1400000");
        $projectData->setPhysicalProjectProgress("zz");
        $projectData->setProjectProgressPercent("1000");
        $projectData->setObservation("abc");
        $projectData->setAnnee("2018");
        $projectData->setMois("10");
        $projectData->setFileName("excel_projet.xlsx");
        $projectData->setFileId("1589113998");
        $projectData->setEnable(true);
        $manager->persist($projectData);


        //Kasserine
        $projectData = new ProjectDataCsv();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectData->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Foussana"));
        $projectData->setDelegation($delegation);
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $projectData->setSector($secteur);
        $projectData->setGovernoratTitle("Kasserine");
        $projectData->setDelegationTitle("Foussana");
        $projectData->setTitleProject("Projet h");
        $projectData->setTypeProject("public");
        $projectData->setSectorTitle("Agroalimentaire");
        $projectData->setProjectLeader("Lead 8");
        $projectData->setRegistrationProjectYear("2020");
        $projectData->setProjectCost("120000");
        $projectData->setProjectComponent("ac");
        $projectData->setProjectCompletionDate(new \DateTime("01-05-2020"));
        $projectData->setTypeFinance("espece");
        $projectData->setFunders("ab8");
        $projectData->setProjectCostUpdated("150000");
        $projectData->setProjectCostUpdatedDate(new \DateTime("2019-01-05"));
        $projectData->setProjectFollowUpDate(new \DateTime("01-01-1970"));
        $projectData->setExpenseReal("1400000");
        $projectData->setPhysicalProjectProgress("zz");
        $projectData->setProjectProgressPercent("1000");
        $projectData->setObservation("abc");
        $projectData->setAnnee("2019");
        $projectData->setMois("1");
        $projectData->setFileName("excel_projet.xlsx");
        $projectData->setFileId("1589113999");
        $projectData->setEnable(true);
        $manager->persist($projectData);

        //Kasserine
        $projectData = new ProjectDataCsv();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $projectData->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Kasserine Nord"));
        $projectData->setDelegation($delegation);
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $projectData->setSector($secteur);
        $projectData->setGovernoratTitle("Kasserine");
        $projectData->setDelegationTitle("Kasserine Nord");
        $projectData->setTitleProject("Projet h");
        $projectData->setTypeProject("public");
        $projectData->setSectorTitle("Transport");
        $projectData->setProjectLeader("Lead 9");
        $projectData->setRegistrationProjectYear("2020");
        $projectData->setProjectCost("120000");
        $projectData->setProjectComponent("ac");
        $projectData->setProjectCompletionDate(new \DateTime("01-05-2020"));
        $projectData->setTypeFinance("espece");
        $projectData->setFunders("ab9");
        $projectData->setProjectCostUpdated("150000");
        $projectData->setProjectCostUpdatedDate(new \DateTime("2019-01-05"));
        $projectData->setProjectFollowUpDate(new \DateTime("01-01-1970"));
        $projectData->setExpenseReal("1400000");
        $projectData->setPhysicalProjectProgress("zz");
        $projectData->setProjectProgressPercent("1000");
        $projectData->setObservation("abc");
        $projectData->setAnnee("2019");
        $projectData->setMois("11");
        $projectData->setFileName("excel_projet.xlsx");
        $projectData->setFileId("1589114000");
        $projectData->setEnable(true);
        $manager->persist($projectData);

        //Tunis
        $projectData = new ProjectDataCsv();
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $projectData->setGovernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Bab-El-Bhar"));
        $projectData->setDelegation($delegation);
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $projectData->setSector($secteur);
        $projectData->setGovernoratTitle("Tunis");
        $projectData->setDelegationTitle("Bab-El-Bhar");
        $projectData->setTitleProject("Projet j");
        $projectData->setTypeProject("public");
        $projectData->setSectorTitle("Transport");
        $projectData->setProjectLeader("Lead 10");
        $projectData->setRegistrationProjectYear("2020");
        $projectData->setProjectCost("120000");
        $projectData->setProjectComponent("ac");
        $projectData->setProjectCompletionDate(new \DateTime("01-05-2020"));
        $projectData->setTypeFinance("espece");
        $projectData->setFunders("ab10");
        $projectData->setProjectCostUpdated("150000");
        $projectData->setProjectCostUpdatedDate(new \DateTime("2019-01-05"));
        $projectData->setProjectFollowUpDate(new \DateTime("01-01-1970"));
        $projectData->setExpenseReal("1400000");
        $projectData->setPhysicalProjectProgress("zz");
        $projectData->setProjectProgressPercent("1000");
        $projectData->setObservation("abc");
        $projectData->setAnnee("2020");
        $projectData->setMois("4");
        $projectData->setFileName("excel_projet.xlsx");
        $projectData->setFileId("1589114001");
        $projectData->setEnable(true);
        $manager->persist($projectData);

        $manager->flush();
    }

}