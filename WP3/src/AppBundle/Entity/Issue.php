<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Issue
 *
 * @ORM\Table(name="Issue")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProbleemStellingRepository")
 */
class Issue
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="issues")
     *
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="problem", type="string", length=255)
     */
    private $problem;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="handled", type="boolean")
     */
    private $handled;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="issues")
     *
     */
    private $technician;

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
     * Set problem
     *
     * @param string $problem
     *
     * @return Issue
     */
    public function setProblem($problem)
    {
        $this->problem = $problem;

        return $this;
    }

    /**
     * Get problem
     *
     * @return string
     */
    public function getProblem()
    {
        return $this->problem;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Issue
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set handled
     *
     * @param boolean $handled
     *
     * @return Issue
     */
    public function setHandled($handled)
    {
        $this->handled = $handled;

        return $this;
    }

    /**
     * Get handled
     *
     * @return boolean
     */
    public function getHandled()
    {
        return $this->handled;
    }

    /**
     * Set location
     *
     * @param \AppBundle\Entity\Location $location
     *
     * @return Issue
     */
    public function setLocation(\AppBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \AppBundle\Entity\Location
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set technician
     *
     * @param \AppBundle\Entity\User $technician
     *
     * @return Issue
     */
    public function setTechnician(\AppBundle\Entity\User $technician = null)
    {
        $this->technician = $technician;

        return $this;
    }

    /**
     * Get technician
     *
     * @return \AppBundle\Entity\User
     */
    public function getTechnician()
    {
        return $this->technician;
    }
}
