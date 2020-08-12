<?php

namespace Mfpe\CentreFormationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\Groups;
use Mfpe\ConfigBundle\Entity\AbstractEntity;


/**
 * specialite
 *
 * @ORM\Table(name="specialite")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\CentreFormationBundle\Repository\SpecialiteRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Specialite
{
	
	    use AbstractEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"DeserializeDemandeGroup","detailStatGraduateTraining","detailSpecialite", "DemandeGroup" ,"listDemande", "detailDemande","detailSpecialite","detailCentreFormation","listStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_ar", type="string", length=255, nullable=false)
     * @Serializer\Groups({"listDemande", "detailDemande","detailSpecialite","detailCentreFormation","listStatGraduateTraining","detailStatGraduateTraining","listDetailDemande","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $intituleAr;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_fr", type="string", length=255, nullable=false)
     * @Serializer\Groups({"listDemande", "detailDemande","detailSpecialite","detailCentreFormation","listStatGraduateTraining","detailStatGraduateTraining","listDetailDemande","detailEtatiqueStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $intituleFr;

    /**
     * @var string
     *
     * @ORM\Column(name="code_specialite", type="string", length=45, nullable=false, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailSpecialite","detailCentreFormation"})
     * @Serializer\Expose()
     */
    private $codeSpecialite;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefSecteur")
     * @ORM\JoinColumn(name="secteur", referencedColumnName="id")
     * @Serializer\Groups({"listDemande", "detailDemande","detailSpecialite","detailCentreFormation"})
     * @Serializer\Expose()
     */
    private $secteur;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefSousSecteur")
     * @ORM\JoinColumn(name="sous_secteur", referencedColumnName="id")
     * @Serializer\Groups({"listDemande", "detailDemande","detailSpecialite","detailCentreFormation"})
     * @Serializer\Expose()
     */
    private $sousSecteur;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefNiveauDiplome")
     * @ORM\JoinColumn(name="niveau_diplome", referencedColumnName="id")
     * @Serializer\Groups({"listDemande", "detailDemande","detailSpecialite","detailCentreFormation","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $niveauDiplome;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefNiveauEtude")
     * @ORM\JoinColumn(name="nature_formation", referencedColumnName="id")
     * @Serializer\Groups({"listDemande", "detailDemande","detailSpecialite","detailCentreFormation","detailStatGraduateTraining"})
     * @Serializer\Expose()
     */
    private $natureFormation;

    /**
     * @var string
     *
     * @ORM\Column(name="frais_specialite_exam", type="string", length=255, nullable=false)
     * @Serializer\Groups({"listDemande", "detailDemande","detailSpecialite","detailCentreFormation"})
     * @Serializer\Expose()
     */
    private $fraisSpecialiteExam;


    /**
     * @var \Doctrine\Common\Collections\Collection|CentreFormation[]
     * @ORM\ManyToMany(targetEntity="Mfpe\CentreFormationBundle\Entity\CentreFormation" , mappedBy="specialiteCenters")
     * @Serializer\Expose()
     */
    private $centers;

    /**
     * @var boolean
     * @ORM\Column(name="enable", type="boolean",nullable=true)
     * @Serializer\Groups({"listDemande", "detailDemande","detailSpecialite","detailCentreFormation"})
     * @Serializer\Expose()
     */
    protected $enable;


    /**
     * @var bool
     *
     * @ORM\Column(name="type", type="boolean", options={"default":"0"})
     * @Serializer\Groups({"listDemande", "detailDemande","detailSpecialite","detailCentreFormation"})
     * @Serializer\Expose()
     */
    protected $type;



    /**
     * Constructor
     */
    public function __construct()
    {
        $this->centers = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set intituleAr.
     *
     * @param string $intituleAr
     *
     * @return Specialite
     */
    public function setIntituleAr($intituleAr)
    {
        $this->intituleAr = $intituleAr;

        return $this;
    }

    /**
     * Get intituleAr.
     *
     * @return string
     */
    public function getIntituleAr()
    {
        return $this->intituleAr;
    }

    /**
     * Set intituleFr.
     *
     * @param string $intituleFr
     *
     * @return Specialite
     */
    public function setIntituleFr($intituleFr)
    {
        $this->intituleFr = $intituleFr;

        return $this;
    }

    /**
     * Get intituleFr.
     *
     * @return string
     */
    public function getIntituleFr()
    {
        return $this->intituleFr;
    }

    /**
     * Set codeSpecialite.
     *
     * @param string $codeSpecialite
     *
     * @return Specialite
     */
    public function setCodeSpecialite($codeSpecialite)
    {
        $this->codeSpecialite = $codeSpecialite;

        return $this;
    }

    /**
     * Get codeSpecialite.
     *
     * @return string
     */
    public function getCodeSpecialite()
    {
        return $this->codeSpecialite;
    }

    /**
     * Set fraisSpecialiteExam.
     *
     * @param string $fraisSpecialiteExam
     *
     * @return Specialite
     */
    public function setFraisSpecialiteExam($fraisSpecialiteExam)
    {
        $this->fraisSpecialiteExam = $fraisSpecialiteExam;

        return $this;
    }

    /**
     * Get fraisSpecialiteExam.
     *
     * @return string
     */
    public function getFraisSpecialiteExam()
    {
        return $this->fraisSpecialiteExam;
    }

    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return Specialite
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
     * Set type.
     *
     * @param bool $type
     *
     * @return Specialite
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return bool
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set secteur.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefSecteur|null $secteur
     *
     * @return Specialite
     */
    public function setSecteur(\Mfpe\ReferencielBundle\Entity\RefSecteur $secteur = null)
    {
        $this->secteur = $secteur;

        return $this;
    }

    /**
     * Get secteur.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefSecteur|null
     */
    public function getSecteur()
    {
        return $this->secteur;
    }

    /**
     * Set sousSecteur.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefSousSecteur|null $sousSecteur
     *
     * @return Specialite
     */
    public function setSousSecteur(\Mfpe\ReferencielBundle\Entity\RefSousSecteur $sousSecteur = null)
    {
        $this->sousSecteur = $sousSecteur;

        return $this;
    }

    /**
     * Get sousSecteur.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefSousSecteur|null
     */
    public function getSousSecteur()
    {
        return $this->sousSecteur;
    }

    /**
     * Set niveauDiplome.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefNiveauDiplome|null $niveauDiplome
     *
     * @return Specialite
     */
    public function setNiveauDiplome(\Mfpe\ReferencielBundle\Entity\RefNiveauDiplome $niveauDiplome = null)
    {
        $this->niveauDiplome = $niveauDiplome;

        return $this;
    }

    /**
     * Get niveauDiplome.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefNiveauDiplome|null
     */
    public function getNiveauDiplome()
    {
        return $this->niveauDiplome;
    }

    /**
     * Set natureFormation.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefNiveauEtude|null $natureFormation
     *
     * @return Specialite
     */
    public function setNatureFormation(\Mfpe\ReferencielBundle\Entity\RefNiveauEtude $natureFormation = null)
    {
        $this->natureFormation = $natureFormation;

        return $this;
    }

    /**
     * Get natureFormation.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefNiveauEtude|null
     */
    public function getNatureFormation()
    {
        return $this->natureFormation;
    }

    /**
     * Add center.
     *
     * @param \Mfpe\CentreFormationBundle\Entity\CentreFormation $center
     *
     * @return Specialite
     */
    public function addCenter(\Mfpe\CentreFormationBundle\Entity\CentreFormation $center)
    {
        $this->centers[] = $center;

        return $this;
    }

    /**
     * Remove center.
     *
     * @param \Mfpe\CentreFormationBundle\Entity\CentreFormation $center
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCenter(\Mfpe\CentreFormationBundle\Entity\CentreFormation $center)
    {
        return $this->centers->removeElement($center);
    }

    /**
     * Get centers.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCenters()
    {
        return $this->centers;
    }
}
