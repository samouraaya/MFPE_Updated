<?php

namespace Mfpe\ReferencielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Serializer\Annotation\Groups;
use Mfpe\ReferencielBundle\Entity\TraitFieldsReferenciel;


/**
 * RefSecteur
 * @ORM\MappedSuperclass
 * @ORM\Table(name="referenciel")
 * @ORM\Entity()
 */
class RefSecteur extends Referenciel {

    use TraitFieldsReferenciel;

    /**
     * @ORM\Column(name="type", type="string", length=255, nullable=true, columnDefinition="ENUM('public', 'private')")
     *  @Serializer\Groups({"ReferencielGroup"})
     * @Serializer\Expose()
     * @Groups({"ReferencielGroup"})
     */
    protected $type;


    /**
     * @var bool
     *
     * @ORM\Column(name="typeSecteur", type="boolean", options={"default":"0"})
     * @Serializer\Groups({"ReferencielGroup"})
     * @Serializer\Expose()
     */
    protected $typeSecteur;
    
    /**
     * Set type.
     *
     * @param string|null $type
     *
     * @return RefSecteur
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return RefSecteur
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
     * Set typeSecteur.
     *
     * @param bool $typeSecteur
     *
     * @return RefSecteur
     */
    public function setTypeSecteur($typeSecteur)
    {
        $this->typeSecteur = $typeSecteur;

        return $this;
    }

    /**
     * Get typeSecteur.
     *
     * @return bool
     */
    public function getTypeSecteur()
    {
        return $this->typeSecteur;
    }
}
