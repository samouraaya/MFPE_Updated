<?php

namespace Mfpe\ReferencielBundle\DataFixtures\SecondDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

//Entity
use Mfpe\UniteRegionaleBundle\Entity\IdentiteRegion;


class IdentiteRegionFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {

        //Ariana
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("7");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ariana"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("7");
        $IdentiteRegion->setNbrPrivateTrainingCenters("8");
        $IdentiteRegion->setNbrPublicTrainingCenters("10");
        $IdentiteRegion->setNbrEmploymentOffices("4");
        $IdentiteRegion->setNbrSpacesUndertake("14");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("18");
        $IdentiteRegion->setDescriptionRegion("Ariana est l'un des 24 gouvernorats de la Tunisie. Il est situé dans le nord du pays");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();



        //Beja
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("9");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Beja"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("12");
        $IdentiteRegion->setNbrPrivateTrainingCenters("8");
        $IdentiteRegion->setNbrPublicTrainingCenters("7");
        $IdentiteRegion->setNbrEmploymentOffices("3");
        $IdentiteRegion->setNbrSpacesUndertake("5");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("15");
        $IdentiteRegion->setDescriptionRegion("Beja est l'un des 24 gouvernorats de la Tunisie. Il est situé dans le nord-ouest du pays");
        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //BenArous
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("12");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ben Arous"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("13");
        $IdentiteRegion->setNbrPrivateTrainingCenters("20");
        $IdentiteRegion->setNbrPublicTrainingCenters("11");
        $IdentiteRegion->setNbrEmploymentOffices("3");
        $IdentiteRegion->setNbrSpacesUndertake("9");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("31");
        $IdentiteRegion->setDescriptionRegion("Ben Arous est situé dans le nord du pays et couvre une superficie de 761 km²");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();

        //Bizerte
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("14");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Bizerte"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("17");
        $IdentiteRegion->setNbrPrivateTrainingCenters("12");
        $IdentiteRegion->setNbrPublicTrainingCenters("13");
        $IdentiteRegion->setNbrEmploymentOffices("7");
        $IdentiteRegion->setNbrSpacesUndertake("7");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("25");
        $IdentiteRegion->setDescriptionRegion("Bizerte est situé dans le nord du pays et couvre une superficie de 3 685 km²");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //Gabès
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("10");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gabès"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("16");
        $IdentiteRegion->setNbrPrivateTrainingCenters("8");
        $IdentiteRegion->setNbrPublicTrainingCenters("8");
        $IdentiteRegion->setNbrEmploymentOffices("5");
        $IdentiteRegion->setNbrSpacesUndertake("8");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("16");
        $IdentiteRegion->setDescriptionRegion("Gabes est situé dans le sud-est du pays et couvre une superficie de 7 175 km²");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //Gafsa
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("11");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gafsa"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("13");
        $IdentiteRegion->setNbrPrivateTrainingCenters("8");
        $IdentiteRegion->setNbrPublicTrainingCenters("7");
        $IdentiteRegion->setNbrEmploymentOffices("5");
        $IdentiteRegion->setNbrSpacesUndertake("7");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("15");
        $IdentiteRegion->setDescriptionRegion("Gafsa est situé dans le sud-ouest du pays, à la frontière de l'Algérie");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //Jendouba
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("9");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Jendouba"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("14");
        $IdentiteRegion->setNbrPrivateTrainingCenters("6");
        $IdentiteRegion->setNbrPublicTrainingCenters("3");
        $IdentiteRegion->setNbrEmploymentOffices("4");
        $IdentiteRegion->setNbrSpacesUndertake("4");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("9");
        $IdentiteRegion->setDescriptionRegion("Jendouba est situé dans le nord-ouest du pays, à la frontière tuniso-algérienne");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //Kairouan
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("11");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kairouan"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("19");
        $IdentiteRegion->setNbrPrivateTrainingCenters("9");
        $IdentiteRegion->setNbrPublicTrainingCenters("7");
        $IdentiteRegion->setNbrEmploymentOffices("4");
        $IdentiteRegion->setNbrSpacesUndertake("9");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("16");
        $IdentiteRegion->setDescriptionRegion("Kairouan  est situé dans le centre du pays et couvre une superficie de 6 712 km²");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //Kasserine
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("13");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("19");
        $IdentiteRegion->setNbrPrivateTrainingCenters("5");
        $IdentiteRegion->setNbrPublicTrainingCenters("7");
        $IdentiteRegion->setNbrEmploymentOffices("4");
        $IdentiteRegion->setNbrSpacesUndertake("6");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("12");
        $IdentiteRegion->setDescriptionRegion("Kasserine est situé dans l'ouest du pays, à la frontière algéro-tunisienne");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();

