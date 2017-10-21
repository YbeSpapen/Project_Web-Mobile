<?php

namespace model;


interface StatusRepository
{
    public function getStatusesByLocationId($location_id);
    public function addStatus($id, $location_id, $status, $date);
}