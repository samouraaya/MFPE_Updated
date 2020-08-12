<?php

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
 * @ORM\Table(name="stat_graduate_training")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\CollectDataBundle\Repository\StatGraduateTrainingRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class StatGraduateTraining
{

    use AbstractEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"listStatGraduateTraining","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var \trainingCenter
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\CentreFormationBundle\Entity\CentreFormation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="training_center", referencedColumnName="id")
     * })
     * @Serializer\Groups({"listStatGraduateTraining","detailStatGraduateTraining","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $trainingCenter;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefSecteur")
     * @ORM\JoinColumn(name="sector", referencedColumnName="id")
     * @Serializer\Groups({"listStatGraduateTraining","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $sector;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefSousSecteur")
     * @ORM\JoinColumn(name="subsector", referencedColumnName="id")
     * @Serializer\Groups({"listStatGraduateTraining","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $subsector;

    /**
     * @var \specialty
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\CentreFormationBundle\Entity\Specialite")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="speciality", referencedColumnName="id")
     * })
     * @Serializer\Groups({"listStatGraduateTraining","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $speciality;

    /**
     * @var bool
     *
     * @ORM\Column(name="approved", type="boolean", options={"default":"0"})
     * @Serializer\Groups({"listStatGraduateTraining","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $approved;

    /**
     * @var \Year
     *
     * @ORM\Column(name="administrative_year", columnDefinition="YEAR", nullable=true)
     * @Serializer\Groups({"listStatGraduateTraining","detailEtatiqueStatGraduateTraining","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $administrativeYear;

    /**
     * @ORM\Column(type="integer", name="month", nullable=true)
     * @Serializer\Groups({"listStatGraduateTraining","detailEtatiqueStatGraduateTraining","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $month;

    /**
     * @var string
     *
     * @ORM\Column(name="sector_type", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $sectorType;

    /**
     * @ORM\OneToMany(targetEntity="LevelStudy", mappedBy="statGraduateTraining")
     * @Serializer\Groups({"detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $levelStudy;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_stat_graduate_training", type="datetime",nullable=true)
     * @Serializer\Groups({"listStatGraduateTraining","detailEtatiqueStatGraduateTraining","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $dateStatGraduateTraining;

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
     * Set approved.
     *
     * @param bool $approved
     *
     * @return StatGraduateTraining
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved.
     *
     * @return bool
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set administrativeYear.
     *
     * @param string|null $administrativeYear
     *
     * @return StatGraduateTraining
     */
    public function setAdministrativeYear($administrativeYear = null)
    {
        $this->administrativeYear = $administrativeYear;

        return $this;
    }

    /**
     * Get administrativeYear.
     *
     * @return string|null
     */
    public function getAdministrativeYear()
    {
        return $this->administrativeYear;
    }

    /**
     * Set trainingCenter.
     *
     * @param \Mfpe\CentreFormationBundle\Entity\CentreFormation|null $trainingCenter
     *
     * @return StatGraduateTraining
     */
    public function setTrainingCenter(\Mfpe\CentreFormationBundle\Entity\CentreFormation $trainingCenter = null)
    {
        $this->trainingCenter = $trainingCenter;

        return $this;
    }

    /**
     * Get trainingCenter.
     *
     * @return \Mfpe\CentreFormationBundle\Entity\CentreFormation|null
     */
    public function getTrainingCenter()
    {
        return $this->trainingCenter;
    }

    /**
     * Set sector.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefSecteur|null $sector
     *
     * @return StatGraduateTraining
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
     * Set subsector.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefSousSecteur|null $subsector
     *
     * @return StatGraduateTraining
     */
    public function setSubsector(\Mfpe\ReferencielBundle\Entity\RefSousSecteur $subsector = null)
    {
        $this->subsector = $subsector;

        return $this;
    }

    /**
     * Get subsector.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefSousSecteur|null
     */
    public function getSubsector()
    {
        return $this->subsector;
    }

    /**
     * Set speciality.
     *
     * @param \Mfpe\CentreFormationBundle\Entity\Specialite|null $speciality
     *
     * @return StatGraduateTraining
     */
    public function setSpeciality(\Mfpe\CentreFormationBundle\Entity\Specialite $speciality = null)
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * Get speciality.
     *
     * @return \Mfpe\CentreFormationBundle\Entity\Specialite|null
     */
    public function getSpeciality()
    {
        return $this->speciality;
    }

    
    /**
     * Set month.
     *
     * @param int|null $month
     *
     * @return StatGraduateTraining
     */
    public function setMonth($month = null)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month.
     *
     * @return int|null
     */
    public function getMonth()
    {
        return $this->month;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->levelStudy = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add levelStudy.
     *
     * @param \Mfpe\CollectDataBundle\Entity\LevelStudy $levelStudy
     *
     * @return StatGraduateTraining
     */
    public function addLevelStudy(\Mfpe\CollectDataBundle\Entity\LevelStudy $levelStudy)
    {
        $this->levelStudy[] = $levelStudy;

        return $this;
    }

    /**
     * Remove levelStudy.
     *
     * @param \Mfpe\CollectDataBundle\Entity\LevelStudy $levelStudy
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeLevelStudy(\Mfpe\CollectDataBundle\Entity\LevelStudy $levelStudy)
    {
        return $this->levelStudy->removeElement($levelStudy);
    }

    /**
     * Get levelStudy.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLevelStudy()
    {
        return $this->levelStudy;
    }



    /**
     * Set sectorType.
     *
     * @param string|null $sectorType
     *
     * @return StatGraduateTraining
     */
    public function setSectorType($sectorType = null)
    {
        $this->sectorType = $sectorType;

        return $this;
    }

    /**
     * Get sectorType.
     *
     * @return string|null
     */
    public function getSectorType()
    {
        return $this->sectorType;
    }
    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return StatGraduateTraining
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
     * Set dateStatGraduateTraining.
     *
     * @param \DateTime|null $dateStatGraduateTraining
     *
     * @return StatGraduateTraining
     */
    public function setDateStatGraduateTraining($dateStatGraduateTraining = null)
    {
        $this->dateStatGraduateTraining = $dateStatGraduateTraining;

        return $this;
    }

    /**
     * Get dateStatGraduateTraining.
     *
     * @return \DateTime|null
     */
    public function getDateStatGraduateTraining()
    {
        return $this->dateStatGraduateTraining;
    }
}