        //Kébili
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("6");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kébili"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("9");
        $IdentiteRegion->setNbrPrivateTrainingCenters("3");
        $IdentiteRegion->setNbrPublicTrainingCenters("7");
        $IdentiteRegion->setNbrEmploymentOffices("3");
        $IdentiteRegion->setNbrSpacesUndertake("7");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("10");
        $IdentiteRegion->setDescriptionRegion("Kébili est situé dans le sud-ouest du pays, à la frontière algéro-tunisienne");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //LeKef
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("11");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "El Kef"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("15");
        $IdentiteRegion->setNbrPrivateTrainingCenters("6");
        $IdentiteRegion->setNbrPublicTrainingCenters("5");
        $IdentiteRegion->setNbrEmploymentOffices("4");
        $IdentiteRegion->setNbrSpacesUndertake("3");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("11");
        $IdentiteRegion->setDescriptionRegion("est situé dans le nord-ouest du pays, à la frontière algéro-tunisienne");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //Mahdia
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("11");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Mahdia"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("18");
        $IdentiteRegion->setNbrPrivateTrainingCenters("12");
        $IdentiteRegion->setNbrPublicTrainingCenters("6");
        $IdentiteRegion->setNbrEmploymentOffices("3");
        $IdentiteRegion->setNbrSpacesUndertake("9");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("18");
        $IdentiteRegion->setDescriptionRegion("Mahdia est situé dans l'est du pays et couvre une superficie de 2 966 km²");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //La Manouba
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("8");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "La Manouba"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("10");
        $IdentiteRegion->setNbrPrivateTrainingCenters("15");
        $IdentiteRegion->setNbrPublicTrainingCenters("12");
        $IdentiteRegion->setNbrEmploymentOffices("3");
        $IdentiteRegion->setNbrSpacesUndertake("7");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("27");
        $IdentiteRegion->setDescriptionRegion("Manouba est l'un des 24 gouvernorats de la Tunisie et situé dans le nord du pays");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //Medenine
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("9");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Médnine"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("10");
        $IdentiteRegion->setNbrPrivateTrainingCenters("6");
        $IdentiteRegion->setNbrPublicTrainingCenters("5");
        $IdentiteRegion->setNbrEmploymentOffices("5");
        $IdentiteRegion->setNbrSpacesUndertake("4");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("11");
        $IdentiteRegion->setDescriptionRegion("Medenine est situé dans le sud-est du pays, à la frontière tuniso-libyenne");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //Monastir
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("13");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Monastir"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("22");
        $IdentiteRegion->setNbrPrivateTrainingCenters("15");
        $IdentiteRegion->setNbrPublicTrainingCenters("14");
        $IdentiteRegion->setNbrEmploymentOffices("5");
        $IdentiteRegion->setNbrSpacesUndertake("11");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("29");
        $IdentiteRegion->setDescriptionRegion("Monastir est l'un des 24 gouvernorats de la Tunisie. Il est situé dans l'est du pays");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();



        //Nabeul
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("16");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Nabeul"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("27");
        $IdentiteRegion->setNbrPrivateTrainingCenters("16");
        $IdentiteRegion->setNbrPublicTrainingCenters("18");
        $IdentiteRegion->setNbrEmploymentOffices("5");
        $IdentiteRegion->setNbrSpacesUndertake("12");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("34");
        $IdentiteRegion->setDescriptionRegion("Nabeul est situé dans le nord-est du pays et couvre une superficie de 2 822 km²");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();



