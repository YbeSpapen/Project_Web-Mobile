<?php

namespace model;


interface IssueRepository
{
    public function getIssuesByLocationId($locationId);
    public function getIssueById($id);
    public function getIssuesBytechnicianId($technicianId);
}