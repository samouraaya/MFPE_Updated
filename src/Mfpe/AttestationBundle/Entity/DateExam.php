<?php

namespace Mfpe\AttestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\Groups;
use Mfpe\ConfigBundle\Entity\AbstractEntity;

/**
 * date_exam
 *
 * @ORM\Table(name="date_exam")
 * @ORM\Entity(repositoryClass="Mfpe\AttestationBundle\Repository\DateExamRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class DateExam
{
    use AbstractEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"listDemande", "detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_exam", type="datetime",nullable=true)
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $dateExam;

    /**
     * @var string|null
     *
     * @ORM\Column(name="material", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $material;

    /**
     * @var integer
     * @ORM\Column(name="nb_times_not_pass_examen", type="integer" , nullable=true, options={"default"="0"})
     * @Serializer\Groups({"detailDemande","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $nbTimesNotPassExamen;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\AttestationBundle\Entity\Demande", inversedBy="dateExams")
     * @ORM\JoinColumn(name="demande", referencedColumnName="id")
     * @Serializer\Groups({"listDemande", "detailDemande"})
     * @Serializer\Expose()
     */
    private $demande;

   

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
     * Set dateExam.
     *
     * @param \DateTime|null $dateExam
     *
     * @return DateExam
     */
    public function setDateExam($dateExam = null)
    {
        $this->dateExam = $dateExam;

        return $this;
    }

    /**
     * Get dateExam.
     *
     * @return \DateTime|null
     */
    public function getDateExam()
    {
        return $this->dateExam;
    }

    /**
     * Set material.
     *
     * @param string|null $material
     *
     * @return DateExam
     */
    public function setMaterial($material = null)
    {
        $this->material = $material;

        return $this;
    }

    /**
     * Get material.
     *
     * @return string|null
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * Set nbTimesNotPassExamen.
     *
     * @param int|null $nbTimesNotPassExamen
     *
     * @return DateExam
     */
    public function setNbTimesNotPassExamen($nbTimesNotPassExamen = null)
    {
        $this->nbTimesNotPassExamen = $nbTimesNotPassExamen;

        return $this;
    }

    /**
     * Get nbTimesNotPassExamen.
     *
     * @return int|null
     */
    public function getNbTimesNotPassExamen()
    {
        return $this->nbTimesNotPassExamen;
    }

    /**
     * Set demande.
     *
     * @param \Mfpe\AttestationBundle\Entity\Demande|null $demande
     *
     * @return DateExam
     */
    public function setDemande(\Mfpe\AttestationBundle\Entity\Demande $demande = null)
    {
        $this->demande = $demande;

        return $this;
    }

    /**
     * Get demande.
     *
     * @return \Mfpe\AttestationBundle\Entity\Demande|null
     */
    public function getDemande()
    {
        return $this->demande;
    }
}
