<?php

namespace Mfpe\ReferencielBundle\DataFixtures\ThirdDataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
//Entity
use Mfpe\ConfigBundle\Entity\Role;
use Mfpe\ConfigBundle\Entity\AppUser;

class RolesUsersFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        /****************************** Insert data Role ******************************/
        $roles = array(
            array(
                "intituleAr" => "المشرف العام على الموقع",
                "intituleFr" => "Administrateur du site",
                "role" => "ROLE_SUPER_ADMIN",
                "editable" => false,
                "status" => array("ATTENTE_DR", "SPECIALITE_CHOISIE", "SCAN_OK", "CENTRE_OK", "ATTENTE_PAIEMENT", "PAIEMENT_OK", "DATE_EXAM_OK", "RE_DATE_EXAM_OK", "PV_UPLOAD", "PV_ACCEPTE", "ATTESTATION_OK", "REFUSE_DR", "REFUS_CENTRE", "PAIEMENT_KO", "PV_REFUSE", "ATTESTATION_KO","CONDIDAT_ABSENT"),
                "stateExecute" => array("ATTENTE_DR", "SPECIALITE_CHOISIE", "SCAN_OK", "CENTRE_OK", "ATTENTE_PAIEMENT", "PAIEMENT_OK", "DATE_EXAM_OK", "RE_DATE_EXAM_OK", "PV_UPLOAD", "PV_ACCEPTE", "ATTESTATION_OK", "REFUSE_DR", "REFUS_CENTRE", "PAIEMENT_KO", "PV_REFUSE", "ATTESTATION_KO","CONDIDAT_ABSENT"),
                "frontInterfaces" => array("informations", "demands", "consultDemands", "collectData", "publicProjects", "internationalProjectsCooperation",
                                           "inscrit-secteur-public", "diplomé-secteur-public", "inscrit-secteur-privé", "diplomé-secteur-privé", "privateCenterNumber", "donneesSecteurSocio",
                                           "formAdd", "uploadFile", "donneesSecteurEmploi", "donneesBts", "projectAPI", "projectAPIA", "numberEntrepDiffic",
                                           "donneesAneti", "editique", "dashboard", "affichageStandard", "affichagePersonnalisé", "ficheDescriptive",
                                           "regionalNewsletter", "accessProfilingManagment", "agentsManagement","citoyenManagement", "rolesManagement", "nomenclatures","settings",
                                           "trainingCenterList", "specialities", "referencesList", "ruList","identityRegional", "disconnect"
                )
            ),
            array(
                "intituleAr" => "المشرف العام على الموقع",
                "intituleFr" => "Administrateur du site",
                "role" => "ROLE_ADMIN",
                "editable" => false,
                "status" => array("ATTENTE_DR", "SPECIALITE_CHOISIE", "SCAN_OK", "CENTRE_OK", "ATTENTE_PAIEMENT", "PAIEMENT_OK", "DATE_EXAM_OK", "RE_DATE_EXAM_OK", "PV_UPLOAD", "PV_ACCEPTE", "ATTESTATION_OK", "REFUSE_DR", "REFUS_CENTRE", "PAIEMENT_KO", "PV_REFUSE", "ATTESTATION_KO","CONDIDAT_ABSENT"),
                "stateExecute" => array("ATTENTE_DR", "SPECIALITE_CHOISIE", "SCAN_OK", "CENTRE_OK", "ATTENTE_PAIEMENT", "PAIEMENT_OK", "DATE_EXAM_OK", "RE_DATE_EXAM_OK", "PV_UPLOAD", "PV_ACCEPTE", "ATTESTATION_OK", "REFUSE_DR", "REFUS_CENTRE", "PAIEMENT_KO", "PV_REFUSE", "ATTESTATION_KO","CONDIDAT_ABSENT"),
                "frontInterfaces" => array("informations", "demands", "consultDemands", "collectData", "publicProjects", "internationalProjectsCooperation",
                                           "inscrit-secteur-public", "diplomé-secteur-public", "inscrit-secteur-privé", "diplomé-secteur-privé", "privateCenterNumber", "donneesSecteurSocio",
                                           "formAdd", "uploadFile", "donneesSecteurEmploi", "donneesBts", "projectAPI", "projectAPIA", "numberEntrepDiffic",
                                           "donneesAneti", "editique", "dashboard", "affichageStandard", "affichagePersonnalisé", "ficheDescriptive",
                                           "regionalNewsletter", "accessProfilingManagment", "agentsManagement","citoyenManagement", "rolesManagement", "nomenclatures","settings",
                                           "trainingCenterList", "specialities", "referencesList", "ruList","identityRegional", "disconnect"
                )
            ),
            array(
                "intituleAr" => "المشرف العام على الموقع",
                "intituleFr" => "Administrateur du site",
                "role" => "ROLE_CYNAPSYS",
                "editable" => false,
                "status" => array("ATTENTE_DR", "SPECIALITE_CHOISIE", "SCAN_OK", "CENTRE_OK", "ATTENTE_PAIEMENT", "PAIEMENT_OK", "DATE_EXAM_OK", "RE_DATE_EXAM_OK", "PV_UPLOAD", "PV_ACCEPTE", "ATTESTATION_OK", "REFUSE_DR", "REFUS_CENTRE", "PAIEMENT_KO", "PV_REFUSE", "ATTESTATION_KO","CONDIDAT_ABSENT"),
                "stateExecute" => array("ATTENTE_DR", "SPECIALITE_CHOISIE", "SCAN_OK", "CENTRE_OK", "ATTENTE_PAIEMENT", "PAIEMENT_OK", "DATE_EXAM_OK", "RE_DATE_EXAM_OK", "PV_UPLOAD", "PV_ACCEPTE", "ATTESTATION_OK", "REFUSE_DR", "REFUS_CENTRE", "PAIEMENT_KO", "PV_REFUSE", "ATTESTATION_KO","CONDIDAT_ABSENT"),
                "frontInterfaces" => array("informations", "demands", "consultDemands", "collectData", "publicProjects", "internationalProjectsCooperation",
                                           "inscrit-secteur-public", "diplomé-secteur-public", "inscrit-secteur-privé", "diplomé-secteur-privé", "privateCenterNumber", "donneesSecteurSocio",
                                           "formAdd", "uploadFile", "donneesSecteurEmploi", "donneesBts", "projectAPI", "projectAPIA", "numberEntrepDiffic",
                                           "donneesAneti", "editique", "dashboard", "affichageStandard", "affichagePersonnalisé", "ficheDescriptive",
                                           "regionalNewsletter", "accessProfilingManagment", "agentsManagement","citoyenManagement", "rolesManagement", "nomenclatures","settings",
                                           "trainingCenterList", "specialities", "referencesList", "ruList","identityRegional", "disconnect"
                )
            ),
            array(
                "intituleAr" => "الشخص المسؤول عن الطلب والشهادة",
                "intituleFr" => "Le responsable de la demande et la certification",
                "role" => "ROLE_CITOYEN",
                "editable" => false,
                "status" => array("ATTENTE_DR", "SPECIALITE_CHOISIE", "SCAN_OK", "CENTRE_OK", "ATTENTE_PAIEMENT", "PAIEMENT_OK", "DATE_EXAM_OK", "RE_DATE_EXAM_OK", "PV_UPLOAD", "PV_ACCEPTE", "ATTESTATION_OK", "REFUSE_DR", "REFUS_CENTRE", "PAIEMENT_KO", "PV_REFUSE", "ATTESTATION_KO"),
                "stateExecute" => array("PAIEMENT_OK", "PAIEMENT_KO"),
                "frontInterfaces" => array("informations", "demands", "newApplicationsList", "inProgressApplicationsList", "rejectedApplicationsList",
                                           "closedApplicationsList", "disconnect"
                )
            ),
            array(
                "intituleAr" => "المكلف بالعلاقة مع المواطن إسداء الخدمات",
                "intituleFr" => "Responsable de la relation avec le citoyen pour fournir des services",
                "role" => "ROLE_AGENT_DR1",
                "editable" => true,
                "status" => array("ATTENTE_DR"),
                "stateExecute" => array("SPECIALITE_CHOISIE", "REFUSE_DR"),
                "frontInterfaces" => array("informations", "demands", "consultDemands", "donneesSecteurSocio", "formAdd", "uploadFile",
                                           "donneesSecteurEmploi", "editique", "dashboard", "ficheDescriptive", "nomenclatures", "trainingCenterList",
                                           "specialities", "disconnect"
                )
            ),
            array(
                "intituleAr" => "المكلف بالعلاقة مع المواطن إسداء الخدمات",
                "intituleFr" => "Responsable de la relation avec le citoyen pour fournir des services",
                "role" => "ROLE_AGENT_DR2",
                "editable" => true,
                "status" => array("SPECIALITE_CHOISIE", "REFUS_CENTRE"),
                "stateExecute" => array("CENTRE_OK"),
                "frontInterfaces" => array("informations", "demands", "consultDemands", "donneesSecteurSocio", "formAdd", "uploadFile",
                                           "donneesSecteurEmploi", "editique", "dashboard", "ficheDescriptive", "nomenclatures", "trainingCenterList",
                                           "specialities", "disconnect"
                )
            ),
            array(
                "intituleAr" => "المكلف بالعلاقة مع المواطن إسداء الخدمات",
                "intituleFr" => "Responsable de la relation avec le citoyen pour fournir des services",
                "role" => "ROLE_AGENT_DR3",
                "editable" => true,
                "status" => array("CENTRE_OK", "REFUS_CENTRE"),
                "stateExecute" => array("SCAN_OK"),
                "frontInterfaces" => array("informations", "demands", "consultDemands", "donneesSecteurSocio", "formAdd", "uploadFile",
                                           "donneesSecteurEmploi", "editique", "dashboard", "ficheDescriptive", "nomenclatures", "trainingCenterList",
                                           "specialities", "disconnect"
                )
            ),
            array(
                "intituleAr" => "المكلف بالعلاقة مع المواطن إسداء الخدمات",
                "intituleFr" => "Responsable de la relation avec le citoyen pour fournir des services",
                "role" => "ROLE_AGENT_DR4",
                "editable" => true,
                "status" => array("PV_UPLOAD"),
                "stateExecute" => array("PV_ACCEPTE", "PV_REFUSE"),
                "frontInterfaces" => array("informations", "demands", "consultDemands", "donneesSecteurSocio", "formAdd", "uploadFile",
                                           "donneesSecteurEmploi", "editique", "dashboard", "ficheDescriptive", "nomenclatures", "trainingCenterList",
                                           "specialities", "disconnect"
                )
            ),
            array(
                "intituleAr" => "مدير الإقليم",
                "intituleFr" => "Directeur de la direction régionale",
                "role" => "ROLE_DIRECTEUR_DR",
                "editable" => true,
                "status" => array("PV_ACCEPTE"),
                "stateExecute" => array("ATTESTATION_OK", "ATTESTATION_KO"),
                "frontInterfaces" => array("informations", "demands", "consultDemands", "editique", "dashboard", "ficheDescriptive",
                                           "nomenclatures", "trainingCenterList", "specialities", "disconnect"
                )
            ),
            //            array(
            //                "role" => "ROLE_AGENT_CENTRE",
            //                "status" => "SCAN_OK,PAIEMENT_OK,DATE_EXAM_OK,RE_DATE_EXAM_OK,PV_REFUSE,ATTENTE_PAIEMENT",
            //                "stateExecute" => "REFUS_CENTRE,ATTENTE_PAIEMENT,DATE_EXAM_OK,RE_DATE_EXAM_OK,PV_UPLOAD"
            //            ),
            array(
                "intituleAr" => "وكيل إدخال البيانات بالوزارة",
                "intituleFr" => "Agent de saisie dans la ministère ",
                "role" => "ROLE_AGENT_MFPE",
                "editable" => true,
                "status" => array(),
                "stateExecute" => array(),
                "frontInterfaces" => array("informations", "demands", "consultDemands", "editique", "dashboard",
                                           "ficheDescriptive", "nomenclatures", "trainingCenterList", "specialities", "disconnect"
                )
            )
        );

        /****************************** Insert Roles ******************************/
        foreach ($roles as $key => $value) {
            $roleExist = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array('role' => $value["role"]));
            if (!is_object($roleExist)) {
                $role = New Role();
                $role->setIntituleAr($value["intituleAr"]);
                $role->setIntituleFr($value["intituleFr"]);
                $role->setRole($value["role"]);
                $role->setFrontInterfaces($value["frontInterfaces"]);
                $role->setStatus($value["status"]);
                $role->setStateExecute($value["stateExecute"]);
                $role->setEditable($value["editable"]);
                $role->setCreatedAt(new \DateTime());
                $manager->persist($role);
                $manager->flush();

            }
        }

        /****************************** Insert data user ******************************/
        //insert user ROLE_SUPER_ADMIN
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_SUPER_ADMIN"));
        $user = New AppUser();
        $user->setNomAr("المشرف");
        $user->setPrenomAr("المشرف");
        $user->setUsername("admin@gmail.com");
        $user->setNomFr("admin");
        $user->setPrenomFr("admin");
        $user->setEmail("admin@gmail.com");
        $user->setPassword("admin");
        $user->setPlainPassword("admin");
        $user->setPasswordPrint("admin");
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin("99999999");
        $user->setIdentifiant("TUN-99999999");
        $user->setGrade("Administrateur site web");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $user->setDelegation($delegation);
        $niveauEtude = $manager->getRepository('MfpeReferencielBundle:RefNiveauEtude')->findOneBy(array("intituleFr" => "Baccalauréat + année universitaire"));
        $user->setNiveauEtude($niveauEtude);
        //$user->setUniteRegionale();
        $user->setCreatedAt(new \DateTime());

        //$user->setUserRoles($roleInsert);
        $manager->persist($user);
        $manager->flush();


        //insert user ROLE_ADMIN
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_ADMIN"));
        $user = New AppUser();
        $user->setNomAr("المشرف2");
        $user->setPrenomAr("المشرف2");
        $user->setUsername("admin2@gmail.com");
        $user->setNomFr("admin2");
        $user->setPrenomFr("admin2");
        $user->setEmail("admin2@gmail.com");
        $user->setPassword("admin2");
        $user->setPlainPassword("admin2");
        $user->setPasswordPrint("admin");
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(99999999);
        $user->setIdentifiant("TUN-99999999");
        $user->setGrade("Deuxième Administrateur site web");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $user->setDelegation($delegation);
        $niveauEtude = $manager->getRepository('MfpeReferencielBundle:RefNiveauEtude')->findOneBy(array("intituleFr" => "Baccalauréat + année universitaire"));
        $user->setNiveauEtude($niveauEtude);
        //$user->setUniteRegionale();
        $user->setCreatedAt(new \DateTime());

        //$user->setUserRoles($roleInsert);
        $manager->persist($user);
        $manager->flush();


        //insert user ROLE_CITOYEN
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_CITOYEN"));
        $user = New AppUser();
        $faker = Faker\Factory::create('ar_SA');
        $user->setNomAr("$faker->firstName");
        $user->setPrenomAr("$faker->lastName");
        $user->setUsername("TUN-11111111");
        $user->setNomFr("citoyen1");
        $user->setPrenomFr("citoyen1");
        $user->setEmail("citoyen1@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(11111111);
        $user->setIdentifiant("TUN-11111111");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $user->setDelegation($delegation);
        $niveauEtude = $manager->getRepository('MfpeReferencielBundle:RefNiveauEtude')->findOneBy(array("intituleFr" => "Baccalauréat + année universitaire"));
        $user->setNiveauEtude($niveauEtude);
        //$user->setUniteRegionale();
        $user->setCreatedAt(new \DateTime());

        //$user->setUserRoles($roleInsert);
        $manager->persist($user);
        $manager->flush();

        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_CITOYEN"));
        $nbDigits = $faker->randomNumber($nbDigits = 8, $strict = true);
        $user = New AppUser();
        $faker = Faker\Factory::create('ar_SA');
        $user->setNomAr("$faker->firstName");
        $user->setPrenomAr("$faker->lastName");
        $user->setUsername("TUN-11111112");
        $user->setNomFr("citoyen2");
        $user->setPrenomFr("citoyen2");
        $user->setEmail("citoyen2@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(11111112);
        $user->setIdentifiant("TUN-11111112");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Foussana"));
        $user->setDelegation($delegation);
        $niveauEtude = $manager->getRepository('MfpeReferencielBundle:RefNiveauEtude')->findOneBy(array("intituleFr" => "Baccalauréat + année universitaire"));
        $user->setNiveauEtude($niveauEtude);
        //$user->setUniteRegionale();
        $user->setCreatedAt(new \DateTime());

        //$user->setUserRoles($roleInsert);
        $manager->persist($user);
        $manager->flush();


        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_CITOYEN"));
        $user = New AppUser();
        $faker = Faker\Factory::create('ar_SA');
        $user->setNomAr("$faker->firstName");
        $user->setPrenomAr("$faker->lastName");
        $user->setUsername("TUN-11111113");
        $user->setNomFr("citoyen3");
        $user->setPrenomFr("citoyen3");
        $user->setEmail("citoyen3@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(11111113);
        $user->setIdentifiant("TUN-11111113");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tozeur"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Nefta"));
        $user->setDelegation($delegation);
        $niveauEtude = $manager->getRepository('MfpeReferencielBundle:RefNiveauEtude')->findOneBy(array("intituleFr" => "Baccalauréat + année universitaire"));
        $user->setNiveauEtude($niveauEtude);
        //$user->setUniteRegionale();
        $user->setCreatedAt(new \DateTime());

        //$user->setUserRoles($roleInsert);
        $manager->persist($user);
        $manager->flush();

        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_CITOYEN"));
        $user = New AppUser();
        $faker = Faker\Factory::create('ar_SA');
        $user->setNomAr("$faker->firstName");
        $user->setPrenomAr("$faker->lastName");
        $user->setUsername("TUN-11111114");
        $user->setNomFr("citoyen4");
        $user->setPrenomFr("citoyen4");
        $user->setEmail("citoyen4@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(11111114);
        $user->setIdentifiant("TUN-11111114");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Mahrès"));
        $user->setDelegation($delegation);
        $niveauEtude = $manager->getRepository('MfpeReferencielBundle:RefNiveauEtude')->findOneBy(array("intituleFr" => "Baccalauréat + année universitaire"));
        $user->setNiveauEtude($niveauEtude);
        //$user->setUniteRegionale();
        $user->setCreatedAt(new \DateTime());

        $manager->persist($user);
        $manager->flush();


        //ROLE_AGENT_DR1
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_DR1"));
        $user = New AppUser();
        $user->setNomAr("agent1");
        $user->setPrenomAr("agent1");
        $user->setUsername("agent1@gmail.com");
        $user->setNomFr("agent1");
        $user->setPrenomFr("agent1");
        $user->setEmail("agent1@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(22222221);
        $user->setIdentifiant("TUN-22222221");
        $user->setGrade("Agent de guichet et relation avec client");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $user->setDelegation($delegation);
        $uniteRegionale = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT1"));
        $user->setUniteRegionale($uniteRegionale);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Direction regionale"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => $role->getRole()));
        $user->setFonction($fonction);
        $user->setCreatedAt(new \DateTime());

        $manager->persist($user);
        $manager->flush();

        //ROLE_AGENT_DR2
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_DR2"));
        $user = New AppUser();
        $user->setNomAr("agent2");
        $user->setPrenomAr("agent2");
        $user->setUsername("agent2@gmail.com");
        $user->setNomFr("agent2");
        $user->setPrenomFr("agent2");
        $user->setEmail("agent2@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(22222222);
        $user->setIdentifiant("TUN-22222222");
        $user->setGrade("Agent de guichet et relation avec client");
        $user->setTel("+21655555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $user->setDelegation($delegation);
        $uniteRegionale = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT1"));
        $user->setUniteRegionale($uniteRegionale);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Direction regionale"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => $role->getRole()));
        $user->setFonction($fonction);
        $user->setCreatedAt(new \DateTime());

        $manager->persist($user);
        $manager->flush();

        //ROLE_AGENT_DR3
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_DR3"));
        $user = New AppUser();
        $user->setNomAr("agent3");
        $user->setPrenomAr("agent3");
        $user->setUsername("agent3@gmail.com");
        $user->setNomFr("agent3");
        $user->setPrenomFr("agent3");
        $user->setEmail("agent3@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(22222223);
        $user->setIdentifiant("TUN-22222223");
        $user->setGrade("Agent de guichet et relation avec client");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $user->setDelegation($delegation);
        $uniteRegionale = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT1"));
        $user->setUniteRegionale($uniteRegionale);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Direction regionale"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => $role->getRole()));
        $user->setFonction($fonction);
        $user->setCreatedAt(new \DateTime());

        $manager->persist($user);
        $manager->flush();

        //ROLE_AGENT_DR3
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_DR4"));
        $user = New AppUser();
        $user->setNomAr("agent4");
        $user->setPrenomAr("agent4");
        $user->setUsername("agent4@gmail.com");
        $user->setNomFr("agent4");
        $user->setPrenomFr("agent4");
        $user->setEmail("agent4@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(22222224);
        $user->setIdentifiant("TUN-22222224");
        $user->setGrade("Agent de guichet et relation avec client");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $user->setDelegation($delegation);
        $uniteRegionale = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT1"));
        $user->setUniteRegionale($uniteRegionale);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Direction regionale"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => $role->getRole()));
        $user->setFonction($fonction);
        $user->setCreatedAt(new \DateTime());

        $manager->persist($user);
        $manager->flush();

        //ROLE_AGENT_DR1
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_DR1"));
        $user = New AppUser();
        $user->setNomAr("agent5");
        $user->setPrenomAr("agent5");
        $user->setUsername("agent5@gmail.com");
        $user->setNomFr("agent5");
        $user->setPrenomFr("agent5");
        $user->setEmail("agent5@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(33333335);
        $user->setIdentifiant("TUN-33333335");
        $user->setGrade("Agent de guichet et relation avec client");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Foussana"));
        $user->setDelegation($delegation);
        $uniteRegionale = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT2"));
        $user->setUniteRegionale($uniteRegionale);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Direction regionale"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => $role->getRole()));
        $user->setFonction($fonction);
        $user->setCreatedAt(new \DateTime());

        $manager->persist($user);
        $manager->flush();

        //ROLE_AGENT_DR2
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_DR2"));
        $user = New AppUser();
        $user->setNomAr("agent6");
        $user->setPrenomAr("agent6");
        $user->setUsername("agent6@gmail.com");
        $user->setNomFr("agent6");
        $user->setPrenomFr("agent6");
        $user->setEmail("agent6@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(33333336);
        $user->setIdentifiant("TUN-33333336");
        $user->setGrade("Agent de guichet et relation avec client");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Foussana"));
        $user->setDelegation($delegation);
        $uniteRegionale = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT2"));
        $user->setUniteRegionale($uniteRegionale);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Direction regionale"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => $role->getRole()));
        $user->setFonction($fonction);
        $user->setCreatedAt(new \DateTime());

        $manager->persist($user);
        $manager->flush();

        //ROLE_AGENT_DR3
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_DR3"));
        $user = New AppUser();
        $user->setNomAr("agent7");
        $user->setPrenomAr("agent7");
        $user->setUsername("agent7@gmail.com");
        $user->setNomFr("agent7");
        $user->setPrenomFr("agent7");
        $user->setEmail("agent7@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(33333337);
        $user->setIdentifiant("TUN-33333337");
        $user->setGrade("Agent de guichet et relation avec client");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Foussana"));
        $user->setDelegation($delegation);
        $uniteRegionale = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT2"));
        $user->setUniteRegionale($uniteRegionale);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Direction regionale"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => $role->getRole()));
        $user->setFonction($fonction);
        $user->setCreatedAt(new \DateTime());

        $manager->persist($user);
        $manager->flush();

        //ROLE_AGENT_DR4
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_DR4"));
        $user = New AppUser();
        $user->setNomAr("agent8");
        $user->setPrenomAr("agent8");
        $user->setUsername("agent8@gmail.com");
        $user->setNomFr("agent8");
        $user->setPrenomFr("agent8");
        $user->setEmail("agent8@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(33333338);
        $user->setIdentifiant("TUN-33333338");
        $user->setGrade("Agent de guichet et relation avec client");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Foussana"));
        $user->setDelegation($delegation);
        $uniteRegionale = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT2"));
        $user->setUniteRegionale($uniteRegionale);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Direction regionale"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => $role->getRole()));
        $user->setFonction($fonction);
        $user->setCreatedAt(new \DateTime());

        $manager->persist($user);
        $manager->flush();


        //ROLE_DIRECTEUR_DR
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_DIRECTEUR_DR"));
        $user = New AppUser();
        $user->setNomAr("directeur1");
        $user->setPrenomAr("directeur1");
        $user->setUsername("directeur1@gmail.com");
        $user->setNomFr("directeur1");
        $user->setPrenomFr("directeur1");
        $user->setEmail("directeur1@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(44444441);
        $user->setIdentifiant("TUN-44444441");
        $user->setGrade("Directeur général unité régionale");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $user->setDelegation($delegation);
        $uniteRegionale = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT1"));
        $user->setUniteRegionale($uniteRegionale);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Direction regionale"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => $role->getRole()));
        $user->setFonction($fonction);
        $user->setCreatedAt(new \DateTime());

        $manager->persist($user);
        $manager->flush();

        //ROLE_DIRECTEUR_DR
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_DIRECTEUR_DR"));
        $user = New AppUser();
        $user->setNomAr("directeur2");
        $user->setPrenomAr("directeur2");
        $user->setUsername("directeur2@gmail.com");
        $user->setNomFr("directeur2");
        $user->setPrenomFr("directeur2");
        $user->setEmail("directeur2@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(44444442);
        $user->setIdentifiant("TUN-44444442");
        $user->setGrade("Directeur général unité régionale");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Kasserine"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Sbeïtla"));
        $user->setDelegation($delegation);
        $uniteRegionale = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT2"));
        $user->setUniteRegionale($uniteRegionale);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Direction regionale"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => $role->getRole()));
        $user->setFonction($fonction);
        $user->setCreatedAt(new \DateTime());

        $manager->persist($user);
        $manager->flush();

        //ROLE_DIRECTEUR_DR
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_DIRECTEUR_DR"));
        $user = New AppUser();
        $user->setNomAr("directeur3");
        $user->setPrenomAr("directeur3");
        $user->setUsername("directeur3@gmail.com");
        $user->setNomFr("directeur3");
        $user->setPrenomFr("directeur3");
        $user->setEmail("directeur3@gmail.com");
        $user->setPassword(99999999);
        $user->setPlainPassword(99999999);
        $user->setPasswordPrint(99999999);
        $user->setUserRoles(array($role));
        $user->setEnable(true);
        $user->setSexe("homme");
        $user->setDateNaissance(new \DateTime("05-05-1990"));
        $user->setNumCin(44444443);
        $user->setIdentifiant("TUN-44444443");
        $user->setGrade("Directeur général unité régionale");
        $user->setTel("+216 55555555");
        $user->setDateDelivranceCin(new \DateTime());
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $user->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Mahrès"));
        $user->setDelegation($delegation);
        $uniteRegionale = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT3"));
        $user->setUniteRegionale($uniteRegionale);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Direction regionale"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => $role->getRole()));
        $user->setFonction($fonction);
        $user->setCreatedAt(new \DateTime());

        $manager->persist($user);
        $manager->flush();
    }


}