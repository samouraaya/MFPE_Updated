<?php

namespace Mfpe\CentreFormationBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\Groups;
use Mfpe\ConfigBundle\Entity\AbstractEntity;

/**
 * centreFormation
 *
 * @ORM\Table(name="centre_formation")
 * @ORM\Entity(repositoryClass="Mfpe\CentreFormationBundle\Repository\CentreFormationRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class CentreFormation
{
    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"DeserializeDemandeGroup", "DemandeGroup" ,"listDemande","detailStatGraduateTraining", "detailDemande","detailCentreFormation","listStatGraduateTraining","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="type", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","notification","listStatGraduateTraining","detailStatGraduateTraining","detailEtatiqueStatGraduateTraining","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $type;
    /**
     * @var string
     *
     * @ORM\Column(name="intitule_ar", type="string", length=255)
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","notification","listStatGraduateTraining","detailStatGraduateTraining","detailEtatiqueStatGraduateTraining","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $intituleAr;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_fr", type="string", length=255)
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","notification","listStatGraduateTraining","detailStatGraduateTraining","detailEtatiqueStatGraduateTraining","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $intituleFr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation"})
     * @Serializer\Expose()
     */
    private $adresse;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tel", type="string", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation"})
     * @Serializer\Expose()
     */
    private $tel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fax", type="string", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation"})
     * @Serializer\Expose()
     */
    private $fax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation"})
     * @Serializer\Expose()
     */
    private $email;


    /**
     * @var string
     *
     * @ORM\Column(name="nom_directeur_ar", type="string", length=255)
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $nomDirecteurAr;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_directeur_fr", type="string", length=255)
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $nomDirecteurFr;

    /**
     * @var int|null
     *
     * @ORM\Column(name="annee_creation", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $anneeCreation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="capacite_accueil", type="string", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $capaciteAccueil;

    /**
     * @var int|null
     *
     * @ORM\Column(name="numero_enregistrement", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $numeroEnregistrement;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nombre_formateur", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $nombreFormateur;

    /**
     * @var int|null
     *
     * @ORM\Column(name="nombre_cadre_administratif", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $nombreCadreAdministratif;

    /**
     * @var int|null
     *
     * @ORM\Column(name="capacite_hebergement", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $capaciteHebergement;

    /**
     * @var int|null
     *
     * @ORM\Column(name="capacite_restaurant", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $capaciteRestaurant;


    /**
     * @var string|null
     *
     * @ORM\Column(name="organisme", type="string", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","detailStatGraduateTraining","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $organisme;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="gouvernorat", referencedColumnName="id", nullable=true)
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","detailStatGraduateTraining","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $gouvernorat;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefDelegation")
     * @ORM\JoinColumn(name="delegation", referencedColumnName="id", nullable=true)
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $delegation;


    /**
     * @var \Doctrine\Common\Collections\Collection|Specialite[]
     * @ORM\ManyToMany(targetEntity="Mfpe\CentreFormationBundle\Entity\Specialite", inversedBy="centers")
     * @ORM\JoinTable(
     *  name="specialite_center",
     *  joinColumns={
     *      @ORM\JoinColumn(name="center_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *     @ORM\JoinColumn(name="speciality_id", referencedColumnName="id")
     * })
     * @Serializer\Groups({"detailCentreFormation","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $specialiteCenters;

    /**
     * @var boolean
     * @ORM\Column(name="enable", type="boolean",nullable=true)
     * @Serializer\Groups({"listDemande", "detailDemande","detailCentreFormation","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    protected $enable;





    /**
     * Constructor
     */
    public function __construct()
    {
        $this->specialiteCenters = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set intituleAr.
     *
     * @param string $intituleAr
     *
     * @return CentreFormation
     */
    public function setIntituleAr($intituleAr)
    {
        $this->intituleAr = $intituleAr;

        return $this;
    }

    /**
     * Get intituleAr.
     *
     * @return string
     */
    public function getIntituleAr()
    {
        return $this->intituleAr;
    }

    /**
     * Set intituleFr.
     *
     * @param string $intituleFr
     *
     * @return CentreFormation
     */
    public function setIntituleFr($intituleFr)
    {
        $this->intituleFr = $intituleFr;

        return $this;
    }

    /**
     * Get intituleFr.
     *
     * @return string
     */
    public function getIntituleFr()
    {
        return $this->intituleFr;
    }

    /**
     * Set adresse.
     *
     * @param string|null $adresse
     *
     * @return CentreFormation
     */
    public function setAdresse($adresse = null)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse.
     *
     * @return string|null
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set tel.
     *
     * @param string|null $tel
     *
     * @return CentreFormation
     */
    public function setTel($tel = null)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel.
     *
     * @return string|null
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set fax.
     *
     * @param string|null $fax
     *
     * @return CentreFormation
     */
    public function setFax($fax = null)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax.
     *
     * @return string|null
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return CentreFormation
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * Set nomDirecteurAr.
     *
     * @param string $nomDirecteurAr
     *
     * @return CentreFormation
     */
    public function setNomDirecteurAr($nomDirecteurAr)
    {
        $this->nomDirecteurAr = $nomDirecteurAr;

        return $this;
    }

    /**
     * Get nomDirecteurAr.
     *
     * @return string
     */
    public function getNomDirecteurAr()
    {
        return $this->nomDirecteurAr;
    }

    /**
     * Set nomDirecteurFr.
     *
     * @param string $nomDirecteurFr
     *
     * @return CentreFormation
     */
    public function setNomDirecteurFr($nomDirecteurFr)
    {
        $this->nomDirecteurFr = $nomDirecteurFr;

        return $this;
    }

    /**
     * Get nomDirecteurFr.
     *
     * @return string
     */
    public function getNomDirecteurFr()
    {
        return $this->nomDirecteurFr;
    }

    /**
     * Set anneeCreation.
     *
     * @param int|null $anneeCreation
     *
     * @return CentreFormation
     */
    public function setAnneeCreation($anneeCreation = null)
    {
        $this->anneeCreation = $anneeCreation;

        return $this;
    }

    /**
     * Get anneeCreation.
     *
     * @return int|null
     */
    public function getAnneeCreation()
    {
        return $this->anneeCreation;
    }

    /**
     * Set capaciteAccueil.
     *
     * @param string|null $capaciteAccueil
     *
     * @return CentreFormation
     */
    public function setCapaciteAccueil($capaciteAccueil = null)
    {
        $this->capaciteAccueil = $capaciteAccueil;

        return $this;
    }

    /**
     * Get capaciteAccueil.
     *
     * @return string|null
     */
    public function getCapaciteAccueil()
    {
        return $this->capaciteAccueil;
    }

    /**
     * Set numeroEnregistrement.
     *
     * @param int|null $numeroEnregistrement
     *
     * @return CentreFormation
     */
    public function setNumeroEnregistrement($numeroEnregistrement = null)
    {
        $this->numeroEnregistrement = $numeroEnregistrement;

        return $this;
    }

    /**
     * Get numeroEnregistrement.
     *
     * @return int|null
     */
    public function getNumeroEnregistrement()
    {
        return $this->numeroEnregistrement;
    }

    /**
     * Set nombreFormateur.
     *
     * @param int|null $nombreFormateur
     *
     * @return CentreFormation
     */
    public function setNombreFormateur($nombreFormateur = null)
    {
        $this->nombreFormateur = $nombreFormateur;

        return $this;
    }

    /**
     * Get nombreFormateur.
     *
     * @return int|null
     */
    public function getNombreFormateur()
    {
        return $this->nombreFormateur;
    }

    /**
     * Set nombreCadreAdministratif.
     *
     * @param int|null $nombreCadreAdministratif
     *
     * @return CentreFormation
     */
    public function setNombreCadreAdministratif($nombreCadreAdministratif = null)
    {
        $this->nombreCadreAdministratif = $nombreCadreAdministratif;

        return $this;
    }

    /**
     * Get nombreCadreAdministratif.
     *
     * @return int|null
     */
    public function getNombreCadreAdministratif()
    {
        return $this->nombreCadreAdministratif;
    }

    /**
     * Set capaciteHebergement.
     *
     * @param int|null $capaciteHebergement
     *
     * @return CentreFormation
     */
    public function setCapaciteHebergement($capaciteHebergement = null)
    {
        $this->capaciteHebergement = $capaciteHebergement;

        return $this;
    }

    /**
     * Get capaciteHebergement.
     *
     * @return int|null
     */
    public function getCapaciteHebergement()
    {
        return $this->capaciteHebergement;
    }

    /**
     * Set capaciteRestaurant.
     *
     * @param int|null $capaciteRestaurant
     *
     * @return CentreFormation
     */
    public function setCapaciteRestaurant($capaciteRestaurant = null)
    {
        $this->capaciteRestaurant = $capaciteRestaurant;

        return $this;
    }

    /**
     * Get capaciteRestaurant.
     *
     * @return int|null
     */
    public function getCapaciteRestaurant()
    {
        return $this->capaciteRestaurant;
    }

    /**
     * Set organisme.
     *
     * @param string|null $organisme
     *
     * @return CentreFormation
     */
    public function setOrganisme($organisme = null)
    {
        $this->organisme = $organisme;

        return $this;
    }

    /**
     * Get organisme.
     *
     * @return string|null
     */
    public function getOrganisme()
    {
        return $this->organisme;
    }

    /**
     * Set gouvernorat.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $gouvernorat
     *
     * @return CentreFormation
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
     * @return CentreFormation
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
     * Add specialiteCenter.
     *
     * @param \Mfpe\CentreFormationBundle\Entity\Specialite $specialiteCenter
     *
     * @return CentreFormation
     */
    public function addSpecialiteCenter(\Mfpe\CentreFormationBundle\Entity\Specialite $specialiteCenter)
    {
        $this->specialiteCenters[] = $specialiteCenter;

        return $this;
    }

    /**
     * Remove specialiteCenter.
     *
     * @param \Mfpe\CentreFormationBundle\Entity\Specialite $specialiteCenter
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeSpecialiteCenter(\Mfpe\CentreFormationBundle\Entity\Specialite $specialiteCenter)
    {
        return $this->specialiteCenters->removeElement($specialiteCenter);
    }

    /**
     * Get specialiteCenters.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecialiteCenters()
    {
        return $this->specialiteCenters;
    }

    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return CentreFormation
     */
    public function setEnable($enable = null)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable.
     *
     * @return bool|null
     */
    public function getEnable()
    {
        return $this->enable;
    }




    /**
     * Set type.
     *
     * @param int|null $type
     *
     * @return CentreFormation
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return int|null
     */
    public function getType()
    {
        return $this->type;
    }
}
