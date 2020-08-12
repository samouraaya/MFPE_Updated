<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;


use Mfpe\ReferencielBundle\Entity\RefCaracteristiqueRegion;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CaracteristiqueRegion extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefCaracteristiqueRegionFixtures ******************************/
        $referenciel = New RefCaracteristiqueRegion();
        $referenciel->setIntituleAr("مطار");
        $referenciel->setIntituleFr("Aéroport");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $referenciel->setCode("AEROPORT");
        $manager->persist($referenciel);

        $referenciel = New RefCaracteristiqueRegion();
        $referenciel->setIntituleAr("ميناء");
        $referenciel->setIntituleFr("port");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $referenciel->setCode("PORT");
        $manager->persist($referenciel);

        $referenciel = New RefCaracteristiqueRegion();
        $referenciel->setIntituleAr("طريق سريع");
        $referenciel->setIntituleFr("autoroute");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $referenciel->setCode("AUTOROUTE");
        $manager->persist($referenciel);

        $referenciel = New RefCaracteristiqueRegion();
        $referenciel->setIntituleAr("السكة الحديدية");
        $referenciel->setIntituleFr("chemin de fer");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $referenciel->setCode("CHEMIN_DE_FER");
        $manager->persist($referenciel);

        $referenciel = New RefCaracteristiqueRegion();
        $referenciel->setIntituleAr("المنطقة الصناعية");
        $referenciel->setIntituleFr("zone industruele");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $referenciel->setCode("ZONE_INDUSTRIELLE");
        $manager->persist($referenciel);

        $referenciel = New RefCaracteristiqueRegion();
        $referenciel->setIntituleAr("منطقة سياحية");
        $referenciel->setIntituleFr("zone touristique");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $referenciel->setCode("ZONE_TOURISTIQUE");
        $manager->persist($referenciel);

        $referenciel = New RefCaracteristiqueRegion();
        $referenciel->setIntituleAr("منطقة الحرفية");
        $referenciel->setIntituleFr("zone artizanale");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $referenciel->setCode("ZONE_ARTIZANALE");
        $manager->persist($referenciel);

        $referenciel = New RefCaracteristiqueRegion();
        $referenciel->setIntituleAr("الشركات الكبرى");
        $referenciel->setIntituleFr("grande entreprise");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $referenciel->setCode("GRANDE_ENTREPRISE");
        $manager->persist($referenciel);


        $referenciel = New RefCaracteristiqueRegion();
        $referenciel->setIntituleAr("الجمعيات كبيرة");
        $referenciel->setIntituleFr("grande associations");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $referenciel->setCode("GRANDE_ASSOCIATIONS");
        $manager->persist($referenciel);

        $referenciel = New RefCaracteristiqueRegion();
        $referenciel->setIntituleAr("تغطية الشبكة");
        $referenciel->setIntituleFr("couverture réseau");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $referenciel->setCode("COUVERTURE_RESEAU");
        $manager->persist($referenciel);

        $referenciel = New RefCaracteristiqueRegion();
        $referenciel->setIntituleAr("منطقة تجارية كبيرة");
        $referenciel->setIntituleFr("Grande surface commerciale");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $referenciel->setCode("GRANDE_SURFACE_COMMERCIALE");
        $manager->persist($referenciel);


        $referenciel = New RefCaracteristiqueRegion();
        $referenciel->setIntituleAr("ثروة");
        $referenciel->setIntituleFr("richesse");
        $referenciel->setCreatedAt(new \DateTime());
        $referenciel->setEnable(true);
        $referenciel->setCode("RICHESSE");
        $manager->persist($referenciel);

        $manager->flush();
    }
}