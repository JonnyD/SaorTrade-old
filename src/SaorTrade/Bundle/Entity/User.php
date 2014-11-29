<?php

namespace SaorTrade\Bundle\Entity;

use SaorTrade\Bundle\Entity\Role;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\EquatableInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="SaorTrade\Bundle\Repository\Doctrine\ORM\UserRepository")
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="user", indexes={
 *      @ORM\Index(name="username_idx", columns={"username", "username"}),
 *      @ORM\Index(name="email_idx", columns={"email", "email"})
 * })
 */
class User implements UserInterface, EquatableInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    private $username;

    /**
     * @ORM\Column(name="username_canonical", type="string", nullable=true, unique=true)
     */
    protected $usernameCanonical;

    /**
     * @ORM\Column(type="string")
     */
    protected $password;

    /**
     * @ORM\Column(name="reset_key", type="string", length=255, nullable=true)
     */
    protected $resetKey;

    /**
     * @ORM\Column(name="reset_request_time", type="datetime", nullable=true)
     */
    protected $resetRequest;

    /**
     * @ORM\Column(name="last_reset_time", type="datetime", nullable=true)
     */
    protected $lastReset;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $email;

    /**
     * @ORM\Column(name="email_canonical", type="string", nullable=true, unique=true)
     */
    protected $emailCanonical;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $activated;

    /**
     * @ORM\Column(name="activation_key", type="string", length=255, nullable=true)
     */
    protected $activationKey;

    /**
     * @Gedmo\Timestampable(on="create")
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $registered;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $lastActive;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $avatar;

    /**
     * @ORM\Column(name="salt",  type="string", length=255, nullable=true)
     */
    protected $salt;

    /**
     * @ORM\ManyToMany(targetEntity="Role", inversedBy="users")
     * @ORM\JoinTable(name="user_role")
     */
    private $roles;

    /**
     * @ORM\OneToMany(targetEntity="Want", mappedBy="user", cascade="persist")
     */
    private $wants;

    public function __construct()
    {
        $this->roles = new ArrayCollection();
        $this->wants = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getUsernameCanonical()
    {
        return $this->usernameCanonical;
    }

    public function setUsernameCanonical($usernameCanonical)
    {
        $this->usernameCanonical = $usernameCanonical;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getResetKey()
    {
        return $this->resetKey;
    }

    public function setResetKey($resetKey)
    {
        $this->resetKey = $resetKey;
    }

    public function getResetRequest()
    {
        return $this->resetRequest;
    }

    public function setResetRequest($resetRequest)
    {
        $this->resetRequest = $resetRequest;
    }

    public function getLastReset()
    {
        return $this->lastReset;
    }

    public function setLastReset($lastReset)
    {
        $this->lastReset = $lastReset;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getEmailCanonical()
    {
        return $this->emailCanonical;
    }

    public function setEmailCanonical($emailCanonical)
    {
        $this->emailCanonical = $emailCanonical;
    }

    public function getActivated()
    {
        return $this->activated;
    }

    public function setActivated($activated)
    {
        $this->activated = $activated;
    }

    public function getActivationKey()
    {
        return $this->activationKey;
    }

    public function setActivationKey($activationKey)
    {
        $this->activationKey = $activationKey;
    }

    public function getRegistered()
    {
        return $this->registered;
    }

    public function setRegistered($registered)
    {
        $this->registered = $registered;
    }

    public function getLastActive()
    {
        return $this->lastActive;
    }

    public function setLastActive($lastActive)
    {
        $this->lastActive = $lastActive;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
    }

    public function getSalt()
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        $roleNames = array();
        foreach ($this->roles as $role) {
            $roleNames[] = $role->getRole();
        }
        return $roleNames;
    }

    /**
     * Has role
     *
     * @param Role $role
     * @return bool
     */
    public function hasRole(Role $role)
    {
        return $this->roles->contains($role);
    }

    /**
     * Add role
     *
     * @param Role $role
     */
    public function addRole(Role $role)
    {
        if (!$this->hasRole($role)) {
            $this->roles->add($role);
        }
    }

    /**
     * Remove roles
     *
     * @param Role $role
     */
    public function removeRole(Role $role)
    {
        if ($this->hasRole($role)) {
            $this->roles->removeElement($role);
            $role->removeUser($this);
        }
    }

    public function isEqualTo(UserInterface $user)
    {
        if (!$user instanceof User) {
            return false;
        }

        if ($this->username !== $user->getUsername()) {
            return false;
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {

    }

    public function getWants()
    {
        return $this->wants;
    }

    public function setWants($wants)
    {
        $this->wants = $wants;
    }

    public function hasWant(Want $want)
    {
        return $this->wants->contains($want);
    }

    public function addWant(Want $want)
    {
        if (!$this->hasWant($want)) {
            $this->wants->add($want);
            $want->setUser($this);
        }
    }
}