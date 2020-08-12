<?php

namespace Mfpe\ReferencielBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Mfpe\ConfigBundle\Entity\AbstractEntity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * Referenciel
 *
 * @ORM\Table(name="referenciel")
 * @ORM\Entity(repositoryClass="Mfpe\ReferencielBundle\Repository\ReferencielRepository")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="categorie", type="string")
 * @ORM\DiscriminatorMap({
 *     "Referenciel" = "Referenciel",
 *     "RefPays" = "RefPays",
 *     "RefNationalite" = "RefNationalite",
 *     "RefGouvernorat" = "RefGouvernorat",
 *     "RefDelegation" = "RefDelegation",
 *     "RefMunicipalite" = "RefMunicipalite",
 *     "RefLocalite" = "RefLocalite",
 *     "RefDomaine"="RefDomaine",
 *     "RefSecteur"="RefSecteur",
 *     "RefSousSecteur"="RefSousSecteur",
 *     "RefNatureBesoinSpecifique"="RefNatureBesoinSpecifique",
 *     "RefNiveauEtude"="RefNiveauEtude",
 *     "RefNiveauDiplome"="RefNiveauDiplome",
 *     "RefStatut"="RefStatut",
 *     "RefMotif"="RefMotif",
 *     "RefStructure"="RefStructure",
 *     "RefFonction"="RefFonction",
 *     "RefDelaisDemande"="RefDelaisDemande",
 *     "RefRegime"="RefRegime",
 *     "RefSecteurEconomic"="RefSecteurEconomic",
 *     "RefObjetEconomic"="RefObjetEconomic",
 *     "RefFonctionCadreRegion"="RefFonctionCadreRegion",
 *     "RefCaracteristiqueRegion"="RefCaracteristiqueRegion",
 *     "RefGrade"="RefGrade"
 *
 * })
 * @Serializer\ExclusionPolicy("ALL")
 */


class Referenciel {

    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"ReferencielGroup","detailPrivateTrainingCentre","detailStatGraduateTraining","listDemande", "detailDemande", "AppUserGroup","uniteRegional","detailSpecialite","detailCentreFormation","detailTrainingCentre","detailsEconomicData","listDetailDemande","detailsBTS"})
     * @Serializer\Expose()
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_fr", type="string", length=255)
     *
     * @Serializer\Groups({"ReferencielGroup","listDemande", "detailDemande", "AppUserGroup","uniteRegional","detailSpecialite","detailCentreFormation","detailTrainingCentre","detailStatGraduateTraining","detailPrivateTrainingCentre","detailEtatiqueStatGraduateTraining","detailsEconomicData","detailProject","listDetailDemande","detailsBTS"})
     * @Serializer\Expose()
     * @Groups({"ReferencielGroup"})
     */
    protected $intituleFr;

    /**
     * @var string
     *
     * @ORM\Column(name="intitule_ar", type="string", length=255)
     * @Serializer\Groups({"ReferencielGroup","listDemande", "detailDemande", "AppUserGroup","uniteRegional","detailSpecialite","detailCentreFormation","detailTrainingCentre","detailStatGraduateTraining","detailPrivateTrainingCentre","detailEtatiqueStatGraduateTraining","detailsEconomicData","detailProject","listDetailDemande","detailsBTS"})
     * @Serializer\Expose()
     * @Groups({"ReferencielGroup"})
     */
    protected $intituleAr;


    /**
     * @ORM\OneToMany(targetEntity="Referenciel", mappedBy="parent")
     * @ORM\OrderBy({"intituleFr" = "ASC"})
     *  @Serializer\Groups({"filtrecateggroup"})
     * @Serializer\Expose()
     * @Groups({"filtrecateggroup"}),
     */
    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="Referenciel", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     * @Serializer\Groups({"ReferencielGroup", "AppUserGroup","uniteRegional","detailSpecialite","detailCentreFormation","detailTrainingCentre","listDetailDemande","detailsBTS"})
     * @Serializer\Expose()
     * @Groups({"ReferencielGroup"})
     */
    protected $parent;

    /**
     * @var boolean
     * @ORM\Column(name="enable", type="boolean",nullable=true)
     * @Serializer\Groups({"ReferencielGroup"})
     * @Serializer\Expose()
     */
    protected $enable;
    /**
     * Default constructor, initializes collections
     */
    public function __construct() {
        $this->children = new ArrayCollection();
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set intituleFr.
     *
     * @param string $intituleFr
     *
     * @return Referenciel
     */
    public function setIntituleFr($intituleFr) {
        $this->intituleFr = $intituleFr;

        return $this;
    }

    /**
     * Get intituleFr.
     *
     * @return string
     */
    public function getIntituleFr() {
        return $this->intituleFr;
    }

    /**
     * Set intituleAr.
     *
     * @param string $intituleAr
     *
     * @return Referenciel
     */
    public function setIntituleAr($intituleAr) {
        $this->intituleAr = $intituleAr;

        return $this;
    }

    /**
     * Get intituleAr.
     *
     * @return string
     */
    public function getIntituleAr() {
        return $this->intituleAr;
    }

    /**
     * @return ArrayCollection
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * @param ArrayCollection $children
     */
    public function setChildren($children) {
        $this->children = $children;
    }

    /**
     * @return Referenciel
     */
    public function getParent() {
        return $this->parent;
    }

    /**
     * @param Referenciel $parent
     */
    public function setParent($parent) {
        $this->parent = $parent;
    }

    /**
     * Method to retrieve the possible categories for a reference
     * @return ArrayCollection
     */
    public static function getReferencielCategories() {
        $categorie = new ArrayCollection();		
        $categorie->add("RefPays");
        $categorie->add("RefNationalite");
        $categorie->add("RefGouvernorat");
        $categorie->add("RefDelegation");
        $categorie->add("RefMunicipalite");
        $categorie->add("RefLocalite");
        $categorie->add("RefDomaine");
        $categorie->add("RefSecteur");
        $categorie->add("RefSousSecteur");		
        $categorie->add("RefNatureBesoinSpecifique");
        $categorie->add("RefNiveauEtude");
        $categorie->add("RefNiveauDiplome");
        $categorie->add("RefStatut");
        $categorie->add("RefMotif");
        $categorie->add("RefStructure");
        $categorie->add("RefFonction");
        $categorie->add("RefDelaisDemande");
        $categorie->add("RefRegime");
        $categorie->add("RefSecteurEconomic");
        $categorie->add("RefObjetEconomic");
        $categorie->add("RefFonctionCadreRegion");
        $categorie->add("RefCaracteristiqueRegion");
        $categorie->add("RefGrade");
        return $categorie;
    }

    /**
     * Method to check if the categorie is valid
     * @return bool
     */
    public static function checkIfValidCategorie($categorie) {
        $categories = Referenciel::getReferencielCategories();
        return $categories->contains($categorie);
    }

    /**
     * Add child.
     *
     * @param \Mfpe\ReferencielBundle\Entity\Referenciel $child
     *
     * @return Referenciel
     */
    public function addChild(\Mfpe\ReferencielBundle\Entity\Referenciel $child) {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child.
     *
     * @param \Mfpe\ReferencielBundle\Entity\Referenciel $child
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeChild(\Mfpe\ReferencielBundle\Entity\Referenciel $child) {
        return $this->children->removeElement($child);
    }


    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return Referenciel
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
