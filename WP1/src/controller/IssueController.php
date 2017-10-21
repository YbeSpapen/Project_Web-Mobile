<?php

namespace controller;

use model\IssueRepository;
use view\IssueView;

class IssueController
{
    private $issueRepository;
    private $issueView;

    public function __construct(IssueRepository $issueRepository)
    {
        $this->issueRepository = $issueRepository;
        $this->issueView = new IssueView();
    }

    public function handleGetIssuesByLocationId($location_id) {
        $issues = $this->issueRepository->getIssuesByLocationId($location_id);
        $this->issueView->showIssues($issues);
    }

    public function handleGetIssueById($id) {
        $issue = $this->issueRepository->getIssueById($id);
        $this->issueView->showIssues($issue);
    }

    public function handleGetIssueByTechnicianId($technician_id){
        $issues = $this->issueRepository->getIssuesBytechnicianId($technician_id);
        $this->issueView->showIssues($issues);
    }

    public function handleAddIssue($id, $location_id, $problem, $date, $handled, $technician_id) {
        $returnCode = $this->issueRepository->addIssue($id, $location_id, $problem, $date, $handled, $technician_id);
        $this->issueView->showIssues($returnCode);
    }
}