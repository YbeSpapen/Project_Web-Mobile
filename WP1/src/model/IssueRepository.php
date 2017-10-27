<?php

namespace model;

interface IssueRepository
{
    public function getIssuesByLocationId($location_id);
    public function getIssueById($id);
    public function getIssuesByTechnicianId($technician_id);
    public function addIssue($location_id, $problem, $date, $handled);
    public function assignIssue($issue_id, $technician_id);
}