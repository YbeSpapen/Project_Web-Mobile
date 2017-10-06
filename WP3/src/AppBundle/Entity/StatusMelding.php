<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatusMelding
 *
 * @ORM\Table(name="StatusMelding")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\StatusMeldingRepository")
 */
class StatusMelding
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
     * @ORM\Column(name="Status", type="string", length=255)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Datum", type="datetime")
     */
    private $datum;


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
     * @return StatusMelding
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
     * Set status
     *
     * @param string $status
     *
     * @return StatusMelding
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set datum
     *
     * @param \DateTime $datum
     *
     * @return StatusMelding
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
}

