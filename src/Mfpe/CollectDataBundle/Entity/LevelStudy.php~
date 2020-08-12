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
 * LevelStady
 *
 * @ORM\Table(name="level_study")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\CollectDataBundle\Repository\LevelStudyRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class LevelStudy
{

    use AbstractEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"listLevelStudy","detailLevelStudy"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(name="nbr_trained_f", type="integer" , nullable=true, options={"default"="0"})
     * @Serializer\Groups({"listLevelStudy","detailLevelStudy","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $nbrTrainedF;

    /**
     * @var integer
     * @ORM\Column(name="nbr_trained_h", type="integer" , nullable=true, options={"default"="0"})
     * @Serializer\Groups({"listLevelStudy","detailLevelStudy","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $nbrTrainedH;
    /**
     * @var integer
     * @ORM\Column(name="nbr_foreigner", type="integer" , nullable=true, options={"default"="0"})
     * @Serializer\Groups({"listLevelStudy","detailLevelStudy","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $nbrForeigner;

    /**
     * @var integer
     * @ORM\Column(name="nbr_abundant", type="integer" , nullable=true, options={"default"="0"})
     * @Serializer\Groups({"listLevelStudy","detailLevelStudy","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $nbrAbundant;

    /**
     * @var integer
     * @ORM\Column(name="nbr_total", type="integer" , nullable=true, options={"default"="0"})
     * @Serializer\Groups({"listLevelStudy","detailLevelStudy","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $nbrTotal;
    /**
     * @var string|null
     *
     * @ORM\Column(name="level", type="integer",  nullable=true, options={"default"="1"})
     * @Serializer\Groups({"listLevelStudy","detailLevelStudy","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $level;

    /**
     * @var \StatGraduateTraining
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\CollectDataBundle\Entity\StatGraduateTraining", inversedBy="levelStudy")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stat_graduate_training", referencedColumnName="id")
     * })
     * @Serializer\Groups({"listStatGraduateTraining","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $statGraduateTraining;


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
     * Set nbrTrainedF.
     *
     * @param int|null $nbrTrainedF
     *
     * @return LevelStudy
     */
    public function setNbrTrainedF($nbrTrainedF = null)
    {
        $this->nbrTrainedF = $nbrTrainedF;

        return $this;
    }

    /**
     * Get nbrTrainedF.
     *
     * @return int|null
     */
    public function getNbrTrainedF()
    {
        return $this->nbrTrainedF;
    }

    /**
     * Set nbrTrainedH.
     *
     * @param int|null $nbrTrainedH
     *
     * @return LevelStudy
     */
    public function setNbrTrainedH($nbrTrainedH = null)
    {
        $this->nbrTrainedH = $nbrTrainedH;

        return $this;
    }

    /**
     * Get nbrTrainedH.
     *
     * @return int|null
     */
    public function getNbrTrainedH()
    {
        return $this->nbrTrainedH;
    }

    /**
     * Set nbrForeigner.
     *
     * @param int|null $nbrForeigner
     *
     * @return LevelStudy
     */
    public function setNbrForeigner($nbrForeigner = null)
    {
        $this->nbrForeigner = $nbrForeigner;

        return $this;
    }

    /**
     * Get nbrForeigner.
     *
     * @return int|null
     */
    public function getNbrForeigner()
    {
        return $this->nbrForeigner;
    }

    /**
     * Set nbrAbundant.
     *
     * @param int|null $nbrAbundant
     *
     * @return LevelStudy
     */
    public function setNbrAbundant($nbrAbundant = null)
    {
        $this->nbrAbundant = $nbrAbundant;

        return $this;
    }

    /**
     * Get nbrAbundant.
     *
     * @return int|null
     */
    public function getNbrAbundant()
    {
        return $this->nbrAbundant;
    }

    /**
     * Set nbrTotal.
     *
     * @param int|null $nbrTotal
     *
     * @return LevelStudy
     */
    public function setNbrTotal($nbrTotal = null)
    {
        $this->nbrTotal = $nbrTotal;

        return $this;
    }

    /**
     * Get nbrTotal.
     *
     * @return int|null
     */
    public function getNbrTotal()
    {
        return $this->nbrTotal;
    }

    /**
     * Set level.
     *
     * @param string|null $level
     *
     * @return LevelStudy
     */
    public function setLevel($level = null)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level.
     *
     * @return string|null
     */
    public function getLevel()
    {
        return $this->level;
    }



   

    /**
     * Set statGraduateTraining.
     *
     * @param \Mfpe\CollectDataBundle\Entity\StatGraduateTraining|null $statGraduateTraining
     *
     * @return LevelStudy
     */
    public function setStatGraduateTraining(\Mfpe\CollectDataBundle\Entity\StatGraduateTraining $statGraduateTraining = null)
    {
        $this->statGraduateTraining = $statGraduateTraining;

        return $this;
    }

    /**
     * Get statGraduateTraining.
     *
     * @return \Mfpe\CollectDataBundle\Entity\StatGraduateTraining|null
     */
    public function getStatGraduateTraining()
    {
        return $this->statGraduateTraining;
    }
    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return LevelStudy
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
