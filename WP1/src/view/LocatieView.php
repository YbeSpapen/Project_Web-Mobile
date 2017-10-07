<?php

namespace view;

class LocatieView
{
    public function showLocaties($locaties) {
        echo json_encode($locaties, JSON_PRETTY_PRINT);
    }
}