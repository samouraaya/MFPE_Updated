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
 * AnetiTable2
 *
 * @ORM\Table(name="Aneti_table2")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\CollectDataBundle\Repository\AnetiTable2Repository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class AnetiTable2
{

    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="annee", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */
    private $annee;

    /**
     * @var int|null
     *
     * @ORM\Column(name="mois", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"MoeGroup"})
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
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */


    private $idGouvernorat;
    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="governorat", referencedColumnName="id")
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */

    private $gouvernorat;
    /**
     * @var string|null
     *
     * @ORM\Column(name="lib_gouvernorat", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */
    private $libGouvernorat;

    /**
     * @var int|null
     *
     * @ORM\Column(name="id_delegation", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */
    private $idDelegation;
    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefDelegation")
     * @ORM\JoinColumn(name="delegation", referencedColumnName="id")
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */
    private $delegation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lib_delegation", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */

    private $libDelegation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bureau", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */

    private $bureau;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lib_bureau", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */

    private $libBureau;

    /**
     * @var string|null
     *
     * @ORM\Column(name="id_sector", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */
    private $idSector;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefSecteur")
     * @ORM\JoinColumn(name="sector", referencedColumnName="id")
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $sector;

    /**
     * @var string|null
     *
     * @ORM\Column(name="lib_sector", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */
    private $libSector;
    /**
     * @var string|null
     *
     * @ORM\Column(name="taille", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */
    private $taille;
    /**
     * @var string|null
     *
     * @ORM\Column(name="lib_taille", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"MoeGroup"})
     * @Serializer\Expose()
     */
    private $libTaille;
    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"MoeGroup"})
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
     * @return AnetiTable2
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
     * @return AnetiTable2
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
     * @return AnetiTable2
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
     * @return AnetiTable2
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
     * @return AnetiTable2
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
     * @return AnetiTable2
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
     * @return AnetiTable2
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
     * @return AnetiTable2
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
     * Set idSector.
     *
     * @param string|null $idSector
     *
     * @return AnetiTable2
     */
    public function setIdSector($idSector = null)
    {
        $this->idSector = $idSector;

        return $this;
    }

    /**
     * Get idSector.
     *
     * @return string|null
     */
    public function getIdSector()
    {
        return $this->idSector;
    }

    /**
     * Set libSector.
     *
     * @param string|null $libSector
     *
     * @return AnetiTable2
     */
    public function setLibSector($libSector = null)
    {
        $this->libSector = $libSector;

        return $this;
    }

    /**
     * Get libSector.
     *
     * @return string|null
     */
    public function getLibSector()
    {
        return $this->libSector;
    }

    /**
     * Set taille.
     *
     * @param string|null $taille
     *
     * @return AnetiTable2
     */
    public function setTaille($taille = null)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille.
     *
     * @return string|null
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set libTaille.
     *
     * @param string|null $libTaille
     *
     * @return AnetiTable2
     */
    public function setLibTaille($libTaille = null)
    {
        $this->libTaille = $libTaille;

        return $this;
    }

    /**
     * Get libTaille.
     *
     * @return string|null
     */
    public function getLibTaille()
    {
        return $this->libTaille;
    }

    /**
     * Set nombre.
     *
     * @param int|null $nombre
     *
     * @return AnetiTable2
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
     * @return AnetiTable2
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
     * @return AnetiTable2
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
     * Set sector.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefSecteur|null $sector
     *
     * @return AnetiTable2
     */
    public function setSector(\Mfpe\ReferencielBundle\Entity\RefSecteur $sector = null)
    {
        $this->sector = $sector;

        return $this;
    }

    /**
     * Get sector.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefSecteur|null
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * Set dateAneti.
     *
     * @param \DateTime|null $dateAneti
     *
     * @return AnetiTable2
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
     * @return AnetiTable2
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
