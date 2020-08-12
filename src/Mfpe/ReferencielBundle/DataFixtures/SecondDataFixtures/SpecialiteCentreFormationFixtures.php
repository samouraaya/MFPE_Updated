<?php

namespace Mfpe\ReferencielBundle\DataFixtures\SecondDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

//Entity
use Mfpe\ConfigBundle\Entity\Role;
use Mfpe\ConfigBundle\Entity\AppUser;
use Mfpe\CentreFormationBundle\Entity\Specialite;
use Mfpe\CentreFormationBundle\Entity\CentreFormation;


class SpecialiteCentreFormationFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /****************************** Insert Role ROLE_AGENT_CENTRE_FORMATION ******************************/
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array('role' => "ROLE_AGENT_CENTRE_FORMATION"));
        if (!is_object($role)) {
            $role = New Role();
            $role->setRole("ROLE_AGENT_CENTRE_FORMATION");
            $role->setIntituleAr("دور وكيل مركز تكوين مهني");
            $role->setIntituleFr("Role agent centre formation");
            $role->setFrontInterfaces(array("informations", "demands", "consultDemands", "editique", "dashboard", "ficheDescriptive", "nomenclatures", "trainingCenterList", "specialities", "disconnect"));
            $role->setStatus(array("SCAN_OK", "PAIEMENT_OK", "PV_REFUSE", "RE_DATE_EXAM_OK", "DATE_EXAM_OK"));
            $role->setStateExecute(array("REFUS_CENTRE", "ATTENTE_PAIEMENT", "DATE_EXAM_OK", "RE_DATE_EXAM_OK", "PV_UPLOAD"));
            $role->setEditable(false);
            $role->setCreatedAt(new \DateTime());
            $manager->persist($role);
            $manager->flush();
        }
        /****************************** Insert data Specialite ******************************/
        //specialite1
        $specialite = New Specialite();
        $specialite->setIntituleAr("مخابز و حلويات");
        $specialite->setIntituleFr(" Boulangerie-Pâtisserie");
        $specialite->setCodeSpecialite("BLG");
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $specialite->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Fabrication de produits de boulangerie-pâtisserie et de pâtes alimentaires"));
        $specialite->setSousSecteur($sousSecteur);
        $niveauDiplome = $manager->getRepository('MfpeReferencielBundle:RefNiveauDiplome')->findOneBy(array("intituleFr" => "Technicien"));
        $specialite->setNiveauDiplome($niveauDiplome);
        $niveauEtude = $manager->getRepository('MfpeReferencielBundle:RefNiveauEtude')->findOneBy(array("intituleFr" => "9ème année de base"));
        $specialite->setNatureFormation($niveauEtude);
        $specialite->setFraisSpecialiteExam("250");
        $specialite->setEnable(true);
        $specialite->setType(true);
        $specialite->setCreatedAt(new \DateTime());
        $manager->persist($specialite);

        //specialite2
        $specialite = New Specialite();
        $specialite->setIntituleAr("ميكانيك السيارات");
        $specialite->setIntituleFr("Mécanique AUTO");
        $specialite->setCodeSpecialite("MEC-AUTO");
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $specialite->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Transport routier"));
        $specialite->setSousSecteur($sousSecteur);
        $niveauDiplome = $manager->getRepository('MfpeReferencielBundle:RefNiveauDiplome')->findOneBy(array("intituleFr" => "Technicien"));
        $specialite->setNiveauDiplome($niveauDiplome);
        $niveauEtude = $manager->getRepository('MfpeReferencielBundle:RefNiveauEtude')->findOneBy(array("intituleFr" => "9ème année de base"));
        $specialite->setNatureFormation($niveauEtude);
        $specialite->setFraisSpecialiteExam("300");
        $specialite->setEnable(true);
        $specialite->setType(true);
        $specialite->setCreatedAt(new \DateTime());
        $manager->persist($specialite);

        //specialite3
        $specialite = New Specialite();
        $specialite->setIntituleAr("الأشجار  المثمرة والزراعات السقوية");
        $specialite->setIntituleFr("Arbres fruitiers et de l'agriculture irriguée");
        $specialite->setCodeSpecialite("AFAI");
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $specialite->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Fabrication de produits de boulangerie-pâtisserie et de pâtes alimentaires"));
        $specialite->setSousSecteur($sousSecteur);
        $niveauDiplome = $manager->getRepository('MfpeReferencielBundle:RefNiveauDiplome')->findOneBy(array("intituleFr" => "Technicien"));
        $specialite->setNiveauDiplome($niveauDiplome);
        $niveauEtude = $manager->getRepository('MfpeReferencielBundle:RefNiveauEtude')->findOneBy(array("intituleFr" => "9ème année de base"));
        $specialite->setNatureFormation($niveauEtude);
        $specialite->setFraisSpecialiteExam("500");
        $specialite->setEnable(true);
        $specialite->setType(true);
        $specialite->setCreatedAt(new \DateTime());
        $manager->persist($specialite);

        //specialite4
        $specialite = New Specialite();
        $specialite->setIntituleAr("سوق المال");
        $specialite->setIntituleFr("Bourse ");
        $specialite->setCodeSpecialite("Bourse");
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Banque et Assurance"));
        $specialite->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Intermédiaire en bourse"));
        $specialite->setSousSecteur($sousSecteur);
        $niveauDiplome = $manager->getRepository('MfpeReferencielBundle:RefNiveauDiplome')->findOneBy(array("intituleFr" => "Technicien"));
        $specialite->setNiveauDiplome($niveauDiplome);
        $niveauEtude = $manager->getRepository('MfpeReferencielBundle:RefNiveauEtude')->findOneBy(array("intituleFr" => "9ème année de base"));
        $specialite->setNatureFormation($niveauEtude);
        $specialite->setFraisSpecialiteExam("350");
        $specialite->setEnable(true);
        $specialite->setType(false);
        $specialite->setCreatedAt(new \DateTime());
        $manager->persist($specialite);
        $manager->flush();

        //specialite5
        $specialite = New Specialite();
        $specialite->setIntituleAr("البنوك والتمويل");
        $specialite->setIntituleFr("Banque et Assurance ");
        $specialite->setCodeSpecialite("BA");
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $specialite->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Transport routier"));
        $specialite->setSousSecteur($sousSecteur);
        $niveauDiplome = $manager->getRepository('MfpeReferencielBundle:RefNiveauDiplome')->findOneBy(array("intituleFr" => "Technicien"));
        $specialite->setNiveauDiplome($niveauDiplome);
        $niveauEtude = $manager->getRepository('MfpeReferencielBundle:RefNiveauEtude')->findOneBy(array("intituleFr" => "9ème année de base"));
        $specialite->setNatureFormation($niveauEtude);
        $specialite->setFraisSpecialiteExam("320");
        $specialite->setEnable(true);
        $specialite->setType(true);
        $specialite->setCreatedAt(new \DateTime());
        $manager->persist($specialite);
        $manager->flush();

        //specialite6
        $specialite = New Specialite();
        $specialite->setIntituleAr("النقل والخدمات اللوجستية");
        $specialite->setIntituleFr("Logistique de transport ");
        $specialite->setCodeSpecialite("LDT");
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $specialite->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Transport routier"));
        $specialite->setSousSecteur($sousSecteur);
        $niveauDiplome = $manager->getRepository('MfpeReferencielBundle:RefNiveauDiplome')->findOneBy(array("intituleFr" => "Technicien"));
        $specialite->setNiveauDiplome($niveauDiplome);
        $niveauEtude = $manager->getRepository('MfpeReferencielBundle:RefNiveauEtude')->findOneBy(array("intituleFr" => "9ème année de base"));
        $specialite->setNatureFormation($niveauEtude);
        $specialite->setFraisSpecialiteExam("270");
        $specialite->setEnable(true);
        $specialite->setType(true);
        $specialite->setCreatedAt(new \DateTime());
        $manager->persist($specialite);
        $manager->flush();
        /****************************** Insert data CentreFormation && user ******************************/
        //Centre formation 1
        $centreFormation = New CentreFormation();
        $centreFormation->setIntituleAr("المهنية الزراعية");
        $centreFormation->setIntituleFr("Pro Argricole");
        $centreFormation->setAdresse("Kasserine-Sbeitla");
        $centreFormation->setTel("00216 79779490");
        $centreFormation->setFax("00216 79779490");
        $centreFormation->setEmail("centre1@gmail.com");
        $centreFormation->setNomDirecteurAr("وسيم نوارة");
        $centreFormation->setNomDirecteurFr("Wassim Nawara");
        $centreFormation->setAnneeCreation(1990);
        $centreFormation->setCapaciteAccueil(500);
        $centreFormation->setNombreFormateur(15);
        $centreFormation->setNombreCadreAdministratif(20);
        $centreFormation->setCapaciteHebergement(350);
        $centreFormation->setCapaciteRestaurant(500);
        $centreFormation->setOrganisme("ATFP");
        $centreFormation->setType(1);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $centreFormation->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Mahrès"));
        $centreFormation->setDelegation($delegation);
        $centreFormation->setEnable(true);
        $specialites = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findByType(true);
        foreach ($specialites as $specialite) {
            if ($specialite instanceof Specialite) {
                $centreFormation->addSpecialiteCenter($specialite);
            }
        }
        $centreFormation->setCreatedAt(new \DateTime());
        $user = new AppUser();
        $user->setNomFr("Pro Argricole");
        $user->setNomAr("المهنية الزراعية");
        $user->setPrenomFr("Wassim Nawara");
        $user->setPrenomAr("وسيم نوارة");
        $user->setTel("+216 79779490");
        $user->setCentreFormation($centreFormation);
        $user->setEmail("centre1@gmail.com");
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_CENTRE_FORMATION"));
        $user->setUserRoles(array($role));
        $user->setPlainPassword("P@ssw0rd");
        $user->setPasswordPrint("P@ssw0rd");
        $user->setUsername("centre1@gmail.com");
        $user->setIdentifiant("TN-".uniqid());
        $user->setEnable(true);
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Centre de formation"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => "ROLE_AGENT_CENTRE_FORMATION"));
        $user->setFonction($fonction);
        $manager->persist($centreFormation);
        $manager->persist($user);

        //Centre formation 2
        $centreFormation = New CentreFormation();
        $centreFormation->setIntituleAr("المهنية في المخابز والحلويات");
        $centreFormation->setIntituleFr("Professionnel Boulangerie & Patisserie");
        $centreFormation->setAdresse("Tunis-Bab-El-Bhar");
        $centreFormation->setTel("+216 98888888");
        $centreFormation->setFax("+216 98888888");
        $centreFormation->setEmail("centre2@gmail.com");
        $centreFormation->setNomDirecteurAr("أيمن بن صالح");
        $centreFormation->setNomDirecteurFr("Aymen Ben Salih");
        $centreFormation->setAnneeCreation(1990);
        $centreFormation->setCapaciteAccueil(500);
        $centreFormation->setNombreFormateur(15);
        $centreFormation->setNombreCadreAdministratif(20);
        $centreFormation->setCapaciteHebergement(350);
        $centreFormation->setCapaciteRestaurant(500);
        $centreFormation->setOrganisme("AVFA");
        $centreFormation->setType(2);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $centreFormation->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Mahrès"));
        $centreFormation->setDelegation($delegation);
        $centreFormation->setEnable(true);
        $specialites = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findByType(false);
        foreach ($specialites as $specialite) {
            if ($specialite instanceof Specialite) {
                $centreFormation->addSpecialiteCenter($specialite);
            }
        }
        $centreFormation->setCreatedAt(new \DateTime());
        $user = new AppUser();
        $user->setNomAr("المهنية في المخابز والحلويات");
        $user->setNomFr("Pro Boulangerie & Patisserie");
        $user->setPrenomAr("أيمن بن صالح");
        $user->setPrenomFr("Aymen Ben Salih");
        $user->setTel("00216 98888888");
        $user->setEmail("centre2@gmail.com");
        $user->setCentreFormation($centreFormation);
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_CENTRE_FORMATION"));
        $user->setUserRoles(array($role));
        $user->setPlainPassword("P@ssw0rd");
        $user->setPasswordPrint("P@ssw0rd");
        $user->setUsername("centre2@gmail.com");
        $user->setIdentifiant("TN-".uniqid());
        $user->setEnable(true);
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Centre de formation"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => "ROLE_AGENT_CENTRE_FORMATION"));
        $user->setFonction($fonction);
        $manager->persist($centreFormation);
        $manager->persist($user);


        //Centre formation 3
        $centreFormation = New CentreFormation();
        $centreFormation->setIntituleAr("المهنية في الميكانيك");
        $centreFormation->setIntituleFr("Pro Mécanique");
        $centreFormation->setAdresse("Sfax-Mahrès");
        $centreFormation->setTel("00216 71555555");
        $centreFormation->setFax("00216 71555555");
        $centreFormation->setEmail("centre3@gmail.com");
        $centreFormation->setNomDirecteurAr("محمد بن علي");
        $centreFormation->setNomDirecteurFr("Mohamed Ben Ali");
        $centreFormation->setAnneeCreation(1990);
        $centreFormation->setCapaciteAccueil(500);
        $centreFormation->setNumeroEnregistrement(123456789);
        $centreFormation->setNombreFormateur(15);
        $centreFormation->setNombreCadreAdministratif(20);
        $centreFormation->setCapaciteHebergement(350);
        $centreFormation->setCapaciteRestaurant(500);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $centreFormation->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $centreFormation->setDelegation($delegation);
        $centreFormation->setEnable(true);
        $centreFormation->setType(3);
        $specialites = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findByType(false);
        foreach ($specialites as $specialite) {
            if ($specialite instanceof Specialite) {
                $centreFormation->addSpecialiteCenter($specialite);
            }
        }
        $centreFormation->setCreatedAt(new \DateTime());
        $user = new AppUser();
        $user->setNomFr("المهنية في الميكانيك");
        $user->setNomAr("Pro Mécanique");
        $user->setPrenomAr("محمد بن علي");
        $user->setPrenomFr("Mohamed Ben Ali");
        $user->setTel("+216 71555555");
        $user->setGouvernorat($gouvernorat);
        $user->setDelegation($delegation);
        $user->setEmail("centre3@gmail.com");
        $user->setCentreFormation($centreFormation);
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_CENTRE_FORMATION"));
        $user->setUserRoles(array($role));
        $user->setPlainPassword("P@ssw0rd");
        $user->setPasswordPrint("P@ssw0rd");
        $user->setUsername("centre3@gmail.com");
        $user->setIdentifiant("TN-".uniqid());
        $user->setEnable(true);
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Centre de formation"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => "ROLE_AGENT_CENTRE_FORMATION"));
        $user->setFonction($fonction);
        $manager->persist($centreFormation);
        $manager->persist($user);

        //Centre formation 4
        $centreFormation = New CentreFormation();
        $centreFormation->setIntituleAr("المهنية في سوق المال");
        $centreFormation->setIntituleFr("Pro Bourse");
        $centreFormation->setAdresse("Tunis-Carthage");
        $centreFormation->setTel("00216 71555555");
        $centreFormation->setFax("00216 71555555");
        $centreFormation->setEmail("centre4@gmail.com");
        $centreFormation->setNomDirecteurAr("أنيس شريف");
        $centreFormation->setNomDirecteurFr("Anis Cherif");
        $centreFormation->setAnneeCreation(1990);
        $centreFormation->setCapaciteAccueil(700);
        $centreFormation->setNombreFormateur(20);
        $centreFormation->setNombreCadreAdministratif(20);
        $centreFormation->setCapaciteHebergement(350);
        $centreFormation->setCapaciteRestaurant(500);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $centreFormation->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Mahrès"));
        $centreFormation->setDelegation($delegation);
        $centreFormation->setOrganisme("ONTT");
        $centreFormation->setEnable(true);
        $centreFormation->setType(2);
        $specialites = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findByType(false);
        foreach ($specialites as $specialite) {
            if ($specialite instanceof Specialite) {
                $centreFormation->addSpecialiteCenter($specialite);
            }
        }
        $centreFormation->setCreatedAt(new \DateTime());
        $user = new AppUser();
        $user->setNomFr("المهنية في سوق المال");
        $user->setNomAr("Pro Bourse");
        $user->setPrenomAr("أنيس شريف");
        $user->setPrenomFr("Anis Cherif");
        $user->setTel("+216 71555555");
        $user->setEmail("centre4@gmail.com");
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_CENTRE_FORMATION"));
        $user->setUserRoles(array($role));
        $user->setPlainPassword("P@ssw0rd");
        $user->setPasswordPrint("P@ssw0rd");
        $user->setUsername("centre4@gmail.com");
        $user->setCentreFormation($centreFormation);
        $user->setIdentifiant("TN-".uniqid());
        $user->setEnable(true);
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Centre de formation"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => "ROLE_AGENT_CENTRE_FORMATION"));
        $user->setFonction($fonction);
        $manager->persist($centreFormation);
        $manager->persist($user);

        //Centre formation 5
        $centreFormation = New CentreFormation();
        $centreFormation->setIntituleAr("المهنية في البنوك والتمويل");
        $centreFormation->setIntituleFr("Pro Banque et Assurance");
        $centreFormation->setAdresse("Tunis-Carthage");
        $centreFormation->setTel("00216 71555555");
        $centreFormation->setFax("00216 71555555");
        $centreFormation->setEmail("centre5@gmail.com");
        $centreFormation->setNomDirecteurAr("محمد بن محمد");
        $centreFormation->setNomDirecteurFr("Mohamed Ben Mohamed");
        $centreFormation->setAnneeCreation(2000);
        $centreFormation->setCapaciteAccueil(400);
        $centreFormation->setNumeroEnregistrement(125556789);
        $centreFormation->setNombreFormateur(10);
        $centreFormation->setNombreCadreAdministratif(9);
        $centreFormation->setCapaciteHebergement(350);
        $centreFormation->setCapaciteRestaurant(500);
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $centreFormation->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $centreFormation->setDelegation($delegation);
        $centreFormation->setEnable(true);
        $centreFormation->setType(3);
        $specialites = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findByType(false);
        foreach ($specialites as $specialite) {
            if ($specialite instanceof Specialite) {
                $centreFormation->addSpecialiteCenter($specialite);
            }
        }
        $centreFormation->setCreatedAt(new \DateTime());
        $user = new AppUser();
        $user->setNomFr("المهنية في البنوك والتمويل");
        $user->setNomAr("Pro Banque et Assurance");
        $user->setPrenomAr("محمد بن محمد");
        $user->setPrenomFr("Mohamed Ben Mohamed");
        $user->setTel("+216 71555555");
        $user->setGouvernorat($gouvernorat);
        $user->setDelegation($delegation);
        $user->setEmail("centre5@gmail.com");
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_CENTRE_FORMATION"));
        $user->setUserRoles(array($role));
        $user->setPlainPassword("P@ssw0rd");
        $user->setPasswordPrint("P@ssw0rd");
        $user->setUsername("centre5@gmail.com");
        $user->setCentreFormation($centreFormation);
        $user->setIdentifiant("TN-".uniqid());
        $user->setEnable(true);
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Centre de formation"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => "ROLE_AGENT_CENTRE_FORMATION"));
        $user->setFonction($fonction);
        $manager->persist($centreFormation);
        $manager->persist($user);

        //Centre formation 6
        $centreFormation = New CentreFormation();
        $centreFormation->setIntituleAr("المهنية في النقل والخدمات اللوجستية");
        $centreFormation->setIntituleFr("Pro Logistique de transport");
        $centreFormation->setAdresse("Sfax-Mahrès");
        $centreFormation->setTel("00216 71555555");
        $centreFormation->setFax("00216 71555555");
        $centreFormation->setEmail("centre6@gmail.com");
        $centreFormation->setNomDirecteurAr("محمد بن علي");
        $centreFormation->setNomDirecteurFr("Mohamed Ben Ali");
        $centreFormation->setAnneeCreation(2000);
        $centreFormation->setCapaciteAccueil(400);
        $centreFormation->setNombreFormateur(10);
        $centreFormation->setNombreCadreAdministratif(9);
        $centreFormation->setCapaciteHebergement(350);
        $centreFormation->setCapaciteRestaurant(500);
        $centreFormation->setOrganisme("ONTT");
        $gouvernorat = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Sfax"));
        $centreFormation->setGouvernorat($gouvernorat);
        $delegation = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Mahrès"));
        $centreFormation->setDelegation($delegation);
        $centreFormation->setEnable(true);
        $centreFormation->setType(1);
        $specialites = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findByType(true);
        foreach ($specialites as $specialite) {
            if ($specialite instanceof Specialite) {
                $centreFormation->addSpecialiteCenter($specialite);
            }
        }
        $centreFormation->setCreatedAt(new \DateTime());
        $user = new AppUser();
        $user->setNomFr("المهنية في النقل والخدمات اللوجستية");
        $user->setNomAr("Pro Logistique de transport");
        $user->setPrenomAr("محمد بن علي");
        $user->setPrenomFr("Mohamed Ben Ali");
        $user->setTel("+216 71555555");
        $user->setEmail("centre6@gmail.com");
        $user->setCentreFormation($centreFormation);
        $role = $manager->getRepository('MfpeConfigBundle:Role')->findOneBy(array("role" => "ROLE_AGENT_CENTRE_FORMATION"));
        $user->setUserRoles(array($role));
        $user->setPlainPassword("P@ssw0rd");
        $user->setPasswordPrint("P@ssw0rd");
        $user->setUsername("centre6@gmail.com");
        $user->setIdentifiant("TN-".uniqid());
        $user->setEnable(true);
        $nationalite = $manager->getRepository('MfpeReferencielBundle:RefNationalite')->findOneBy(array("intituleFr" => "Tunisienne"));
        $user->setNationalite($nationalite);
        $structure = $manager->getRepository('MfpeReferencielBundle:RefStructure')->findOneBy(array("intituleFr" => "Centre de formation"));
        $user->setStructure($structure);
        $fonction = $manager->getRepository('MfpeReferencielBundle:RefFonction')->findOneBy(array("intituleFr" => "ROLE_AGENT_CENTRE_FORMATION"));
        $user->setFonction($fonction);
        $manager->persist($centreFormation);
        $manager->persist($user);

        $manager->flush();
    }

}