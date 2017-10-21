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
                    $iss = new Issue($issue['id'], $issue['location_id'], $issue['problem'], $issue['date'], $issue['handled'], $issue['technician_id']);
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
                    $iss = new Issue($issue['id'], $issue['location_id'], $issue['problem'], $issue['date'], $issue['handled'], $issue['technician_id']);
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
                    $iss = new Issue($issue['id'], $issue['location_id'], $issue['problem'], $issue['date'], $issue['handled'], $issue['technician_id']);
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

    public function addIssue($id, $location_id, $problem, $date, $handled, $technician_id)
    {
        try {
            $statement = $this->connection->prepare('INSERT INTO issue (id, location_id, problem, date, handled, technician_id) VALUES(?, ?, ?, ?, ?, ?)');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->bindParam(2, $location_id, \PDO::PARAM_INT);
            $statement->bindParam(3, $problem, \PDO::PARAM_STR);
            $statement->bindParam(4, $date, \PDO::PARAM_STR);
            $statement->bindParam(5, $handled, \PDO::PARAM_INT);
            $statement->bindParam(6, $technician_id, \PDO::PARAM_INT);
            return $statement->execute();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}