<?php

namespace model;

use model\Issue;

class IssueRepositoryPDO implements IssueRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getIssuesByLocationId($location_id)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM issue WHERE location_id = ?');
            $statement->bindParam(1, $location_id, \PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $arrayResults = array();

            if (count($results) > 0) {
                foreach ($results as $issue) {
                    $iss = new Issue($issue['id'], $issue['location_id'], $issue['problem'],
                        $issue['date'], $issue['handled'], $issue['technician_id']);
                    array_push($arrayResults, $iss);
                }
                return $arrayResults;
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function getIssueById($id)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM issue WHERE id = ?');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                foreach ($result as $issue) {
                    $iss = new Issue($issue['id'], $issue['location_id'],
                        $issue['problem'], $issue['date'], $issue['handled'], $issue['technician_id']);
                    return $iss;
                }
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function getIssuesBytechnicianId($technician_id)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM issue WHERE technician_id = ?');
            $statement->bindParam(1, $technician_id, \PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $arrayResults = array();

            if (count($results) > 0) {
                foreach ($results as $issue) {
                    $iss = new Issue($issue['id'], $issue['location_id'],
                        $issue['problem'], $issue['date'], $issue['handled'], $issue['technician_id']);
                    array_push($arrayResults, $iss);
                }
                return $arrayResults;
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function addIssue($location_id, $problem, $date, $handled)
    {
        try {
            $statement = $this->connection->
                prepare('INSERT INTO issue (location_id, problem, date, handled) VALUES(?, ?, ?, ?)');
            $statement->bindParam(1, $location_id, \PDO::PARAM_INT);
            $statement->bindParam(2, $problem, \PDO::PARAM_STR);
            $statement->bindParam(3, $date, \PDO::PARAM_STR);
            $statement->bindParam(4, $handled, \PDO::PARAM_INT);
            $statement->execute();
            $id = $this->connection->lastInsertId();
            return new Issue($id, $location_id, $problem, $date, $handled, null);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function assignIssue($issue_id, $technician_id)
    {
        try {
            $statement = $this->connection->prepare('UPDATE issue SET technician_id = ? WHERE id = ?');
            $statement->bindParam(1, $technician_id, \PDO::PARAM_INT);
            $statement->bindParam(2, $issue_id, \PDO::PARAM_INT);
            $statement->execute();
            return $this->getIssueById($issue_id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function changeIssueState($issue_id, $handled)
    {
        try {
            $statement = $this->connection->prepare('UPDATE issue SET handled = ? WHERE id = ?');
            $statement->bindParam(1, $handled, \PDO::PARAM_INT);
            $statement->bindParam(2, $issue_id, \PDO::PARAM_INT);
            $statement->execute();
            return $this->getIssueById($issue_id);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}