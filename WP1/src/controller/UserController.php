<?php

namespace controller;


use model\UserRepository;
use view\UserView;

class UserController
{
    private $userRepository;
    private $userView;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->userView = new UserView();
    }

    public function handleGetTechnicians()
    {
        $technicians = $this->userRepository->getTechnicians();
        $this->userView->showUsers($technicians);
    }

    public function handleAddTechnician($email, $name, $role, $password)
    {
        $returnCode = $this->userRepository->addTechnician($email, $name, $role, $password);
        $this->userView->showUsers($returnCode);
    }
}