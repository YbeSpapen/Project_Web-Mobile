<?php

namespace view;

class IssueView
{
    public function showIssues($issues)
    {
        header("Access-Control-Allow-Origin: http://192.168.46.137:3000");
        //header("Access-Control-Allow-Origin: http://localhost:3000");
        header("Content-Type: application/json");
        echo json_encode($issues, JSON_PRETTY_PRINT);
        //echo "\r\n" . http_response_code();
    }
}