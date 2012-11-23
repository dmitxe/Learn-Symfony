<?php

namespace Acme\BlogBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @var integer $id
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string", length=255, name="first_name")
     * 
     * @var string $firstName
     */
    protected $firstName;
    
    /**
     * @ORM\Column(type="string", length=255, name="last_name")
     * 
     * @var string $lastName
     */
    protected $lastName;
    
    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @var string $email
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string username
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string password
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string salt
     */
    protected $salt;
    
    /**
     * @ORM\Column(type="datetime", name="created_at")
     * 
     * @var DateTime $createdAt
     */
    protected $createdAt;
    
    /**
     * @ORM\OneToMany(targetEntity="Post", mappedBy="user")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     * 
     * @var ArrayCollection $posts
     */
    protected $posts;

    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="user_role",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     *
     * @var ArrayCollection $userRoles
     */
    protected $userRoles;
    
    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        /*
         * ! Don't serialize $roles field !
         */
        return \serialize(array(
            $this->id,
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->username,
            $this->password,
            $this->salt,
            $this->createdAt,
            $this->post,
            serialize($this->$userRoles),
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->firstName,
            $this->lastName,
            $this->email,
            $this->username,
            $this->password,
            $this->salt,
            $this->createdAt,
            $this->post,
            $userRoles,
        ) = \unserialize($serialized);

        $this->roles = unserialize($userRoles);
    }
    
    /**
     * Gets the id.
     * 
     * @return integer The id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Gets the user's first name.
     * 
     * @return string The first name
     */
    public function getFirstName()
    {
        return $this->firstName;
    }
    
    /**
     * Sets the user's first name.
     * 
     * @param string $value The first name
     */
    public function setFirstName( $value )
    {
        $this->firstName = $value;
    }
    
    /**
     * Gets the user's last name.
     * 
     * @return string The last name
     */
    public function getLastName()
    {
        return $this->lastName;
    }
    
    /**
     * Sets the user's last name.
     * 
     * @param string $value The last name
     */
    public function setLastName( $value )
    {
        $this->lastName = $value;
    }
    
    /**
     * Gets the user's email address.
     * 
     * @return string The email
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Sets the user's email address.
     * 
     * @param string $value The email
     */
    public function setEmail($value)
    {
        $this->email = $value;
    }

    /**
     * Gets the username.
     *
     * @return string The username.
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Sets the username.
     *
     * @param string $value The username.
     */
    public function setUsername($value)
    {
        $this->username = $value;
    }

    /**
     * Gets the user password.
     *
     * @return string The password.
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Sets the user password.
     *
     * @param string $value The password.
     */
    public function setPassword($value)
    {
        $this->password = $value;
    }

    /**
     * Gets the user salt.
     *
     * @return string The salt.
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * Sets the user salt.
     *
     * @param string $value The salt.
     */
    public function setSalt($value)
    {
        $this->salt = $value;
    }
    
    /**
     * Gets an object representing the date and time the user was created.
     * 
     * @return DateTime A DateTime object
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    /**
     * Gets all of the user's posts
     * 
     * @return ArrayCollection The user's posts
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * Gets the user roles.
     *
     * @return ArrayCollection A Doctrine ArrayCollection
     */
    public function getUserRoles()
    {
        return $this->userRoles;
    }
    
    /**
     * Constructs a new instance of User
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
        $this->userRoles = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }
    
    /**
     * Gets the full name of the user.
     * 
     * @return string The full name
     */
    public function getFullName()
    {
        return sprintf('%s %s', $this->firstName, $this->lastName);
    }

    /**
     * Erases the user credentials.
     */
    public function eraseCredentials()
    {

    }

    /**
     * Gets an array of roles.
     * 
     * @return array An array of Role objects
     */
    public function getRoles()
    {
        return $this->getUserRoles()->toArray();
    }

    /**
     * Compares this user to another to determine if they are the same.
     * 
     * @param UserInterface $user The user
     * @return boolean True if equal, false othwerwise.
     */
    public function  isEqualTo(UserInterface $user)
    {
        return md5($this->getUsername()) == md5($user->getUsername());
    }
}