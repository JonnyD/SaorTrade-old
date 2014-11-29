<?php

namespace SaorTrade\Bundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * @ORM\Entity(repositoryClass="SaorTrade\Bundle\Repository\Doctrine\ORM\RoleRepository")
 * @ORM\Table(name="role")
 */
class Role implements RoleInterface, \Serializable
{
    /**
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=30)
     */
    private $name;

    /**
     * @ORM\Column(name="role", type="string", length=20, unique=true)
     */
    private $role;

    /**
     * @ORM\ManyToMany(targetEntity="User", mappedBy="roles")
     */
    private $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * @see RoleInterface
     */
    public function getRole()
    {
        return $this->role;
    }


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Role
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set role
     *
     * @param string $role
     * @return Role
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Has user
     *
     * @param User $user
     * @return bool
     */
    public function hasUser(User $user)
    {
        return $this->users->contains($user);
    }

    /**
     * Add user
     *
     * @param User $user
     */
    public function addUser(User $user)
    {
        if (!$this->hasUser($user)) {
            $this->users->add($user);
        }
    }

    /**
     * Remove user
     *
     * @param User $user
     */
    public function removeUser(User $user)
    {
        if ($this->hasUser($user)) {
            $this->users->removeElement($user);
            $user->addRole($this);
        }
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            ) = unserialize($serialized);
    }
}