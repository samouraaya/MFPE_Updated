<?php

namespace Mfpe\ReferencielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation as Serializer;
use Mfpe\ReferencielBundle\Entity\TraitFieldsReferenciel;

/**
 * RefSousSecteur
 * @ORM\MappedSuperclass
 * @ORM\Table(name="referenciel")
 * @ORM\Entity()
 */
class RefSousSecteur extends Referenciel {
    use TraitFieldsReferenciel;

    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return RefSousSecteur
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
