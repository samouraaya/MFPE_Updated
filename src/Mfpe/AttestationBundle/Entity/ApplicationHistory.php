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
 * ApplicationHistory
 *
 * @ORM\Table(name="application_history")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Mfpe\AttestationBundle\Repository\ApplicationHistoryRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class ApplicationHistory
{
	
	    use AbstractEntity;
		
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"detailDemande"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var \Mfpe\AttestationBundle\Entity\Demande
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\AttestationBundle\Entity\Demande", inversedBy="applicationHistorys")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="demande", referencedColumnName="id")
     * })
     * @Serializer\Groups({"detailDemande"})
     * @Serializer\Expose()
     */
    private $demande;

    /**
     * @var \statut
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefStatut")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="statut", referencedColumnName="id")
     * })
     * @Serializer\Groups({"detailDemande"})
     * @Serializer\Expose()
     */
    private $statut;

    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\ReferencielBundle\Entity\RefMotif")
     * @ORM\JoinColumn(name="motif", referencedColumnName="id")
     * @Serializer\Groups({"detailDemande"})
     * @Serializer\Expose()
     */
    private $motif;




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
     * Set demande.
     *
     * @param \Mfpe\AttestationBundle\Entity\Demande|null $demande
     *
     * @return ApplicationHistory
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
     * Set statut.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefStatut|null $statut
     *
     * @return ApplicationHistory
     */
    public function setStatut(\Mfpe\ReferencielBundle\Entity\RefStatut $statut = null)
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * Get statut.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefStatut|null
     */
    public function getStatut()
    {
        return $this->statut;
    }

    /**
     * Set motif.
     *
     * @param \Mfpe\ReferencielBundle\Entity\RefMotif|null $motif
     *
     * @return ApplicationHistory
     */
    public function setMotif(\Mfpe\ReferencielBundle\Entity\RefMotif $motif = null)
    {
        $this->motif = $motif;

        return $this;
    }

    /**
     * Get motif.
     *
     * @return \Mfpe\ReferencielBundle\Entity\RefMotif|null
     */
    public function getMotif()
    {
        return $this->motif;
    }
}
