<?php

namespace Mfpe\ReferencielBundle\DataFixtures\ThirdDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

//Entity
use Mfpe\UniteRegionaleBundle\Entity\Description;

class DescriptionIdentiteRegionFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        //Ariana
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "Aéroport"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ariana"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Un aéroport est l'ensemble des bâtiments et des installations qui servent au traitement des passagers ou du fret aérien situés sur un aérodrome");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "port"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ariana"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Un port est une infrastructure construite par l'homme, située sur le littoral maritime, sur les berges d'un lac ou sur un cours d'eau, et destinée à accueillir des bateaux et navires");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "autoroute"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ariana"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Une autoroute est une voie de communication routière à chaussées séparées, réservée à la circulation à vitesse élevée des véhicules motorisés");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //Beja
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "chemin de fer"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Beja"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Le chemin de fer est un système de transport guidé servant au déplacement de personnes et de marchandises");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "zone industruele"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Beja"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Une zone industriel est une zone d'activité prévue pour un usage industriel");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();


        //Ben Arous
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "chemin de fer"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ben Arous"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Le chemin de fer est un système de transport guidé servant au déplacement de personnes et de marchandises");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "zone touristique"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Ben Arous"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("une zone touristique est une aire géographique attractive pour le développement du tourisme, reconnue pour la richesse de son environnement et de son patrimoine");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //Bizerte
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "grande entreprise"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Bizerte"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Une grande entreprise est une entreprise qui vérifie au moins une des deux conditions :avoir au moins 5000 salariés et plus de 1,5 milliards d'euros de chiffre d'affaires et plus de 2 milliards d'euros de total de bilan");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "zone artizanale"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Bizerte"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Une zone artisanale un site réservé à l’implantation d’entreprises dans un périmètre donné");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();


        //Gabès
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "couverture réseau"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gabès"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("La couverture réseau désigne la part des internautes ou mobinautes exprimée en pourcentage que touche le site ou réseau sur une période donnée");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "grande associations"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gabès"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("L'association est la convention par laquelle deux ou plusieurs personnes mettent en commun, d'une façon permanente leurs connaissances dans un but autre que partager des bénéfices");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //Gafsa
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "richesse"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gafsa"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("La richesse est la valeur de l'ensemble des biens détenus par un agent économique pouvant être soit produite par un revenu ou une plus-value, soit acquise par un legs ou une donation");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "grande associations"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Gafsa"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("L'association est la convention par laquelle deux ou plusieurs personnes mettent en commun, d'une façon permanente leurs connaissances dans un but autre que partager des bénéfices");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //Jendouba
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "chemin de fer"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Jendouba"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Le chemin de fer est un système de transport guidé servant au déplacement de personnes et de marchandises");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "grande associations"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Jendouba"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("L'association est la convention par laquelle deux ou plusieurs personnes mettent en commun, d'une façon permanente leurs connaissances dans un but autre que partager des bénéfices");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //Kairouan
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "port"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kairouan"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Un port est une infrastructure construite par l'homme, située sur le littoral maritime, sur les berges d'un lac ou sur un cours d'eau, et destinée à accueillir des bateaux et navires");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "grande associations"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kairouan"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("L'association est la convention par laquelle deux ou plusieurs personnes mettent en commun, d'une façon permanente leurs connaissances dans un but autre que partager des bénéfices");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();


        //Kasserine
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "autoroute"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Une autoroute est une voie de communication routière à chaussées séparées, réservée à la circulation à vitesse élevée des véhicules motorisés");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "Aéroport"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Un aéroport est l'ensemble des bâtiments et des installations qui servent au traitement des passagers ou du fret aérien situés sur un aérodrome");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();


        //Kébili
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "zone artizanale"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kébili"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Une zone artisanale un site réservé à l’implantation d’entreprises dans un périmètre donné");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "zone industruele"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kébili"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("zone industrielle ou site industriel est une zone d'activité prévue pour un usage industriel");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();



        //El Kef
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "couverture réseau"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "El Kef"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Couverture réseau désigne la part des internautes ou mobinautes exprimée en pourcentage que touche le site ou réseau sur une période donnée");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "grande associations"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "El Kef"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("L'association est la convention par laquelle deux ou plusieurs personnes mettent en commun, d'une façon permanente leurs connaissances dans un but autre que partager des bénéfices");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //Mahdia
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "couverture réseau"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Mahdia"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Couverture réseau désigne la part des internautes ou mobinautes exprimée en pourcentage que touche le site ou réseau sur une période donnée");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "autoroute"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Mahdia"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Une autoroute est une voie de communication routière à chaussées séparées, réservée à la circulation à vitesse élevée des véhicules motorisés");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //La Manouba
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "Grande surface commerciale"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "La Manouba"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Qualificatif d'un point de vente au détail de grande dimension");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "richesse"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "La Manouba"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("La richesse est la valeur de l'ensemble des biens détenus par un agent économique pouvant être soit produite par un revenu ou une plus-value, soit acquise par un legs ou une donation");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //Médnine
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "Grande surface commerciale"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Médnine"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Qualificatif d'un point de vente au détail de grande dimension");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "couverture réseau"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Médnine"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Couverture réseau désigne la part des internautes ou mobinautes exprimée en pourcentage que touche le site ou réseau sur une période donnée");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //Monastir
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "zone touristique"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Monastir"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("une zone touristique est une aire géographique attractive pour le développement du tourisme, reconnue pour la richesse de son environnement et de son patrimoine");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "couverture réseau"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Monastir"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Couverture réseau désigne la part des internautes ou mobinautes exprimée en pourcentage que touche le site ou réseau sur une période donnée");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();



        //Nabeul
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "port"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Nabeul"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Un port est une infrastructure construite par l'homme, située sur le littoral maritime, sur les berges d'un lac ou sur un cours d'eau, et destinée à accueillir des bateaux et navires");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "zone industruele"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Nabeul"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("zone industrielle ou site industriel est une zone d'activité prévue pour un usage industriel");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //Sfax
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "grande associations"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("L'association est la convention par laquelle deux ou plusieurs personnes mettent en commun, d'une façon permanente leurs connaissances dans un but autre que partager des bénéfices");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "Aéroport"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Un aéroport est l'ensemble des bâtiments et des installations qui servent au traitement des passagers ou du fret aérien situés sur un aérodrome");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();



        //Sidi Bouzid
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "grande associations"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sidi Bouzid"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("L'association est la convention par laquelle deux ou plusieurs personnes mettent en commun, d'une façon permanente leurs connaissances dans un but autre que partager des bénéfices");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "richesse"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sidi Bouzid"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("La richesse est la valeur de l'ensemble des biens détenus par un agent économique pouvant être soit produite par un revenu ou une plus-value, soit acquise par un legs ou une donation");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();


        //Siliana
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "Grande surface commerciale"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Siliana"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Qualificatif d'un point de vente au détail de grande dimension");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "richesse"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Siliana"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("La richesse est la valeur de l'ensemble des biens détenus par un agent économique pouvant être soit produite par un revenu ou une plus-value, soit acquise par un legs ou une donation");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();


        //Sousse
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "Grande surface commerciale"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sousse"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Qualificatif d'un point de vente au détail de grande dimension");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "richesse"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sousse"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("La richesse est la valeur de l'ensemble des biens détenus par un agent économique pouvant être soit produite par un revenu ou une plus-value, soit acquise par un legs ou une donation");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //Tataouine
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "grande entreprise"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tataouine"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Une grande entreprise est une entreprise qui vérifie au moins une des deux conditions :avoir au moins 5000 salariés et plus de 1,5 milliards d'euros de chiffre d'affaires et plus de 2 milliards d'euros de total de bilan");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "couverture réseau"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tataouine"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Couverture réseau désigne la part des internautes ou mobinautes exprimée en pourcentage que touche le site ou réseau sur une période donnée");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //Tozeur
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "zone artizanale"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Une zone artisanale est un site réservé à l’implantation d’entreprises dans un périmètre donné");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "couverture réseau"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Couverture réseau désigne la part des internautes ou mobinautes exprimée en pourcentage que touche le site ou réseau sur une période donnée");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //Tunis
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "zone industruele"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("zone industrielle ou site industriel est une zone d'activité prévue pour un usage industriel");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "couverture réseau"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Couverture réseau désigne la part des internautes ou mobinautes exprimée en pourcentage que touche le site ou réseau sur une période donnée");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        //Tunis
        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "zone touristique"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Zaghouan"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("une zone touristique est une aire géographique attractive pour le développement du tourisme, reconnue pour la richesse de son environnement et de son patrimoine");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();

        $description = new Description();
        $caracteristique= $manager->getRepository('MfpeReferencielBundle:RefCaracteristiqueRegion')->findOneBy(array("intituleFr" => "chemin de fer"));
        $description->setCaracteristiqueRegion($caracteristique);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Zaghouan"));
        $identiteRegion = $manager->getRepository('MfpeUniteRegionaleBundle:IdentiteRegion')->findOneBy(array("gouvernorate" => $gouv->getId()));
        $description->setIdentiteRegion($identiteRegion);
        $description->setDescription("Le chemin de fer est un système de transport guidé servant au déplacement de personnes et de marchandises");
        $description->setEnable(true);
        $manager->persist($description);
        $manager->flush();
    }

}