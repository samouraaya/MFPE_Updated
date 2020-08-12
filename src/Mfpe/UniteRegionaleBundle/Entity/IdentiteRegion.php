<?php

namespace Mfpe\UniteRegionaleBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;

use Mfpe\ConfigBundle\Entity\AbstractEntity;


/**
 * IdentiteRegion
 *
 * @ORM\Table(name="identite_region")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\UniteRegionaleBundle\Repository\IdentiteRegionRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */

class IdentiteRegion
{
    use AbstractEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"regionGroup","cadreGroup"})
     * @Serializer\Expose()
     */
    private $id;


    /**
     * @ORM\Column(type="integer", name="nbr_localite", nullable=true)
     * @Serializer\Groups({"regionGroup","cadreGroup"})
     * @Serializer\Expose()
     */
    private $nbrLocalities;
    /**
     * @ORM\Column(type="integer", name="nbr_municipalities", nullable=true)
     * @Serializer\Groups({"regionGroup","cadreGroup"})
     * @Serializer\Expose()
     */
    private $nbrMunicipalities;
    /**
     * @ORM\Column(type="integer", name="nbr_private_training_centers", nullable=true)
     * @Serializer\Groups({"regionGroup","cadreGroup"})
     * @Serializer\Expose()
     */
    private $nbrPrivateTrainingCenters;
    /**
     * @ORM\Column(type="integer", name="nbr_public_training_centers", nullable=true)
     * @Serializer\Groups({"regionGroup","cadreGroup"})
     * @Serializer\Expose()
     */
    private $nbrPublicTrainingCenters;
    /**
     * @ORM\Column(type="integer", name="nbr_employment_offices", nullable=true)
     * @Serializer\Groups({"regionGroup","cadreGroup"})
     * @Serializer\Expose()
     */
    private $nbrEmploymentOffices;
    /**
     * @ORM\Column(type="integer", name="nbr_spaces_undertake", nullable=true)
     * @Serializer\Groups({"regionGroup","cadreGroup"})
     * @Serializer\Expose()
     */
    private $nbrSpacesUndertake;
    /**
     * @ORM\Column(type="integer", name="nbr_regional_continuing_education_units", nullable=true)
     * @Serializer\Groups({"regionGroup","cadreGroup"})
     * @Serializer\Expose()
     */
    private $nbrRegionalContinuingEducationUnits;


    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="gouvernorate", referencedColumnName="id")
     * @Serializer\Groups({"regionGroup"})
     * @Serializer\Expose()
     */
    private $gouvernorate;

    /**
     * @ORM\OneToMany(targetEntity="Mfpe\UniteRegionaleBundle\Entity\Description", mappedBy="identiteRegion")
     * @Serializer\Groups({"regionGroup"})
     * @Serializer\Expose()
     */
    private $descriptions;

    /**
     * @ORM\OneToMany(targetEntity="Mfpe\UniteRegionaleBundle\Entity\CadresRegionaux", mappedBy="identiteRegionId")
     * @Serializer\Groups({"regionGroup","cadreGroup"})
     * @Serializer\Expose()
     */
    private $cadresRegions;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description_region", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"descriptionGroup"})
     * @Serializer\Expose()
     */
    private $descriptionRegion;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->descriptions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->cadresRegions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set nbrLocalities.
     *
     * @param int|null $nbrLocalities
     *
     * @return IdentiteRegion
     */
    public function setNbrLocalities($nbrLocalities = null)
    {
        $this->nbrLocalities = $nbrLocalities;

        return $this;
    }

    /**
     * Get nbrLocalities.
     *
     * @return int|null
     */
    public function getNbrLocalities()
    {
        return $this->nbrLocalities;
    }

    /**
     * Set nbrMunicipalities.
     *
     * @param int|null $nbrMunicipalities
     *
     * @return IdentiteRegion
     */
    public function setNbrMunicipalities($nbrMunicipalities = null)
    {
        $this->nbrMunicipalities = $nbrMunicipalities;

        return $this;
    }

    /**
     * Get nbrMunicipalities.
     *
     * @return int|null
     */
    public function getNbrMunicipalities()
    {
        return $this->nbrMunicipalities;
    }

    /**
     * Set nbrPrivateTrainingCenters.
     *
     * @param int|null $nbrPrivateTrainingCenters
     *
     * @return IdentiteRegion
     */
    public function setNbrPrivateTrainingCenters($nbrPrivateTrainingCenters = null)
    {
        $this->nbrPrivateTrainingCenters = $nbrPrivateTrainingCenters;

        return $this;
    }

    /**
     * Get nbrPrivateTrainingCenters.
     *
     * @return int|null
     */
    public function getNbrPrivateTrainingCenters()
    {
        return $this->nbrPrivateTrainingCenters;
    }

    /**
     * Set nbrPublicTrainingCenters.
     *
     * @param int|null $nbrPublicTrainingCenters
     *
     * @return IdentiteRegion
     */
    public function setNbrPublicTrainingCenters($nbrPublicTrainingCenters = null)
    {
        $this->nbrPublicTrainingCenters = $nbrPublicTrainingCenters;

        return $this;
    }

    /**
     * Get nbrPublicTrainingCenters.
     *
     * @return int|null
     */
    public function getNbrPublicTrainingCenters()
    {
        return $this->nbrPublicTrainingCenters;
    }

    /**
     * Set nbrEmploymentOffices.
     *
     * @param int|null $nbrEmploymentOffices
     *
     * @return IdentiteRegion
     */
    public function setNbrEmploymentOffices($nbrEmploymentOffices = null)
    {
        $this->nbrEmploymentOffices = $nbrEmploymentOffices;

        return $this;
    }

    /**
     * Get nbrEmploymentOffices.
     *
     * @return int|null
     */
    public function getNbrEmploymentOffices()
    {
        return $this->nbrEmploymentOffices;
    }

    /**
     * Set nbrSpacesUndertake.
     *
     * @param int|null $nbrSpacesUndertake
     *
     * @return IdentiteRegion
     */
    public function setNbrSpacesUndertake($nbrSpacesUndertake = null)
    {
        $this->nbrSpacesUndertake = $nbrSpacesUndertake;

        return $this;
    }

    /**
     * Get nbrSpacesUndertake.
     *
     * @return int|null
     */
    public function getNbrSpacesUndertake()
    {
        return $this->nbrSpacesUndertake;
    }

    /**
     * Set nbrRegionalContinuingEducationUnits.
     *
     * @param int|null $nbrRegionalContinuingEducationUnits
     *
     * @return IdentiteRegion
     */
    public function setNbrRegionalContinuingEducationUnits($nbrRegionalContinuingEducationUnits = null)
    {
        $this->nbrRegionalContinuingEducationUnits = $nbrRegionalContinuingEducationUnits;

        return $this;
    }

    /**
     * Get nbrRegionalContinuingEducationUnits.
     *
     * @return int|null
     */
    public function getNbrRegionalContinuingEducationUnits()
    {
        return $this->nbrRegionalContinuingEducationUnits;
    }

    /**
     * Set descriptionRegion.
     *
     * @param string|null $descriptionRegion
     *
     * @return IdentiteRegion
     */
    public function setDescriptionRegion($descriptionRegion = null)
    {
        $this->descriptionRegion = $descriptionRegion;

        return $this;
    }

    /**
     * Get descriptionRegion.
     *
     * @return string|null
     */
    public function getDescriptionRegion()
    {
        return $this->descriptionRegion;
    }

    /**
     * Set gouvernorate.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $gouvernorate
     *
     * @return IdentiteRegion
     */
    public function setGouvernorate(\Mfpe\ReferencielBundle\Entity\RefGouvernorat $gouvernorate = null)
    {
        $this->gouvernorate = $gouvernorate;

        return $this;
    }

    /**
     * Get gouvernorate.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null
     */
    public function getGouvernorate()
    {
        return $this->gouvernorate;
    }

    /**
     * Add description.
     *
     * @param \Mfpe\UniteRegionaleBundle\Entity\Description $description
     *
     * @return IdentiteRegion
     */
    public function addDescription(\Mfpe\UniteRegionaleBundle\Entity\Description $description)
    {
        $this->descriptions[] = $description;

        return $this;
    }

    /**
     * Remove description.
     *
     * @param \Mfpe\UniteRegionaleBundle\Entity\Description $description
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeDescription(\Mfpe\UniteRegionaleBundle\Entity\Description $description)
    {
        return $this->descriptions->removeElement($description);
    }

    /**
     * Get descriptions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDescriptions()
    {
        return $this->descriptions;
    }

    /**
     * Add cadresRegion.
     *
     * @param \Mfpe\UniteRegionaleBundle\Entity\CadresRegionaux $cadresRegion
     *
     * @return IdentiteRegion
     */
    public function addCadresRegion(\Mfpe\UniteRegionaleBundle\Entity\CadresRegionaux $cadresRegion)
    {
        $this->cadresRegions[] = $cadresRegion;

        return $this;
    }

    /**
     * Remove cadresRegion.
     *
     * @param \Mfpe\UniteRegionaleBundle\Entity\CadresRegionaux $cadresRegion
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCadresRegion(\Mfpe\UniteRegionaleBundle\Entity\CadresRegionaux $cadresRegion)
    {
        return $this->cadresRegions->removeElement($cadresRegion);
    }

    /**
     * Get cadresRegions.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCadresRegions()
    {
        return $this->cadresRegions;
    }

    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return IdentiteRegion
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
