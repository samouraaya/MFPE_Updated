<?php

namespace Mfpe\ReferencielBundle\DataFixtures\FirstDataFixtures;


use Mfpe\ReferencielBundle\Entity\RefStatut;
use Mfpe\ReferencielBundle\Entity\RefMotif;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;


class StatutFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert data RefStatut ******************************/
        $statut = New RefStatut();
        $statut->setIntituleAr("في انتظار التحقق من صحة الملف في الوحدة الإقليمية");
        $statut->setIntituleFr("En attente de validation du demande dans la direction régionale");
        $statut->setCode("ATTENTE_DR");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);
        if (is_object($statut)) {
            $motif = New RefMotif();
            $motif->setIntituleAr("عدم وجود الوثائق اللازمة");
            $motif->setIntituleFr("Manque de papiers nécessaires ");
            $motif->setParent($statut);
            $motif->setCreatedAt(new \DateTime());
            $motif->setEnable(true);
            $manager->persist($motif);

            $motif = New RefMotif();
            $motif->setIntituleAr("التخصص غير واضح");
            $motif->setIntituleFr("Spécialité non claire");
            $motif->setParent($statut);
            $motif->setCreatedAt(new \DateTime());
            $motif->setEnable(true);
            $manager->persist($motif);
        }

        $statut = New RefStatut();
        $statut->setIntituleAr("تم إختيار التخصص");
        $statut->setIntituleFr("Spécilaité choisie");
        $statut->setCode("SPECIALITE_CHOISIE");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);

        $statut = New RefStatut();
        $statut->setIntituleAr("تم نسخ الوثائق التابعة للملف");
        $statut->setIntituleFr("Scan des documents avec succèss");
        $statut->setCode("SCAN_OK");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);
        if (is_object($statut)) {
            $motif = New RefMotif();
            $motif->setIntituleAr("التخصص غير الموجود في مركز التكوين");
            $motif->setIntituleFr("Spécialité non existante dans le centre");
            $motif->setParent($statut);
            $motif->setCreatedAt(new \DateTime());
            $motif->setEnable(true);
            $manager->persist($motif);

            $motif = New RefMotif();
            $motif->setIntituleAr("عدم وجود المدرسين و الفنيين  في الإختصاص المذكور");
            $motif->setIntituleFr("Absence des formateurs dans le centre de formation");
            $motif->setParent($statut);
            $motif->setCreatedAt(new \DateTime());
            $motif->setEnable(true);
            $manager->persist($motif);
        }

        $statut = New RefStatut();
        $statut->setIntituleAr("تم إختيار مركز التكوين");
        $statut->setIntituleFr("Choix de centre de formation avec succèss");
        $statut->setCode("CENTRE_OK");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);

        $statut = New RefStatut();
        $statut->setIntituleAr("في انتظار دفع رسوم الامتحان");
        $statut->setIntituleFr("En attente de payement du frais d'examen");
        $statut->setCode("ATTENTE_PAIEMENT");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);
        if (is_object($statut)) {
            $motif = New RefMotif();
            $motif->setIntituleAr("مدة الدفع رسوم الامتحان تجاوزت المدة المحددة");
            $motif->setIntituleFr("Durée de paiement du frais d'examen dépassée la delais");
            $motif->setParent($statut);
            $motif->setCreatedAt(new \DateTime());
            $motif->setEnable(true);
            $manager->persist($motif);
        }

        $statut = New RefStatut();
        $statut->setIntituleAr("تم دفع معاليم الأمتحان بنجاح");
        $statut->setIntituleFr("Paiement avec sucess");
        $statut->setCode("PAIEMENT_OK");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);

        $statut = New RefStatut();
        $statut->setIntituleAr("تاريخ إجراء الأمتحان");
        $statut->setIntituleFr("Date d'examen fixé");
        $statut->setCode("DATE_EXAM_OK");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);

        $statut = New RefStatut();
        $statut->setIntituleAr("إعادة تاريخ إجراء الأمتحان");
        $statut->setIntituleFr("Changement date examen");
        $statut->setCode("RE_DATE_EXAM_OK");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);

        $statut = New RefStatut();
        $statut->setIntituleAr("رفع تقرير المطلب");
        $statut->setIntituleFr("Procès-verbal (PV) téléchargé");
        $statut->setCode("PV_UPLOAD");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);
        if (is_object($statut)) {
            $motif = New RefMotif();
            $motif->setIntituleAr("محضر المطلب غير واضح ");
            $motif->setIntituleFr("Procès-verbal (PV) non claire");
            $motif->setParent($statut);
            $motif->setCreatedAt(new \DateTime());
            $motif->setEnable(true);
            $manager->persist($motif);

            $motif = New RefMotif();
            $motif->setIntituleAr("عدم وجود التوقيع في محضر المطلب");
            $motif->setIntituleFr("Manque de signature dans de Procès-verbal (PV)");
            $motif->setParent($statut);
            $motif->setCreatedAt(new \DateTime());
            $motif->setEnable(true);
            $manager->persist($motif);
        }

        $statut = New RefStatut();
        $statut->setIntituleAr("محضر المطلب مقبول");
        $statut->setIntituleFr("Procès-verbal (PV) accepté");
        $statut->setCode("PV_ACCEPTE");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);
        if (is_object($statut)) {
            $motif = New RefMotif();
            $motif->setIntituleAr("نتيجة الأمتحان أقل من درجة القبول");
            $motif->setIntituleFr("Note de l'examen est au dessous de la valeur de réussite");
            $motif->setParent($statut);
            $motif->setCreatedAt(new \DateTime());
            $motif->setEnable(true);
            $manager->persist($motif);

            $motif = New RefMotif();
            $motif->setIntituleAr("سلوك سيء مع المدرسين في مركز التكوين");
            $motif->setIntituleFr("Mauvais comportment avec les enseignats du centre de formation");
            $motif->setParent($statut);
            $motif->setCreatedAt(new \DateTime());
            $motif->setEnable(true);
            $manager->persist($motif);
        }

        $statut = New RefStatut();
        $statut->setIntituleAr("تسليم  الشهادة");
        $statut->setIntituleFr("Remise du certificat");
        $statut->setCode("ATTESTATION_OK");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);

        $statut = New RefStatut();
        $statut->setIntituleAr("رفض المطلب من قبل الإدارة الإقليمية");
        $statut->setIntituleFr("Refus demande par direction régionale");
        $statut->setCode("REFUSE_DR");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);

        $statut = New RefStatut();
        $statut->setIntituleAr("رفض المطلب من قبل مركز التكوين");
        $statut->setIntituleFr("Refus demande par centre de formation");
        $statut->setCode("REFUS_CENTRE");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);


        $statut = New RefStatut();
        $statut->setIntituleAr("عدم دفع رسوم الامتحان");
        $statut->setIntituleFr("Echec de paimement du frais d'examen");
        $statut->setCode("PAIEMENT_KO");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);


        $statut = New RefStatut();
        $statut->setIntituleAr("رفض محضر المطلب");
        $statut->setIntituleFr("Procès-verbal (PV) refusé");
        $statut->setCode("PV_REFUSE");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);


        $statut = New RefStatut();
        $statut->setIntituleAr("رفض الشهادة");
        $statut->setIntituleFr("Attestation refusé");
        $statut->setCode("ATTESTATION_KO");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);


        $statut = New RefStatut();
        $statut->setIntituleAr("مرشح غائب");
        $statut->setIntituleFr("condidat absent");
        $statut->setCode("CONDIDAT_ABSENT");
        $statut->setCreatedAt(new \DateTime());
        $statut->setEnable(true);
        $manager->persist($statut);

        $manager->flush();
    }
}