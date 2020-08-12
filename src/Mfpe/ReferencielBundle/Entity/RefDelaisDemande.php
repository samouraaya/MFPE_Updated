<?php
namespace Mfpe\ReferencielBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Mfpe\ReferencielBundle\Entity\TraitFieldsReferenciel;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation as Serializer;


/**
 * RefDelaisDemande
 * @ORM\MappedSuperclass
 * @ORM\Table(name="referenciel")
 * @ORM\Entity()
 */
class RefDelaisDemande extends Referenciel
{
    use TraitFieldsReferenciel;


    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return RefDelaisDemande
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
