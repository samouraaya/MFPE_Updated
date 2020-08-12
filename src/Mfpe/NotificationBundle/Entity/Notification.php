<?php

namespace Mfpe\NotificationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Mfpe\ConfigBundle\Entity\AbstractEntity;

/**
 * notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="Mfpe\NotificationBundle\Repository\NotificationRepository")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Notification
{
    use AbstractEntity;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @Serializer\Groups({"notification"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime",nullable=true)
     * @Serializer\Groups({"notification"})
     * @Serializer\Expose()
     */
    private $dateCreation;
    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="integer", length=1, nullable=true, options={"default"="NULL"})
     * @Serializer\Groups({"notification"})
     * @Serializer\Expose()
     */
    private $type;
    /**
     * @ORM\ManyToOne(targetEntity="Mfpe\AttestationBundle\Entity\Demande")
     * @ORM\JoinColumn(name="demande", referencedColumnName="id")
     * @Serializer\Groups({"notification"})
     * @Serializer\Expose()
     */
    private $demande;
    /**
     * @var string|null
     *
     * @ORM\Column(name="status_notif", type="boolean")
     * @Serializer\Groups({"notification"})
     * @Serializer\Expose()
     */
    private $statusNotif;
    /**
     * @var \Mfpe\ConfigBundle\Entity\AppUser
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\ConfigBundle\Entity\AppUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_send", referencedColumnName="id")
     * })
     * @Serializer\Groups({"notification"})
     * @Serializer\Expose()
     */
    private $userSend;
    /**
     * @var \Mfpe\ConfigBundle\Entity\AppUser
     *
     * @ORM\ManyToOne(targetEntity="Mfpe\ConfigBundle\Entity\AppUser")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_receive", referencedColumnName="id")
     * })
     * @Serializer\Groups({"notification"})
     * @Serializer\Expose()
     */
    private $userReceive;


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
     * @return Notification
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
     * Set userSend.
     *
     * @param \Mfpe\ConfigBundle\Entity\AppUser|null $userSend
     *
     * @return Notification
     */
    public function setUserSend(\Mfpe\ConfigBundle\Entity\AppUser $userSend = null)
    {
        $this->userSend = $userSend;

        return $this;
    }

    /**
     * Get userSend.
     *
     * @return \Mfpe\ConfigBundle\Entity\AppUser|null
     */
    public function getUserSend()
    {
        return $this->userSend;
    }

    /**
     * Set userReceive.
     *
     * @param \Mfpe\ConfigBundle\Entity\AppUser|null $userReceive
     *
     * @return Notification
     */
    public function setUserReceive(\Mfpe\ConfigBundle\Entity\AppUser $userReceive = null)
    {
        $this->userReceive = $userReceive;

        return $this;
    }

    /**
     * Get userReceive.
     *
     * @return \Mfpe\ConfigBundle\Entity\AppUser|null
     */
    public function getUserReceive()
    {
        return $this->userReceive;
    }

    /**
     * Set type.
     *
     * @param int|null $type
     *
     * @return Notification
     */
    public function setType($type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return int|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set statusNotif.
     *
     * @param bool|null $statusNotif
     *
     * @return Notification
     */
    public function setStatusNotif($statusNotif = null)
    {
        $this->statusNotif = $statusNotif;

        return $this;
    }

    /**
     * Get statusNotif.
     *
     * @return bool|null
     */
    public function getStatusNotif()
    {
        return $this->statusNotif;
    }

    /**
     * Set dateCreation.
     *
     * @param \DateTime|null $dateCreation
     *
     * @return Notification
     */
    public function setDateCreation($dateCreation = null)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation.
     *
     * @return \DateTime|null
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }
}
