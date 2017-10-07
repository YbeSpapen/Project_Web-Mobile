<?php

namespace controller;

use view\LocatieView;

class LocatieController
{
    private $locatieRepository;
    private $locatieView;

    public function __construct(LocatieRepository $locatieRepository)
    {
        $this->locatieRepository = $locatieRepository;
        $this->locatieView = new LocatieView();
    }

    public function handleGetLocaties() {
        $locaties = $this->locatieRepository->getLocaties();
        $this->locatieView->showLocaties($locaties);

    }
}