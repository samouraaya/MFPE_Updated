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
 * ProjectDataCsv
 *
 * @ORM\Table(name="csv_project_data")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\CollectDataBundle\Repository\ProjectDataCsvRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */


class ProjectDataCsv
{

    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"publicProjectCsv"})
     * @Serializer\Expose()
     */
    private $id;
    /**
     * @var string|null
     *
     * @ORM\Column(name="governorat_title", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $governoratTitle;
    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="governorat", referencedColumnName="id")
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $governorat;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefDelegation")
     * @ORM\JoinColumn(name="delegation", referencedColumnName="id")
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $delegation;
    /**
     * @var string|null
     *
     * @ORM\Column(name="delegation_title", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $delegationTitle;
    /**
     * @var string|null
     *
     * @ORM\Column(name="title_project", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $titleProject;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type_project", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $typeProject;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefSecteur")
     * @ORM\JoinColumn(name="sector", referencedColumnName="id")
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $sector;
    /**
     * @var string|null
     *
     * @ORM\Column(name="sector_title", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $sectorTitle;
    /**
     * @var string|null
     *
     * @ORM\Column(name="project_leader", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $projectLeader;


    /**
     * @var string|null
     *
     * @ORM\Column(name="registration_project_year", columnDefinition="YEAR", nullable=true)
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $registrationProjectYear;

    /**
     * @var string|null
     *
     * @ORM\Column(name="project_cost", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $projectCost;

    /**
     * @var string|null
     *
     * @ORM\Column(name="project_component", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $projectComponent;

    /**
     * @var \DateTime
     * @ORM\Column(name="project_completion_date", type="datetime", nullable=true)
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $projectCompletionDate;


    /**
     * @var string|null
     *
     * @ORM\Column(name="type_finance", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $typeFinance;

    /**
     * @var string|null
     *
     * @ORM\Column(name="funders", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $funders;



    /**
     * @var string|null
     *
     * @ORM\Column(name="project_cost_updated", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $projectCostUpdated;

    /**
     * @var \DateTime
     * @ORM\Column(name="project_cost_updated_date", type="datetime", nullable=true)
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $projectCostUpdatedDate;

    /**
     * @var \DateTime
     * @ORM\Column(name="project_follow_up_date", type="datetime", nullable=true)
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $projectFollowUpDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="expense_real", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $expenseReal;
    /**
     * @var string|null
     *
     * @ORM\Column(name="physical_project_progress", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $physicalProjectProgress;


    /**
     * @var string|null
     *
     * @ORM\Column(name="project_progress_percent", type="float", nullable=true, options={"default"="0"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $projectProgressPercent;



    /**
     * @var string|null
     *
     * @ORM\Column(name="observation", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $observation;



    /**
     * @var int|null
     *
     * @ORM\Column(name="annee", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $annee;


    /**
     * @var int|null
     *
     * @ORM\Column(name="mois", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"projetCsv"})
     * @Serializer\Expose()
     */
    private $mois;


    /**
     * @var string|null
     *
     * @ORM\Column(name="file_name", type="string", length=255, nullable=true)
     * @Serializer\Groups({"projetCsv"})
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
     * Set governoratTitle.
     *
     * @param string|null $governoratTitle
     *
     * @return ProjectDataCsv
     */
    public function setGovernoratTitle($governoratTitle = null)
    {
        $this->governoratTitle = $governoratTitle;

        return $this;
    }

    /**
     * Get governoratTitle.
     *
     * @return string|null
     */
    public function getGovernoratTitle()
    {
        return $this->governoratTitle;
    }

    /**
     * Set delegationTitle.
     *
     * @param string|null $delegationTitle
     *
     * @return ProjectDataCsv
     */
    public function setDelegationTitle($delegationTitle = null)
    {
        $this->delegationTitle = $delegationTitle;

        return $this;
    }

    /**
     * Get delegationTitle.
     *
     * @return string|null
     */
    public function getDelegationTitle()
    {
        return $this->delegationTitle;
    }

    /**
     * Set titleProject.
     *
     * @param string|null $titleProject
     *
     * @return ProjectDataCsv
     */
    public function setTitleProject($titleProject = null)
    {
        $this->titleProject = $titleProject;

        return $this;
    }

    /**
     * Get titleProject.
     *
     * @return string|null
     */
    public function getTitleProject()
    {
        return $this->titleProject;
    }

    /**
     * Set typeProject.
     *
     * @param string|null $typeProject
     *
     * @return ProjectDataCsv
     */
    public function setTypeProject($typeProject = null)
    {
        $this->typeProject = $typeProject;

        return $this;
    }

    /**
     * Get typeProject.
     *
     * @return string|null
     */
    public function getTypeProject()
    {
        return $this->typeProject;
    }

    /**
     * Set sectorTitle.
     *
     * @param string|null $sectorTitle
     *
     * @return ProjectDataCsv
     */
    public function setSectorTitle($sectorTitle = null)
    {
        $this->sectorTitle = $sectorTitle;

        return $this;
    }

    /**
     * Get sectorTitle.
     *
     * @return string|null
     */
    public function getSectorTitle()
    {
        return $this->sectorTitle;
    }

    /**
     * Set projectLeader.
     *
     * @param string|null $projectLeader
     *
     * @return ProjectDataCsv
     */
    public function setProjectLeader($projectLeader = null)
    {
        $this->projectLeader = $projectLeader;

        return $this;
    }

    /**
     * Get projectLeader.
     *
     * @return string|null
     */
    public function getProjectLeader()
    {
        return $this->projectLeader;
    }

    /**
     * Set registrationProjectYear.
     *
     * @param string|null $registrationProjectYear
     *
     * @return ProjectDataCsv
     */
    public function setRegistrationProjectYear($registrationProjectYear = null)
    {
        $this->registrationProjectYear = $registrationProjectYear;

        return $this;
    }

    /**
     * Get registrationProjectYear.
     *
     * @return string|null
     */
    public function getRegistrationProjectYear()
    {
        return $this->registrationProjectYear;
    }

    /**
     * Set projectCost.
     *
     * @param int|null $projectCost
     *
     * @return ProjectDataCsv
     */
    public function setProjectCost($projectCost = null)
    {
        $this->projectCost = $projectCost;

        return $this;
    }

    /**
     * Get projectCost.
     *
     * @return int|null
     */
    public function getProjectCost()
    {
        return $this->projectCost;
    }

    /**
     * Set projectComponent.
     *
     * @param string|null $projectComponent
     *
     * @return ProjectDataCsv
     */
    public function setProjectComponent($projectComponent = null)
    {
        $this->projectComponent = $projectComponent;

        return $this;
    }

    /**
     * Get projectComponent.
     *
     * @return string|null
     */
    public function getProjectComponent()
    {
        return $this->projectComponent;
    }

    /**
     * Set projectCompletionDate.
     *
     * @param \DateTime|null $projectCompletionDate
     *
     * @return ProjectDataCsv
     */
    public function setProjectCompletionDate($projectCompletionDate = null)
    {
        $this->projectCompletionDate = $projectCompletionDate;

        return $this;
    }

    /**
     * Get projectCompletionDate.
     *
     * @return \DateTime|null
     */
    public function getProjectCompletionDate()
    {
        return $this->projectCompletionDate;
    }

    /**
     * Set typeFinance.
     *
     * @param string|null $typeFinance
     *
     * @return ProjectDataCsv
     */
    public function setTypeFinance($typeFinance = null)
    {
        $this->typeFinance = $typeFinance;

        return $this;
    }

    /**
     * Get typeFinance.
     *
     * @return string|null
     */
    public function getTypeFinance()
    {
        return $this->typeFinance;
    }

    /**
     * Set funders.
     *
     * @param string|null $funders
     *
     * @return ProjectDataCsv
     */
    public function setFunders($funders = null)
    {
        $this->funders = $funders;

        return $this;
    }

    /**
     * Get funders.
     *
     * @return string|null
     */
    public function getFunders()
    {
        return $this->funders;
    }

    /**
     * Set projectCostUpdated.
     *
     * @param int|null $projectCostUpdated
     *
     * @return ProjectDataCsv
     */
    public function setProjectCostUpdated($projectCostUpdated = null)
    {
        $this->projectCostUpdated = $projectCostUpdated;

        return $this;
    }

    /**
     * Get projectCostUpdated.
     *
     * @return int|null
     */
    public function getProjectCostUpdated()
    {
        return $this->projectCostUpdated;
    }

    /**
     * Set projectCostUpdatedDate.
     *
     * @param \DateTime|null $projectCostUpdatedDate
     *
     * @return ProjectDataCsv
     */
    public function setProjectCostUpdatedDate($projectCostUpdatedDate = null)
    {
        $this->projectCostUpdatedDate = $projectCostUpdatedDate;

        return $this;
    }

    /**
     * Get projectCostUpdatedDate.
     *
     * @return \DateTime|null
     */
    public function getProjectCostUpdatedDate()
    {
        return $this->projectCostUpdatedDate;
    }

    /**
     * Set projectFollowUpDate.
     *
     * @param \DateTime|null $projectFollowUpDate
     *
     * @return ProjectDataCsv
     */
    public function setProjectFollowUpDate($projectFollowUpDate = null)
    {
        $this->projectFollowUpDate = $projectFollowUpDate;

        return $this;
    }

    /**
     * Get projectFollowUpDate.
     *
     * @return \DateTime|null
     */
    public function getProjectFollowUpDate()
    {
        return $this->projectFollowUpDate;
    }

    /**
     * Set expenseReal.
     *
     * @param int|null $expenseReal
     *
     * @return ProjectDataCsv
     */
    public function setExpenseReal($expenseReal = null)
    {
        $this->expenseReal = $expenseReal;

        return $this;
    }

    /**
     * Get expenseReal.
     *
     * @return int|null
     */
    public function getExpenseReal()
    {
        return $this->expenseReal;
    }

    /**
     * Set physicalProjectProgress.
     *
     * @param string|null $physicalProjectProgress
     *
     * @return ProjectDataCsv
     */
    public function setPhysicalProjectProgress($physicalProjectProgress = null)
    {
        $this->physicalProjectProgress = $physicalProjectProgress;

        return $this;
    }

    /**
     * Get physicalProjectProgress.
     *
     * @return string|null
     */
    public function getPhysicalProjectProgress()
    {
        return $this->physicalProjectProgress;
    }

    /**
     * Set projectProgressPercent.
     *
     * @param float|null $projectProgressPercent
     *
     * @return ProjectDataCsv
     */
    public function setProjectProgressPercent($projectProgressPercent = null)
    {
        $this->projectProgressPercent = $projectProgressPercent;

        return $this;
    }

    /**
     * Get projectProgressPercent.
     *
     * @return float|null
     */
    public function getProjectProgressPercent()
    {
        return $this->projectProgressPercent;
    }

    /**
     * Set observation.
     *
     * @param string|null $observation
     *
     * @return ProjectDataCsv
     */
    public function setObservation($observation = null)
    {
        $this->observation = $observation;

        return $this;
    }

    /**
     * Get observation.
     *
     * @return string|null
     */
    public function getObservation()
    {
        return $this->observation;
    }

    /**
     * Set annee.
     *
     * @param int|null $annee
     *
     * @return ProjectDataCsv
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
     * @return ProjectDataCsv
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
     * @return ProjectDataCsv
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
     * @return ProjectDataCsv
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
     * Set governorat.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $governorat
     *
     * @return ProjectDataCsv
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
     * @return ProjectDataCsv
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
     * @return ProjectDataCsv
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
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return ProjectDataCsv
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
