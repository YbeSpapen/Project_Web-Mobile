<?php

namespace model;


interface StatusRepository
{
    public function getStatusesByLocationId($locationId);
}