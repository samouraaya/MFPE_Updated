<?php

namespace Mfpe\ReferencielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Mfpe\ReferencielBundle\Entity\TraitFieldsReferenciel;

/**
 * RefGrade
 * @ORM\MappedSuperclass
 * @ORM\Table(name="referenciel")
 * @ORM\Entity()
 */
class RefGrade extends Referenciel
{
    use TraitFieldsReferenciel;


    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return RefGrade
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
