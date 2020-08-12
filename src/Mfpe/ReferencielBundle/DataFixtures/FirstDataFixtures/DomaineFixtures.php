<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;

use Mfpe\ReferencielBundle\Entity\RefDomaine;
use Mfpe\ReferencielBundle\Entity\RefSecteur;
use Mfpe\ReferencielBundle\Entity\RefSousSecteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class DomaineFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefDomaine ******************************/
        $faker = Faker\Factory::create('fr_FR');

        /*************************************** Domaine Agriculture ***************************************/
//        $domaine = New RefDomaine();
//        $domaine->setIntituleAr("الفلاحة");
//        $domaine->setIntituleFr("Agriculture");
//        $domaine->setCreatedAt(new \DateTime());
//        $domaine->setEnable(true);
//        $manager->persist($domaine);
//        if ($domaine) {
            //persist secteur
            $secteur = New RefSecteur();
//            $secteur->setParent($domaine);
            $secteur->setIntituleAr("الزراعات الكبرى");
            $secteur->setIntituleFr("Agroalimentaire");
            $secteur->setTypeSecteur(true);
            $secteur->setEnable(true);
            $secteur->setCreatedAt(new \DateTime());
            $manager->persist($secteur);
//        }
        if ($secteur) {
            $sousSecteur = New RefSousSecteur();
            $sousSecteur->setIntituleAr("تصنيع منتجات الألبان");
            $sousSecteur->setIntituleFr("Fabrication de produits laitiers ");
            $sousSecteur->setParent($secteur);
            $sousSecteur->setCreatedAt(new \DateTime());
            $sousSecteur->setEnable(true);
            $manager->persist($sousSecteur);

            $sousSecteur = New RefSousSecteur();
            $sousSecteur->setIntituleAr("صناعة منتجات المخابز والمعكرونة");
            $sousSecteur->setIntituleFr("Fabrication de produits de boulangerie-pâtisserie et de pâtes alimentaires");
            $sousSecteur->setParent($secteur);
            $sousSecteur->setCreatedAt(new \DateTime());
            $sousSecteur->setEnable(true);
            $manager->persist($sousSecteur);

            $sousSecteur = New RefSousSecteur();
            $sousSecteur->setIntituleAr("صناعة المشروبات");
            $sousSecteur->setIntituleFr("Fabrication de boissons");
            $sousSecteur->setParent($secteur);
            $sousSecteur->setCreatedAt(new \DateTime());
            $sousSecteur->setEnable(true);
            $manager->persist($sousSecteur);

            $sousSecteur = New RefSousSecteur();
            $sousSecteur->setIntituleAr("تصنيع الزيوت النباتية والحيوانية والدهون");
            $sousSecteur->setIntituleFr("Fabrication d'huiles et graisses végétales et animales");
            $sousSecteur->setParent($secteur);
            $sousSecteur->setCreatedAt(new \DateTime());
            $sousSecteur->setEnable(true);
            $manager->persist($sousSecteur);
        }
        /*************************************** Domaine Industrie ***************************************/
//        $domaine = New RefDomaine();
//        $domaine->setIntituleAr("الصناعة");
//        $domaine->setIntituleFr("Industrie");
//        $domaine->setCreatedAt(new \DateTime());
//        $domaine->setEnable(true);
//        $manager->persist($domaine);
//        if ($domaine) {
            //persist secteur
            $secteur = New RefSecteur();
//            $secteur->setParent($domaine);
            $secteur->setIntituleAr("النقل");
            $secteur->setIntituleFr("Transport");
            $secteur->setTypeSecteur(true);
            $secteur->setCreatedAt(new \DateTime());
            $secteur->setEnable(true);
            $manager->persist($secteur);
//        }
        if ($secteur) {
            //persist sousSecteur
            $sousSecteur = New RefSousSecteur();
            $sousSecteur->setIntituleAr("النقل البري");
            $sousSecteur->setIntituleFr("Transport routier");
            $sousSecteur->setParent($secteur);
            $sousSecteur->setCreatedAt(new \DateTime());
            $sousSecteur->setEnable(true);
            $manager->persist($sousSecteur);

            $sousSecteur = New RefSousSecteur();
            $sousSecteur->setIntituleAr("نقل جوي");
            $sousSecteur->setIntituleFr("Transport aérien");
            $sousSecteur->setParent($secteur);
            $sousSecteur->setCreatedAt(new \DateTime());
            $sousSecteur->setEnable(true);
            $manager->persist($sousSecteur);

            $sousSecteur = New RefSousSecteur();
            $sousSecteur->setIntituleAr("النقل بالسكك الحديدية");
            $sousSecteur->setIntituleFr("Transport ferroviaire");
            $sousSecteur->setParent($secteur);
            $sousSecteur->setCreatedAt(new \DateTime());
            $sousSecteur->setEnable(true);
            $manager->persist($sousSecteur);
        }
        /*************************************** Domaine Commerce ***************************************/
//        $domaine = New RefDomaine();
//        $domaine->setIntituleAr("التجارة");
//        $domaine->setIntituleFr("Commerce");
//        $domaine->setCreatedAt(new \DateTime());
//        $domaine->setEnable(true);
//        $manager->persist($domaine);
//        if ($domaine) {
            //persist sousSecteur
            $secteur = New RefSecteur();
//            $secteur->setParent($domaine);
            $secteur->setIntituleAr("البنك والتأمين");
            $secteur->setIntituleFr("Banque et Assurance");
            $secteur->setCreatedAt(new \DateTime());
            $secteur->setEnable(true);
            $secteur->setTypeSecteur(false);
            $manager->persist($secteur);
//        }
        if ($secteur) {
            //persist sousSecteur
            $sousSecteur = New RefSousSecteur();
            $sousSecteur->setIntituleAr("وسيط");
            $sousSecteur->setIntituleFr("Intermédiaire en bourse");
            $sousSecteur->setParent($secteur);
            $sousSecteur->setCreatedAt(new \DateTime());
            $sousSecteur->setEnable(true);
            $manager->persist($sousSecteur);
        }

            $manager->flush();
    }
}