<?php

namespace Mfpe\ReferencielBundle\DataFixtures\ThirdDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
//Entity

use Mfpe\CollectDataBundle\Entity\LevelStudy;


class LevelStudyFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        $levelStudy=new LevelStudy();
        $centreForm = $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("intituleFr" => "Pro Bourse"));
        $statGraduate = $manager->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->findOneBy(array("trainingCenter" => $centreForm->getId()));
        $levelStudy->setStatGraduateTraining($statGraduate);
        $levelStudy->setNbrTrainedF("75");
        $levelStudy->setNbrTrainedH("75");
        $levelStudy->setNbrAbundant("75");
        $levelStudy->setNbrForeigner("75");
        $levelStudy->setNbrTotal("300");
        $levelStudy->setLevel("1");
        $levelStudy->setEnable(true);
        $manager->persist($levelStudy);
        $manager->flush();

        $levelStudy=new LevelStudy();
        $centreForm= $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("intituleFr" => "Pro Bourse"));
        $statGraduate = $manager->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->findOneBy(array("trainingCenter" => $centreForm->getId()));
        $levelStudy->setStatGraduateTraining($statGraduate);
        $levelStudy->setNbrTrainedF("50");
        $levelStudy->setNbrTrainedH("48");
        $levelStudy->setNbrAbundant("34");
        $levelStudy->setNbrForeigner("80");
        $levelStudy->setNbrTotal("212");
        $levelStudy->setLevel("2");
        $levelStudy->setEnable(true);
        $manager->persist($levelStudy);
        $manager->flush();

        $levelStudy=new LevelStudy();
        $centreForm = $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("intituleFr" => "Pro Bourse"));
        $statGraduate = $manager->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->findOneBy(array("trainingCenter" => $centreForm->getId()));
        $levelStudy->setStatGraduateTraining($statGraduate);
        $levelStudy->setNbrTrainedF("70");
        $levelStudy->setNbrTrainedH("50");
        $levelStudy->setNbrAbundant("25");
        $levelStudy->setNbrForeigner("57");
        $levelStudy->setNbrTotal("55");
        $levelStudy->setLevel("0");
        $levelStudy->setEnable(true);
        $manager->persist($levelStudy);
        $manager->flush();

        $levelStudy=new LevelStudy();
        $centreForm = $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("intituleFr" => "Pro Banque et Assurance"));
        $statGraduate = $manager->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->findOneBy(array("trainingCenter" => $centreForm->getId()));
        $levelStudy->setStatGraduateTraining($statGraduate);
        $levelStudy->setNbrTrainedF("70");
        $levelStudy->setNbrTrainedH("55");
        $levelStudy->setNbrAbundant("35");
        $levelStudy->setNbrForeigner("60");
        $levelStudy->setNbrTotal("220");
        $levelStudy->setLevel("1");
        $levelStudy->setEnable(true);
        $manager->persist($levelStudy);
        $manager->flush();


        $levelStudy=new LevelStudy();
        $centreForm= $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("intituleFr" => "Pro Banque et Assurance"));
        $statGraduate = $manager->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->findOneBy(array("trainingCenter" => $centreForm->getId()));
        $levelStudy->setStatGraduateTraining($statGraduate);
        $levelStudy->setNbrTrainedF("35");
        $levelStudy->setNbrTrainedH("25");
        $levelStudy->setNbrAbundant("45");
        $levelStudy->setNbrForeigner("45");
        $levelStudy->setNbrTotal("150");
        $levelStudy->setLevel("2");
        $levelStudy->setEnable(true);
        $manager->persist($levelStudy);
        $manager->flush();


        $levelStudy=new LevelStudy();
        $centreForm = $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("intituleFr" => "Pro Banque et Assurance"));
        $statGraduate = $manager->getRepository('MfpeCollectDataBundle:StatGraduateTraining')->findOneBy(array("trainingCenter" => $centreForm->getId()));
        $levelStudy->setStatGraduateTraining($statGraduate);
        $levelStudy->setNbrTrainedF("80");
        $levelStudy->setNbrTrainedH("65");
        $levelStudy->setNbrAbundant("25");
        $levelStudy->setNbrForeigner("57");
        $levelStudy->setNbrTotal("227");
        $levelStudy->setLevel("0");
        $levelStudy->setEnable(true);
        $manager->persist($levelStudy);
        $manager->flush();




    }

}