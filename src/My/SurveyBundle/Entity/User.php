<?php

namespace My\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 * @UniqueEntity("email")
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="first_name", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $firsName;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=60, unique=true)
     * @Assert\Email()
     * @Assert\NotBlank()
     */
    protected $email;

    /**
     * @var date
     *
     * @ORM\Column(name="birthday", type="date")
     * @Assert\DateTime()
     * @Assert\NotBlank()
     */
    protected $birthday;

    /**
     * @var integer
     *
     * @ORM\Column(name="shoe_size", type="smallint")
     * @Assert\NotBlank()
     */
    protected $shoeSize;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    protected $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    protected $updatedAt;

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
     * Set firsName
     *
     * @param string $firsName
     * @return User
     */
    public function setFirsName($firsName)
    {
        $this->firsName = $firsName;

        return $this;
    }

    /**
     * Get firsName
     *
     * @return string 
     */
    public function getFirsName()
    {
        return $this->firsName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return User
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set shoeSize
     *
     * @param integer $shoeSize
     * @return User
     */
    public function setShoeSize($shoeSize)
    {
        $this->shoeSize = $shoeSize;

        return $this;
    }

    /**
     * Get shoeSize
     *
     * @return integer 
     */
    public function getShoeSize()
    {
        return $this->shoeSize;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return User
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtToNow()
    {
        $this->createdAt = new \DateTime("now");
        $this->updatedAt = new \DateTime("now");
    }

    /**
     * @ORM\PreUpdate
     */
    public function setUpdatedAtToNow()
    {
        $this->updatedAt = new \DateTime("now");
    }
}
