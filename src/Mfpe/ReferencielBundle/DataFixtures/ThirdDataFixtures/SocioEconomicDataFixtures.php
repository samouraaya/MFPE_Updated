<?php

namespace Mfpe\ReferencielBundle\DataFixtures\ThirdDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

//Entity
use Mfpe\DataSocioEconomicBundle\Entity\SocioEconomicData;

class SocioEconomicDataFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        //UNIT 1
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tunis"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("55");
        $socioEconomic->setHealthInstitutionYear("2015");
        $socioEconomic->setSchoolInstitutionNumber("50");
        $socioEconomic->setSchoolInstitutionYear("2015");
        $socioEconomic->setUniversityInstitutionNumber("19");
        $socioEconomic->setInstitutionUniversityYear("2020");
        $socioEconomic->setDropoutSchoolNumber("154");
        $socioEconomic->setDropoutSchoolYear("2015");
        $socioEconomic->setNeedyFamilyNumber("989");
        $socioEconomic->setNeedyFamilyYear("2015");
        $socioEconomic->setAssociationNumber("145");
        $socioEconomic->setAssociationYear("2015");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet A");
        $socioEconomic->setEnable(true);
        $socioEconomic->setCreatedAt(new \DateTime("11-01-2015"));
        $manager->persist($socioEconomic);
        $manager->flush();


        //UNIT 1
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tunis"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("60");
        $socioEconomic->setHealthInstitutionYear("2015");
        $socioEconomic->setSchoolInstitutionNumber("45");
        $socioEconomic->setSchoolInstitutionYear("2015");
        $socioEconomic->setUniversityInstitutionNumber("25");
        $socioEconomic->setInstitutionUniversityYear("2020");
        $socioEconomic->setDropoutSchoolNumber("125");
        $socioEconomic->setDropoutSchoolYear("2015");
        $socioEconomic->setNeedyFamilyNumber("552");
        $socioEconomic->setNeedyFamilyYear("2015");
        $socioEconomic->setAssociationNumber("14");
        $socioEconomic->setAssociationYear("2015");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet A");
        $socioEconomic->setEnable(true);
        $socioEconomic->setCreatedAt(new \DateTime("10-02-2016"));
        $manager->persist($socioEconomic);
        $manager->flush();

        //UNIT 1
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tunis"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("41");
        $socioEconomic->setHealthInstitutionYear("2015");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2015");
        $socioEconomic->setUniversityInstitutionNumber("63");
        $socioEconomic->setInstitutionUniversityYear("2020");
        $socioEconomic->setDropoutSchoolNumber("63");
        $socioEconomic->setDropoutSchoolYear("2015");
        $socioEconomic->setNeedyFamilyNumber("47");
        $socioEconomic->setNeedyFamilyYear("2015");
        $socioEconomic->setAssociationNumber("58");
        $socioEconomic->setAssociationYear("2015");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet A");
        $socioEconomic->setEnable(true);
        $socioEconomic->setCreatedAt(new \DateTime("13-03-2017"));
        $manager->persist($socioEconomic);
        $manager->flush();


        //UNIT 1
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tunis"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("74");
        $socioEconomic->setHealthInstitutionYear("2015");
        $socioEconomic->setSchoolInstitutionNumber("65");
        $socioEconomic->setSchoolInstitutionYear("2015");
        $socioEconomic->setUniversityInstitutionNumber("44");
        $socioEconomic->setInstitutionUniversityYear("2020");
        $socioEconomic->setDropoutSchoolNumber("32");
        $socioEconomic->setDropoutSchoolYear("2015");
        $socioEconomic->setNeedyFamilyNumber("41");
        $socioEconomic->setNeedyFamilyYear("2015");
        $socioEconomic->setAssociationNumber("63");
        $socioEconomic->setAssociationYear("2015");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet A");
        $socioEconomic->setEnable(true);
        $socioEconomic->setCreatedAt(new \DateTime("21-04-2018"));
        $manager->persist($socioEconomic);
        $manager->flush();


        //UNIT 1
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tunis"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("21");
        $socioEconomic->setHealthInstitutionYear("2015");
        $socioEconomic->setSchoolInstitutionNumber("74");
        $socioEconomic->setSchoolInstitutionYear("2015");
        $socioEconomic->setUniversityInstitutionNumber("88");
        $socioEconomic->setInstitutionUniversityYear("2020");
        $socioEconomic->setDropoutSchoolNumber("63");
        $socioEconomic->setDropoutSchoolYear("2015");
        $socioEconomic->setNeedyFamilyNumber("75");
        $socioEconomic->setNeedyFamilyYear("2015");
        $socioEconomic->setAssociationNumber("88");
        $socioEconomic->setAssociationYear("2015");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet A");
        $socioEconomic->setEnable(true);
        $socioEconomic->setCreatedAt(new \DateTime("30-06-2019"));
        $manager->persist($socioEconomic);
        $manager->flush();

        //UNIT 1
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tunis"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("44");
        $socioEconomic->setHealthInstitutionYear("2015");
        $socioEconomic->setSchoolInstitutionNumber("63");
        $socioEconomic->setSchoolInstitutionYear("2015");
        $socioEconomic->setUniversityInstitutionNumber("777");
        $socioEconomic->setInstitutionUniversityYear("2020");
        $socioEconomic->setDropoutSchoolNumber("14");
        $socioEconomic->setDropoutSchoolYear("2015");
        $socioEconomic->setNeedyFamilyNumber("32");
        $socioEconomic->setNeedyFamilyYear("2015");
        $socioEconomic->setAssociationNumber("63");
        $socioEconomic->setAssociationYear("2015");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet A");
        $socioEconomic->setEnable(true);
        $socioEconomic->setCreatedAt(new \DateTime("25-01-2020"));
        $manager->persist($socioEconomic);
        $manager->flush();

        //UNIT 2
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kasserine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2016");
        $socioEconomic->setSchoolInstitutionNumber("74");
        $socioEconomic->setSchoolInstitutionYear("2016");
        $socioEconomic->setUniversityInstitutionNumber("10");
        $socioEconomic->setInstitutionUniversityYear("2016");
        $socioEconomic->setDropoutSchoolNumber("30");
        $socioEconomic->setDropoutSchoolYear("2016");
        $socioEconomic->setNeedyFamilyNumber("74");
        $socioEconomic->setNeedyFamilyYear("2016");
        $socioEconomic->setAssociationNumber("10");
        $socioEconomic->setAssociationYear("2016");
        $socioEconomic->setDescription("pâtisserie   ");
        $socioEconomic->setCurrentProject("Projet B");
        $socioEconomic->setCreatedAt(new \DateTime("15-08-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);
        $manager->flush();

        //Unit 2
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kasserine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("22");
        $socioEconomic->setHealthInstitutionYear("2016");
        $socioEconomic->setSchoolInstitutionNumber("74");
        $socioEconomic->setSchoolInstitutionYear("2016");
        $socioEconomic->setUniversityInstitutionNumber("20");
        $socioEconomic->setInstitutionUniversityYear("2016");
        $socioEconomic->setDropoutSchoolNumber("32");
        $socioEconomic->setDropoutSchoolYear("2016");
        $socioEconomic->setNeedyFamilyNumber("24");
        $socioEconomic->setNeedyFamilyYear("2016");
        $socioEconomic->setAssociationNumber("77");
        $socioEconomic->setAssociationYear("2016");
        $socioEconomic->setDescription("pâtisserie   ");
        $socioEconomic->setCurrentProject("Projet B");
        $socioEconomic->setCreatedAt(new \DateTime("19-09-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);
        $manager->flush();

        //UNIT 2
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kasserine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("21");
        $socioEconomic->setHealthInstitutionYear("2016");
        $socioEconomic->setSchoolInstitutionNumber("100");
        $socioEconomic->setSchoolInstitutionYear("2016");
        $socioEconomic->setUniversityInstitutionNumber("47");
        $socioEconomic->setInstitutionUniversityYear("2016");
        $socioEconomic->setDropoutSchoolNumber("22");
        $socioEconomic->setDropoutSchoolYear("2016");
        $socioEconomic->setNeedyFamilyNumber("32");
        $socioEconomic->setNeedyFamilyYear("2016");
        $socioEconomic->setAssociationNumber("74");
        $socioEconomic->setAssociationYear("2016");
        $socioEconomic->setDescription("pâtisserie   ");
        $socioEconomic->setCurrentProject("Projet B");
        $socioEconomic->setCreatedAt(new \DateTime("09-10-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);
        $manager->flush();

        //UNIT 2
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kasserine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("21");
        $socioEconomic->setHealthInstitutionYear("2016");
        $socioEconomic->setSchoolInstitutionNumber("44");
        $socioEconomic->setSchoolInstitutionYear("2016");
        $socioEconomic->setUniversityInstitutionNumber("74");
        $socioEconomic->setInstitutionUniversityYear("2016");
        $socioEconomic->setDropoutSchoolNumber("77");
        $socioEconomic->setDropoutSchoolYear("2016");
        $socioEconomic->setNeedyFamilyNumber("33");
        $socioEconomic->setNeedyFamilyYear("2016");
        $socioEconomic->setAssociationNumber("74");
        $socioEconomic->setAssociationYear("2016");
        $socioEconomic->setDescription("pâtisserie   ");
        $socioEconomic->setCurrentProject("Projet B");
        $socioEconomic->setCreatedAt(new \DateTime("27-11-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);
        $manager->flush();

        //UNIT 2
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kasserine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("40");
        $socioEconomic->setHealthInstitutionYear("2016");
        $socioEconomic->setSchoolInstitutionNumber("10");
        $socioEconomic->setSchoolInstitutionYear("2016");
        $socioEconomic->setUniversityInstitutionNumber("44");
        $socioEconomic->setInstitutionUniversityYear("2016");
        $socioEconomic->setDropoutSchoolNumber("55");
        $socioEconomic->setDropoutSchoolYear("2016");
        $socioEconomic->setNeedyFamilyNumber("74");
        $socioEconomic->setNeedyFamilyYear("2016");
        $socioEconomic->setAssociationNumber("55");
        $socioEconomic->setAssociationYear("2016");
        $socioEconomic->setDescription("pâtisserie   ");
        $socioEconomic->setCurrentProject("Projet B");
        $socioEconomic->setCreatedAt(new \DateTime("17-12-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);
        $manager->flush();

        //UNIT 2
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kasserine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("88");
        $socioEconomic->setHealthInstitutionYear("2016");
        $socioEconomic->setSchoolInstitutionNumber("63");
        $socioEconomic->setSchoolInstitutionYear("2016");
        $socioEconomic->setUniversityInstitutionNumber("74");
        $socioEconomic->setInstitutionUniversityYear("2016");
        $socioEconomic->setDropoutSchoolNumber("66");
        $socioEconomic->setDropoutSchoolYear("2016");
        $socioEconomic->setNeedyFamilyNumber("85");
        $socioEconomic->setNeedyFamilyYear("2016");
        $socioEconomic->setAssociationNumber("77");
        $socioEconomic->setAssociationYear("2016");
        $socioEconomic->setDescription("pâtisserie   ");
        $socioEconomic->setCurrentProject("Projet B");
        $socioEconomic->setCreatedAt(new \DateTime("22-01-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);
        $manager->flush();

        //UNIT 3
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sfax"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("39");
        $socioEconomic->setHealthInstitutionYear("2017");
        $socioEconomic->setSchoolInstitutionNumber("33");
        $socioEconomic->setSchoolInstitutionYear("2017");
        $socioEconomic->setUniversityInstitutionNumber("14");
        $socioEconomic->setInstitutionUniversityYear("2017");
        $socioEconomic->setDropoutSchoolNumber("89");
        $socioEconomic->setDropoutSchoolYear("2017");
        $socioEconomic->setNeedyFamilyNumber("987");
        $socioEconomic->setNeedyFamilyYear("2017");
        $socioEconomic->setAssociationNumber("98");
        $socioEconomic->setAssociationYear("2017");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet C");
        $socioEconomic->setCreatedAt(new \DateTime("25-02-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 3
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sfax"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2017");
        $socioEconomic->setSchoolInstitutionNumber("37");
        $socioEconomic->setSchoolInstitutionYear("2017");
        $socioEconomic->setUniversityInstitutionNumber("15");
        $socioEconomic->setInstitutionUniversityYear("2017");
        $socioEconomic->setDropoutSchoolNumber("85");
        $socioEconomic->setDropoutSchoolYear("2017");
        $socioEconomic->setNeedyFamilyNumber("97");
        $socioEconomic->setNeedyFamilyYear("2017");
        $socioEconomic->setAssociationNumber("90");
        $socioEconomic->setAssociationYear("2017");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet C");
        $socioEconomic->setCreatedAt(new \DateTime("29-03-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 3
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sfax"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("30");
        $socioEconomic->setHealthInstitutionYear("2017");
        $socioEconomic->setSchoolInstitutionNumber("30");
        $socioEconomic->setSchoolInstitutionYear("2017");
        $socioEconomic->setUniversityInstitutionNumber("17");
        $socioEconomic->setInstitutionUniversityYear("2017");
        $socioEconomic->setDropoutSchoolNumber("19");
        $socioEconomic->setDropoutSchoolYear("2017");
        $socioEconomic->setNeedyFamilyNumber("97");
        $socioEconomic->setNeedyFamilyYear("2017");
        $socioEconomic->setAssociationNumber("74");
        $socioEconomic->setAssociationYear("2017");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet C");
        $socioEconomic->setCreatedAt(new \DateTime("15-04-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 3
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sfax"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("24");
        $socioEconomic->setHealthInstitutionYear("2017");
        $socioEconomic->setSchoolInstitutionNumber("70");
        $socioEconomic->setSchoolInstitutionYear("2017");
        $socioEconomic->setUniversityInstitutionNumber("12");
        $socioEconomic->setInstitutionUniversityYear("2017");
        $socioEconomic->setDropoutSchoolNumber("15");
        $socioEconomic->setDropoutSchoolYear("2017");
        $socioEconomic->setNeedyFamilyNumber("19");
        $socioEconomic->setNeedyFamilyYear("2017");
        $socioEconomic->setAssociationNumber("66");
        $socioEconomic->setAssociationYear("2017");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet C");
        $socioEconomic->setCreatedAt(new \DateTime("11-05-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 3
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sfax"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("52");
        $socioEconomic->setHealthInstitutionYear("2017");
        $socioEconomic->setSchoolInstitutionNumber("12");
        $socioEconomic->setSchoolInstitutionYear("2017");
        $socioEconomic->setUniversityInstitutionNumber("14");
        $socioEconomic->setInstitutionUniversityYear("2017");
        $socioEconomic->setDropoutSchoolNumber("32");
        $socioEconomic->setDropoutSchoolYear("2017");
        $socioEconomic->setNeedyFamilyNumber("24");
        $socioEconomic->setNeedyFamilyYear("2017");
        $socioEconomic->setAssociationNumber("66");
        $socioEconomic->setAssociationYear("2017");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet C");
        $socioEconomic->setCreatedAt(new \DateTime("01-06-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 3
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sfax"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("20");
        $socioEconomic->setHealthInstitutionYear("2017");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2017");
        $socioEconomic->setUniversityInstitutionNumber("26");
        $socioEconomic->setInstitutionUniversityYear("2017");
        $socioEconomic->setDropoutSchoolNumber("77");
        $socioEconomic->setDropoutSchoolYear("2017");
        $socioEconomic->setNeedyFamilyNumber("25");
        $socioEconomic->setNeedyFamilyYear("2017");
        $socioEconomic->setAssociationNumber("74");
        $socioEconomic->setAssociationYear("2017");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet C");
        $socioEconomic->setCreatedAt(new \DateTime("31-07-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 4
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tozeur"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("24");
        $socioEconomic->setHealthInstitutionYear("2020");
        $socioEconomic->setSchoolInstitutionNumber("54");
        $socioEconomic->setSchoolInstitutionYear("2020");
        $socioEconomic->setUniversityInstitutionNumber("10");
        $socioEconomic->setInstitutionUniversityYear("2020");
        $socioEconomic->setDropoutSchoolNumber("17");
        $socioEconomic->setDropoutSchoolYear("2020");
        $socioEconomic->setNeedyFamilyNumber("15");
        $socioEconomic->setNeedyFamilyYear("2020");
        $socioEconomic->setAssociationNumber("23");
        $socioEconomic->setAssociationYear("2020");
        $socioEconomic->setDescription("pâtisserie   ");
        $socioEconomic->setCurrentProject("Projet D");
        $socioEconomic->setCreatedAt(new \DateTime("03-08-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 4
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tozeur"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("52");
        $socioEconomic->setHealthInstitutionYear("2020");
        $socioEconomic->setSchoolInstitutionNumber("44");
        $socioEconomic->setSchoolInstitutionYear("2020");
        $socioEconomic->setUniversityInstitutionNumber("91");
        $socioEconomic->setInstitutionUniversityYear("2020");
        $socioEconomic->setDropoutSchoolNumber("120");
        $socioEconomic->setDropoutSchoolYear("2020");
        $socioEconomic->setNeedyFamilyNumber("25");
        $socioEconomic->setNeedyFamilyYear("2020");
        $socioEconomic->setAssociationNumber("17");
        $socioEconomic->setAssociationYear("2020");
        $socioEconomic->setDescription("pâtisserie   ");
        $socioEconomic->setCurrentProject("Projet D");
        $socioEconomic->setCreatedAt(new \DateTime("01-08-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 4
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tozeur"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("17");
        $socioEconomic->setHealthInstitutionYear("2020");
        $socioEconomic->setSchoolInstitutionNumber("15");
        $socioEconomic->setSchoolInstitutionYear("2020");
        $socioEconomic->setUniversityInstitutionNumber("10");
        $socioEconomic->setInstitutionUniversityYear("2020");
        $socioEconomic->setDropoutSchoolNumber("14");
        $socioEconomic->setDropoutSchoolYear("2020");
        $socioEconomic->setNeedyFamilyNumber("112");
        $socioEconomic->setNeedyFamilyYear("2020");
        $socioEconomic->setAssociationNumber("17");
        $socioEconomic->setAssociationYear("2020");
        $socioEconomic->setDescription("pâtisserie   ");
        $socioEconomic->setCurrentProject("Projet D");
        $socioEconomic->setCreatedAt(new \DateTime("07-09-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 4
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tozeur"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("21");
        $socioEconomic->setHealthInstitutionYear("2020");
        $socioEconomic->setSchoolInstitutionNumber("15");
        $socioEconomic->setSchoolInstitutionYear("2020");
        $socioEconomic->setUniversityInstitutionNumber("14");
        $socioEconomic->setInstitutionUniversityYear("2020");
        $socioEconomic->setDropoutSchoolNumber("16");
        $socioEconomic->setDropoutSchoolYear("2020");
        $socioEconomic->setNeedyFamilyNumber("25");
        $socioEconomic->setNeedyFamilyYear("2020");
        $socioEconomic->setAssociationNumber("20");
        $socioEconomic->setAssociationYear("2020");
        $socioEconomic->setDescription("pâtisserie   ");
        $socioEconomic->setCurrentProject("Projet D");
        $socioEconomic->setCreatedAt(new \DateTime("31-10-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 4
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tozeur"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("15");
        $socioEconomic->setHealthInstitutionYear("2020");
        $socioEconomic->setSchoolInstitutionNumber("16");
        $socioEconomic->setSchoolInstitutionYear("2020");
        $socioEconomic->setUniversityInstitutionNumber("19");
        $socioEconomic->setInstitutionUniversityYear("2020");
        $socioEconomic->setDropoutSchoolNumber("17");
        $socioEconomic->setDropoutSchoolYear("2020");
        $socioEconomic->setNeedyFamilyNumber("25");
        $socioEconomic->setNeedyFamilyYear("2020");
        $socioEconomic->setAssociationNumber("27");
        $socioEconomic->setAssociationYear("2020");
        $socioEconomic->setDescription("pâtisserie   ");
        $socioEconomic->setCurrentProject("Projet D");
        $socioEconomic->setCreatedAt(new \DateTime("31-10-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 4
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tozeur"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("88");
        $socioEconomic->setHealthInstitutionYear("2020");
        $socioEconomic->setSchoolInstitutionNumber("15");
        $socioEconomic->setSchoolInstitutionYear("2020");
        $socioEconomic->setUniversityInstitutionNumber("19");
        $socioEconomic->setInstitutionUniversityYear("2020");
        $socioEconomic->setDropoutSchoolNumber("125");
        $socioEconomic->setDropoutSchoolYear("2020");
        $socioEconomic->setNeedyFamilyNumber("124");
        $socioEconomic->setNeedyFamilyYear("2020");
        $socioEconomic->setAssociationNumber("18");
        $socioEconomic->setAssociationYear("2020");
        $socioEconomic->setDescription("pâtisserie   ");
        $socioEconomic->setCurrentProject("Projet D");
        $socioEconomic->setCreatedAt(new \DateTime("28-02-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 5
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Ariana"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("19");
        $socioEconomic->setHealthInstitutionYear("2019");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2019");
        $socioEconomic->setUniversityInstitutionNumber("26");
        $socioEconomic->setInstitutionUniversityYear("2029");
        $socioEconomic->setDropoutSchoolNumber("28");
        $socioEconomic->setDropoutSchoolYear("2019");
        $socioEconomic->setNeedyFamilyNumber("78");
        $socioEconomic->setNeedyFamilyYear("2019");
        $socioEconomic->setAssociationNumber("24");
        $socioEconomic->setAssociationYear("2019");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet E");
        $socioEconomic->setCreatedAt(new \DateTime("07-09-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 5
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Ariana"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("34");
        $socioEconomic->setHealthInstitutionYear("2019");
        $socioEconomic->setSchoolInstitutionNumber("47");
        $socioEconomic->setSchoolInstitutionYear("2019");
        $socioEconomic->setUniversityInstitutionNumber("16");
        $socioEconomic->setInstitutionUniversityYear("2029");
        $socioEconomic->setDropoutSchoolNumber("17");
        $socioEconomic->setDropoutSchoolYear("2019");
        $socioEconomic->setNeedyFamilyNumber("48");
        $socioEconomic->setNeedyFamilyYear("2019");
        $socioEconomic->setAssociationNumber("15");
        $socioEconomic->setAssociationYear("2019");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet E");
        $socioEconomic->setCreatedAt(new \DateTime("07-10-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 5
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Ariana"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("24");
        $socioEconomic->setHealthInstitutionYear("2019");
        $socioEconomic->setSchoolInstitutionNumber("22");
        $socioEconomic->setSchoolInstitutionYear("2019");
        $socioEconomic->setUniversityInstitutionNumber("28");
        $socioEconomic->setInstitutionUniversityYear("2029");
        $socioEconomic->setDropoutSchoolNumber("17");
        $socioEconomic->setDropoutSchoolYear("2019");
        $socioEconomic->setNeedyFamilyNumber("174");
        $socioEconomic->setNeedyFamilyYear("2019");
        $socioEconomic->setAssociationNumber("25");
        $socioEconomic->setAssociationYear("2019");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet E");
        $socioEconomic->setCreatedAt(new \DateTime("17-10-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 5
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Ariana"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2019");
        $socioEconomic->setSchoolInstitutionNumber("54");
        $socioEconomic->setSchoolInstitutionYear("2019");
        $socioEconomic->setUniversityInstitutionNumber("16");
        $socioEconomic->setInstitutionUniversityYear("2029");
        $socioEconomic->setDropoutSchoolNumber("19");
        $socioEconomic->setDropoutSchoolYear("2019");
        $socioEconomic->setNeedyFamilyNumber("88");
        $socioEconomic->setNeedyFamilyYear("2019");
        $socioEconomic->setAssociationNumber("27");
        $socioEconomic->setAssociationYear("2019");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet E");
        $socioEconomic->setCreatedAt(new \DateTime("25-06-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 5
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Ariana"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("17");
        $socioEconomic->setHealthInstitutionYear("2019");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2019");
        $socioEconomic->setUniversityInstitutionNumber("30");
        $socioEconomic->setInstitutionUniversityYear("2029");
        $socioEconomic->setDropoutSchoolNumber("11");
        $socioEconomic->setDropoutSchoolYear("2019");
        $socioEconomic->setNeedyFamilyNumber("32");
        $socioEconomic->setNeedyFamilyYear("2019");
        $socioEconomic->setAssociationNumber("25");
        $socioEconomic->setAssociationYear("2019");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet E");
        $socioEconomic->setCreatedAt(new \DateTime("11-12-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 5
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Ariana"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("17");
        $socioEconomic->setHealthInstitutionYear("2019");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2019");
        $socioEconomic->setUniversityInstitutionNumber("15");
        $socioEconomic->setInstitutionUniversityYear("2029");
        $socioEconomic->setDropoutSchoolNumber("17");
        $socioEconomic->setDropoutSchoolYear("2019");
        $socioEconomic->setNeedyFamilyNumber("96");
        $socioEconomic->setNeedyFamilyYear("2019");
        $socioEconomic->setAssociationNumber("28");
        $socioEconomic->setAssociationYear("2019");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet E");
        $socioEconomic->setCreatedAt(new \DateTime("27-02-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 6
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Béja"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("74");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("63");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("85");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("63");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("53");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet F");
        $socioEconomic->setCreatedAt(new \DateTime("27-01-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 6
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Béja"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("44");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("71");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("06");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("152");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("15");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("36");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet F");
        $socioEconomic->setCreatedAt(new \DateTime("01-11-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 6
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Béja"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("74");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("63");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("75");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("14");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("52");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet F");
        $socioEconomic->setCreatedAt(new \DateTime("31-01-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 6
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Béja"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("14");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("62");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("24");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("33");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("74");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("68");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet F");
        $socioEconomic->setCreatedAt(new \DateTime("07-12-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 6
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Béja"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("44");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("14");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("09");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("25");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("74");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("35");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet F");
        $socioEconomic->setCreatedAt(new \DateTime("21-10-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 6
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Béja"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("44");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("52");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("99");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("74");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("32");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet F");
        $socioEconomic->setCreatedAt(new \DateTime("04-03-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 7
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Mahdia"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("44");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("26");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("74");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("125");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("1024");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("25");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet G");
        $socioEconomic->setCreatedAt(new \DateTime("07-09-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 7
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Mahdia"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("17");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("27");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("41");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("25");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("74");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("10");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet G");
        $socioEconomic->setCreatedAt(new \DateTime("31-12-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 7
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Mahdia"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("57");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("41");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("05");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("131");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("1024");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("34");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet G");
        $socioEconomic->setCreatedAt(new \DateTime("03-09-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 7
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Mahdia"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("24");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("08");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("175");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("125");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("125");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet G");
        $socioEconomic->setCreatedAt(new \DateTime("13-10-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 7
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Mahdia"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("85");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("47");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("06");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("17");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("125");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("174");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet G");
        $socioEconomic->setCreatedAt(new \DateTime("04-04-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 7
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Mahdia"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("88");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("87");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("52");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("36");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("142");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("66");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet G");
        $socioEconomic->setCreatedAt(new \DateTime("02-02-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 8
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Bizerte"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("27");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("38");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("28");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("39");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("75");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet H");
        $socioEconomic->setCreatedAt(new \DateTime("07-01-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);




        //UNIT 8
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Bizerte"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("88");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("75");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("57");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("58");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("63");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("25");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet H");
        $socioEconomic->setCreatedAt(new \DateTime("17-08-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 8
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Bizerte"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("47");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("77");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("09");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("85");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("47");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("26");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet H");
        $socioEconomic->setCreatedAt(new \DateTime("09-11-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);
        //UNIT 8
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Bizerte"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("47");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("43");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("07");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("325");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("958");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("32");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet H");
        $socioEconomic->setCreatedAt(new \DateTime("15-05-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 8
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Bizerte"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("37");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("23");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("28");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("27");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("36");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("74");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet H");
        $socioEconomic->setCreatedAt(new \DateTime("02-09-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 8
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Bizerte"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("27");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("47");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("07");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("385");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("978");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("37");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet H");
        $socioEconomic->setCreatedAt(new \DateTime("19-12-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 8
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Bizerte"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("17");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("33");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("27");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("32");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("98");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("35");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet H");
        $socioEconomic->setCreatedAt(new \DateTime("07-10-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 9
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sousse"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("115");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("58");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("19");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("131");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("858");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("89");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet I");
        $socioEconomic->setCreatedAt(new \DateTime("11-01-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 9
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sousse"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("15");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("55");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("49");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("185");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("818");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("79");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet I");
        $socioEconomic->setCreatedAt(new \DateTime("14-04-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 9
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sousse"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("125");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("38");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("89");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("121");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("878");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("59");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet I");
        $socioEconomic->setCreatedAt(new \DateTime("27-12-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 9
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sousse"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("145");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("50");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("29");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("141");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("828");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("39");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet I");
        $socioEconomic->setCreatedAt(new \DateTime("07-01-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 9
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sousse"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("175");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("158");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("39");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("139");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("828");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("79");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet I");
        $socioEconomic->setCreatedAt(new \DateTime("07-11-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 9
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sousse"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("165");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("38");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("89");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("151");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("558");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("69");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet I");
        $socioEconomic->setCreatedAt(new \DateTime("28-10-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);
        //UNIT 10
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Nabeul"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("78");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("45");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("61");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("257");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("238");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("193");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet J");
        $socioEconomic->setCreatedAt(new \DateTime("27-01-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 10
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Nabeul"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("58");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("35");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("11");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("254");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("948");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("123");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet J");
        $socioEconomic->setCreatedAt(new \DateTime("01-04-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 10
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Nabeul"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("78");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("31");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("24");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("98");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("13");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet J");
        $socioEconomic->setCreatedAt(new \DateTime("07-11-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 10
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Nabeul"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("38");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("65");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("18");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("36");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("45");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("15");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet J");
        $socioEconomic->setCreatedAt(new \DateTime("07-09-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 10
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Nabeul"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("77");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("45");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("25");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("63");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("85");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("96");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet J");
        $socioEconomic->setCreatedAt(new \DateTime("24-11-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 10
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Nabeul"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("98");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("61");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("14");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("68");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("19");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet J");
        $socioEconomic->setCreatedAt(new \DateTime("09-09-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 11
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Monastir"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("152");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("32");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("29");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("351");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("326");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("285");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet K");
        $socioEconomic->setCreatedAt(new \DateTime("18-02-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 11
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Monastir"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("26");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("39");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("327");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("632");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("254");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet K");
        $socioEconomic->setCreatedAt(new \DateTime("07-05-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 11
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Monastir"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("632");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("28");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("362");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("241");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("62");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet K");
        $socioEconomic->setCreatedAt(new \DateTime("16-09-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 11
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Monastir"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("85");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("258");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("362");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("425");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("28");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet K");
        $socioEconomic->setCreatedAt(new \DateTime("13-12-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 11
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Monastir"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("126");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("52");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("25");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("25");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("78");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("22");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet K");
        $socioEconomic->setCreatedAt(new \DateTime("29-09-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 11
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Monastir"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("155");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("28");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("152");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("632");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("725");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("23");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet K");
        $socioEconomic->setCreatedAt(new \DateTime("05-05-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 12
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sidi Bouzid"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("23");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("63");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("36");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("632");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("25");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("15");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet L");
        $socioEconomic->setCreatedAt(new \DateTime("07-02-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 12
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sidi Bouzid"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("69");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("21");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("04");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("745");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("1214");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("12");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet L");
        $socioEconomic->setCreatedAt(new \DateTime("17-10-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 12
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sidi Bouzid"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("19");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("31");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("04");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("75");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("124");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("125");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet L");
        $socioEconomic->setCreatedAt(new \DateTime("19-09-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 12
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sidi Bouzid"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("39");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("28");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("85");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("725");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("52");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("26");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet L");
        $socioEconomic->setCreatedAt(new \DateTime("19-10-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 12
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sidi Bouzid"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("21");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("95");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("32");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("25");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("28");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet L");
        $socioEconomic->setCreatedAt(new \DateTime("12-11-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 12
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Sidi Bouzid"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("36");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("24");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("85");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("184");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("12");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet L");
        $socioEconomic->setCreatedAt(new \DateTime("02-07-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 13
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kébili"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("31");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("13");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("03");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("578");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("1325");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("09");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet M");
        $socioEconomic->setCreatedAt(new \DateTime("07-09-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 13
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kébili"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("21");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("23");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("23");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("58");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("15");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("19");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet M");
        $socioEconomic->setCreatedAt(new \DateTime("18-07-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 13
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kébili"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("81");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("63");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("83");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("98");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("55");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("59");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet M");
        $socioEconomic->setCreatedAt(new \DateTime("06-06-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 13
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kébili"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("51");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("83");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("33");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("58");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("15");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("29");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet M");
        $socioEconomic->setCreatedAt(new \DateTime("14-09-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 13
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kébili"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("23");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("43");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("58");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("15");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("79");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet M");
        $socioEconomic->setCreatedAt(new \DateTime("03-03-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 13
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kébili"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("71");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("18");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("53");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("58");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("125");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("59");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet M");
        $socioEconomic->setCreatedAt(new \DateTime("02-04-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);





        //UNIT 14
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de El Kef"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("54");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("28");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("74");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("79");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("1121");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("57");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet N");
        $socioEconomic->setCreatedAt(new \DateTime("17-05-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 14
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de El Kef"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("44");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("43");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("24");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("79");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("21");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("17");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet N");
        $socioEconomic->setCreatedAt(new \DateTime("10-07-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 14
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de El Kef"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("44");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("24");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("74");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("79");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("121");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("127");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet N");
        $socioEconomic->setCreatedAt(new \DateTime("20-02-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 14
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de El Kef"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("24");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("63");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("54");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("79");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("15");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("15");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet N");
        $socioEconomic->setCreatedAt(new \DateTime("27-07-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 14
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de El Kef"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("64");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("29");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("74");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("79");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("11");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("15");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet N");
        $socioEconomic->setCreatedAt(new \DateTime("10-06-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 14
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de El Kef"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("34");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("73");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("54");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("79");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("141");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("152");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet N");
        $socioEconomic->setCreatedAt(new \DateTime("17-01-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 15
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Ben Arous"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("171");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("29");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("58");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("271");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("178");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("43");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet O");
        $socioEconomic->setCreatedAt(new \DateTime("17-05-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 15
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Ben Arous"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("11");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("08");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("131");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("178");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("43");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet O");
        $socioEconomic->setCreatedAt(new \DateTime("19-01-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 15
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Ben Arous"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("81");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("65");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("08");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("121");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("138");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("48");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet O");
        $socioEconomic->setCreatedAt(new \DateTime("11-10-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 15
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Ben Arous"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("175");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("29");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("68");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("151");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("138");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("49");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet O");
        $socioEconomic->setCreatedAt(new \DateTime("17-07-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 15
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Ben Arous"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("171");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("29");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("78");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("121");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("138");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("43");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet O");
        $socioEconomic->setCreatedAt(new \DateTime("30-08-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 15
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Ben Arous"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("102");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("55");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("58");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("161");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("178");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("73");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet O");
        $socioEconomic->setCreatedAt(new \DateTime("27-06-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);




        //UNIT 16
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Gabès"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("63");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("19");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("07");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("785");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("745");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("17");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet P");
        $socioEconomic->setCreatedAt(new \DateTime("17-05-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 16
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Gabès"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("33");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("79");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("57");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("75");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("74");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("177");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet P");
        $socioEconomic->setCreatedAt(new \DateTime("01-04-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 16
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Gabès"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("53");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("69");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("07");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("75");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("75");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("57");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet P");
        $socioEconomic->setCreatedAt(new \DateTime("27-07-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 16
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Gabès"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("23");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("79");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("67");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("65");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("75");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("57");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet P");
        $socioEconomic->setCreatedAt(new \DateTime("30-10-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 16
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Gabès"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("33");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("79");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("17");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("725");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("775");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("185");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet P");
        $socioEconomic->setCreatedAt(new \DateTime("25-02-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 16
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Gabès"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("88");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("39");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("27");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("75");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("75");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("67");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet P");
        $socioEconomic->setCreatedAt(new \DateTime("03-01-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 17
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Gafsa"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("96");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("23");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("11");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("557");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("1025");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("23");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet Q");
        $socioEconomic->setCreatedAt(new \DateTime("18-03-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 17
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Gafsa"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("56");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("63");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("51");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("57");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("105");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("26");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet Q");
        $socioEconomic->setCreatedAt(new \DateTime("06-06-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 17
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Gafsa"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("76");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("53");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("19");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("67");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("153");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("232");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet Q");
        $socioEconomic->setCreatedAt(new \DateTime("19-10-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 17
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Gafsa"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("196");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("123");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("111");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("57");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("125");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("26");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet Q");
        $socioEconomic->setCreatedAt(new \DateTime("22-01-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 17
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Gafsa"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("56");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("26");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("19");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("57");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("105");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("123");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet Q");
        $socioEconomic->setCreatedAt(new \DateTime("17-01-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 17
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Gafsa"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("126");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("33");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("18");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("757");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("85");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("29");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet Q");
        $socioEconomic->setCreatedAt(new \DateTime("18-11-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 18
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kairouan"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("76");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("45");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("12");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("412");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("1214");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("27");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet R");
        $socioEconomic->setCreatedAt(new \DateTime("10-01-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 18
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kairouan"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("176");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("145");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("111");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("452");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("154");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("257");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet R");
        $socioEconomic->setCreatedAt(new \DateTime("12-07-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 18
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kairouan"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("176");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("425");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("122");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("472");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("1254");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("127");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet R");
        $socioEconomic->setCreatedAt(new \DateTime("23-03-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 18
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kairouan"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("126");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("75");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("42");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("42");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("124");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("127");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet R");
        $socioEconomic->setCreatedAt(new \DateTime("18-10-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 18
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kairouan"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("74");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("35");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("72");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("41");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("14");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("77");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet R");
        $socioEconomic->setCreatedAt(new \DateTime("11-01-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 18
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Kairouan"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("66");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("35");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("82");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("42");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("142");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("52");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet R");
        $socioEconomic->setCreatedAt(new \DateTime("28-12-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 19
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Médnine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("45");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("15");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("04");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("789");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("1450");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("12");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet S");
        $socioEconomic->setCreatedAt(new \DateTime("18-11-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 19
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Médnine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("35");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("74");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("79");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("140");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("142");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet S");
        $socioEconomic->setCreatedAt(new \DateTime("10-03-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 19
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Médnine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("75");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("85");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("34");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("79");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("10");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("112");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet S");
        $socioEconomic->setCreatedAt(new \DateTime("18-11-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 19
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Médnine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("425");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("125");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("024");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("779");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("1250");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("185");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet S");
        $socioEconomic->setCreatedAt(new \DateTime("15-07-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 19
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Médnine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("145");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("155");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("74");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("79");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("145");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("120");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet S");
        $socioEconomic->setCreatedAt(new \DateTime("23-12-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 19
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Médnine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("145");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("155");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("04");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("789");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("145");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("122");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet S");
        $socioEconomic->setCreatedAt(new \DateTime("22-11-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 19
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Médnine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("43");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("12");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("24");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("79");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("150");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("12");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet S");
        $socioEconomic->setCreatedAt(new \DateTime("24-04-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 20
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de La Manouba"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("35");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("74");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("15");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("85");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("72");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet T");
        $socioEconomic->setCreatedAt(new \DateTime("11-04-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 20
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de La Manouba"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("95");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("54");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("15");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("75");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("33");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet T");
        $socioEconomic->setCreatedAt(new \DateTime("26-10-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 20
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de La Manouba"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("35");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("75");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("64");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("165");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("785");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("36");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet T");
        $socioEconomic->setCreatedAt(new \DateTime("12-10-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 20
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de La Manouba"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("45");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("25");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("14");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("145");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("75");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("36");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet T");
        $socioEconomic->setCreatedAt(new \DateTime("17-06-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 20
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de La Manouba"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("35");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("16");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("125");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("75");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("36");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet T");
        $socioEconomic->setCreatedAt(new \DateTime("16-05-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 20
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de La Manouba"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("29");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("34");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("135");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("725");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("132");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet T");
        $socioEconomic->setCreatedAt(new \DateTime("30-08-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 21
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Siliana"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("127");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("122");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("62");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("14");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("11");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("12");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet U");
        $socioEconomic->setCreatedAt(new \DateTime("30-11-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 21
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Siliana"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("17");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("12");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("06");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("1314");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("1141");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("17");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet U");
        $socioEconomic->setCreatedAt(new \DateTime("08-10-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 21
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Siliana"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("171");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("121");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("16");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("124");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("11");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("16");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet U");
        $socioEconomic->setCreatedAt(new \DateTime("10-12-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 21
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Siliana"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("127");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("122");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("66");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("134");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("121");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("117");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet U");
        $socioEconomic->setCreatedAt(new \DateTime("14-08-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 21
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Siliana"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("16");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("15");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("56");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("134");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("141");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("65");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet U");
        $socioEconomic->setCreatedAt(new \DateTime("12-10-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 21
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Siliana"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("18");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("19");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("16");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("114");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("131");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("127");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet U");
        $socioEconomic->setCreatedAt(new \DateTime("18-01-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 22
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Zaghouan"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("37");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("39");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("89");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("74");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("97");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("224");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet V");
        $socioEconomic->setCreatedAt(new \DateTime("01-05-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);



        //UNIT 22
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Zaghouan"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("77");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("31");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("09");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("874");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("987");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("24");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet V");
        $socioEconomic->setCreatedAt(new \DateTime("11-10-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 22
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Zaghouan"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("37");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("36");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("59");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("84");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("97");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("224");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet V");
        $socioEconomic->setCreatedAt(new \DateTime("10-01-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 22
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Zaghouan"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("47");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("35");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("79");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("87");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("97");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("24");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet V");
        $socioEconomic->setCreatedAt(new \DateTime("13-10-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 22
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Zaghouan"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("57");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("71");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("69");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("84");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("87");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("64");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet V");
        $socioEconomic->setCreatedAt(new \DateTime("08-11-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 22
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Zaghouan"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("27");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("71");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("79");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("84");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("87");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("64");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("pâtisserie");
        $socioEconomic->setCurrentProject("Projet V");
        $socioEconomic->setCreatedAt(new \DateTime("13-11-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);
        //UNIT 23
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tataouine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("74");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("37");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("72");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("121");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("957");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("13");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet W");
        $socioEconomic->setCreatedAt(new \DateTime("13-01-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 23
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tataouine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("24");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("17");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("02");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("1021");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("987");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("11");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet W");
        $socioEconomic->setCreatedAt(new \DateTime("12-04-2015"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 23
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tataouine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("214");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("127");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("12");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("11");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("87");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("61");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet W");
        $socioEconomic->setCreatedAt(new \DateTime("16-11-2016"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 23
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tataouine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("74");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("67");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("72");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("121");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("97");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("16");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet W");
        $socioEconomic->setCreatedAt(new \DateTime("18-06-2017"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 23
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tataouine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("64");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("37");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("72");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("107");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("98");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("151");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet W");
        $socioEconomic->setCreatedAt(new \DateTime("13-03-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 23
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Tataouine"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("224");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("157");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("72");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("151");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("97");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("17");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet W");
        $socioEconomic->setCreatedAt(new \DateTime("12-11-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);


        //UNIT 24
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Jendouba"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("45");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("19");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("04");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("741");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("968");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("13");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet X");
        $socioEconomic->setCreatedAt(new \DateTime("10-11-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 24
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Jendouba"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("35");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("79");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("64");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("71");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("98");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("18");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet X");
        $socioEconomic->setCreatedAt(new \DateTime("04-03-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 24
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Jendouba"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("65");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("79");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("94");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("71");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("68");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("153");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet X");
        $socioEconomic->setCreatedAt(new \DateTime("20-01-2014"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 24
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Jendouba"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("145");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("119");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("154");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("71");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("68");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("18");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet X");
        $socioEconomic->setCreatedAt(new \DateTime("31-10-2019"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 24
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Jendouba"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("25");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("79");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("64");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("71");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("98");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("183");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet X");
        $socioEconomic->setCreatedAt(new \DateTime("13-10-2018"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        //UNIT 24
        $socioEconomic = new SocioEconomicData();
        $dir= $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("titreFr" => "Direction régionale de la formation professionnelle et de l'emploi de Jendouba"));
        $socioEconomic->setDirectionRegional($dir);
        $socioEconomic->setHealthInstitutionNumber("145");
        $socioEconomic->setHealthInstitutionYear("2018");
        $socioEconomic->setSchoolInstitutionNumber("119");
        $socioEconomic->setSchoolInstitutionYear("2018");
        $socioEconomic->setUniversityInstitutionNumber("114");
        $socioEconomic->setInstitutionUniversityYear("2018");
        $socioEconomic->setDropoutSchoolNumber("521");
        $socioEconomic->setDropoutSchoolYear("2018");
        $socioEconomic->setNeedyFamilyNumber("748");
        $socioEconomic->setNeedyFamilyYear("2018");
        $socioEconomic->setAssociationNumber("173");
        $socioEconomic->setAssociationYear("2018");
        $socioEconomic->setDescription("Boulangerie");
        $socioEconomic->setCurrentProject("Projet X");
        $socioEconomic->setCreatedAt(new \DateTime("09-03-2020"));
        $socioEconomic->setEnable(true);
        $manager->persist($socioEconomic);

        $manager->flush();


    }




}