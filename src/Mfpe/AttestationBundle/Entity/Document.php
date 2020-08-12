<?php

namespace Mfpe\AttestationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Serializer\Annotation\Groups;
use Mfpe\ConfigBundle\Entity\AbstractEntity;


/**
 * Document
 *
 * @ORM\Table(name="document")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\AttestationBundle\Repository\DocumentRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Document
{

    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"listDemande", "detailDemande","listDetailDemande","document"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\AttestationBundle\Entity\Demande", inversedBy="documents")
     * @ORM\JoinColumn(name="Demande", referencedColumnName="id")
     * @Serializer\Groups({"listDemande", "detailDemande","document"})
     * @Serializer\Expose()
     */
    private $demande;


    /**
     * @var string|null
     *
     * @ORM\Column(name="path", type="string", length=255, nullable=true)
     * @Serializer\Groups({"listDemande", "detailDemande","listDetailDemande","document"})
     * @Serializer\Expose()
     */
    private $path;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     * @Serializer\Groups({"listDemande", "detailDemande","listDetailDemande","document"})
     * @Serializer\Expose()
     */
    private $name;


    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     * @Serializer\Groups({"listDemande", "detailDemande","listDetailDemande","document"})
     * @Serializer\Expose()
     */
    private $type;


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
     * Set path.
     *
     * @param string|null $path
     *
     * @return Document
     */
    public function setPath($path = null)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path.
     *
     * @return string|null
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set name.
     *
     * @param string|null $name
     *
     * @return Document
     */
    public function setName($name = null)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string|null
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set demande.
     *
     * @param \Mfpe\AttestationBundle\Entity\Demande|null $demande
     *
     * @return Document
     */
    public function setDemande(\Mfpe\AttestationBundle\Entity\Demande $demande = null)
    {
        $this->demande = $demande;

        return $this;
    }

    /**
     * Get demande.
     *
     * @return \Mfpe\AttestationBundle\Entity\Demande|null
     */
    public function getDemande()
    {
        return $this->demande;
    }

    /**
     * Set type.
     *
     * @param string|null $type
     *
     * @return Document
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
}
