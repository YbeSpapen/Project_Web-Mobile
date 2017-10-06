<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProbleemStelling
 *
 * @ORM\Table(name="ProbleemStelling")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProbleemStellingRepository")
 */
class ProbleemStelling
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
     * @ORM\Column(name="LocatieId", type="integer")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Locatie", inversedBy="id")
     */
    private $locatieId;

    /**
     * @var string
     *
     * @ORM\Column(name="Probleem", type="string", length=255)
     */
    private $probleem;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Datum", type="datetime")
     */
    private $datum;

    /**
     * @var bool
     *
     * @ORM\Column(name="Afgehandeld", type="boolean")
     */
    private $afgehandeld;

    /**
     * @var int
     *
     * @ORM\Column(name="TechniekerId", type="integer")
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Technicus", inversedBy="id")
     */
    private $techniekerId;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set locatieId
     *
     * @param integer $locatieId
     *
     * @return ProbleemStelling
     */
    public function setLocatieId($locatieId)
    {
        $this->locatieId = $locatieId;

        return $this;
    }

    /**
     * Get locatieId
     *
     * @return int
     */
    public function getLocatieId()
    {
        return $this->locatieId;
    }

    /**
     * Set probleem
     *
     * @param string $probleem
     *
     * @return ProbleemStelling
     */
    public function setProbleem($probleem)
    {
        $this->probleem = $probleem;

        return $this;
    }

    /**
     * Get probleem
     *
     * @return string
     */
    public function getProbleem()
    {
        return $this->probleem;
    }

    /**
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return ProbleemStelling
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;

        return $this;
    }

    /**
     * Get datum
     *
     * @return \DateTime
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * Set afgehandeld
     *
     * @param boolean $afgehandeld
     *
     * @return ProbleemStelling
     */
    public function setAfgehandeld($afgehandeld)
    {
        $this->afgehandeld = $afgehandeld;

        return $this;
    }

    /**
     * Get afgehandeld
     *
     * @return bool
     */
    public function getAfgehandeld()
    {
        return $this->afgehandeld;
    }

    /**
     * Set techniekerId
     *
     * @param integer $techniekerId
     *
     * @return ProbleemStelling
     */
    public function setTechniekerId($techniekerId)
    {
        $this->techniekerId = $techniekerId;

        return $this;
    }

    /**
     * Get techniekerId
     *
     * @return int
     */
    public function getTechniekerId()
    {
        return $this->techniekerId;
    }
}

