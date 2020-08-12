<?php

namespace Mfpe\CollectDataBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\Groups;
use Mfpe\ConfigBundle\Entity\AbstractEntity;

/**
 * PrivateTrainnigCenter
 *
 * @ORM\Table(name="private_trainnig_center")
 * @ORM\Entity(repositoryClass="Mfpe\CollectDataBundle\Repository\PrivateTrainnigCenterRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class PrivateTrainnigCenter
{
    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"listTrainingCentre","detailTrainingCentre","detailPrivateTrainingCentre"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="gouvernorat", referencedColumnName="id")
     * @Serializer\Groups({"listTrainingCentre","detailTrainingCentre","detailPrivateTrainingCentre"})
     * @Serializer\Expose()
     */
    private $governorat;

    /**
     * @ORM\Column(type="integer", name="month", nullable=true)
     * @Serializer\Groups({"listStatGraduateTraining","detailStatGraduateTraining","detailPrivateTrainingCentre"})
     * @Serializer\Expose()
     */
    private $month;

    /**
     * @var int|null
     *
     * @ORM\Column(name="year", columnDefinition="YEAR", nullable=true)
     * @Serializer\Groups({"listTrainingCentre","detailTrainingCentre","detailPrivateTrainingCentre"})

     * @Serializer\Expose()
     */
    private $year;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_private_training_center", type="datetime",nullable=true)
     * @Serializer\Groups({"listTrainingCentre","detailTrainingCentre","detailPrivateTrainingCentre"})
     * @Serializer\Expose()
     */
    private $datePrivateTrainingCenter;

    /**
     * @var int|null
     *
     * @ORM\Column(name="initial_number", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listTrainingCentre","detailTrainingCentre","detailPrivateTrainingCentre"})
     * @Serializer\Expose()
     */
    private $initialNumber;


    /**
     * @var int|null
     *
     * @ORM\Column(name="continus_number", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listTrainingCentre","detailTrainingCentre","detailPrivateTrainingCentre"})
     * @Serializer\Expose()
     */
    private $continusNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="initial_continus_number", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listTrainingCentre","detailTrainingCentre","detailPrivateTrainingCentre"})
     * @Serializer\Expose()
     */
    private $initialContiusNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="change_number", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listTrainingCentre","detailTrainingCentre","detailPrivateTrainingCentre"})
     * @Serializer\Expose()
     */
    private $changeNumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="closed_training_center_number", type="integer", nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listTrainingCentre","detailTrainingCentre","detailPrivateTrainingCentre"})
     * @Serializer\Expose()
     */
    private $closedTrainingCenterNumber;

   

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
     * Set month.
     *
     * @param int|null $month
     *
     * @return PrivateTrainnigCenter
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
     * Set year.
     *
     * @param string|null $year
     *
     * @return PrivateTrainnigCenter
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
     * Set datePrivateTrainingCenter.
     *
     * @param \DateTime|null $datePrivateTrainingCenter
     *
     * @return PrivateTrainnigCenter
     */
    public function setDatePrivateTrainingCenter($datePrivateTrainingCenter = null)
    {
        $this->datePrivateTrainingCenter = $datePrivateTrainingCenter;

        return $this;
    }

    /**
     * Get datePrivateTrainingCenter.
     *
     * @return \DateTime|null
     */
    public function getDatePrivateTrainingCenter()
    {
        return $this->datePrivateTrainingCenter;
    }

    /**
     * Set initialNumber.
     *
     * @param int|null $initialNumber
     *
     * @return PrivateTrainnigCenter
     */
    public function setInitialNumber($initialNumber = null)
    {
        $this->initialNumber = $initialNumber;

        return $this;
    }

    /**
     * Get initialNumber.
     *
     * @return int|null
     */
    public function getInitialNumber()
    {
        return $this->initialNumber;
    }

    /**
     * Set continusNumber.
     *
     * @param int|null $continusNumber
     *
     * @return PrivateTrainnigCenter
     */
    public function setContinusNumber($continusNumber = null)
    {
        $this->continusNumber = $continusNumber;

        return $this;
    }

    /**
     * Get continusNumber.
     *
     * @return int|null
     */
    public function getContinusNumber()
    {
        return $this->continusNumber;
    }

    /**
     * Set initialContiusNumber.
     *
     * @param int|null $initialContiusNumber
     *
     * @return PrivateTrainnigCenter
     */
    public function setInitialContiusNumber($initialContiusNumber = null)
    {
        $this->initialContiusNumber = $initialContiusNumber;

        return $this;
    }

    /**
     * Get initialContiusNumber.
     *
     * @return int|null
     */
    public function getInitialContiusNumber()
    {
        return $this->initialContiusNumber;
    }

    /**
     * Set changeNumber.
     *
     * @param int|null $changeNumber
     *
     * @return PrivateTrainnigCenter
     */
    public function setChangeNumber($changeNumber = null)
    {
        $this->changeNumber = $changeNumber;

        return $this;
    }

    /**
     * Get changeNumber.
     *
     * @return int|null
     */
    public function getChangeNumber()
    {
        return $this->changeNumber;
    }

    /**
     * Set closedTrainingCenterNumber.
     *
     * @param int|null $closedTrainingCenterNumber
     *
     * @return PrivateTrainnigCenter
     */
    public function setClosedTrainingCenterNumber($closedTrainingCenterNumber = null)
    {
        $this->closedTrainingCenterNumber = $closedTrainingCenterNumber;

        return $this;
    }

    /**
     * Get closedTrainingCenterNumber.
     *
     * @return int|null
     */
    public function getClosedTrainingCenterNumber()
    {
        return $this->closedTrainingCenterNumber;
    }

    /**
     * Set governorat.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $governorat
     *
     * @return PrivateTrainnigCenter
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
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return PrivateTrainnigCenteryes
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
