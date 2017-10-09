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

    public function handleGetStatusesByLocationId($locationId) {
        $statuses = $this->statusRepository->getStatusesByLocationId($locationId);
        $this->statusView->showStatuses($statuses);
    }

    public function handleAddStatus($id, $locationId, $status, $date) {
        $returnCode = $this->statusRepository->addStatus($id, $locationId, $status, $date);
        $this->statusView->showStatuses($returnCode);
    }
}