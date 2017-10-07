<?php

namespace model;

class Technicus implements \JsonSerializable
{
    private $Id;
    private $Naam;
    private $Voornaam;
    private $Telefoon;

    /**
     * Technicus constructor.
     * @param $Id
     * @param $Naam
     * @param $Voornaam
     * @param $Telefoon
     */
    public function __construct($Id, $Naam, $Voornaam, $Telefoon)
    {
        $this->Id = $Id;
        $this->Naam = $Naam;
        $this->Voornaam = $Voornaam;
        $this->Telefoon = $Telefoon;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->Id;
    }

    /**
     * @param mixed $Id
     */
    public function setId($Id)
    {
        $this->Id = $Id;
    }

    /**
     * @return mixed
     */
    public function getNaam()
    {
        return $this->Naam;
    }

    /**
     * @param mixed $Naam
     */
    public function setNaam($Naam)
    {
        $this->Naam = $Naam;
    }

    /**
     * @return mixed
     */
    public function getVoornaam()
    {
        return $this->Voornaam;
    }

    /**
     * @param mixed $Voornaam
     */
    public function setVoornaam($Voornaam)
    {
        $this->Voornaam = $Voornaam;
    }

    /**
     * @return mixed
     */
    public function getTelefoon()
    {
        return $this->Telefoon;
    }

    /**
     * @param mixed $Telefoon
     */
    public function setTelefoon($Telefoon)
    {
        $this->Telefoon = $Telefoon;
    }

    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}