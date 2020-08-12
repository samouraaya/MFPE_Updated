<?php


namespace Mfpe\CollectDataBundle\Entity;

namespace Mfpe\CollectDataBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\Groups;
use Mfpe\ConfigBundle\Entity\AbstractEntity;


/**
 * StatGraduateTraining
 *
 * @ORM\Table(name="Aneti_table1")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\CollectDataBundle\Repository\AnetiTable1Repository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class AnetiTable1
{

    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="annee", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */
    private $annee;

    /**
     * @var int|null
     *
     * @ORM\Column(name="mois", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */
    private $mois;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_aneti", type="datetime",nullable=true)
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */
    private $dateAneti;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_gouvernorat", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */
    private $idGouvernorat;
    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="governorat", referencedColumnName="id")
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */

    private $gouvernorat;
    /**
     * @var string|null
     *
     * @ORM\Column(name="lib_gouvernorat", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */
    private $libGouvernorat;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_delegation", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */
    private $idDelegation;
    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefDelegation")
     * @ORM\JoinColumn(name="delegation", referencedColumnName="id")
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */
    private $delegation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lib_delegation", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */

    private $libDelegation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bureau", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */

    private $bureau;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lib_bureau", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */

    private $libBureau;

    /**
     * @var string|null
     *
     * @ORM\Column(name="genre", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */
    private $genre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dip_sup", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */

    private $dipSup;

    /**
     * @var string|null
     *
     * @ORM\Column(name="indicateur", type="string", length=30, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */

    private $indicateur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"AnetiGroup"})
     * @Serializer\Expose()
     */

    private $nombre;

  

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
     * Set annee.
     *
     * @param int|null $annee
     *
     * @return Aneti
     */
    public function setAnnee($annee = null)
    {
        $this->annee = $annee;

        return $this;
    }

    /**
     * Get annee.
     *
     * @return int|null
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * Set mois.
     *
     * @param int|null $mois
     *
     * @return Aneti
     */
    public function setMois($mois = null)
    {
        $this->mois = $mois;

        return $this;
    }

    /**
     * Get mois.
     *
     * @return int|null
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set idGouvernorat.
     *
     * @param int|null $idGouvernorat
     *
     * @return Aneti
     */
    public function setIdGouvernorat($idGouvernorat = null)
    {
        $this->idGouvernorat = $idGouvernorat;

        return $this;
    }

    /**
     * Get idGouvernorat.
     *
     * @return int|null
     */
    public function getIdGouvernorat()
    {
        return $this->idGouvernorat;
    }

    /**
     * Set libGouvernorat.
     *
     * @param string|null $libGouvernorat
     *
     * @return Aneti
     */
    public function setLibGouvernorat($libGouvernorat = null)
    {
        $this->libGouvernorat = $libGouvernorat;

        return $this;
    }

    /**
     * Get libGouvernorat.
     *
     * @return string|null
     */
    public function getLibGouvernorat()
    {
        return $this->libGouvernorat;
    }

    /**
     * Set idDelegation.
     *
     * @param int|null $idDelegation
     *
     * @return Aneti
     */
    public function setIdDelegation($idDelegation = null)
    {
        $this->idDelegation = $idDelegation;

        return $this;
    }

    /**
     * Get idDelegation.
     *
     * @return int|null
     */
    public function getIdDelegation()
    {
        return $this->idDelegation;
    }

    /**
     * Set libDelegation.
     *
     * @param string|null $libDelegation
     *
     * @return Aneti
     */
    public function setLibDelegation($libDelegation = null)
    {
        $this->libDelegation = $libDelegation;

        return $this;
    }

    /**
     * Get libDelegation.
     *
     * @return string|null
     */
    public function getLibDelegation()
    {
        return $this->libDelegation;
    }

    /**
     * Set bureau.
     *
     * @param string|null $bureau
     *
     * @return Aneti
     */
    public function setBureau($bureau = null)
    {
        $this->bureau = $bureau;

        return $this;
    }

    /**
     * Get bureau.
     *
     * @return string|null
     */
    public function getBureau()
    {
        return $this->bureau;
    }

    /**
     * Set libBureau.
     *
     * @param string|null $libBureau
     *
     * @return Aneti
     */
    public function setLibBureau($libBureau = null)
    {
        $this->libBureau = $libBureau;

        return $this;
    }

    /**
     * Get libBureau.
     *
     * @return string|null
     */
    public function getLibBureau()
    {
        return $this->libBureau;
    }

    /**
     * Set genre.
     *
     * @param string|null $genre
     *
     * @return Aneti
     */
    public function setGenre($genre = null)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre.
     *
     * @return string|null
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * Set dipSup.
     *
     * @param string|null $dipSup
     *
     * @return Aneti
     */
    public function setDipSup($dipSup = null)
    {
        $this->dipSup = $dipSup;

        return $this;
    }

    /**
     * Get dipSup.
     *
     * @return string|null
     */
    public function getDipSup()
    {
        return $this->dipSup;
    }

    /**
     * Set indicateur.
     *
     * @param string|null $indicateur
     *
     * @return Aneti
     */
    public function setIndicateur($indicateur = null)
    {
        $this->indicateur = $indicateur;

        return $this;
    }

    /**
     * Get indicateur.
     *
     * @return string|null
     */
    public function getIndicateur()
    {
        return $this->indicateur;
    }

    /**
     * Set nombre.
     *
     * @param int|null $nombre
     *
     * @return Aneti
     */
    public function setNombre($nombre = null)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre.
     *
     * @return int|null
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set gouvernorat.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $gouvernorat
     *
     * @return Aneti
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
     * @return Aneti
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
     * Set dateAneti.
     *
     * @param \DateTime|null $dateAneti
     *
     * @return AnetiTable1
     */
    public function setDateAneti($dateAneti = null)
    {
        $this->dateAneti = $dateAneti;

        return $this;
    }

    /**
     * Get dateAneti.
     *
     * @return \DateTime|null
     */
    public function getDateAneti()
    {
        return $this->dateAneti;
    }

    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return Aneti
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
}