        //Sfax
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("16");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("23");
        $IdentiteRegion->setNbrPrivateTrainingCenters("19");
        $IdentiteRegion->setNbrPublicTrainingCenters("15");
        $IdentiteRegion->setNbrEmploymentOffices("7");
        $IdentiteRegion->setNbrSpacesUndertake("14");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("34");
        $IdentiteRegion->setDescriptionRegion("Sfax est la deuxième ville et centre économique de Tunisie");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //Sidi Bouzid
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("12");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sidi Bouzid"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("17");
        $IdentiteRegion->setNbrPrivateTrainingCenters("6");
        $IdentiteRegion->setNbrPublicTrainingCenters("4");
        $IdentiteRegion->setNbrEmploymentOffices("4");
        $IdentiteRegion->setNbrSpacesUndertake("7");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("10");
        $IdentiteRegion->setDescriptionRegion("Sidi Bouzid est situé dans le centre du pays et couvre une superficie de 6 994 km²");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();

        //Siliana
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("11                           ");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Siliana"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("12");
        $IdentiteRegion->setNbrPrivateTrainingCenters("3");
        $IdentiteRegion->setNbrPublicTrainingCenters("4");
        $IdentiteRegion->setNbrEmploymentOffices("4");
        $IdentiteRegion->setNbrSpacesUndertake("5");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("7");
        $IdentiteRegion->setDescriptionRegion("Siliana est situé dans le nord-ouest du pays et couvre une superficie de 4 642 km²");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();

        //Sousse
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("15");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sousse"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("18");
        $IdentiteRegion->setNbrPrivateTrainingCenters("17");
        $IdentiteRegion->setNbrPublicTrainingCenters("15");
        $IdentiteRegion->setNbrEmploymentOffices("5");
        $IdentiteRegion->setNbrSpacesUndertake("14");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("32");
        $IdentiteRegion->setDescriptionRegion("Sousse est situé dans l'est du pays et couvre une superficie de 2 669 km²");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();



        //Tataouine
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("7");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tataouine"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("7");
        $IdentiteRegion->setNbrPrivateTrainingCenters("6");
        $IdentiteRegion->setNbrPublicTrainingCenters("3");
        $IdentiteRegion->setNbrEmploymentOffices("6");
        $IdentiteRegion->setNbrSpacesUndertake("8");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("10");
        $IdentiteRegion->setDescriptionRegion("Tataouine est situé dans le sud-est du pays à la frontière avec l'Algérie et la Libye");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //Tozeur
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("5");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("6");
        $IdentiteRegion->setNbrPrivateTrainingCenters("5");
        $IdentiteRegion->setNbrPublicTrainingCenters("4");
        $IdentiteRegion->setNbrEmploymentOffices("5");
        $IdentiteRegion->setNbrSpacesUndertake("4");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("9");
        $IdentiteRegion->setDescriptionRegion("Tozeur est situé dans le sud-ouest du pays, à la frontière algéro-tunisienne");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();



        //Tunis
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("21");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("8");
        $IdentiteRegion->setNbrPrivateTrainingCenters("18");
        $IdentiteRegion->setNbrPublicTrainingCenters("11");
        $IdentiteRegion->setNbrEmploymentOffices("8");
        $IdentiteRegion->setNbrSpacesUndertake("13");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("29");
        $IdentiteRegion->setDescriptionRegion("Tunis est situé dans le Nord du pays et couvre une superficie de 346 km²");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();


        //Zaghouan
        $IdentiteRegion = new IdentiteRegion();
        $IdentiteRegion->setNbrLocalities("6");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Zaghouan"));
        $IdentiteRegion->setGouvernorate($gouvernorat);
        $IdentiteRegion->setNbrMunicipalities("8");
        $IdentiteRegion->setNbrPrivateTrainingCenters("7");
        $IdentiteRegion->setNbrPublicTrainingCenters("2");
        $IdentiteRegion->setNbrEmploymentOffices("2");
        $IdentiteRegion->setNbrSpacesUndertake("7");
        $IdentiteRegion->setNbrRegionalContinuingEducationUnits("9");
        $IdentiteRegion->setDescriptionRegion("Zaghouan est situé dans le nord-est du pays et couvre une superficie de 2 820 km²");

        $IdentiteRegion->setEnable(true);
        $manager->persist($IdentiteRegion);
        $manager->flush();











    }
}