<?php

namespace model;

class User implements \JsonSerializable
{
    private $id;
    private $email;
    private $name;
    private $role;
    private $password;

    public function __construct($id, $email, $name, $role, $password)
    {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->role = $role;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}