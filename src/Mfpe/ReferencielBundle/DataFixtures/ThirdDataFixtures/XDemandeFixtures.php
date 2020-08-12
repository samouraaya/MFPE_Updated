<?php

namespace Mfpe\ReferencielBundle\DataFixtures\ThirdDataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;
//Entity
use Mfpe\ConfigBundle\Entity\Role;
use Mfpe\ConfigBundle\Entity\AppUser;
use Mfpe\AttestationBundle\Entity\ApplicationHistory;
use Mfpe\AttestationBundle\Entity\DateExam;
use Mfpe\AttestationBundle\Entity\Demande;

class XDemandeFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');
        // nouvelle demande

        $demande = new Demande();
        $user = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "citoyen1@gmail.com"));
        $demande->setUser($user);
        $cf = $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("adresse" => "Tunis-Bab-El-Bhar"));
        $demande->setCentreFormation($cf);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $demande->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Fabrication de produits laitiers"));
        $demande->setSousSecteur($sousSecteur);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $demande->setGouvernorat($gouv);
        $dele = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Bab-El-Bhar"));
        $demande->setDelegation($dele);
        $demande->setGouvernoratProjet($gouv);
        $demande->setDelegationProjet($dele);
        $sepcialite = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findOneBy(array("intituleFr" => "Arbres fruitiers et de l'agriculture irriguée"));
        $demande->setSpecialite($sepcialite);
        $unite = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT1"));
        $demande->setUniteRegionale($unite);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "DATE_EXAM_OK"));
        $demande->setCurrentStatut($statut);
        $demande->setSpecialiteCitoyen("agriculture");
        $demande->setAttestationFormation("0");
        $demande->setNomEmployeur("citoyen1");
        $demande->setProjet("1");
        $demande->setAdresseProjet("beja");
        $demande->setAdresseResidenceActuelle("manar 2 ");
        $demande->setAdresseEntreprise("lac 2");
        $demande->setCode("TN-11/2020/1");
        $demande->setCodeConvocation("TN-11/2020/1");
        $demande->setIdentifiant("TN-11/2020/1");
        $demande->setAccessAttestation("0");
        $demande->setUniteRegionaleGouvernoratProjet("0");
        $demande->setCreatedAt(new \DateTime('01-01-2020'));
        $demande->setUpdatedAt(new \DateTime('30-01-2020'));
        $demande->setJustificatifExperience("ATTESTATION_TRAVAIL");
        $manager->persist($demande);
        $manager->flush();

        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/1"));
        // ATTENT_DR
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_DR"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('01-01-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        //SPECIALITE_CHOISIE
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SPECIALITE_CHOISIE"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('03-01-2020'));
        $userCentre = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userCentre->getId());

        $manager->persist($history);
        $manager->flush();

        //scan ok
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SCAN_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('05-01-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        // CENTRE_OK
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "CENTRE_OK"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('06-01-2020'));
        $manager->persist($history);
        $manager->flush();

        //ATTENTE_PAIEMENT
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_PAIEMENT"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('07-01-2020'));
        $manager->persist($history);
        $manager->flush();

        // PAIEMENT_OK
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PAIEMENT_OK"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('08-01-2020'));
        $manager->persist($history);
        $manager->flush();

        // DATE_EXAM_OK
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "DATE_EXAM_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('09-01-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        $dateexam = new DateExam();
        $dateexam->setDemande($id);
        $dateexam->setDateExam(new \DateTime('29-05-2021'));
        $dateexam->setMaterial("calculatrice");
        $dateexam->setNbTimesNotPassExamen(0);
        $manager->persist($dateexam);
        $manager->flush();


        $demande = new Demande();
        $user = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "citoyen2@gmail.com"));
        $demande->setUser($user);
        $cf = $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("adresse" => "Sfax-Mahrès"));
        $demande->setCentreFormation($cf);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $demande->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Transport routier"));
        $demande->setSousSecteur($sousSecteur);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $demande->setGouvernorat($gouv);
        $dele = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $demande->setDelegation($dele);
        $demande->setGouvernoratProjet($gouv);
        $demande->setDelegationProjet($dele);
        $sepcialite = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findOneBy(array("intituleFr" => "Mécanique AUTO"));
        $demande->setSpecialite($sepcialite);
        $unite = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT1"));
        $demande->setUniteRegionale($unite);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "REFUSE_DR"));
        $demande->setCurrentStatut($statut);
        $demande->setSpecialiteCitoyen("Mécanique");
        $demande->setAttestationFormation("0");
        $demande->setNomEmployeur("citoyen2");
        $demande->setProjet("1");
        $demande->setAdresseProjet("monastir");
        $demande->setAdresseResidenceActuelle("Sousse");
        $demande->setAdresseEntreprise("Sousse");
        $demande->setCode("TN-11/2020/2");
        $demande->setCodeConvocation("TN-11/2020/2");
        $demande->setIdentifiant("TN-11/2020/2");
        $demande->setAccessAttestation("0");
        $demande->setUniteRegionaleGouvernoratProjet("0");
        $demande->setCreatedAt(new \DateTime('12-12-2019'));
        $demande->setUpdatedAt(new \DateTime('30-01-2020'));
        $demande->setJustificatifExperience("ATTESTATION_TRAVAIL");
        $motif = $manager->getRepository('MfpeReferencielBundle:RefMotif')->findOneBy(array("intituleFr" => "Manque de papiers nécessaires "));
        $demande->setMotif($motif);
        $manager->persist($demande);
        $manager->flush();

        //ATTENT_DR
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/2"));
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_DR"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('01-01-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        //SPECIALITE_CHOISIE
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SPECIALITE_CHOISIE"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('09-01-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        // Refus Dr
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "REFUSE_DR"));
        $history->setStatut($statut);
        $motif = $manager->getRepository('MfpeReferencielBundle:RefMotif')->findOneBy(array("intituleFr" => "Manque de papiers nécessaires "));
        $history->setMotif($motif);
        $history->setCreatedAt(new \DateTime('11-01-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        // nouvelle demande
        $demande = new Demande();
        $user = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "citoyen3@gmail.com"));
        $demande->setUser($user);
        $cf = $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("adresse" => "Tunis-Bab-El-Bhar"));
        $demande->setCentreFormation($cf);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $demande->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Fabrication de produits laitiers"));
        $demande->setSousSecteur($sousSecteur);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $demande->setGouvernorat($gouv);
        $dele = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Bab-El-Bhar"));
        $demande->setDelegation($dele);
        $demande->setGouvernoratProjet($gouv);
        $demande->setDelegationProjet($dele);
        $sepcialite = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findOneBy(array("intituleFr" => "Arbres fruitiers et de l'agriculture irriguée"));
        $demande->setSpecialite($sepcialite);
        $unite = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT1"));
        $demande->setUniteRegionale($unite);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "DATE_EXAM_OK"));
        $demande->setCurrentStatut($statut);
        $demande->setSpecialiteCitoyen("agriculture");
        $demande->setAttestationFormation("0");
        $demande->setNomEmployeur("citoyen3");
        $demande->setProjet("1");
        $demande->setAdresseProjet("kef");
        $demande->setAdresseResidenceActuelle("ariana ");
        $demande->setAdresseEntreprise("ariana");
        $demande->setCode("TN-11/2020/3");
        $demande->setCodeConvocation("TN-11/2020/3");
        $demande->setIdentifiant("TN-11/2020/3");
        $demande->setAccessAttestation("0");
        $demande->setUniteRegionaleGouvernoratProjet("0");
        $demande->setJustificatifExperience("ATTESTATION_TRAVAIL");
        $demande->setCreatedAt(new \DateTime('01-02-2020'));
        $demande->setUpdatedAt(new \DateTime('05-03-2020'));
        $manager->persist($demande);
        $manager->flush();

        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/3"));

        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_DR"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('05-02-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        //SPECIALITE_CHOISIE
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/3"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SPECIALITE_CHOISIE"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('06-02-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        //scan ok
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/3"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SCAN_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('07-02-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        // CENTRE_OK
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/3"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "CENTRE_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('08-02-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        //ATTENTE_PAIEMENT
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/3"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_PAIEMENT"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('09-02-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        // PAIEMENT_OK
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/3"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PAIEMENT_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('10-02-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        // DATE_EXAM_OK
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/3"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "DATE_EXAM_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('11-02-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        $dateexam = new DateExam();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/3"));
        $dateexam->setDemande($id);
        $dateexam->setDateExam(new \DateTime('29-05-2021'));
        $dateexam->setMaterial("calculatrice");
        $dateexam->setNbTimesNotPassExamen(0);
        $manager->persist($dateexam);
        $manager->flush();

        // nouvelle demande
        $demande = new Demande();
        $user = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "citoyen4@gmail.com"));
        $demande->setUser($user);
        $cf = $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("adresse" => "Tunis-Carthage"));
        $demande->setCentreFormation($cf);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $demande->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Transport routier"));
        $demande->setSousSecteur($sousSecteur);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $demande->setGouvernorat($gouv);
        $dele = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $demande->setDelegation($dele);
        $demande->setGouvernoratProjet($gouv);
        $demande->setDelegationProjet($dele);
        $sepcialite = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findOneBy(array("intituleFr" => "Banque et Assurance"));
        $demande->setSpecialite($sepcialite);
        $unite = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT3"));
        $demande->setUniteRegionale($unite);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PV_REFUSE"));
        $demande->setCurrentStatut($statut);
        $demande->setSpecialiteCitoyen("Commerce");
        $demande->setAttestationFormation("0");
        $demande->setNomEmployeur("citoyen4");
        $demande->setProjet("1");
        $demande->setAdresseProjet("sfax");
        $demande->setAdresseResidenceActuelle("ariana ");
        $demande->setAdresseEntreprise("ariana");
        $demande->setCode("TN-11/2020/4");
        $demande->setCodeConvocation("TN-11/2020/4");
        $demande->setIdentifiant("TN-11/2020/4");
        $demande->setAccessAttestation("0");
        $demande->setUniteRegionaleGouvernoratProjet("0");
        $demande->setJustificatifExperience("ATTESTATION_TRAVAIL");
        $motif = $manager->getRepository('MfpeReferencielBundle:RefMotif')->findOneBy(array("intituleFr" => "Procès-verbal (PV) non claire"));
        $demande->setMotif($motif);
        $demande->setCreatedAt(new \DateTime('01-12-2019'));
        $demande->setUpdatedAt(new \DateTime('30-01-2020'));
        $manager->persist($demande);
        $manager->flush();

        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/4"));

        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_DR"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('01-04-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        //SPECIALITE_CHOISIE
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/4"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SPECIALITE_CHOISIE"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('02-04-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        //scan ok
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/4"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SCAN_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('03-04-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        // CENTRE_OK
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/4"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "CENTRE_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('04-04-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        //ATTENTE_PAIEMENT
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/4"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_PAIEMENT"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('05-04-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        // PAIEMENT_OK
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/4"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PAIEMENT_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('06-04-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        // DATE_EXAM_OK
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/4"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "DATE_EXAM_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('07-04-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        $dateexam = new DateExam();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/4"));
        $dateexam->setDemande($id);
        $dateexam->setDateExam(new \DateTime('29-05-2021'));
        $dateexam->setMaterial("calculatrice");
        $dateexam->setNbTimesNotPassExamen(0);
        $manager->persist($dateexam);
        $manager->flush();

        // PV UPLOAD
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/4"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PV_UPLOAD"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('08-04-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $manager->persist($history);
        $manager->flush();

        // PV refus
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/4"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PV_UPLOAD"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('09-04-2020'));
        $userDR = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userDR->getId());
        $motif = $manager->getRepository('MfpeReferencielBundle:RefMotif')->findOneBy(array("intituleFr" => "Procès-verbal (PV) non claire"));
        $history->setMotif($motif);
        $manager->persist($history);
        $manager->flush();

        // nouvelle demande
        $demande = new Demande();
        $user = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "citoyen1@gmail.com"));
        $demande->setUser($user);
        $cf = $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("adresse" => "Tunis-Bab-El-Bhar"));
        $demande->setCentreFormation($cf);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $demande->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Fabrication de produits laitiers"));
        $demande->setSousSecteur($sousSecteur);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $demande->setGouvernorat($gouv);
        $dele = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Bab-El-Bhar"));
        $demande->setDelegation($dele);
        $demande->setGouvernoratProjet($gouv);
        $demande->setDelegationProjet($dele);
        $sepcialite = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findOneBy(array("intituleFr" => "Arbres fruitiers et de l'agriculture irriguée"));
        $demande->setSpecialite($sepcialite);
        $unite = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT2"));
        $demande->setUniteRegionale($unite);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTESTATION_OK"));
        $demande->setCurrentStatut($statut);
        $demande->setSpecialiteCitoyen("agriculture");
        $demande->setAttestationFormation("0");
        $demande->setNomEmployeur("citoyen1");
        $demande->setProjet("1");
        $demande->setAdresseProjet("beja");
        $demande->setAdresseResidenceActuelle("manar 2 ");
        $demande->setAdresseEntreprise("lac 2");
        $demande->setCode("TN-11/2020/5");
        $demande->setCodeConvocation("TN-11/2020/5");
        $demande->setIdentifiant("TN-11/2020/5");
        $demande->setAccessAttestation("0");
        $demande->setUniteRegionaleGouvernoratProjet("0");
        $demande->setCreatedAt(new \DateTime('01-04-2020'));
        $demande->setUpdatedAt(new \DateTime('06-04-2020'));
        $demande->setJustificatifExperience("ATTESTATION_TRAVAIL");
        $manager->persist($demande);
        $manager->flush();

        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/5"));

        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_DR"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('06-04-2020'));
        $manager->persist($history);
        $manager->flush();

        //SPECIALITE_CHOISIE
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SPECIALITE_CHOISIE"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('07-04-2020'));
        $manager->persist($history);
        $manager->flush();

        //scan ok
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SCAN_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('08-04-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        // CENTRE_OK
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "CENTRE_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('10-04-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        //ATTENTE_PAIEMENT
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_PAIEMENT"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('11-04-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        // PAIEMENT_OK
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PAIEMENT_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('12-04-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        // DATE_EXAM_OK
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "DATE_EXAM_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('13-04-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        $dateexam = new DateExam();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/5"));
        $dateexam->setDemande($id);
        $dateexam->setDateExam(new \DateTime('29-12-2020'));
        $dateexam->setMaterial("calculatrice");
        $dateexam->setNbTimesNotPassExamen(0);
        $manager->persist($dateexam);
        $manager->flush();


        // PV UPLOAD
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PV_UPLOAD"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('14-04-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        //PV accepte
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PV_ACCEPTE"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('15-04-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        // attestation OK
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTESTATION_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('16-04-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();


        // nouvelle demande
        $demande = new Demande();
        $user = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "citoyen2@gmail.com"));
        $demande->setUser($user);
        $cf = $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("adresse" => "Sfax-Mahrès"));
        $demande->setCentreFormation($cf);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $demande->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Transport routier"));
        $demande->setSousSecteur($sousSecteur);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $demande->setGouvernorat($gouv);
        $dele = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $demande->setDelegation($dele);
        $demande->setGouvernoratProjet($gouv);
        $demande->setDelegationProjet($dele);
        $sepcialite = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findOneBy(array("intituleFr" => "Mécanique AUTO"));
        $demande->setSpecialite($sepcialite);
        $unite = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT2"));
        $demande->setUniteRegionale($unite);

        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "RE_DATE_EXAM_OK"));
        $demande->setCurrentStatut($statut);

        $demande->setSpecialiteCitoyen("Mécanique");
        $demande->setAttestationFormation("0");
        $demande->setNomEmployeur("citoyen2");
        $demande->setProjet("1");
        $demande->setAdresseProjet("monastir");
        $demande->setAdresseResidenceActuelle("Sousse");
        $demande->setAdresseEntreprise("Sousse");
        $demande->setCode("TN-11/2020/6");
        $demande->setCodeConvocation("TN-11/2020/6");
        $demande->setIdentifiant("TN-11/2020/6");
        $demande->setAccessAttestation("0");
        $demande->setUniteRegionaleGouvernoratProjet("0");
        $demande->setCreatedAt(new \DateTime('01-04-2020'));
        $demande->setUpdatedAt(new \DateTime('30-05-2020'));
        $demande->setJustificatifExperience("ATTESTATION_TRAVAIL");
        $manager->persist($demande);
        $manager->flush();

        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/6"));

        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_DR"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('01-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        //SPECIALITE_CHOISIE
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SPECIALITE_CHOISIE"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('02-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        //scan ok
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SCAN_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('03-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        // CENTRE_OK
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "CENTRE_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('04-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        //ATTENTE_PAIEMENT
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_PAIEMENT"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('05-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        // PAIEMENT_OK
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PAIEMENT_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('06-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        // DATE_EXAM_OK
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "DATE_EXAM_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('07-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        // RE_DATE_EXAM_OK
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "RE_DATE_EXAM_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('07-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        $dateexam = new DateExam();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/6"));
        $dateexam->setDemande($id);
        $dateexam->setDateExam(new \DateTime('29-08-2019'));
        $dateexam->setMaterial("calculatrice");
        $dateexam->setNbTimesNotPassExamen(0);
        $manager->persist($dateexam);
        $manager->flush();

        $dateexam = new DateExam();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/6"));
        $dateexam->setDemande($id);
        $dateexam->setDateExam(new \DateTime('01-02-2020'));
        $dateexam->setMaterial("calculatrice");
        $dateexam->setNbTimesNotPassExamen(1);
        $manager->persist($dateexam);
        $manager->flush();

        $dateexam = new DateExam();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/6"));
        $dateexam->setDemande($id);
        $dateexam->setDateExam(new \DateTime('01-04-2020'));
        $dateexam->setMaterial("calculatrice");
        $dateexam->setNbTimesNotPassExamen(3);
        $manager->persist($dateexam);
        $manager->flush();

