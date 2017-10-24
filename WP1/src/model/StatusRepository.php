<?php

namespace model;


interface StatusRepository
{
    public function getStatusesByLocationId($location_id);
    public function addStatus($location_id, $status, $date);
}