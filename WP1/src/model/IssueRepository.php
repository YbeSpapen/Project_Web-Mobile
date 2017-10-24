<?php

namespace model;

interface IssueRepository
{
    public function getIssuesByLocationId($location_id);
    public function getIssueById($id);
    public function getIssuesBytechnicianId($technician_id);
    public function addIssue($location_id, $problem, $date, $handled);
}