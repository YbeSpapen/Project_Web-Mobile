<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Technicus
 *
 * @ORM\Table(name="Technicus")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TechnicusRepository")
 */
class Technicus
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProbleemStelling",mappedBy="techniekerId")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Naam", type="string", length=50)
     */
    private $naam;

    /**
     * @var string
     *
     * @ORM\Column(name="Voornaam", type="string", length=50)
     */
    private $voornaam;

    /**
     * @var string
     *
     * @ORM\Column(name="Telefoon", type="string", length=50)
     */
    private $telefoon;


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
     * Set naam
     *
     * @param string $naam
     *
     * @return Technicus
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Get naam
     *
     * @return string
     */
    public function getNaam()
    {
        return $this->naam;
    }

    /**
     * Set voornaam
     *
     * @param string $voornaam
     *
     * @return Technicus
     */
    public function setVoornaam($voornaam)
    {
        $this->voornaam = $voornaam;

        return $this;
    }

    /**
     * Get voornaam
     *
     * @return string
     */
    public function getVoornaam()
    {
        return $this->voornaam;
    }

    /**
     * Set telefoon
     *
     * @param string $telefoon
     *
     * @return Technicus
     */
    public function setTelefoon($telefoon)
    {
        $this->telefoon = $telefoon;

        return $this;
    }

    /**
     * Get telefoon
     *
     * @return string
     */
    public function getTelefoon()
    {
        return $this->telefoon;
    }
}

