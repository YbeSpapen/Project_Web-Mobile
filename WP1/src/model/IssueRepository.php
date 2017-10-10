<?php

namespace model;

interface IssueRepository
{
    public function getIssuesByLocationId($locationId);
    public function getIssueById($id);
    public function getIssuesBytechnicianId($technicianId);
    public function addIssue($id, $locationId, $problem, $date, $handled, $technicianId);
}