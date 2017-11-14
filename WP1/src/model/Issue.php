<?php

namespace model;

class Issue implements \JsonSerializable
{
    private $id;
    private $location_id;
    private $problem;
    private $date;
    private $handled;
    private $technician_id;

    public function __construct($id, $location_id, $problem, $date, $handled, $technician_id)
    {
        $this->id = $id;
        $this->location_id = $location_id;
        $this->problem = $problem;
        $this->date = $date;
        $this->handled = $handled;
        $this->technician_id = $technician_id;
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
        return $this->location_id;
    }

    public function setLocationId($location_id)
    {
        $this->location_id = $location_id;
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
        return $this->technician_id;
    }

    public function setTechnicianId($technician_id)
    {
        $this->technician_id = $technician_id;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }

    function __toString()
    {
        return "id: " . $this->getId() . ", location_id: " . $this->getLocationId() . ", problem: " .
            $this->getProblem() . ", date: " . $this->getDate() . ", handled: " . $this->getHandled() .
            ", technician_id: " . $this->getTechnicianId();
    }


}