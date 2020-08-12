<?php

namespace Mfpe\DataSocioEconomicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Mfpe\ConfigBundle\Entity\AbstractEntity;

/**
 * CsvSocioEconomicData
 *
 * @ORM\Table(name="csv_socio_economic_data")
 * @ORM\Entity(repositoryClass="Mfpe\DataSocioEconomicBundle\Repository\CsvSocioEconomicDataRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class CsvSocioEconomicData {

    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="governorat", type="string", length=255, nullable=false)
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $governorat;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="governorat_id", referencedColumnName="id", nullable=true)
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $governoratId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_governorat", type="string", length=255, nullable=true)
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $codeGovernorat;

    /**
     * @var bigint
     *
     * @ORM\Column(name="population_size", type="bigint", nullable=false)
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $populationSize;

    /**
     * @var bigint
     *
     * @ORM\Column(name="population_age_activity", type="bigint", nullable=false)
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $populationAgeActivity;

    /**
     * @var bigint
     *
     * @ORM\Column(name="active_population", type="bigint", nullable=false)
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $activePopulation;

    /**
     * @var bigint
     *
     * @ORM\Column(name="active_population_occupied", type="bigint", nullable=false)
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $activePopulationOccupied;

    /**
     * @var bigint
     *
     * @ORM\Column(name="unemployed_population", type="bigint", nullable=false)
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $unemployedPopulation;

    /**
     * @var float
     *
     * @ORM\Column(name="unemployment_rate", type="float", nullable=false)
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $unemploymentRate;

    /**
     * @var bigint
     *
     * @ORM\Column(name="number_company", type="bigint", nullable=false)
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */

    private $numberCompany;

    /**
     * @var int|null
     *
     * @ORM\Column(name="annee", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $annee;

    /**
     * @var int|null
     *
     * @ORM\Column(name="mois", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $mois;

    /**
     * @var string|null
     *
     * @ORM\Column(name="file_name", type="string", length=255, nullable=true)
     * @Serializer\Groups({"detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $fileName;
    /**
     * @var integer
     *
     * @ORM\Column(name="file_id", type="integer", nullable=false)
     * @Serializer\Groups({"listEconomicData", "detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $fileId;
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
     * Set governorat.
     *
     * @param string $governorat
     *
     * @return CsvSocioEconomicData
     */
    public function setGovernorat($governorat)
    {
        $this->governorat = $governorat;

        return $this;
    }

    /**
     * Get governorat.
     *
     * @return string
     */
    public function getGovernorat()
    {
        return $this->governorat;
    }

    /**
     * Set populationSize.
     *
     * @param int $populationSize
     *
     * @return CsvSocioEconomicData
     */
    public function setPopulationSize($populationSize)
    {
        $this->populationSize = $populationSize;

        return $this;
    }

    /**
     * Get populationSize.
     *
     * @return int
     */
    public function getPopulationSize()
    {
        return $this->populationSize;
    }

    /**
     * Set populationAgeActivity.
     *
     * @param int $populationAgeActivity
     *
     * @return CsvSocioEconomicData
     */
    public function setPopulationAgeActivity($populationAgeActivity)
    {
        $this->populationAgeActivity = $populationAgeActivity;

        return $this;
    }

    /**
     * Get populationAgeActivity.
     *
     * @return int
     */
    public function getPopulationAgeActivity()
    {
        return $this->populationAgeActivity;
    }

    /**
     * Set activePopulation.
     *
     * @param int $activePopulation
     *
     * @return CsvSocioEconomicData
     */
    public function setActivePopulation($activePopulation)
    {
        $this->activePopulation = $activePopulation;

        return $this;
    }

    /**
     * Get activePopulation.
     *
     * @return int
     */
    public function getActivePopulation()
    {
        return $this->activePopulation;
    }

    /**
     * Set activePopulationOccupied.
     *
     * @param int $activePopulationOccupied
     *
     * @return CsvSocioEconomicData
     */
    public function setActivePopulationOccupied($activePopulationOccupied)
    {
        $this->activePopulationOccupied = $activePopulationOccupied;

        return $this;
    }

    /**
     * Get activePopulationOccupied.
     *
     * @return int
     */
    public function getActivePopulationOccupied()
    {
        return $this->activePopulationOccupied;
    }

    /**
     * Set unemployedPopulation.
     *
     * @param int $unemployedPopulation
     *
     * @return CsvSocioEconomicData
     */
    public function setUnemployedPopulation($unemployedPopulation)
    {
        $this->unemployedPopulation = $unemployedPopulation;

        return $this;
    }

    /**
     * Get unemployedPopulation.
     *
     * @return int
     */
    public function getUnemployedPopulation()
    {
        return $this->unemployedPopulation;
    }

    /**
     * Set unemploymentRate.
     *
     * @param float $unemploymentRate
     *
     * @return CsvSocioEconomicData
     */
    public function setUnemploymentRate($unemploymentRate)
    {
        $this->unemploymentRate = $unemploymentRate;

        return $this;
    }

    /**
     * Get unemploymentRate.
     *
     * @return float
     */
    public function getUnemploymentRate()
    {
        return $this->unemploymentRate;
    }

    /**
     * Set numberCompany.
     *
     * @param int $numberCompany
     *
     * @return CsvSocioEconomicData
     */
    public function setNumberCompany($numberCompany)
    {
        $this->numberCompany = $numberCompany;

        return $this;
    }

    /**
     * Get numberCompany.
     *
     * @return int
     */
    public function getNumberCompany()
    {
        return $this->numberCompany;
    }

    /**
     * Set governoratId.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $governoratId
     *
     * @return CsvSocioEconomicData
     */
    public function setGovernoratId(\Mfpe\ReferencielBundle\Entity\RefGouvernorat $governoratId = null)
    {
        $this->governoratId = $governoratId;

        return $this;
    }

    /**
     * Get governoratId.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null
     */
    public function getGovernoratId()
    {
        return $this->governoratId;
    }

    /**
     * Set codeGovernorat.
     *
     * @param string $codeGovernorat
     *
     * @return CsvSocioEconomicData
     */
    public function setCodeGovernorat($codeGovernorat)
    {
        $this->codeGovernorat = $codeGovernorat;

        return $this;
    }

    /**
     * Get codeGovernorat.
     *
     * @return string
     */
    public function getCodeGovernorat()
    {
        return $this->codeGovernorat;
    }

    /**
     * Set annee.
     *
     * @param int|null $annee
     *
     * @return CsvSocioEconomicData
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
     * @return CsvSocioEconomicData
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
     * Set fileName.
     *
     * @param string|null $fileName
     *
     * @return CsvSocioEconomicData
     */
    public function setFileName($fileName = null)
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * Get fileName.
     *
     * @return string|null
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * Set fileId.
     *
     * @param int $fileId
     *
     * @return CsvSocioEconomicData
     */
    public function setFileId($fileId)
    {
        $this->fileId = $fileId;

        return $this;
    }

    /**
     * Get fileId.
     *
     * @return int
     */
    public function getFileId()
    {
        return $this->fileId;
    }
    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return CsvSocioEconomicData
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
