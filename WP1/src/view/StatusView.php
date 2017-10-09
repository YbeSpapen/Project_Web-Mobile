<?php

namespace view;

class StatusView
{
    public function showStatuses($statuses) {
        echo json_encode($statuses, JSON_PRETTY_PRINT);
    }
}