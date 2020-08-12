<?php

namespace Mfpe\ReferencielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Mfpe\ReferencielBundle\Entity\TraitFieldsReferenciel;

/**
 * RefFonctionCadreRegion
 * @ORM\MappedSuperclass
 * @ORM\Table(name="referenciel")
 * @ORM\Entity()
 */
class RefFonctionCadreRegion extends Referenciel
{
    use TraitFieldsReferenciel;
    /**
     * @var bool
     *
     * @ORM\Column(name="delegation", type="boolean", options={"default":"0"})
     * @Serializer\Groups({"ReferencielGroup"})
     * @Serializer\Expose()
     */
    private $delegation;

    /**
     * Set delegation.
     *
     * @param bool $delegation
     *
     * @return RefFonctionCadreRegion
     */
    public function setDelegation($delegation)
    {
        $this->delegation = $delegation;

        return $this;
    }

    /**
     * Get delegation.
     *
     * @return bool
     */
    public function getDelegation()
    {
        return $this->delegation;
    }

    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return RefFonctionCadreRegion
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
