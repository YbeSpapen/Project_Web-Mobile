<?php
/**
 * Created by PhpStorm.
 * User: Spape
 * Date: 24/10/2017
 * Time: 19:16
 */

namespace model;


class OptionsAltoRouter extends \AltoRouter
{
    public function match($requestUrl = null, $requestMethod = null){
        $originalRequestMethod = $requestMethod;
        if($requestMethod == 'OPTIONS'){
            $requestMethod = $_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD'];
        }
        if($match = parent::match($requestUrl, $requestMethod)){
            $match['request_method'] = $originalRequestMethod;
        }
        return $match;
    }
}