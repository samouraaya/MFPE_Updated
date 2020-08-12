<?php

namespace Mfpe\ReferencielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Mfpe\ReferencielBundle\Entity\TraitFieldsReferenciel;

/**
 * RefMotif
 * @ORM\MappedSuperclass
 * @ORM\Table(name="referenciel")
 * @ORM\Entity()
 */
class RefMotif extends Referenciel
{
    use TraitFieldsReferenciel;
    /**
     * @var bool
     *
     * @ORM\Column(name="motif_dr", type="boolean", options={"default":"0"})
     * @Serializer\Groups({"ReferencielGroup"})
     * @Serializer\Expose()
     */
    private $motifDr;

    /**
     * Set motifDr.
     *
     * @param bool $motifDr
     *
     * @return RefMotif
     */
    public function setMotifDr($motifDr)
    {
        $this->motifDr = $motifDr;

        return $this;
    }



    /**
     * Get motifDr.
     *
     * @return bool
     */
    public function getMotifDr()
    {
        return $this->motifDr;
    }

    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return RefMotif
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
