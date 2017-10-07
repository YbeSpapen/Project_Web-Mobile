<?php

namespace controller;

use model\LocationRepository;
use view\LocationView;

class LocationController
{
    private $locationRepository;
    private $locationView;

    public function __construct(LocationRepository $locationRepository)
    {
        $this->locationRepository = $locationRepository;
        $this->locationView = new LocationView();
    }

    public function handleGetLocations() {
        $locations = $this->locationRepository->getLocations();
        $this->locationView->showLocations($locations);

    }
}