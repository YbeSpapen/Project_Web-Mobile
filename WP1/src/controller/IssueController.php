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

    public function handleGetIssuesByLocationId($locationId) {
        $issues = $this->issueRepository->getIssuesByLocationId($locationId);
        $this->issueView->showIssues($issues);
    }

    public function handleGetIssueById($id) {
        $issue = $this->issueRepository->getIssueById($id);
        $this->issueView->showIssues($issue);
    }

    public function handleGetIssueByTechnicianId($technicianId){
        $issues = $this->issueRepository->getIssuesBytechnicianId($technicianId);
        $this->issueView->showIssues($issues);
    }
}