<?php

namespace model;


interface StatusRepository
{
    public function getStatusesByLocationId($locationId);
    public function addStatus($id, $locationId, $status, $date);
}