//        // PV UPLOAD
//        $history = new ApplicationHistory();
//        $history->setDemande($id);
//        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PV_UPLOAD"));
//        $history->setStatut($statut);
//        $history->setCreatedAt(new \DateTime('08-05-2020'));
//        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
//        $history->setUpdatedBy($userAgent->getId());
//        $manager->persist($history);
//        $manager->flush();

//        //PV accepte
//        $history = new ApplicationHistory();
//        $history->setDemande($id);
//        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PV_ACCEPTE"));
//        $history->setStatut($statut);
//        $history->setCreatedAt(new \DateTime('09-05-2020'));
//        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
//        $history->setUpdatedBy($userAgent->getId());
//        $manager->persist($history);
//        $manager->flush();
//
//        // attestation OK
//        $history = new ApplicationHistory();
//        $history->setDemande($id);
//        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTESTATION_OK"));
//        $history->setStatut($statut);
//        $history->setCreatedAt(new \DateTime('10-05-2020'));
//        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
//        $history->setUpdatedBy($userAgent->getId());
//        $manager->persist($history);
//        $manager->flush();


        // nouvelle demande
        $demande = new Demande();
        $user = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "citoyen3@gmail.com"));
        $demande->setUser($user);
        $cf = $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("adresse" => "Tunis-Bab-El-Bhar"));
        $demande->setCentreFormation($cf);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Agroalimentaire"));
        $demande->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Fabrication de produits laitiers"));
        $demande->setSousSecteur($sousSecteur);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $demande->setGouvernorat($gouv);
        $dele = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Bab-El-Bhar"));
        $demande->setDelegation($dele);
        $demande->setGouvernoratProjet($gouv);
        $demande->setDelegationProjet($dele);
        $sepcialite = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findOneBy(array("intituleFr" => "Arbres fruitiers et de l'agriculture irriguée"));
        $demande->setSpecialite($sepcialite);
        $unite = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT2"));
        $demande->setUniteRegionale($unite);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "RE_DATE_EXAM_OK"));
        $demande->setCurrentStatut($statut);
        $demande->setSpecialiteCitoyen("agriculture");
        $demande->setAttestationFormation("0");
        $demande->setNomEmployeur("citoyen3");
        $demande->setProjet("1");
        $demande->setAdresseProjet("kef");
        $demande->setAdresseResidenceActuelle("ariana ");
        $demande->setAdresseEntreprise("ariana");
        $demande->setCode("TN-11/2020/7");
        $demande->setCodeConvocation("TN-11/2020/7");
        $demande->setIdentifiant("TN-11/2020/7");
        $demande->setAccessAttestation("0");
        $demande->setUniteRegionaleGouvernoratProjet("0");
        $demande->setJustificatifExperience("ATTESTATION_TRAVAIL");
        $demande->setCreatedAt(new \DateTime('11-05-2020'));
        $demande->setUpdatedAt(new \DateTime('10-06-2020'));
        $manager->persist($demande);
        $manager->flush();

        //ATTENTE_DR
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/7"));
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_DR"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('11-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        //SPECIALITE_CHOISIE
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/7"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SPECIALITE_CHOISIE"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('12-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        //scan ok
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/7"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SCAN_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('13-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        // CENTRE_OK
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/7"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "CENTRE_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('14-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        //ATTENTE_PAIEMENT
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/7"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_PAIEMENT"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('15-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        // PAIEMENT_OK
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/7"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PAIEMENT_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('16-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        // DATE_EXAM_OK
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/7"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "RE_DATE_EXAM_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('17-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        // RE_DATE_EXAM_OK
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "RE_DATE_EXAM_OK"));
        $history->setStatut($statut);
        $history->setCreatedAt(new \DateTime('07-05-2020'));
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $manager->persist($history);
        $manager->flush();

        $dateexam = new DateExam();
        $dateexam->setDemande($id);
        $dateexam->setDateExam(new \DateTime('29-08-2019'));
        $dateexam->setMaterial("calculatrice");
        $dateexam->setNbTimesNotPassExamen(0);
        $manager->persist($dateexam);
        $manager->flush();

        $dateexam = new DateExam();
        $dateexam->setDemande($id);
        $dateexam->setDateExam(new \DateTime('01-02-2020'));
        $dateexam->setMaterial("calculatrice");
        $dateexam->setNbTimesNotPassExamen(1);
        $manager->persist($dateexam);
        $manager->flush();

        $dateexam = new DateExam();
        $dateexam->setDemande($id);
        $dateexam->setDateExam(new \DateTime('01-04-2020'));
        $dateexam->setMaterial("calculatrice");
        $dateexam->setNbTimesNotPassExamen(3);
        $manager->persist($dateexam);
        $manager->flush();

        //  PV Upload
//        $history = new ApplicationHistory();
//        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/7"));
//        $history->setDemande($id);
//        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PV_UPLOAD"));
//        $history->setStatut($statut);
//        $history->setCreatedAt(new \DateTime('20-05-2020'));
//        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
//        $history->setUpdatedBy($userAgent->getId());
//        $manager->persist($history);
//        $manager->flush();
//
//        //  PV accepte
//        $history = new ApplicationHistory();
//        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/7"));
//        $history->setDemande($id);
//        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PV_ACCEPTE"));
//        $history->setStatut($statut);
//        $history->setCreatedAt(new \DateTime('22-05-2020'));
//        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
//        $history->setUpdatedBy($userAgent->getId());
//        $manager->persist($history);
//        $manager->flush();
//
//        //  attestaion ok
//        $history = new ApplicationHistory();
//        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/7"));
//        $history->setDemande($id);
//        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTESTATION_OK"));
//        $history->setStatut($statut);
//        $history->setCreatedAt(new \DateTime('23-05-2020'));
//        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
//        $history->setUpdatedBy($userAgent->getId());
//        $manager->persist($history);
//        $manager->flush();

        // demande citoyen 4
        $demande = new Demande();
        $user = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "citoyen4@gmail.com"));
        $demande->setUser($user);
        $cf = $manager->getRepository('MfpeCentreFormationBundle:CentreFormation')->findOneBy(array("adresse" => "Tunis-Carthage"));
        $demande->setCentreFormation($cf);
        $secteur = $manager->getRepository('MfpeReferencielBundle:RefSecteur')->findOneBy(array("intituleFr" => "Transport"));
        $demande->setSecteur($secteur);
        $sousSecteur = $manager->getRepository('MfpeReferencielBundle:RefSousSecteur')->findOneBy(array("intituleFr" => "Transport routier"));
        $demande->setSousSecteur($sousSecteur);
        $gouv = $manager->getRepository('MfpeReferencielBundle:RefGouvernorat')->findOneBy(array("intituleFr" => "Tunis"));
        $demande->setGouvernorat($gouv);
        $dele = $manager->getRepository('MfpeReferencielBundle:RefDelegation')->findOneBy(array("intituleFr" => "Carthage"));
        $demande->setDelegation($dele);
        $demande->setGouvernoratProjet($gouv);
        $demande->setDelegationProjet($dele);
        $sepcialite = $manager->getRepository('MfpeCentreFormationBundle:Specialite')->findOneBy(array("intituleFr" => "Banque et Assurance"));
        $demande->setSpecialite($sepcialite);
        $unite = $manager->getRepository('MfpeUniteRegionaleBundle:UniteRegionale')->findOneBy(array("codeUnite" => "UNIT3"));
        $demande->setUniteRegionale($unite);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTESTATION_OK"));
        $demande->setCurrentStatut($statut);
        $demande->setSpecialiteCitoyen("Commerce");
        $demande->setAttestationFormation("0");
        $demande->setNomEmployeur("citoyen4");
        $demande->setProjet("1");
        $demande->setAdresseProjet("sfax");
        $demande->setAdresseResidenceActuelle("ariana ");
        $demande->setAdresseEntreprise("ariana");
        $demande->setCode("TN-11/2020/8");
        $demande->setCodeConvocation("TN-11/2020/8");
        $demande->setIdentifiant("TN-11/2020/8");
        $demande->setAccessAttestation("0");
        $demande->setUniteRegionaleGouvernoratProjet("0");
        $demande->setJustificatifExperience("ATTESTATION_TRAVAIL");
        $demande->setMotif($motif);
        $demande->setCreatedAt(new \DateTime('01-04-2020'));
        $demande->setUpdatedAt(new \DateTime('25-05-2020'));
        $manager->persist($demande);
        $manager->flush();

        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/8"));
        $history = new ApplicationHistory();
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_DR"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('10-04-2020'));
        $manager->persist($history);
        $manager->flush();

        //SPECIALITE_CHOISIE
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/8"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SPECIALITE_CHOISIE"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('11-04-2020'));
        $manager->persist($history);
        $manager->flush();

        //scan ok
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/8"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "SCAN_OK"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('12-04-2020'));
        $manager->persist($history);
        $manager->flush();

        // CENTRE_OK
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/8"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "CENTRE_OK"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('13-04-2020'));
        $manager->persist($history);
        $manager->flush();

        //ATTENTE_PAIEMENT
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/8"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTENTE_PAIEMENT"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('14-04-2020'));
        $manager->persist($history);
        $manager->flush();

        // PAIEMENT_OK
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/8"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PAIEMENT_OK"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('15-04-2020'));
        $manager->persist($history);
        $manager->flush();

        // DATE_EXAM_OK
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/8"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "DATE_EXAM_OK"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('17-04-2020'));
        $manager->persist($history);
        $manager->flush();

        $dateexam = new DateExam();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/8"));
        $dateexam->setDemande($id);
        $dateexam->setDateExam(new \DateTime('29-08-2021'));
        $dateexam->setMaterial("calculatrice");
        $dateexam->setNbTimesNotPassExamen(0);
        $manager->persist($dateexam);
        $manager->flush();

        // PV UPLOAD
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/8"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PV_UPLOAD"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('19-04-2020'));
        $manager->persist($history);
        $manager->flush();

        // PV_ACCEPTE
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/8"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "PV_ACCEPTE"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('20-04-2020'));
        $manager->persist($history);
        $manager->flush();

        // ATTESTATION_OK
        $history = new ApplicationHistory();
        $id = $manager->getRepository('MfpeAttestationBundle:Demande')->findOneBy(array("identifiant" => "TN-11/2020/8"));
        $history->setDemande($id);
        $statut = $manager->getRepository('MfpeReferencielBundle:RefStatut')->findOneBy(array("code" => "ATTESTATION_OK"));
        $history->setStatut($statut);
        $userAgent = $manager->getRepository('MfpeConfigBundle:AppUser')->findOneBy(array("email" => "agent1@gmail.com"));
        $history->setUpdatedBy($userAgent->getId());
        $history->setCreatedAt(new \DateTime('22-04-2020'));
        $manager->persist($history);
        $manager->flush();
    }
}