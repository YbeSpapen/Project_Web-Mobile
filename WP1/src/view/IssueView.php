<?php

namespace view;

class IssueView
{
    public function showIssues($issues)
    {
        echo json_encode($issues, JSON_PRETTY_PRINT);
    }
}