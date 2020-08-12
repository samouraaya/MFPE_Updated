<?php

namespace Mfpe\UniteRegionaleBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;

use Mfpe\ConfigBundle\Entity\AbstractEntity;


/**
 * UniteRegionale
 *
 * @ORM\Table(name="unite_regionale")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\UniteRegionaleBundle\Repository\UniteRegionaleRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */

class UniteRegionale
{
    use AbstractEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"DeserializeDemandeGroup", "DemandeGroup" ,"listDemande", "detailDemande","uniteRegional","detailsEconomicData","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code_unite", type="string", length=45, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","uniteRegional","detailsEconomicData","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $codeUnite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="titre_ar", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","uniteRegional","notification","detailsEconomicData","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $titreAr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="titre_fr", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","uniteRegional","notification","detailsEconomicData","listDetailDemande"})
     * @Serializer\Expose()
     */
    private $titreFr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="premier_responsable", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","uniteRegional"})
     * @Serializer\Expose()
     */
    private $premierResponsable;

    /**
     * @var int|null
     *
     * @ORM\Column(name="tel", type="string",nullable=true)
     * @Serializer\Groups({"listDemande", "detailDemande","uniteRegional"})
     * @Serializer\Expose()
     */
    private $tel;


    /**
     * @var int|null
     *
     * @ORM\Column(name="fax", type="string",nullable=true)
     * @Serializer\Groups({"listDemande", "detailDemande","uniteRegional"})
     * @Serializer\Expose()
     */
    private $fax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"listDemande", "detailDemande","uniteRegional"})
     * @Serializer\Expose()
     */
    private $email;


    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefGouvernorat")
     * @ORM\JoinColumn(name="gouvernorat", referencedColumnName="id")
     * @Serializer\Groups({"listDemande", "detailDemande","uniteRegional","detailsEconomicData"})
     * @Serializer\Expose()
     */
    private $gouvernorat;

    /**
     * @var boolean
     * @ORM\Column(name="enable", type="boolean",nullable=true)
     * @Serializer\Groups({"listDemande", "detailDemande","uniteRegional","detailsEconomicData"})
     * @Serializer\Expose()
     */
    protected $enable;

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
     * Set codeUnite.
     *
     * @param string|null $codeUnite
     *
     * @return UniteRegionale
     */
    public function setCodeUnite($codeUnite = null)
    {
        $this->codeUnite = $codeUnite;

        return $this;
    }

    /**
     * Get codeUnite.
     *
     * @return string|null
     */
    public function getCodeUnite()
    {
        return $this->codeUnite;
    }

    /**
     * Set titreAr.
     *
     * @param string|null $titreAr
     *
     * @return UniteRegionale
     */
    public function setTitreAr($titreAr = null)
    {
        $this->titreAr = $titreAr;

        return $this;
    }

    /**
     * Get titreAr.
     *
     * @return string|null
     */
    public function getTitreAr()
    {
        return $this->titreAr;
    }

    /**
     * Set titreFr.
     *
     * @param string|null $titreFr
     *
     * @return UniteRegionale
     */
    public function setTitreFr($titreFr = null)
    {
        $this->titreFr = $titreFr;

        return $this;
    }

    /**
     * Get titreFr.
     *
     * @return string|null
     */
    public function getTitreFr()
    {
        return $this->titreFr;
    }

    /**
     * Set premierResponsable.
     *
     * @param string|null $premierResponsable
     *
     * @return UniteRegionale
     */
    public function setPremierResponsable($premierResponsable = null)
    {
        $this->premierResponsable = $premierResponsable;

        return $this;
    }

    /**
     * Get premierResponsable.
     *
     * @return string|null
     */
    public function getPremierResponsable()
    {
        return $this->premierResponsable;
    }

    /**
     * Set tel.
     *
     * @param string|null $tel
     *
     * @return UniteRegionale
     */
    public function setTel($tel = null)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel.
     *
     * @return string|null
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set fax.
     *
     * @param string|null $fax
     *
     * @return UniteRegionale
     */
    public function setFax($fax = null)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax.
     *
     * @return string|null
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set email.
     *
     * @param string|null $email
     *
     * @return UniteRegionale
     */
    public function setEmail($email = null)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string|null
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set gouvernorat.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null $gouvernorat
     *
     * @return UniteRegionale
     */
    public function setGouvernorat(\Mfpe\ReferencielBundle\Entity\RefGouvernorat $gouvernorat = null)
    {
        $this->gouvernorat = $gouvernorat;

        return $this;
    }

    /**
     * Get gouvernorat.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefGouvernorat|null
     */
    public function getGouvernorat()
    {
        return $this->gouvernorat;
    }

    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return UniteRegionale
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
