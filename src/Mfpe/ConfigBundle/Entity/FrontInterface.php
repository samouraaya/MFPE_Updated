<?php


namespace Mfpe\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Mfpe\ConfigBundle\Repository\FrontInterfaceRepository")
 * @ORM\Table(name="front_interface")
 * @Serializer\ExclusionPolicy("ALL")
 */
class FrontInterface
{
    //use AbstractEntity;

    /**
     * @var
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"FrontInterfaceGroup"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity="FrontInterface", mappedBy="parent")
     * @ORM\OrderBy({"intituleFr" = "ASC"})
     * @Serializer\Groups({"filtrecateggroup"})
     * @Serializer\Expose()
     */

    protected $children;

    /**
     * @ORM\ManyToOne(targetEntity="FrontInterface", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", onDelete="SET NULL")
     * @Serializer\Groups({"FrontInterfaceGroup"})
     * @Serializer\Expose()
     */
    protected $parent;

    /**
     *
     * @var string
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     * @Serializer\Groups({"FrontInterfaceGroup"})
     * @Serializer\Expose()
     */
    private $link;

    /**
     *
     * @var string
     * @ORM\Column(name="url_back_end", type="string", length=255, nullable=true)
     * @Serializer\Groups({"FrontInterfaceGroup"})
     * @Serializer\Expose()
     */
    private $urlBackEnd;

    /**
     *
     * @var array
     * @ORM\Column(name="parametres", type="array")
     * @Serializer\Groups({"FrontInterfaceGroup"})
     * @Serializer\Expose()
     */
    private $parametres;

    /**
     *
     * @var array
     * @ORM\Column(name="method", type="array")
     * @Serializer\Groups({"FrontInterfaceGroup"})
     * @Serializer\Expose()
     */
    private $method;

    /**
     *
     * @var string
     * @ORM\Column(name="code", type="string", length=255, nullable=false, unique=true)
     * @Serializer\Groups({"FrontInterfaceGroup"})
     * @Serializer\Expose()
     */
    private $code;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

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
     * Set link.
     *
     * @param string|null $link
     *
     * @return FrontInterface
     */
    public function setLink($link = null)
    {
        $this->link = $link;

        return $this;
    }

    /**
     * Get link.
     *
     * @return string|null
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * Set urlBackEnd.
     *
     * @param string|null $urlBackEnd
     *
     * @return FrontInterface
     */
    public function setUrlBackEnd($urlBackEnd = null)
    {
        $this->urlBackEnd = $urlBackEnd;

        return $this;
    }

    /**
     * Get urlBackEnd.
     *
     * @return string|null
     */
    public function getUrlBackEnd()
    {
        return $this->urlBackEnd;
    }

    /**
     * Set parametres.
     *
     * @param array $parametres
     *
     * @return FrontInterface
     */
    public function setParametres($parametres)
    {
        $this->parametres = $parametres;

        return $this;
    }

    /**
     * Get parametres.
     *
     * @return array
     */
    public function getParametres()
    {
        return $this->parametres;
    }

    /**
     * Set method.
     *
     * @param array $method
     *
     * @return FrontInterface
     */
    public function setMethod($method)
    {
        $this->method = $method;

        return $this;
    }

    /**
     * Get method.
     *
     * @return array
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * Set code.
     *
     * @param string $code
     *
     * @return FrontInterface
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Add child.
     *
     * @param \Mfpe\ConfigBundle\Entity\FrontInterface $child
     *
     * @return FrontInterface
     */
    public function addChild(\Mfpe\ConfigBundle\Entity\FrontInterface $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child.
     *
     * @param \Mfpe\ConfigBundle\Entity\FrontInterface $child
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeChild(\Mfpe\ConfigBundle\Entity\FrontInterface $child)
    {
        return $this->children->removeElement($child);
    }

    /**
     * Get children.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent.
     *
     * @param \Mfpe\ConfigBundle\Entity\FrontInterface|null $parent
     *
     * @return FrontInterface
     */
    public function setParent(\Mfpe\ConfigBundle\Entity\FrontInterface $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent.
     *
     * @return \Mfpe\ConfigBundle\Entity\FrontInterface|null
     */
    public function getParent()
    {
        return $this->parent;
    }

}
