<?php

namespace model;

class Status implements \JsonSerializable
{
    private $id;
    private $locationId;
    private $status;
    private $date;

    public function __construct($id, $locationId, $status, $date)
    {
        $this->id = $id;
        $this->locationId = $locationId;
        $this->status = $status;
        $this->date = $date;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getLocationId()
    {
        return $this->locationId;
    }

    public function setLocationId($locationId)
    {
        $this->locationId = $locationId;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}