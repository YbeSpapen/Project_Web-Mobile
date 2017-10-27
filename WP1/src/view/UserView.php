<?php

namespace view;


class UserView
{
    public function showUsers($users)
    {
        echo json_encode($users, JSON_PRETTY_PRINT);
    }
}