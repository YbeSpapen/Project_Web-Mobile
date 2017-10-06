<?php

namespace model;

class Status implements \JsonSerializable
{
    private $Id;
    private $LocatieId;
    private $Status;
    private $Datum;

    /**
     * Status constructor.
     * @param $Id
     * @param $LocatieId
     * @param $Status
     * @param $Datum
     */
    public function __construct($Id, $LocatieId, $Status, $Datum)
    {
        $this->Id = $Id;
        $this->LocatieId = $LocatieId;
        $this->Status = $Status;
        $this->Datum = $Datum;
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
    public function getStatus()
    {
        return $this->Status;
    }

    /**
     * @param mixed $Status
     */
    public function setStatus($Status)
    {
        $this->Status = $Status;
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

    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}