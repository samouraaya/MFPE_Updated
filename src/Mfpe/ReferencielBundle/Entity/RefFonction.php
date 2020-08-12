<?php

namespace Mfpe\ReferencielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Mfpe\ReferencielBundle\Entity\TraitFieldsReferenciel;

/**
 * RefFonction
 * @ORM\MappedSuperclass
 * @ORM\Table(name="referenciel")
 * @ORM\Entity()
 */
class RefFonction extends Referenciel
{
    use TraitFieldsReferenciel;
    /**
     * @ORM\Column(name="role", type="text",nullable=true)
     * @Serializer\Groups({"ReferencielGroup","listDemande", "detailDemande", "AppUserGroup","uniteRegional","detailSpecialite","detailCentreFormation"})
     * @Serializer\Expose()
     */
    protected $role;

    /**
     * Set role.
     *
     * @param string|null $role
     *
     * @return RefFonction
     */
    public function setRole($role = null)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role.
     *
     * @return string|null
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set enable.
     *
     * @param bool|null $enable
     *
     * @return RefFonction
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
