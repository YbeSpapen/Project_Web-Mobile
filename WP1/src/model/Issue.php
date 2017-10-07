<?php

namespace model;

class Issue implements \JsonSerializable
{
    private $id;
    private $locationId;
    private $problem;
    private $date;
    private $handled;
    private $technicianId;

    public function __construct($id, $locationId, $problem, $date, $handled, $technicianId)
    {
        $this->id = $id;
        $this->locationId = $locationId;
        $this->problem = $problem;
        $this->date = $date;
        $this->handled = $handled;
        $this->technicianId = $technicianId;
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

    public function getProblem()
    {
        return $this->problem;
    }

    public function setProblem($problem)
    {
        $this->problem = $problem;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setDate($date)
    {
        $this->date = $date;
    }

    public function getHandled()
    {
        return $this->handled;
    }

    public function setHandled($handled)
    {
        $this->handled = $handled;
    }

    public function getTechnicianId()
    {
        return $this->technicianId;
    }

    public function setTechnicianId($technicianId)
    {
        $this->technicianId = $technicianId;
    }

    function jsonSerialize()
    {
        return get_object_vars($this);
    }
}