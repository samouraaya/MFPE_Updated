<?php

namespace Mfpe\AttestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\Groups;
use Mfpe\ConfigBundle\Entity\AbstractEntity;


/**
 * demande
 *
 * @ORM\Table(name="demande")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\AttestationBundle\Repository\DemandeRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Demande
{

    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"DeserializeDemandeGroup", "DemandeGroup" ,"listDemande","listDemandeCitoyen", "detailDemande","notification","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="specialite_citoyen", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","listDemandeCitoyen","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $specialiteCitoyen;

    /**
     * @var string|null
     *
     * @ORM\Column(name="justificatif_experience", columnDefinition="ENUM('ATTESTATION_TRAVAIL', 'DEUX_TEMOINS','ATTESTATION_TEMOINS')", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $justificatifExperience;


    /**
     * @var string|null
     *
     * @ORM\Column(name="url_demande_pdf", type="string", length=255, nullable=true)
     * @Serializer\Groups({"detailDemande","listDetailDemande","listDemandeCitoyen"})
     * @Serializer\Expose()
     */
    private $urlDemandePdf;
    /**
     * @var bool
     *
     * @ORM\Column(name="attestation_formation", type="boolean", options={"default":"0"})
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $attestationFormation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_employeur", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $nomEmployeur;

    /**
     * @ORM\OneToMany(targetEntity="Document", mappedBy="demande")
     * @Serializer\Groups({"detailDemande","listDemande","listDetailDemande","listDemandeCitoyen"})
     * @Serializer\Expose()
     */
    private $documents;

    /**
     * @ORM\OneToMany(targetEntity="DateExam", mappedBy="demande")
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $dateExams;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse_entreprise", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $adresseEntreprise;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse_residence_actuelle", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $adresseResidenceActuelle;

    /**
     * @var bool
     *
     * @ORM\Column(name="projet", type="boolean", options={"default":"0"})
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $projet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse_projet", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $adresseProjet;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande","listDemandeCitoyen", "detailDemande","notification","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $code;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_convocation", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","listDemandeCitoyen","notification","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $codeConvocation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="identifiant", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $identifiant;

    /**
     * @var bool
     *
     * @ORM\Column(name="access_attestation", type="boolean", options={"default":"0"})
     * @Serializer\Groups({"listDemande","listDemandeCitoyen", "detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $accessAttestation = false;

    /**
     * @var \Mfpe\ConfigBundle\Entity\AppUser
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\ConfigBundle\Entity\AppUser", inversedBy="demandes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     * @Serializer\Groups({"listDemande","listDemandeCitoyen", "detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $user;

    /**
     * @var \Mfpe\CentreFormationBundle\Entity\CentreFormation
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\CentreFormationBundle\Entity\CentreFormation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="centre_formation", referencedColumnName="id")
     * })
     * @Serializer\Groups({"listDemande","listDemandeCitoyen", "detailDemande","notification","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $centreFormation;


    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefSecteur")
     * @ORM\JoinColumn(name="secteur", referencedColumnName="id")
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $secteur;
    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefSousSecteur")
     * @ORM\JoinColumn(name="sous_secteur", referencedColumnName="id")
     * @Serializer\Groups({"detailDemande","listDemande","listDemandeCitoyen","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $sousSecteur;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="gouvernorat", referencedColumnName="id")
     * @Serializer\Groups({"detailDemande","listDemande","listDemandeCitoyen","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $gouvernorat;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefDelegation")
     * @ORM\JoinColumn(name="delegation", referencedColumnName="id")
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $delegation;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="gouvernorat_projet", referencedColumnName="id")
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $gouvernoratProjet;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefDelegation")
     * @ORM\JoinColumn(name="delegation_projet", referencedColumnName="id")
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $delegationProjet;

    /**
     * @var \Specialite
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\CentreFormationBundle\Entity\Specialite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="specialite", referencedColumnName="id")
     * })
     * @Serializer\Groups({"listDemande","listDemandeCitoyen", "detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $specialite;

    /**
     * @var \UniteRegionale
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\UniteRegionaleBundle\Entity\UniteRegionale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unite_regionale", referencedColumnName="id")
     * })
     * @Serializer\Groups({"detailDemande","notification","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $uniteRegionale;


    /**
     * @var bool
     *
     * @ORM\Column(name="unite_regionale_gouvernorat_projet", type="boolean", options={"default":"0"})
     * @Serializer\Expose()
     */
    private $uniteRegionaleGouvernoratProjet = false;

    /**
     * @var \currentStatut
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefStatut")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="current_statut", referencedColumnName="id")
     * })
     * @Serializer\Groups({"listDemande","listDemandeCitoyen", "detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $currentStatut;

    /**
     * @var \motif
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefMotif")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="motif", referencedColumnName="id")
     * })
     * @Serializer\Groups({"listDemande","listDemandeCitoyen", "detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $motif;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observation", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $observation;


    /**
     * @ORM\OneToMany(targetEntity="ApplicationHistory", mappedBy="demande")
     * @Serializer\Groups({"detailDemande"})
     * @Serializer\Expose()
     */
    private $applicationHistorys;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
        $this->dateExams = new \Doctrine\Common\Collections\ArrayCollection();
        $this->applicationHistorys = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set specialiteCitoyen.
     *
     * @param string|null $specialiteCitoyen
     *
     * @return Demande
     */
    public function setSpecialiteCitoyen($specialiteCitoyen = null)
    {
        $this->specialiteCitoyen = $specialiteCitoyen;

        return $this;
    }

    /**
     * Get specialiteCitoyen.
     *
     * @return string|null
     */
    public function getSpecialiteCitoyen()
    {
        return $this->specialiteCitoyen;
    }

    /**
     * Set justificatifExperience.
     *
     * @param string|null $justificatifExperience
     *
     * @return Demande
     */
    public function setJustificatifExperience($justificatifExperience = null)
    {
        $this->justificatifExperience = $justificatifExperience;

        return $this;
    }

    /**
     * Get justificatifExperience.
     *
     * @return string|null
     */
    public function getJustificatifExperience()
    {
        return $this->justificatifExperience;
    }

    /**
     * Set attestationFormation.
     *
     * @param bool $attestationFormation
     * @return Demande
     */
    public function setAttestationFormation($attestationFormation)
    {
        $this->attestationFormation = $attestationFormation;

        return $this;
    }

    /**
     * Get attestationFormation.
     *
     * @return bool
     */
    public function getAttestationFormation()
    {
        return $this->attestationFormation;
    }

    /**
     * Set nomEmployeur.
     *
     * @param string|null $nomEmployeur
     *
     * @return Demande
     */
    public function setNomEmployeur($nomEmployeur = null)
    {
        $this->nomEmployeur = $nomEmployeur;

        return $this;
    }

    /**
     * Get nomEmployeur.
     *
     * @return string|null
     */
    public function getNomEmployeur()
    {
        return $this->nomEmployeur;
    }

    /**
     * Set adresseEntreprise.
     *
     * @param string|null $adresseEntreprise
     *
     * @return Demande
     */
    public function setAdresseEntreprise($adresseEntreprise = null)
    {
        $this->adresseEntreprise = $adresseEntreprise;

        return $this;
    }

    /**
     * Get adresseEntreprise.
     *
     * @return string|null
     */
    public function getAdresseEntreprise()
    {
        return $this->adresseEntreprise;
    }

    /**
     * Set adresseResidenceActuelle.
     *
     * @param string|null $adresseResidenceActuelle
     *
     * @return Demande
     */
    public function setAdresseResidenceActuelle($adresseResidenceActuelle = null)
    {
        $this->adresseResidenceActuelle = $adresseResidenceActuelle;

        return $this;
    }

    /**
     * Get adresseResidenceActuelle.
     *
     * @return string|null
     */
    public function getAdresseResidenceActuelle()
    {
        return $this->adresseResidenceActuelle;
    }

    /**
     * Set projet.
     *
     * @param bool $projet
     *
     * @return Demande
     */
    public function setProjet($projet)
    {
        $this->projet = $projet;

        return $this;
    }

    /**
     * Get projet.
     *
     * @return bool
     */
    public function getProjet()
    {
        return $this->projet;
    }

    /**
     * Set adresseProjet.
     *
     * @param string|null $adresseProjet
     *
     * @return Demande
     */
    public function setAdresseProjet($adresseProjet = null)
    {
        $this->adresseProjet = $adresseProjet;

        return $this;
    }

    /**
     * Get adresseProjet.
     *
     * @return string|null
     */
    public function getAdresseProjet()
    {
        return $this->adresseProjet;
    }

    /**
     * Set code.
     *
     * @param string|null $code
     *
     * @return Demande
     */
    public function setCode($code = null)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set accessAttestation.
     *
     * @param bool $accessAttestation
     *
     * @return Demande
     */
    public function setAccessAttestation($accessAttestation)
    {
        $this->accessAttestation = $accessAttestation;

        return $this;
    }

    /**
     * Get accessAttestation.
     *
     * @return bool
     */
    public function getAccessAttestation()
    {
        return $this->accessAttestation;
    }

    /**
     * Add document.
     *
     * @param \Mfpe\AttestationBundle\Entity\Document $document
     *
     * @return Demande
     */
    public function addDocument(\Mfpe\AttestationBundle\Entity\Document $document)
    {
        $this->documents[] = $document;

        return $this;
    }

    /**
     * Remove document.
     *
     * @param \Mfpe\AttestationBundle\Entity\Document $document
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDocument(\Mfpe\AttestationBundle\Entity\Document $document)
    {
        return $this->documents->removeElement($document);
    }

    /**
     * Get documents.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * Set user.
     *
     * @param \Mfpe\ConfigBundle\Entity\AppUser|null $user
     *
     * @return Demande
     */
    public function setUser(\Mfpe\ConfigBundle\Entity\AppUser $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \Mfpe\ConfigBundle\Entity\AppUser|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set secteur.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefSecteur|null $secteur
     *
     * @return Demande
     */
    public function setSecteur(\Mfpe\ReferencielBundle\Entity\RefSecteur $secteur = null)
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * Get secteur.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefSecteur|null
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * Set gouvernorat.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $gouvernorat
     *
     * @return Demande
     */
    public function setGouvernorat(\Mfpe\ReferencielBundle\Entity\RefGouvernorat $gouvernorat = null)
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    /**
     * Get gouvernorat.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }

    /**
     * Set delegation.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefDelegation|null $delegation
     *
     * @return Demande
     */
    public function setDelegation(\Mfpe\ReferencielBundle\Entity\RefDelegation $delegation = null)
    {
        $this->delegation = $delegation;

        return $this;
    }

    /**
     * Get delegation.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefDelegation|null
     */
    public function getDelegation()
    {
        return $this->delegation;
    }

    /**
     * Set gouvernoratProjet.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $gouvernoratProjet
     *
     * @return Demande
     */
    public function setGouvernoratProjet(\Mfpe\ReferencielBundle\Entity\RefGouvernorat $gouvernoratProjet = null)
    {
        $this->gouvernoratProjet = $gouvernoratProjet;

        return $this;
    }

    /**
     * Get gouvernoratProjet.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null
     */
    public function getGouvernoratProjet()
    {
        return $this->gouvernoratProjet;
    }

    /**
     * Set delegationProjet.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefDelegation|null $delegationProjet
     *
     * @return Demande
     */
    public function setDelegationProjet(\Mfpe\ReferencielBundle\Entity\RefDelegation $delegationProjet = null)
    {
        $this->delegationProjet = $delegationProjet;

        return $this;
    }

    /**
     * Get delegationProjet.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefDelegation|null
     */
    public function getDelegationProjet()
    {
        return $this->delegationProjet;
    }

    /**
     * Set specialite.
     *
     * @param \Mfpe\CentreFormationBundle\Entity\Specialite|null $specialite
     *
     * @return Demande
     */
    public function setSpecialite(\Mfpe\CentreFormationBundle\Entity\Specialite $specialite = null)
    {
        $this->specialite = $specialite;

        return $this;
    }

    /**
     * Get specialite.
     *
     * @return \Mfpe\CentreFormationBundle\Entity\Specialite|null
     */
    public function getSpecialite()
    {
        return $this->specialite;
    }

    /**
     * Set uniteRegionale.
     *
     * @param \Mfpe\UniteRegionaleBundle\Entity\UniteRegionale|null $uniteRegionale
     *
     * @return Demande
     */
    public function setUniteRegionale(\Mfpe\UniteRegionaleBundle\Entity\UniteRegionale $uniteRegionale = null)
    {
        $this->uniteRegionale = $uniteRegionale;

        return $this;
    }

    /**
     * Get uniteRegionale.
     *
     * @return \Mfpe\UniteRegionaleBundle\Entity\UniteRegionale|null
     */
    public function getUniteRegionale()
    {
        return $this->uniteRegionale;
    }


    /**
     * Set currentStatut.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefStatut|null $currentStatut
     *
     * @return Demande
     */
    public function setCurrentStatut(\Mfpe\ReferencielBundle\Entity\RefStatut $currentStatut = null)
    {
        $this->currentStatut = $currentStatut;

        return $this;
    }

    /**
     * Get currentStatut.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefStatut|null
     */
    public function getCurrentStatut()
    {
        return $this->currentStatut;
    }

    /**
     * Add dateExam.
     *
     * @param \Mfpe\AttestationBundle\Entity\DateExam $dateExam
     *
     * @return Demande
     */
    public function addDateExam(\Mfpe\AttestationBundle\Entity\DateExam $dateExam)
    {
        $this->dateExams[] = $dateExam;

        return $this;
    }

    /**
     * Remove dateExam.
     *
     * @param \Mfpe\AttestationBundle\Entity\DateExam $dateExam
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDateExam(\Mfpe\AttestationBundle\Entity\DateExam $dateExam)
    {
        return $this->dateExams->removeElement($dateExam);
    }

    /**
     * Get dateExams.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDateExams()
    {
        return $this->dateExams;
    }


    /**
     * Add applicationHistory.
     *
     * @param \Mfpe\AttestationBundle\Entity\ApplicationHistory $applicationHistory
     *
     * @return Demande
     */
    public function addApplicationHistory(\Mfpe\AttestationBundle\Entity\ApplicationHistory $applicationHistory)
    {
        $this->applicationHistorys[] = $applicationHistory;

        return $this;
    }

    /**
     * Remove applicationHistory.
     *
     * @param \Mfpe\AttestationBundle\Entity\ApplicationHistory $applicationHistory
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeApplicationHistory(\Mfpe\AttestationBundle\Entity\ApplicationHistory $applicationHistory)
    {
        return $this->applicationHistorys->removeElement($applicationHistory);
    }

    /**
     * Get applicationHistorys.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getApplicationHistorys()
    {
        return $this->applicationHistorys;
    }

    /**
     * Set motif.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefMotif|null $motif
     *
     * @return Demande
     */
    public function setMotif(\Mfpe\ReferencielBundle\Entity\RefMotif $motif = null)
    {
        $this->motif = $motif;

        return $this;
    }

    /**
     * Get motif.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefMotif|null
     */
    public function getMotif()
    {
        return $this->motif;
    }

    /**
     * Set observation.
     *
     * @param string|null $observation
     *
     * @return Demande
     */
    public function setObservation($observation = null)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation.
     *
     * @return string|null
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set identifiant.
     *
     * @param string|null $identifiant
     *
     * @return Demande
     */
    public function setIdentifiant($identifiant = null)
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    /**
     * Get identifiant.
     *
     * @return string|null
     */
    public function getIdentifiant()
    {
        return $this->identifiant;
    }

    /**
     * Set uniteRegionaleProjet.
     *
     * @param bool $uniteRegionaleGouvernoratProjet
     *
     * @return Demande
     */
    public function setUniteRegionaleGouvernoratProjet($uniteRegionaleGouvernoratProjet)
    {
        $this->uniteRegionaleGouvernoratProjet = $uniteRegionaleGouvernoratProjet;

        return $this;
    }

    /**
     * Get uniteRegionaleGouvernoratProjet.
     *
     * @return bool
     */
    public function getUniteRegionaleGouvernoratProjet()
    {
        return $this->uniteRegionaleGouvernoratProjet;
    }

    /**
     * Set codeConvocation.
     *
     * @param string|null $codeConvocation
     *
     * @return Demande
     */
    public function setCodeConvocation($codeConvocation = null)
    {
        $this->codeConvocation = $codeConvocation;

        return $this;
    }

    /**
     * Get codeConvocation.
     *
     * @return string|null
     */
    public function getCodeConvocation()
    {
        return $this->codeConvocation;
    }

    /**
     * Set urlDemandePdf.
     *
     * @param string|null $urlDemandePdf
     *
     * @return Demande
     */
    public function setUrlDemandePdf($urlDemandePdf = null)
    {
        $this->urlDemandePdf = $urlDemandePdf;

        return $this;
    }

    /**
     * Get urlDemandePdf.
     *
     * @return string|null
     */
    public function getUrlDemandePdf()
    {
        return $this->urlDemandePdf;
    }

    /**
     * Set centreFormation.
     *
     * @param \Mfpe\CentreFormationBundle\Entity\CentreFormation|null $centreFormation
     *
     * @return Demande
     */
    public function setCentreFormation(\Mfpe\CentreFormationBundle\Entity\CentreFormation $centreFormation = null)
    {
        $this->centreFormation = $centreFormation;

        return $this;
    }

    /**
     * Get centreFormation.
     *
     * @return \Mfpe\CentreFormationBundle\Entity\CentreFormation|null
     */
    public function getCentreFormation()
    {
        return $this->centreFormation;
    }

    



    /**
     * Set sousSecteur.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefSousSecteur|null $sousSecteur
     *
     * @return Demande
     */
    public function setSousSecteur(\Mfpe\ReferencielBundle\Entity\RefSousSecteur $sousSecteur = null)
    {
        $this->sousSecteur = $sousSecteur;

        return $this;
    }

    /**
     * Get sousSecteur.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefSousSecteur|null
     */
    public function getSousSecteur()
    {
        return $this->sousSecteur;
    }
}
