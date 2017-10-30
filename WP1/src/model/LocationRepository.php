<?php

namespace model;

interface LocationRepository
{
    public function getLocations();
    public function setLocation($name);
}