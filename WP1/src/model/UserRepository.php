<?php

namespace model;


interface UserRepository
{
    public function getTechnicians();

    public function addTechnician($email, $name, $role, $password);
}