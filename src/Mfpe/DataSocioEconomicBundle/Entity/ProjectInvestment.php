<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Mfpe\DataSocioEconomicBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\Groups;
use Mfpe\ConfigBundle\Entity\AbstractEntity;

/**
 * Description of ProjectInvestment
 *
 * @author Lamine Mansouri
 */

/**
 * ProjectInvestment
 *
 * @ORM\Table(name="project_investment")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\DataSocioEconomicBundle\Repository\ProjectInvestmentRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class ProjectInvestment {

    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="governorat", referencedColumnName="id")
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $governorat;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefDelegation")
     * @ORM\JoinColumn(name="delegation", referencedColumnName="id")
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $delegation;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefSecteurEconomic")
     * @ORM\JoinColumn(name="sector_economic", referencedColumnName="id")
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $sectorEconomic;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefObjetEconomic")
     * @ORM\JoinColumn(name="object_economic", referencedColumnName="id")
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $objectEconomic;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefRegime")
     * @ORM\JoinColumn(name="regime", referencedColumnName="id")
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $regime;


    /**
     * @var string|null
     *
     * @ORM\Column(name="job_estimed", type="integer", nullable=true, options={"default"="0"})
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $jobEstimed;

    /**
     * @var string|null
     *
     * @ORM\Column(name="investment_cost", type="float", nullable=true, options={"default"="0"})
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $investmentCost;

    /**
     * @var string|null
     *
     * @ORM\Column(name="year", columnDefinition="YEAR", nullable=true)
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $year;

    /**
     * @var string|null
     *
     * @ORM\Column(name="activiry_cessation", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $activiryCessation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="duration", type="float", length=255, nullable=true, options={"default"="0"})
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $duration;

    /**
     * @var string|null
     *
     * @ORM\Column(name="number_job_lost", type="integer", length=255, nullable=true, options={"default"="0"})
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $numberJobLost;

    /**
     * @var \DateTime
     * @ORM\Column(name="date", type="datetime", nullable=true)
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="type", type="integer", options={"default":"0"})
     * @Serializer\Groups({"detailProjectInvestment"})
     * @Serializer\Expose()
     */
    private $type;


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
     * Set jobEstimed.
     *
     * @param int|null $jobEstimed
     *
     * @return ProjectInvestment
     */
    public function setJobEstimed($jobEstimed = null)
    {
        $this->jobEstimed = $jobEstimed;

        return $this;
    }

    /**
     * Get jobEstimed.
     *
     * @return int|null
     */
    public function getJobEstimed()
    {
        return $this->jobEstimed;
    }

    /**
     * Set investmentCost.
     *
     * @param float|null $investmentCost
     *
     * @return ProjectInvestment
     */
    public function setInvestmentCost($investmentCost = null)
    {
        $this->investmentCost = $investmentCost;

        return $this;
    }

    /**
     * Get investmentCost.
     *
     * @return float|null
     */
    public function getInvestmentCost()
    {
        return $this->investmentCost;
    }

    /**
     * Set year.
     *
     * @param string|null $year
     *
     * @return ProjectInvestment
     */
    public function setYear($year = null)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year.
     *
     * @return string|null
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set activiryCessation.
     *
     * @param string|null $activiryCessation
     *
     * @return ProjectInvestment
     */
    public function setActiviryCessation($activiryCessation = null)
    {
        $this->activiryCessation = $activiryCessation;

        return $this;
    }

    /**
     * Get activiryCessation.
     *
     * @return string|null
     */
    public function getActiviryCessation()
    {
        return $this->activiryCessation;
    }

    /**
     * Set duration.
     *
     * @param float|null $duration
     *
     * @return ProjectInvestment
     */
    public function setDuration($duration = null)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration.
     *
     * @return float|null
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set numberJobLost.
     *
     * @param int|null $numberJobLost
     *
     * @return ProjectInvestment
     */
    public function setNumberJobLost($numberJobLost = null)
    {
        $this->numberJobLost = $numberJobLost;

        return $this;
    }

    /**
     * Get numberJobLost.
     *
     * @return int|null
     */
    public function getNumberJobLost()
    {
        return $this->numberJobLost;
    }

    /**
     * Set type.
     *
     * @param int $type
     *
     * @return ProjectInvestment
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set governorat.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $governorat
     *
     * @return ProjectInvestment
     */
    public function setGovernorat(\Mfpe\ReferencielBundle\Entity\RefGouvernorat $governorat = null)
    {
        $this->governorat = $governorat;

        return $this;
    }

    /**
     * Get governorat.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null
     */
    public function getGovernorat()
    {
        return $this->governorat;
    }

    /**
     * Set delegation.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefDelegation|null $delegation
     *
     * @return ProjectInvestment
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
     * Set sectorEconomic.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefSecteurEconomic|null $sectorEconomic
     *
     * @return ProjectInvestment
     */
    public function setSectorEconomic(\Mfpe\ReferencielBundle\Entity\RefSecteurEconomic $sectorEconomic = null)
    {
        $this->sectorEconomic = $sectorEconomic;

        return $this;
    }

    /**
     * Get sectorEconomic.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefSecteurEconomic|null
     */
    public function getSectorEconomic()
    {
        return $this->sectorEconomic;
    }

    /**
     * Set objectEconomic.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefObjetEconomic|null $objectEconomic
     *
     * @return ProjectInvestment
     */
    public function setObjectEconomic(\Mfpe\ReferencielBundle\Entity\RefObjetEconomic $objectEconomic = null)
    {
        $this->objectEconomic = $objectEconomic;

        return $this;
    }

    /**
     * Get objectEconomic.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefObjetEconomic|null
     */
    public function getObjectEconomic()
    {
        return $this->objectEconomic;
    }

    /**
     * Set regime.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefRegime|null $regime
     *
     * @return ProjectInvestment
     */
    public function setRegime(\Mfpe\ReferencielBundle\Entity\RefRegime $regime = null)
    {
        $this->regime = $regime;

        return $this;
    }

    /**
     * Get regime.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefRegime|null
     */
    public function getRegime()
    {
        return $this->regime;
    }

    /**
     * Set date.
     *
     * @param \DateTime|null $date
     *
     * @return ProjectInvestment
     */
    public function setDate($date = null)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime|null
     */
    public function getDate()
    {
        return $this->date;
    }
    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return ProjectInvestment
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
