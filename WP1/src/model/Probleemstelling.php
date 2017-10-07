<?php

namespace model;

class Probleemstelling implements \JsonSerializable
{
    private $Id;
    private $LocatieId;
    private $Probleem;
    private $Datum;
    private $Afgehandeld;
    private $TechniekerId;

    /**
     * Probleemstelling constructor.
     * @param $Id
     * @param $LocatieId
     * @param $Probleem
     * @param $Datum
     * @param $Afgehandeld
     * @param $TechniekerId
     */
    public function __construct($Id, $LocatieId, $Probleem, $Datum, $Afgehandeld, $TechniekerId)
    {
        $this->Id = $Id;
        $this->LocatieId = $LocatieId;
        $this->Probleem = $Probleem;
        $this->Datum = $Datum;
        $this->Afgehandeld = $Afgehandeld;
        $this->TechniekerId = $TechniekerId;
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
    public function getLocatieId()
    {
        return $this->LocatieId;
    }

    /**
     * @param mixed $LocatieId
     */
    public function setLocatieId($LocatieId)
    {
        $this->LocatieId = $LocatieId;
    }

    /**
     * @return mixed
     */
    public function getProbleem()
    {
        return $this->Probleem;
    }

    /**
     * @param mixed $Probleem
     */
    public function setProbleem($Probleem)
    {
        $this->Probleem = $Probleem;
    }

    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->Datum;
    }

    /**
     * @param mixed $Datum
     */
    public function setDatum($Datum)
    {
        $this->Datum = $Datum;
    }

    /**
     * @return mixed
     */
    public function getAfgehandeld()
    {
        return $this->Afgehandeld;
    }

    /**
     * @param mixed $Afgehandeld
     */
    public function setAfgehandeld($Afgehandeld)
    {
        $this->Afgehandeld = $Afgehandeld;
    }

    /**
     * @return mixed
     */
    public function getTechniekerId()
    {
        return $this->TechniekerId;
    }

    /**
     * @param mixed $TechniekerId
     */
    public function setTechniekerId($TechniekerId)
    {
        $this->TechniekerId = $TechniekerId;
    }

    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}