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
     * @var int
     *
     * @ORM\Column(name="locationId", type="integer")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Location", inversedBy="id")
     */
    private $locationId;

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
     * @var int
     *
     * @ORM\Column(name="technicianId", type="integer", nullable=true)
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Technicus", inversedBy="id")
     */
    private $technicianId;

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
     * Set locationId
     *
     * @param integer $locationId
     *
     * @return Issue
     */
    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;

        return $this;
    }

    /**
     * Get locationId
     *
     * @return integer
     */
    public function getLocationId()
    {
        return $this->locationId;
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
     * Set technicianId
     *
     * @param integer $technicianId
     *
     * @return Issue
     */
    public function setTechnicianId($technicianId)
    {
        $this->technicianId = $technicianId;

        return $this;
    }

    /**
     * Get technicianId
     *
     * @return integer
     */
    public function getTechnicianId()
    {
        return $this->technicianId;
    }
}
