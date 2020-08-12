<?php

namespace Mfpe\UniteRegionaleBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;

use Mfpe\ConfigBundle\Entity\AbstractEntity;


/**
 * Description
 *
 * @ORM\Table(name="description")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\UniteRegionaleBundle\Repository\DescriptionRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */

class Description
{
    use AbstractEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"descriptionGroup"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"descriptionGroup"})
     * @Serializer\Expose()
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefCaracteristiqueRegion")
     * @ORM\JoinColumn(name="caracteristique_region", referencedColumnName="id")
     * @Serializer\Groups({"descriptionGroup"})
     * @Serializer\Expose()
     */
    private $caracteristiqueRegion;
    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\UniteRegionaleBundle\Entity\IdentiteRegion",inversedBy="descriptions")
     * @ORM\JoinColumn(name="identite_region", referencedColumnName="id")
     * @Serializer\Groups({"descriptionGroup"})
     * @Serializer\Expose()
     */
    private $identiteRegion;



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
     * Set description.
     *
     * @param string|null $description
     *
     * @return Description
     */
    public function setDescription($description = null)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description.
     *
     * @return string|null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set caracteristiqueRegion.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefCaracteristiqueRegion|null $caracteristiqueRegion
     *
     * @return Description
     */
    public function setCaracteristiqueRegion(\Mfpe\ReferencielBundle\Entity\RefCaracteristiqueRegion $caracteristiqueRegion = null)
    {
        $this->caracteristiqueRegion = $caracteristiqueRegion;

        return $this;
    }

    /**
     * Get caracteristiqueRegion.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefCaracteristiqueRegion|null
     */
    public function getCaracteristiqueRegion()
    {
        return $this->caracteristiqueRegion;
    }

    /**
     * Set identiteRegion.
     *
     * @param \Mfpe\UniteRegionaleBundle\Entity\IdentiteRegion|null $identiteRegion
     *
     * @return Description
     */
    public function setIdentiteRegion(\Mfpe\UniteRegionaleBundle\Entity\IdentiteRegion $identiteRegion = null)
    {
        $this->identiteRegion = $identiteRegion;

        return $this;
    }

    /**
     * Get identiteRegion.
     *
     * @return \Mfpe\UniteRegionaleBundle\Entity\IdentiteRegion|null
     */
    public function getIdentiteRegion()
    {
        return $this->identiteRegion;
    }
    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return Description
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
