<?php

namespace My\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table(name="surveys")
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class Survey
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
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;

    /**
     * @var string
     *
     * @ORM\Column(name="ice_cream", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $iceCream;

    /**
     * @var string
     *
     * @ORM\Column(name="superhero", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $superhero;

    /**
     * @var string
     *
     * @ORM\Column(name="movie_star", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $movieStar;

    /**
     * @var date
     *
     * @ORM\Column(name="world_end", type="date")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    protected $worldEnd;

    /**
     * @var string
     *
     * @ORM\Column(name="super_bowl_winner", type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $superBowlWinner;

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
     * Set iceCream
     *
     * @param string $iceCream
     * @return Survey
     */
    public function setIceCream($iceCream)
    {
        $this->iceCream = $iceCream;

        return $this;
    }

    /**
     * Get iceCream
     *
     * @return string 
     */
    public function getIceCream()
    {
        return $this->iceCream;
    }

    /**
     * Set superhero
     *
     * @param string $superhero
     * @return Survey
     */
    public function setSuperhero($superhero)
    {
        $this->superhero = $superhero;

        return $this;
    }

    /**
     * Get superhero
     *
     * @return string 
     */
    public function getSuperhero()
    {
        return $this->superhero;
    }

    /**
     * Set movieStar
     *
     * @param string $movieStar
     * @return Survey
     */
    public function setMovieStar($movieStar)
    {
        $this->movieStar = $movieStar;

        return $this;
    }

    /**
     * Get movieStar
     *
     * @return string 
     */
    public function getMovieStar()
    {
        return $this->movieStar;
    }

    /**
     * Set worldEnd
     *
     * @param \DateTime $worldEnd
     * @return Survey
     */
    public function setWorldEnd($worldEnd)
    {
        $this->worldEnd = $worldEnd;

        return $this;
    }

    /**
     * Get worldEnd
     *
     * @return \DateTime 
     */
    public function getWorldEnd()
    {
        return $this->worldEnd;
    }

    /**
     * Set superBowlWinner
     *
     * @param string $superBowlWinner
     * @return Survey
     */
    public function setSuperBowlWinner($superBowlWinner)
    {
        $this->superBowlWinner = $superBowlWinner;

        return $this;
    }

    /**
     * Get superBowlWinner
     *
     * @return string 
     */
    public function getSuperBowlWinner()
    {
        return $this->superBowlWinner;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Survey
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
     * @return Survey
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
     * Set user
     *
     * @param \My\SurveyBundle\Entity\User $user
     * @return Survey
     */
    public function setUser(\My\SurveyBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \My\SurveyBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
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
