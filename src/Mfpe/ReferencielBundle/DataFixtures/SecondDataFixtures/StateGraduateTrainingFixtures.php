<?php

namespace Mfpe\ReferencielBundle\DataFixtures\SecondDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
//Entity

use Mfpe\CollectDataBundle\Entity\StatGraduateTraining;


class StateGraduateTrainingFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {


        $statGraduate = new StatGraduateTraining();
        $centre= $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("intituleFr" => "Pro Banque et Assurance"));
        $statGraduate->setTrainingCenter($centre);
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Banque et Assurance"));
        $statGraduate->setSector($secteur);
        $sousSecteur= $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Intermédiaire en bourse"));
        $statGraduate->setSubsector($sousSecteur);
        $specialite= $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findOneBy(array("intituleFr" => "Bourse"));
        $statGraduate->setSpeciality($specialite);
        $statGraduate->setApproved("1");
        $statGraduate->setAdministrativeYear("2020");
        $statGraduate->setMonth("5");
        $statGraduate->setSectorType("true");
        $statGraduate->setEnable(true);
        $statGraduate->setDateStatGraduateTraining(new \DateTime("11-05-2020"));
        $manager->persist($statGraduate);
        $manager->flush();


        $statGraduate = new StatGraduateTraining();
        $centre= $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("intituleFr" => "Pro Bourse"));
        $statGraduate->setTrainingCenter($centre);
        $secteur= $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Banque et Assurance"));
        $statGraduate->setSector($secteur);
        $sousSecteur= $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Intermédiaire en bourse"));
        $statGraduate->setSubsector($sousSecteur);
        $specialite= $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findOneBy(array("intituleFr" => "Bourse"));
        $statGraduate->setSpeciality($specialite);
        $statGraduate->setApproved("0");
        $statGraduate->setAdministrativeYear("2020");
        $statGraduate->setMonth("5");
        $statGraduate->setSectorType("false");
        $statGraduate->setEnable(true);
        $statGraduate->setDateStatGraduateTraining(new \DateTime("11-05-2020"));
        $manager->persist($statGraduate);
        $manager->flush();

    }


}