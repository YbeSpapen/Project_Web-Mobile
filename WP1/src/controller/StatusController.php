<?php

namespace controller;

use model\StatusRepository;
use view\StatusView;

class StatusController
{
    private $statusRepository;
    private $statusView;

    public function __construct(StatusRepository $statusRepository)
    {
        $this->statusRepository = $statusRepository;
        $this->statusView = new StatusView();
    }

    public function handleGetStatusesByLocationId($location_id) {
        $statuses = $this->statusRepository->getStatusesByLocationId($location_id);
        $this->statusView->showStatuses($statuses);
    }

    public function handleAddStatus($location_id, $status, $date) {
        $returnCode = $this->statusRepository->addStatus($location_id, $status, $date);
        $this->statusView->showStatuses($returnCode);
    }

    public function handledGetPercentage() {
        $percentage = $this->statusRepository->getStatusesPercentage();
        $this->statusView->showStatuses($percentage);
    }
}