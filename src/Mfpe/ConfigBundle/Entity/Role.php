<?php
/**
 * Created by PhpStorm.
 * User: cynapsys
 * Date: 28/06/18
 * Time: 05:38 م
 */

namespace Mfpe\ConfigBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="Mfpe\ConfigBundle\Repository\RoleRepository")
 * @ORM\Table(name="roles")
 * @Serializer\ExclusionPolicy("ALL")
 */
class Role
{
    use AbstractEntity;

    /**
     * @var
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Serializer\Groups({"DeserializeUserGroup","detailDemande", "RoleGroup","AppUserGroup"})
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="role", type="string", unique=true)
     * @Serializer\Groups({"RoleGroup","AppUserGroup","detailDemande"})
     * @Serializer\Expose()
     * @Assert\NotBlank(message="Le champ role est obligatoire")
     */
    private $role;

    /**
     * @var string
     * @ORM\Column(name="intitule_ar", type="string", nullable=true)
     * @Serializer\Groups({"RoleGroup","AppUserGroup"})
     * @Serializer\Expose()
     * @Assert\NotBlank(message="Le champ role est obligatoire")
     */
    private $intituleAr;

    /**
     * @var string
     * @ORM\Column(name="intitule_fr", type="string", nullable=true)
     * @Serializer\Groups({"RoleGroup","AppUserGroup"})
     * @Serializer\Expose()
     * @Assert\NotBlank(message="Le champ role est obligatoire")
     */
    private $intituleFr;

    /**
     * @var \Doctrine\Common\Collections\Collection|Permission[]
     * @ORM\ManyToMany(targetEntity="Mfpe\ConfigBundle\Entity\Permission", inversedBy="roles")
     * @ORM\JoinTable(
     *  name="role_permission",
     *  joinColumns={
     *      @ORM\JoinColumn(name="role_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *     @ORM\JoinColumn(name="permission_id", referencedColumnName="id")
     * })
     * @Serializer\Groups({"RoleGroup"})
     * @Serializer\Expose()
     */
    private $permissions;

    /**
     * @var \Doctrine\Common\Collections\Collection|AppUser[]
     * @ORM\ManyToMany(targetEntity="Mfpe\ConfigBundle\Entity\AppUser" , mappedBy="userRoles")
     * @Serializer\Groups({"RoleGroup","UserRole"})
     * @Serializer\Expose()
     */
    private $users;

    /**
     * @var ArrayCollection
     * @ORM\Column(name="front_interfaces", type="array")
     * @Serializer\Groups({"RoleGroup"})
     * @Assert\NotBlank(message="Le champ interfaces est obligatoire")
     * @Serializer\Expose()
     */
    private $frontInterfaces = array();

    /**
     * @var ArrayCollection
     * @ORM\Column(name="status", type="array")
     * @Serializer\Groups({"RoleGroup"})
     * @Serializer\Expose()
     */
    private $status = array();

    /**
     * @var ArrayCollection
     * @ORM\Column(name="state_execute", type="array")
     * @Serializer\Groups({"RoleGroup"})
     * @Serializer\Expose()
     */
    private $stateExecute = array();


    /**
     * @var bool
     *
     * @ORM\Column(name="editable", type="boolean",nullable=true)
     * @Serializer\Groups({"RoleGroup"})
     * @Serializer\Expose()
     */
    private $editable = true;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|Permission[]
     */
    public function getPermissions()
    {
        return $this->permissions;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection|Permission[] $permissions
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;
    }

    /**
     * @param Permission $permission
     */
    public function addPermission(Permission $permission)
    {
        if ($this->permissions->contains($permission)) {
            return;
        }
        $this->permissions->add($permission);
        $permission->addRole($this);
    }

    /**
     * @param Permission $permission
     */
    public function removePermission(Permission $permission)
    {
        if (!$this->permissions->contains($permission)) {
            return;
        }
        $this->permissions->removeElement($permission);
        $permission->removeRole($this);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection|AppUser[]
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection|AppUser[] $users
     */
    public function setUsers($users)
    {
        $this->users = $users;
    }

    /**
     * @param AppUser $user
     */
    public function addUser(AppUser $user)
    {
        if ($this->users->contains($user)) {
            return;
        }
        $this->users->add($user);
        $user->addRole($this);
    }

    /**
     * @param Permission $permission
     */
    public function removeUser(AppUser $user)
    {
        if (!$this->users->contains($user)) {
            return;
        }
        $this->users->removeElement($user);
        $user->removeRole($this);
    }


    /**
     * Set intituleAr.
     *
     * @param string|null $intituleAr
     *
     * @return Role
     */
    public function setIntituleAr($intituleAr = null)
    {
        $this->intituleAr = $intituleAr;

        return $this;
    }

    /**
     * Get intituleAr.
     *
     * @return string|null
     */
    public function getIntituleAr()
    {
        return $this->intituleAr;
    }

    /**
     * Set intituleFr.
     *
     * @param string|null $intituleFr
     *
     * @return Role
     */
    public function setIntituleFr($intituleFr = null)
    {
        $this->intituleFr = $intituleFr;

        return $this;
    }

    /**
     * Get intituleFr.
     *
     * @return string|null
     */
    public function getIntituleFr()
    {
        return $this->intituleFr;
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->permissions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->users = new \Doctrine\Common\Collections\ArrayCollection();
        $this->frontInterfaces = array();
        $this->status = array();
        $this->stateExecute = array();
    }
   

    /**
     * Set editable.
     *
     * @param bool|null $editable
     *
     * @return Role
     */
    public function setEditable($editable = null)
    {
        $this->editable = $editable;

        return $this;
    }

    /**
     * Get editable.
     *
     * @return bool|null
     */
    public function getEditable()
    {
        return $this->editable;
    }

    /**
     * Set frontInterfaces.
     *
     * @param array $frontInterfaces
     *
     * @return Role
     */
    public function setFrontInterfaces($frontInterfaces)
    {
        $this->frontInterfaces = $frontInterfaces;

        return $this;
    }

    /**
     * Get frontInterfaces.
     *
     * @return array
     */
    public function getFrontInterfaces()
    {
        return $this->frontInterfaces;
    }

    /**
     * Set status.
     *
     * @param array $status
     *
     * @return Role
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return array
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set stateExecute.
     *
     * @param array $stateExecute
     *
     * @return Role
     */
    public function setStateExecute($stateExecute)
    {
        $this->stateExecute = $stateExecute;

        return $this;
    }

    /**
     * Get stateExecute.
     *
     * @return array
     */
    public function getStateExecute()
    {
        return $this->stateExecute;
    }
}
