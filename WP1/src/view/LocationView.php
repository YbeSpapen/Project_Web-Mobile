<?php

namespace view;

class LocationView
{
    public function showLocations($locations)
    {
        header("Access-Control-Allow-Origin: http://192.168.46.137:3000");
        //header("Access-Control-Allow-Origin: http://localhost:3000");
        header("Content-Type: application/json");
        echo json_encode($locations, JSON_PRETTY_PRINT);
        //echo "\r\n" . http_response_code();
    }
}