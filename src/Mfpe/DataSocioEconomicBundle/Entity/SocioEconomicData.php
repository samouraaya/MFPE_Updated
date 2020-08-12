<?php

namespace Mfpe\DataSocioEconomicBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Mfpe\ConfigBundle\Entity\AbstractEntity;
use Mfpe\CollectDataBundle\Entity\UniteRegionale;


/**
 * SocioEconomicData
 *
 * @ORM\Table(name="socio_economic_data")
 * @ORM\Entity(repositoryClass="Mfpe\DataSocioEconomicBundle\Repository\SocioEconomicDataRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class SocioEconomicData
{
    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\UniteRegionaleBundle\Entity\UniteRegionale")
     * @ORM\JoinColumn(name="direction_regionale", referencedColumnName="id")
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $directionRegional;
    /**
     * @var bigint
     *
     * @ORM\Column(name="health_institution_number", type="bigint", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $healthInstitutionNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="health_institution_year", columnDefinition="YEAR", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose())
     */
    private $healthInstitutionYear;


    /**
     * @var bigint
     *
     * @ORM\Column(name="school_institution_number", type="bigint", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $schoolInstitutionNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="school_institution_year", columnDefinition="YEAR", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose())
     */
    private $schoolInstitutionYear;

    /**
     * @var bigint
     *
     * @ORM\Column(name="university_institution_number", type="bigint", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $universityInstitutionNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="institution_university_year", columnDefinition="YEAR", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose())
     */
    private $institutionUniversityYear;
    /**
     * @var bigint
     *
     * @ORM\Column(name="dropout_school_number", type="bigint", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $dropoutSchoolNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dropout_school_year", columnDefinition="YEAR", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose())
     */
    private $dropoutSchoolYear;


    /**
     * @var bigint
     *
     * @ORM\Column(name="needy_family_number", type="bigint", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $needyFamilyNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="needy_family_year", columnDefinition="YEAR", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose())
     */
    private $needyFamilyYear;

    /**
     * @var bigint
     *
     * @ORM\Column(name="association_number", type="bigint", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $associationNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="association_year", columnDefinition="YEAR", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose())
     */
    private $associationYear;

    /**
     * @var string|null
     *
     * @ORM\Column(name="current_project", type="string", length=255, nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $currentProject;

    /**
     * @var text|null
     *
     * @ORM\Column(name="description", type="text", length=255, nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $description;


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
     * Set healthInstitutionNumber.
     *
     * @param int $healthInstitutionNumber
     *
     * @return SocioEconomicData
     */
    public function setHealthInstitutionNumber($healthInstitutionNumber)
    {
        $this->healthInstitutionNumber = $healthInstitutionNumber;

        return $this;
    }

    /**
     * Get healthInstitutionNumber.
     *
     * @return int
     */
    public function getHealthInstitutionNumber()
    {
        return $this->healthInstitutionNumber;
    }

    /**
     * Set healthInstitutionYear.
     *
     * @param string $healthInstitutionYear
     *
     * @return SocioEconomicData
     */
    public function setHealthInstitutionYear($healthInstitutionYear)
    {
        $this->healthInstitutionYear = $healthInstitutionYear;

        return $this;
    }

    /**
     * Get healthInstitutionYear.
     *
     * @return string
     */
    public function getHealthInstitutionYear()
    {
        return $this->healthInstitutionYear;
    }

    /**
     * Set schoolInstitutionNumber.
     *
     * @param int $schoolInstitutionNumber
     *
     * @return SocioEconomicData
     */
    public function setSchoolInstitutionNumber($schoolInstitutionNumber)
    {
        $this->schoolInstitutionNumber = $schoolInstitutionNumber;

        return $this;
    }

    /**
     * Get schoolInstitutionNumber.
     *
     * @return int
     */
    public function getSchoolInstitutionNumber()
    {
        return $this->schoolInstitutionNumber;
    }

    /**
     * Set schoolInstitutionYear.
     *
     * @param string $schoolInstitutionYear
     *
     * @return SocioEconomicData
     */
    public function setSchoolInstitutionYear($schoolInstitutionYear)
    {
        $this->schoolInstitutionYear = $schoolInstitutionYear;

        return $this;
    }

    /**
     * Get schoolInstitutionYear.
     *
     * @return string
     */
    public function getSchoolInstitutionYear()
    {
        return $this->schoolInstitutionYear;
    }

    /**
     * Set universityInstitutionNumber.
     *
     * @param int $universityInstitutionNumber
     *
     * @return SocioEconomicData
     */
    public function setUniversityInstitutionNumber($universityInstitutionNumber)
    {
        $this->universityInstitutionNumber = $universityInstitutionNumber;

        return $this;
    }

    /**
     * Get universityInstitutionNumber.
     *
     * @return int
     */
    public function getUniversityInstitutionNumber()
    {
        return $this->universityInstitutionNumber;
    }

    /**
     * Set institutionUniversityYear.
     *
     * @param string $institutionUniversityYear
     *
     * @return SocioEconomicData
     */
    public function setInstitutionUniversityYear($institutionUniversityYear)
    {
        $this->institutionUniversityYear = $institutionUniversityYear;

        return $this;
    }

    /**
     * Get institutionUniversityYear.
     *
     * @return string
     */
    public function getInstitutionUniversityYear()
    {
        return $this->institutionUniversityYear;
    }

    /**
     * Set dropoutSchoolNumber.
     *
     * @param int $dropoutSchoolNumber
     *
     * @return SocioEconomicData
     */
    public function setDropoutSchoolNumber($dropoutSchoolNumber)
    {
        $this->dropoutSchoolNumber = $dropoutSchoolNumber;

        return $this;
    }

    /**
     * Get dropoutSchoolNumber.
     *
     * @return int
     */
    public function getDropoutSchoolNumber()
    {
        return $this->dropoutSchoolNumber;
    }

    /**
     * Set dropoutSchoolYear.
     *
     * @param string $dropoutSchoolYear
     *
     * @return SocioEconomicData
     */
    public function setDropoutSchoolYear($dropoutSchoolYear)
    {
        $this->dropoutSchoolYear = $dropoutSchoolYear;

        return $this;
    }

    /**
     * Get dropoutSchoolYear.
     *
     * @return string
     */
    public function getDropoutSchoolYear()
    {
        return $this->dropoutSchoolYear;
    }

    /**
     * Set needyFamilyNumber.
     *
     * @param int $needyFamilyNumber
     *
     * @return SocioEconomicData
     */
    public function setNeedyFamilyNumber($needyFamilyNumber)
    {
        $this->needyFamilyNumber = $needyFamilyNumber;

        return $this;
    }

    /**
     * Get needyFamilyNumber.
     *
     * @return int
     */
    public function getNeedyFamilyNumber()
    {
        return $this->needyFamilyNumber;
    }

    /**
     * Set needyFamilyYear.
     *
     * @param string $needyFamilyYear
     *
     * @return SocioEconomicData
     */
    public function setNeedyFamilyYear($needyFamilyYear)
    {
        $this->needyFamilyYear = $needyFamilyYear;

        return $this;
    }

    /**
     * Get needyFamilyYear.
     *
     * @return string
     */
    public function getNeedyFamilyYear()
    {
        return $this->needyFamilyYear;
    }

    /**
     * Set associationNumber.
     *
     * @param int $associationNumber
     *
     * @return SocioEconomicData
     */
    public function setAssociationNumber($associationNumber)
    {
        $this->associationNumber = $associationNumber;

        return $this;
    }

    /**
     * Get associationNumber.
     *
     * @return int
     */
    public function getAssociationNumber()
    {
        return $this->associationNumber;
    }

    /**
     * Set associationYear.
     *
     * @param string $associationYear
     *
     * @return SocioEconomicData
     */
    public function setAssociationYear($associationYear)
    {
        $this->associationYear = $associationYear;

        return $this;
    }

    /**
     * Get associationYear.
     *
     * @return string
     */
    public function getAssociationYear()
    {
        return $this->associationYear;
    }

    /**
     * Set currentProject.
     *
     * @param string $currentProject
     *
     * @return SocioEconomicData
     */
    public function setCurrentProject($currentProject)
    {
        $this->currentProject = $currentProject;

        return $this;
    }

    /**
     * Get currentProject.
     *
     * @return string
     */
    public function getCurrentProject()
    {
        return $this->currentProject;
    }

    /**
     * Set description.
     *
     * @param string $description
     *
     * @return SocioEconomicData
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set directionRegional.
     *
     * @param \Mfpe\UniteRegionaleBundle\Entity\UniteRegionale|null $directionRegional
     *
     * @return SocioEconomicData
     */
    public function setDirectionRegional(\Mfpe\UniteRegionaleBundle\Entity\UniteRegionale $directionRegional = null)
    {
        $this->directionRegional = $directionRegional;

        return $this;
    }

    /**
     * Get directionRegional.
     *
     * @return \Mfpe\UniteRegionaleBundle\Entity\UniteRegionale|null
     */
    public function getDirectionRegional()
    {
        return $this->directionRegional;
    }

    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return SocioEconomicData
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
