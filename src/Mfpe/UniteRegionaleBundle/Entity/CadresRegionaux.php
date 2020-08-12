<?php

namespace Mfpe\UniteRegionaleBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;

use Mfpe\ConfigBundle\Entity\AbstractEntity;


/**
 * CadresRegionaux
 *
 * @ORM\Table(name="cadres_regionaux")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\UniteRegionaleBundle\Repository\CadresRegionauxRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */

class CadresRegionaux
{
    use AbstractEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"cadreGroup"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_fr", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"cadreGroup"})
     * @Serializer\Expose()
     */
    private $nomFr;
    /**
     * @var string|null
     *
     * @ORM\Column(name="nom_ar", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"cadreGroup"})
     * @Serializer\Expose()
     */
    private $nomAr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom_fr", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"cadreGroup"})
     * @Serializer\Expose()
     */
    private $prenomFr;
    /**
     * @var string|null
     *
     * @ORM\Column(name="prenom_ar", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"cadreGroup"})
     * @Serializer\Expose()
     */
    private $prenomAr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="contact", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"cadreGroup"})
     * @Serializer\Expose()
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefFonctionCadreRegion")
     * @ORM\JoinColumn(name="fonction_cadre", referencedColumnName="id")
     * @Serializer\Groups({"cadreGroup"})
     * @Serializer\Expose()
     */
    private $fonctionCadre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="adresse", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"cadreGroup"})
     * @Serializer\Expose()
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\UniteRegionaleBundle\Entity\IdentiteRegion",inversedBy="cadresRegions")
     * @ORM\JoinColumn(name="identite_region_id", referencedColumnName="id")
     * @Serializer\Groups({"cadreGroup"})
     * @Serializer\Expose()
     */
    private $identiteRegionId;

    

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
     * Set nomFr.
     *
     * @param string|null $nomFr
     *
     * @return CadresRegionaux
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
     * @return CadresRegionaux
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
     * @return CadresRegionaux
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
     * @return CadresRegionaux
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
     * Set contact.
     *
     * @param string|null $contact
     *
     * @return CadresRegionaux
     */
    public function setContact($contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact.
     *
     * @return string|null
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set adresse.
     *
     * @param string|null $adresse
     *
     * @return CadresRegionaux
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
     * Set fonctionCadre.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefFonctionCadreRegion|null $fonctionCadre
     *
     * @return CadresRegionaux
     */
    public function setFonctionCadre(\Mfpe\ReferencielBundle\Entity\RefFonctionCadreRegion $fonctionCadre = null)
    {
        $this->fonctionCadre = $fonctionCadre;

        return $this;
    }

    /**
     * Get fonctionCadre.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefFonctionCadreRegion|null
     */
    public function getFonctionCadre()
    {
        return $this->fonctionCadre;
    }

    /**
     * Set identiteRegionId.
     *
     * @param \Mfpe\UniteRegionaleBundle\Entity\IdentiteRegion|null $identiteRegionId
     *
     * @return CadresRegionaux
     */
    public function setIdentiteRegionId(\Mfpe\UniteRegionaleBundle\Entity\IdentiteRegion $identiteRegionId = null)
    {
        $this->identiteRegionId = $identiteRegionId;

        return $this;
    }

    /**
     * Get identiteRegionId.
     *
     * @return \Mfpe\UniteRegionaleBundle\Entity\IdentiteRegion|null
     */
    public function getIdentiteRegionId()
    {
        return $this->identiteRegionId;
    }
    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return CadresRegionaux
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
