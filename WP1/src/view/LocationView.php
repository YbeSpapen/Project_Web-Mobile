<?php

namespace view;

class LocationView
{
    public function showLocations($locations) {
        echo json_encode($locations, JSON_PRETTY_PRINT);
    }
}