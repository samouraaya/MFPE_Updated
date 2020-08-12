<?php

namespace Mfpe\ConfigBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * AppUser
 *
 * @ORM\Table(name="app_user")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\ConfigBundle\Repository\AppUserRepository")
 * @UniqueEntity(fields={"username","email"}, message="Username existe deja")
 * @Serializer\ExclusionPolicy("ALL")
 */
class AppUser implements UserInterface
{

    use AbstractEntity;
    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"DeserializeUserGroup","listDemande", "AppUserGroup","notification","UserRole"})
     * @Serializer\Expose()
     * @Groups({"AppUserGroup", "MissionGroup","detailDemande","listDetailDemande","UserRole"})
     */
    private $id;

    /**
     * @ORM\Column(type="string",unique=true)
     * @Serializer\Groups({"AppUserGroup","detailDemande", "DeserializeUserGroup","listDetailDemande","UserRole"})
     * @Serializer\Expose()
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     * @Serializer\Groups({"DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $password;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=255)
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","PersonelDr","listDetailDemande","UserRole"})
     * @Serializer\Expose()
     */
    private $email;

    /**
     * @var boolean
     * @ORM\Column(name="enable", type="boolean",nullable=true)
     * @Serializer\Groups({"AppUserGroup", "DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $enable;


    /**
     * @ORM\Column(type="string",nullable=true)
     * @Serializer\Groups({"AppUserGroup","detailDemande", "DeserializeUserGroup","PersonelDr","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $identifiant;

    /**
     * @var int
     * @ORM\Column(name="tel", type="string",nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande","DeserializeUserGroup","PersonelDr","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $tel;

    /**
     * @var string|null
     * @ORM\Column(name="grade", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AppUserGroup","detailDemande", "DeserializeUserGroup","PersonelDr","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $grade;

    /**
     * @var string|null
     *
     * @ORM\Column(name="premier_responsable", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AppUserGroup","detailDemande", "DeserializeUserGroup","PersonelDr","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $premierResponsable;
    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefStructure")
     * @ORM\JoinColumn(name="structure", referencedColumnName="id")
     * @Serializer\Groups({"listDemande","AppUserGroup", "detailDemande","uniteRegional","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $structure;
    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefFonction")
     * @ORM\JoinColumn(name="fonction", referencedColumnName="id")
     * @Serializer\Groups({"listDemande", "AppUserGroup","detailDemande","uniteRegional","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $fonction;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_naissance", type="datetime", nullable=true)
     * @Serializer\Groups({"AppUserGroup","listDemande", "detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $dateNaissance;

    /**
     * @var string
     * @ORM\Column(name="nom_fr", type="string", length=255)
     * @Serializer\Groups({"AppUserGroup","detailDemande","listDemande","DeserializeUserGroup","PersonelDr","notification","listDetailDemande","UserRole"})
     * @Serializer\Expose()
     */
    private $nomFr;

    /**
     * @var string
     * @ORM\Column(name="nom_ar", type="string", length=255)
     * @Serializer\Groups({"AppUserGroup","detailDemande","listDemande", "DeserializeUserGroup","PersonelDr","listDetailDemande","UserRole"})
     * @Serializer\Expose()
     */
    private $nomAr;

    /**
     * @var string
     * @ORM\Column(name="prenom_fr", type="string", length=255)
     * @Serializer\Groups({"AppUserGroup","detailDemande","listDemande",  "DeserializeUserGroup","PersonelDr","notification","listDetailDemande","UserRole"})
     * @Serializer\Expose()
     */
    private $prenomFr;

    /**
     * @var string
     * @ORM\Column(name="prenom_ar", type="string", length=255)
     * @Serializer\Groups({"AppUserGroup","listDemande","detailDemande", "DeserializeUserGroup","PersonelDr","listDetailDemande","UserRole"})
     * @Serializer\Expose()
     */
    private $prenomAr;

    /**
     * @var int
     * @ORM\Column(name="num_cin", type="string",nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $numCin;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_delivrance_cin", type="datetime", nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $dateDelivranceCin;

    /**
     * @var int
     * @ORM\Column(name="num_passport",type="string", nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $numPassport;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_delivrance_passport", type="datetime", nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $dateDelivrancePassport;

    /**
     * @ORM\Column(name="num_carte_sejour",type="string", nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $numCarteSejour;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_validite_sejour", type="datetime", nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
*/
    private $dateValiditeSejour;

    /**
     * @var \DateTime
     * @ORM\Column(name="date_inscription", type="datetime", nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $dateInscription;

    /**
     * @ORM\Column(type="string" , nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $sexe;

    /**
     * @ORM\Column(name="personne_besoin_specifique", type="boolean", options={"default":false},nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $personneBesoinSpecifique;

    /**
     * @ORM\Column(name="lieu_naissance", type="string", length=255, unique=false, nullable=true)
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $lieuNaissance;

    /**
     * @var boolean
     * @ORM\Column(name="first_login", type="integer",options={"default":0} )
     * @Serializer\Groups({"AppUserGroup","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $firstLogin;

    /**
     * @var string
     *
     * @ORM\Column(name="password_print", type="string", length=255)
     * @Serializer\Groups({"DeserializeUserGroup"})
     * @Serializer\Expose()
     */
    private $passwordPrint;


    /**
     * @var string
     */

    private $plainPassword;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefNationalite")
     * @ORM\JoinColumn(name="nationalite", referencedColumnName="id")
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $nationalite;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="gouvernorat", referencedColumnName="id")
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $gouvernorat;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefDelegation")
     * @ORM\JoinColumn(name="delegation", referencedColumnName="id")
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $delegation;
    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="gouvernorat_residence", referencedColumnName="id")
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $gouvernoratResidence;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefDelegation")
     * @ORM\JoinColumn(name="delegation_residence", referencedColumnName="id")
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $delegationResidence;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefNatureBesoinSpecifique")
     * @ORM\JoinColumn(name="nature_besoin_specifique", referencedColumnName="id")
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $natureBesoinSpecifique;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefNiveauEtude")
     * @ORM\JoinColumn(name="niveau_etude", referencedColumnName="id")
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $niveauEtude;

    /**
     * @var \UniteRegionale
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\UniteRegionaleBundle\Entity\UniteRegionale")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="unite_regionale", referencedColumnName="id")
     * })
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","PersonelDr","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $uniteRegionale;

    /**
     * @var \CentreFormation
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\CentreFormationBundle\Entity\CentreFormation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="centre_formation", referencedColumnName="id")
     * })
     * @Serializer\Groups({"AppUserGroup", "listDemande","detailDemande", "DeserializeUserGroup","PersonelDr","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $centreFormation;

    /**
     * @var \Doctrine\Common\Collections\Collection|Role[]
     * @ORM\ManyToMany(targetEntity="Mfpe\ConfigBundle\Entity\Role", inversedBy="users")
     * @ORM\JoinTable(
     *  name="user_role",
     *  joinColumns={
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *     @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     * })
     * @Serializer\Groups({"DeserializeUserGroup","AppUserGroup","detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     * @Assert\NotBlank(message="Le champ userroles est obligatoire")
     */
    private $userRoles;



    /**
     * @ORM\OneToMany(targetEntity="Mfpe\AttestationBundle\Entity\Demande", mappedBy="user")
     * @Serializer\Groups({"detailDemande"})
     * @Serializer\Expose()
     */
    private $demandes;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->userRoles = new ArrayCollection();
        $this->dateInscription = new \DateTime();
        $this->firstLogin = 0;
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
     * Set username.
     *
     * @param string|null $username
     *
     * @return AppUser
     */
    public function setUsername($username = null)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username.
     *
     * @return string|null
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password.
     *
     * @param string|null $password
     *
     * @return AppUser
     */
    public function setPassword($password = null)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }


    /**
     * @return mixed
     */
    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    /**
     * @param mixed $plainPassword
     */
    public function setPlainPassword($plainPassword)
    {
        $this->plainPassword = $plainPassword;
        $this->password = null;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return AppUser
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
     * Set email
     *
     * @param boolean $enable
     *
     * @return AppUser
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return boolean
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set identifiant.
     *
     * @param string|null $identifiant
     *
     * @return AppUser
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
     * Set tel.
     *
     * @param string|null $tel
     *
     * @return AppUser
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
     * Set grade.
     *
     * @param string|null $grade
     *
     * @return AppUser
     */
    public function setGrade($grade = null)
    {
        $this->grade = $grade;

        return $this;
    }

    /**
     * Get grade.
     *
     * @return string|null
     */
    public function getGrade()
    {
        return $this->grade;
    }

    /**
     * Set premierResponsable.
     *
     * @param string|null $premierResponsable
     *
     * @return AppUser
     */
    public function setPremierResponsable($premierResponsable = null)
    {
        $this->premierResponsable = $premierResponsable;

        return $this;
    }

    /**
     * Get premierResponsable.
     *
     * @return string|null
     */
    public function getPremierResponsable()
    {
        return $this->premierResponsable;
    }

    /**
     * Set fonction.
     *
     * @param string|null $fonction
     *
     * @return AppUser
     */
    public function setFonction($fonction = null)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction.
     *
     * @return string|null
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set dateNaissance.
     *
     * @param \DateTime|null $dateNaissance
     *
     * @return AppUser
     */
    public function setDateNaissance($dateNaissance = null)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance.
     *
     * @return \DateTime|null
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set nomFr.
     *
     * @param string|null $nomFr
     *
     * @return AppUser
     */
    public function setNomFr($nomFr = null)
    {
        $this->nomFr = $nomFr;

        return $this;
    }

    /**
     * Get nomFr.
     *
     * @return string|null
     */
    public function getNomFr()
    {
        return $this->nomFr;
    }

    /**
     * Set nomAr.
     *
     * @param string|null $nomAr
     *
     * @return AppUser
     */
    public function setNomAr($nomAr = null)
    {
        $this->nomAr = $nomAr;

        return $this;
    }

    /**
     * Get nomAr.
     *
     * @return string|null
     */
    public function getNomAr()
    {
        return $this->nomAr;
    }

    /**
     * Set prenomFr.
     *
     * @param string|null $prenomFr
     *
     * @return AppUser
     */
    public function setPrenomFr($prenomFr = null)
    {
        $this->prenomFr = $prenomFr;

        return $this;
    }

    /**
     * Get prenomFr.
     *
     * @return string|null
     */
    public function getPrenomFr()
    {
        return $this->prenomFr;
    }

    /**
     * Set prenomAr.
     *
     * @param string|null $prenomAr
     *
     * @return AppUser
     */
    public function setPrenomAr($prenomAr = null)
    {
        $this->prenomAr = $prenomAr;

        return $this;
    }

    /**
     * Get prenomAr.
     *
     * @return string|null
     */
    public function getPrenomAr()
    {
        return $this->prenomAr;
    }

    /**
     * Set numCin.
     *
     * @param int|null $numCin
     *
     * @return AppUser
     */
    public function setNumCin($numCin = null)
    {
        $this->numCin = $numCin;

        return $this;
    }

    /**
     * Get numCin.
     *
     * @return int|null
     */
    public function getNumCin()
    {
        return $this->numCin;
    }

    /**
     * Set dateDelivranceCin.
     *
     * @param \DateTime|null $dateDelivranceCin
     *
     * @return AppUser
     */
    public function setDateDelivranceCin($dateDelivranceCin = null)
    {
        $this->dateDelivranceCin = $dateDelivranceCin;

        return $this;
    }

    /**
     * Get dateDelivranceCin.
     *
     * @return \DateTime|null
     */
    public function getDateDelivranceCin()
    {
        return $this->dateDelivranceCin;
    }

    /**
     * Set numPassport.
     *
     * @param string|null $numPassport
     *
     * @return AppUser
     */
    public function setNumPassport($numPassport = null)
    {
        $this->numPassport = $numPassport;

        return $this;
    }

    /**
     * Get numPassport.
     *
     * @return string|null
     */
    public function getNumPassport()
    {
        return $this->numPassport;
    }

    /**
     * Set dateDelivrancePassport.
     *
     * @param \DateTime|null $dateDelivrancePassport
     *
     * @return AppUser
     */
    public function setDateDelivrancePassport($dateDelivrancePassport = null)
    {
        $this->dateDelivrancePassport = $dateDelivrancePassport;

        return $this;
    }

    /**
     * Get dateDelivrancePassport.
     *
     * @return \DateTime|null
     */
    public function getDateDelivrancePassport()
    {
        return $this->dateDelivrancePassport;
    }

    /**
     * Set numCarteSejour.
     *
     * @param string|null $numCarteSejour
     *
     * @return AppUser
     */
    public function setNumCarteSejour($numCarteSejour = null)
    {
        $this->numCarteSejour = $numCarteSejour;

        return $this;
    }

    /**
     * Get numCarteSejour.
     *
     * @return string|null
     */
    public function getNumCarteSejour()
    {
        return $this->numCarteSejour;
    }

    /**
     * Set dateValiditeSejour.
     *
     * @param \DateTime|null $dateValiditeSejour
     *
     * @return AppUser
     */
    public function setDateValiditeSejour($dateValiditeSejour = null)
    {
        $this->dateValiditeSejour = $dateValiditeSejour;

        return $this;
    }

    /**
     * Get dateValiditeSejour.
     *
     * @return \DateTime|null
     */
    public function getDateValiditeSejour()
    {
        return $this->dateValiditeSejour;
    }

    /**
     * Set dateInscription.
     *
     * @param \DateTime|null $dateInscription
     *
     * @return AppUser
     */
    public function setDateInscription($dateInscription = null)
    {
        $this->dateInscription = $dateInscription;

        return $this;
    }

    /**
     * Get dateInscription.
     *
     * @return \DateTime|null
     */
    public function getDateInscription()
    {
        return $this->dateInscription;
    }

    /**
     * Set sexe.
     *
     * @param string|null $sexe
     *
     * @return AppUser
     */
    public function setSexe($sexe = null)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe.
     *
     * @return string|null
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set personneBesoinSpecifique.
     *
     * @param bool|null $personneBesoinSpecifique
     *
     * @return AppUser
     */
    public function setPersonneBesoinSpecifique($personneBesoinSpecifique = null)
    {
        $this->personneBesoinSpecifique = $personneBesoinSpecifique;

        return $this;
    }

    /**
     * Get personneBesoinSpecifique.
     *
     * @return bool|null
     */
    public function getPersonneBesoinSpecifique()
    {
        return $this->personneBesoinSpecifique;
    }

    /**
     * Set lieuNaissance.
     *
     * @param string|null $lieuNaissance
     *
     * @return AppUser
     */
    public function setLieuNaissance($lieuNaissance = null)
    {
        $this->lieuNaissance = $lieuNaissance;

        return $this;
    }

    /**
     * Get lieuNaissance.
     *
     * @return string|null
     */
    public function getLieuNaissance()
    {
        return $this->lieuNaissance;
    }

    /**
     * Set firstLogin.
     *
     * @param int|null $firstLogin
     *
     * @return AppUser
     */
    public function setFirstLogin($firstLogin = null)
    {
        $this->firstLogin = $firstLogin;

        return $this;
    }

    /**
     * Get firstLogin.
     *
     * @return int|null
     */
    public function getFirstLogin()
    {
        return $this->firstLogin;
    }

    /**
     * Set passwordPrint.
     *
     * @param string|null $passwordPrint
     *
     * @return AppUser
     */
    public function setPasswordPrint($passwordPrint = null)
    {
        $this->passwordPrint = $passwordPrint;

        return $this;
    }

    /**
     * Get passwordPrint.
     *
     * @return string|null
     */
    public function getPasswordPrint()
    {
        return $this->passwordPrint;
    }

    /**
     * Set nationalite.
     *
     * @param \Mfpe\ReferencielBundle\Entity\Referenciel|null $nationalite
     *
     * @return AppUser
     */
    public function setNationalite(\Mfpe\ReferencielBundle\Entity\RefNationalite $nationalite = null)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite.
     *
     * @return \Mfpe\ReferencielBundle\Entity\Referenciel|null
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set gouvernorat.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $gouvernorat
     *
     * @return AppUser
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
     * @return AppUser
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
     * Set natureBesoinSpecifique.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefNatureBesoinSpecifique|null $natureBesoinSpecifique
     *
     * @return AppUser
     */
    public function setNatureBesoinSpecifique(\Mfpe\ReferencielBundle\Entity\RefNatureBesoinSpecifique $natureBesoinSpecifique = null)
    {
        $this->natureBesoinSpecifique = $natureBesoinSpecifique;

        return $this;
    }

    /**
     * Get natureBesoinSpecifique.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefNatureBesoinSpecifique|null
     */
    public function getNatureBesoinSpecifique()
    {
        return $this->natureBesoinSpecifique;
    }

    /**
     * Set niveauEtude.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefNiveauEtude|null $niveauEtude
     *
     * @return AppUser
     */
    public function setNiveauEtude(\Mfpe\ReferencielBundle\Entity\RefNiveauEtude $niveauEtude = null)
    {
        $this->niveauEtude = $niveauEtude;

        return $this;
    }

    /**
     * Get niveauEtude.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefNiveauEtude|null
     */
    public function getNiveauEtude()
    {
        return $this->niveauEtude;
    }

    /**
     * Set uniteRegionale.
     *
     * @param \Mfpe\UniteRegionaleBundle\Entity\UniteRegionale|null $uniteRegionale
     *
     * @return AppUser
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
     * @return \Doctrine\Common\Collections\Collection|Role[]
     */
    public function getUserRoles()
    {
        return $this->userRoles;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection|Role[] $roles
     */
    public function setUserRoles($roles)
    {
        $this->userRoles = $roles;
    }

    /**
     * @param Role $role
     */
    public function addRole(Role $role)
    {
        if ($this->userRoles->contains($role)) {
            return;
        }
        $this->userRoles->add($role);
        $role->addUser($this);
    }

    /**
     * @param Role $role
     */
    public function removeRole(Role $role)
    {
        if (!$this->userRoles->contains($role)) {
            return;
        }
        $this->userRoles->removeElement($role);
        $role->removeUser($this);
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return [];
    }

    /**
     * Add userRole.
     *
     * @param \Mfpe\ConfigBundle\Entity\Role $userRole
     *
     * @return AppUser
     */
    public function addUserRole(\Mfpe\ConfigBundle\Entity\Role $userRole)
    {
        $this->userRoles[] = $userRole;

        return $this;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        //$this->password='';
    }

    /**
     * Remove userRole.
     *
     * @param \Mfpe\ConfigBundle\Entity\Role $userRole
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeUserRole(\Mfpe\ConfigBundle\Entity\Role $userRole)
    {
        return $this->userRoles->removeElement($userRole);
    }

    /**
     * Set structure.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefStructure|null $structure
     *
     * @return AppUser
     */
    public function setStructure(\Mfpe\ReferencielBundle\Entity\RefStructure $structure = null)
    {
        $this->structure = $structure;

        return $this;
    }

    /**
     * Get structure.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefStructure|null
     */
    public function getStructure()
    {
        return $this->structure;
    }

    /**
     * Add demande.
     *
     * @param \Mfpe\AttestationBundle\Entity\Demande $demande
     *
     * @return AppUser
     */
    public function addDemande(\Mfpe\AttestationBundle\Entity\Demande $demande)
    {
        $this->demandes[] = $demande;

        return $this;
    }

    /**
     * Remove demande.
     *
     * @param \Mfpe\AttestationBundle\Entity\Demande $demande
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDemande(\Mfpe\AttestationBundle\Entity\Demande $demande)
    {
        return $this->demandes->removeElement($demande);
    }

    /**
     * Get demandes.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDemandes()
    {
        return $this->demandes;
    }

    /**
     * Set centreFormation.
     *
     * @param \Mfpe\CentreFormationBundle\Entity\CentreFormation|null $centreFormation
     *
     * @return AppUser
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
     * Set gouvernoratResidence.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $gouvernoratResidence
     *
     * @return AppUser
     */
    public function setGouvernoratResidence(\Mfpe\ReferencielBundle\Entity\RefGouvernorat $gouvernoratResidence = null)
    {
        $this->gouvernoratResidence = $gouvernoratResidence;

        return $this;
    }

    /**
     * Get gouvernoratResidence.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null
     */
    public function getGouvernoratResidence()
    {
        return $this->gouvernoratResidence;
    }

    /**
     * Set delegationResidence.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefDelegation|null $delegationResidence
     *
     * @return AppUser
     */
    public function setDelegationResidence(\Mfpe\ReferencielBundle\Entity\RefDelegation $delegationResidence = null)
    {
        $this->delegationResidence = $delegationResidence;

        return $this;
    }

    /**
     * Get delegationResidence.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefDelegation|null
     */
    public function getDelegationResidence()
    {
        return $this->delegationResidence;
    }


}
