<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;


use Mfpe\ReferencielBundle\Entity\RefSecteur;
use Mfpe\ReferencielBundle\Entity\RefSousSecteur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class SecteurSousSecteurFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
//        /****************************** Insert data RefSecteur ******************************/
//        $faker = Faker\Factory::create('fr_FR');
//        $referenciel = New RefSecteur();
//        $referenciel->setIntituleAr("النقل");
//        $referenciel->setIntituleFr("Transport");
//        $referenciel->setTypeSecteur(true);
//        $referenciel->setCreatedAt(new \DateTime());
//        $manager->persist($referenciel);
//
//        $referenciel = New RefSecteur();
//        $referenciel->setIntituleAr("الزراعات الكبرى");
//        $referenciel->setIntituleFr("Agroalimentaire");
//        $referenciel->setTypeSecteur(true);
//        $referenciel->setCreatedAt(new \DateTime());
//        $manager->persist($referenciel);
//
//        $referenciel = New RefSecteur();
//        $referenciel->setIntituleAr("البنك والتأمين");
//        $referenciel->setIntituleFr("Banque et Assurance");
//        $referenciel->setTypeSecteur(false);
//        $referenciel->setCreatedAt(new \DateTime());
//        $manager->persist($referenciel);
//
//        $manager->flush();
//
//        /****************************** Insert data RefSousSecteur ******************************/
//        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(['intituleFr' => 'Transport']);
//        if (is_object($secteur)) {
//            $referenciel = New RefSousSecteur();
//            $referenciel->setIntituleAr("النقل البري");
//            $referenciel->setIntituleFr("Transport routier");
//            $referenciel->setParent($secteur);
//            $referenciel->setCreatedAt(new \DateTime());
//            $manager->persist($referenciel);
//
//            $referenciel = New RefSousSecteur();
//            $referenciel->setIntituleAr("نقل جوي");
//            $referenciel->setIntituleFr("Transport aérien");
//            $referenciel->setParent($secteur);
//            $referenciel->setCreatedAt(new \DateTime());
//            $manager->persist($referenciel);
//
//            $referenciel = New RefSousSecteur();
//            $referenciel->setIntituleAr("النقل بالسكك الحديدية");
//            $referenciel->setIntituleFr("Transport ferroviaire");
//            $referenciel->setParent($secteur);
//            $referenciel->setCreatedAt(new \DateTime());
//            $manager->persist($referenciel);
//        }
//        /****************************** Insert data RefSousSecteur ******************************/
//
//        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(['intituleFr' => 'Agroalimentaire']);
//        if (is_object($secteur)) {
//            $referenciel = New RefSousSecteur();
//            $referenciel->setIntituleAr("تصنيع منتجات الألبان");
//            $referenciel->setIntituleFr("Fabrication de produits laitiers ");
//            $referenciel->setParent($secteur);
//            $referenciel->setCreatedAt(new \DateTime());
//            $manager->persist($referenciel);
//
//            $referenciel = New RefSousSecteur();
//            $referenciel->setIntituleAr("صناعة منتجات المخابز والمعكرونة");
//            $referenciel->setIntituleFr("Fabrication de produits de boulangerie-pâtisserie et de pâtes alimentaires");
//            $referenciel->setParent($secteur);
//            $referenciel->setCreatedAt(new \DateTime());
//            $manager->persist($referenciel);
//
//            $referenciel = New RefSousSecteur();
//            $referenciel->setIntituleAr("صناعة المشروبات");
//            $referenciel->setIntituleFr("Fabrication de boissons");
//            $referenciel->setParent($secteur);
//            $referenciel->setCreatedAt(new \DateTime());
//            $manager->persist($referenciel);
//
//            $referenciel = New RefSousSecteur();
//            $referenciel->setIntituleAr("تصنيع الزيوت النباتية والحيوانية والدهون");
//            $referenciel->setIntituleFr("Fabrication d'huiles et graisses végétales et animales");
//            $referenciel->setParent($secteur);
//            $referenciel->setCreatedAt(new \DateTime());
//            $manager->persist($referenciel);
//        }
//
//        $manager->flush();
    }
}