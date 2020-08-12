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
 * @ORM\Table(name="project_data")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\CollectDataBundle\Repository\ProjectDataRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */


class ProjectData
{

    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="governorat", referencedColumnName="id")
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $governorat;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefDelegation")
     * @ORM\JoinColumn(name="delegation", referencedColumnName="id")
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $delegation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title_project", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $titleProject;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type_project", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $typeProject;

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
     * @ORM\Column(name="target_population", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $targetPopulation;


    /**
     * @var string|null
     *
     * @ORM\Column(name="number_beneficiarie", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $numberBeneficiarie;

    /**
     * @var string|null
     *
     * @ORM\Column(name="project_manager", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $projectManager;


    /**
     * @var string|null
     *
     * @ORM\Column(name="project_cost", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $projectCost;

    /**
     * @var string|null
     *
     * @ORM\Column(name="project_cost_updated", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $projectCostUpdated;


    /**
     * @var string|null
     *
     * @ORM\Column(name="finance", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $finance;

    /**
     * @var string|null
     *
     * @ORM\Column(name="expense_extimed", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $expenseExtimed;

    /**
     * @var string|null
     *
     * @ORM\Column(name="expense_real", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $expenseReal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type_finance", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $typeFinance;

    /**
     * @var string|null
     *
     * @ORM\Column(name="registration_project_year", columnDefinition="YEAR", nullable=true)
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $registrationProjectYear;


    /**
     * @var string|null
     *
     * @ORM\Column(name="project_duration", type="float", nullable=true, options={"default"="0"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $projectDuration;


    /**
     * @var string|null
     *
     * @ORM\Column(name="project_component", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $projectComponent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="project_progress_percent", type="float", nullable=true, options={"default"="0"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $projectProgressPercent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="project_progress", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $projectProgress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="observation", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
     * @Serializer\Expose()
     */
    private $observation;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailProject","publicProject","cooperateProject"})
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
     * Set titleProject.
     *
     * @param string|null $titleProject
     *
     * @return ProjectData
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
     * @return ProjectData
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
     * Set targetPopulation.
     *
     * @param string|null $targetPopulation
     *
     * @return ProjectData
     */
    public function setTargetPopulation($targetPopulation = null)
    {
        $this->targetPopulation = $targetPopulation;

        return $this;
    }

    /**
     * Get targetPopulation.
     *
     * @return string|null
     */
    public function getTargetPopulation()
    {
        return $this->targetPopulation;
    }

    /**
     * Set numberBeneficiarie.
     *
     * @param string|null $numberBeneficiarie
     *
     * @return ProjectData
     */
    public function setNumberBeneficiarie($numberBeneficiarie = null)
    {
        $this->numberBeneficiarie = $numberBeneficiarie;

        return $this;
    }

    /**
     * Get numberBeneficiarie.
     *
     * @return string|null
     */
    public function getNumberBeneficiarie()
    {
        return $this->numberBeneficiarie;
    }

    /**
     * Set projectManager.
     *
     * @param string|null $projectManager
     *
     * @return ProjectData
     */
    public function setProjectManager($projectManager = null)
    {
        $this->projectManager = $projectManager;

        return $this;
    }

    /**
     * Get projectManager.
     *
     * @return string|null
     */
    public function getProjectManager()
    {
        return $this->projectManager;
    }

    /**
     * Set projectCost.
     *
     * @param int|null $projectCost
     *
     * @return ProjectData
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
     * Set projectCostUpdated.
     *
     * @param int|null $projectCostUpdated
     *
     * @return ProjectData
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
     * Set finance.
     *
     * @param string|null $finance
     *
     * @return ProjectData
     */
    public function setFinance($finance = null)
    {
        $this->finance = $finance;

        return $this;
    }

    /**
     * Get finance.
     *
     * @return string|null
     */
    public function getFinance()
    {
        return $this->finance;
    }

    /**
     * Set expenseExtimed.
     *
     * @param int|null $expenseExtimed
     *
     * @return ProjectData
     */
    public function setExpenseExtimed($expenseExtimed = null)
    {
        $this->expenseExtimed = $expenseExtimed;

        return $this;
    }

    /**
     * Get expenseExtimed.
     *
     * @return int|null
     */
    public function getExpenseExtimed()
    {
        return $this->expenseExtimed;
    }

    /**
     * Set expenseReal.
     *
     * @param int|null $expenseReal
     *
     * @return ProjectData
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
     * Set typeFinance.
     *
     * @param string|null $typeFinance
     *
     * @return ProjectData
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
     * Set registrationProjectYear.
     *
     * @param string|null $registrationProjectYear
     *
     * @return ProjectData
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
     * Set projectDuration.
     *
     * @param int|null $projectDuration
     *
     * @return ProjectData
     */
    public function setProjectDuration($projectDuration = null)
    {
        $this->projectDuration = $projectDuration;

        return $this;
    }

    /**
     * Get projectDuration.
     *
     * @return int|null
     */
    public function getProjectDuration()
    {
        return $this->projectDuration;
    }

    /**
     * Set projectComponent.
     *
     * @param string|null $projectComponent
     *
     * @return ProjectData
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
     * Set projectProgressPercent.
     *
     * @param int|null $projectProgressPercent
     *
     * @return ProjectData
     */
    public function setProjectProgressPercent($projectProgressPercent = null)
    {
        $this->projectProgressPercent = $projectProgressPercent;

        return $this;
    }

    /**
     * Get projectProgressPercent.
     *
     * @return int|null
     */
    public function getProjectProgressPercent()
    {
        return $this->projectProgressPercent;
    }

    /**
     * Set projectProgress.
     *
     * @param string|null $projectProgress
     *
     * @return ProjectData
     */
    public function setProjectProgress($projectProgress = null)
    {
        $this->projectProgress = $projectProgress;

        return $this;
    }

    /**
     * Get projectProgress.
     *
     * @return string|null
     */
    public function getProjectProgress()
    {
        return $this->projectProgress;
    }

    /**
     * Set observation.
     *
     * @param string|null $observation
     *
     * @return ProjectData
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
     * Set governorat.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $governorat
     *
     * @return ProjectData
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
     * @return ProjectData
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
     * @return ProjectData
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
     * Set type.
     *
     * @param string|null $type
     *
     * @return ProjectData
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }
}
