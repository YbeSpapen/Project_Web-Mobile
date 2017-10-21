<?php

namespace model;

interface IssueRepository
{
    public function getIssuesByLocationId($location_id);
    public function getIssueById($id);
    public function getIssuesBytechnicianId($technician_id);
    public function addIssue($id, $location_id, $problem, $date, $handled, $technician_id);
}