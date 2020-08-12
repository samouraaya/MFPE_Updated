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
 * Delais
 *
 * @ORM\Table(name="delais")
 * @ORM\Entity(repositoryClass="Mfpe\AttestationBundle\Repository\DelaisRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Delais
{
    use AbstractEntity;
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"detailDelais"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(name="nb_delais_examen", type="integer" , nullable=true, options={"default"="0"})
     * @Serializer\Groups({"detailDelais"})
     * @Serializer\Expose()
     */
    private $nbDelaisExamen;

    /**
     * @var integer
     * @ORM\Column(name="nb_delais_pv", type="integer" , nullable=true, options={"default"="0"})
     * @Serializer\Groups({"detailDelais"})
     * @Serializer\Expose()
     */
    private $nbDelaisPv;






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
     * Set nbDelaisExamen.
     *
     * @param int|null $nbDelaisExamen
     *
     * @return Delais
     */
    public function setNbDelaisExamen($nbDelaisExamen = null)
    {
        $this->nbDelaisExamen = $nbDelaisExamen;

        return $this;
    }

    /**
     * Get nbDelaisExamen.
     *
     * @return int|null
     */
    public function getNbDelaisExamen()
    {
        return $this->nbDelaisExamen;
    }

    /**
     * Set nbDelaisPv.
     *
     * @param int|null $nbDelaisPv
     *
     * @return Delais
     */
    public function setNbDelaisPv($nbDelaisPv = null)
    {
        $this->nbDelaisPv = $nbDelaisPv;

        return $this;
    }

    /**
     * Get nbDelaisPv.
     *
     * @return int|null
     */
    public function getNbDelaisPv()
    {
        return $this->nbDelaisPv;
    }
}
