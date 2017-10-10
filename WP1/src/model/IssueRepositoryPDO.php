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

    public function getIssuesByLocationId($locationId)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM issue WHERE locationId = ?');
            $statement->bindParam(1, $locationId, \PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $arrayResults = array();

            if (count($results) > 0) {
                foreach ($results as $issue) {
                    $iss = new Issue($issue['id'], $issue['locationId'], $issue['problem'], $issue['date'], $issue['handled'], $issue['technicianId']);
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
            $statement = $this->connection->prepare('SELECT * FROM issue WHERE id = ? LIMIT 1');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if (count($result) > 0) {
                foreach ($result as $issue) {
                    $iss = new Issue($issue['id'], $issue['locationId'], $issue['problem'], $issue['date'], $issue['handled'], $issue['technicianId']);
                    return $iss;
                }
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function getIssuesBytechnicianId($technicianId)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM issue WHERE technicianId = ?');
            $statement->bindParam(1, $technicianId, \PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $arrayResults = array();

            if (count($results) > 0) {
                foreach ($results as $issue) {
                    $iss = new Issue($issue['id'], $issue['locationId'], $issue['problem'], $issue['date'], $issue['handled'], $issue['technicianId']);
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

    public function addIssueWithoutTechnicianId($id, $locationId, $problem, $date, $handled, $technicianId)
    {
        try {
            $statement = $this->connection->prepare('INSERT INTO issue (id, locationId, problem, date, handled, technicianId) VALUES(?, ?, ?, ?, ?, ?)');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->bindParam(2, $locationId, \PDO::PARAM_INT);
            $statement->bindParam(3, $problem, \PDO::PARAM_STR);
            $statement->bindParam(4, $date, \PDO::PARAM_STR);
            $statement->bindParam(5, $handled, \PDO::PARAM_INT);
            $statement->bindParam(6, $technicianId, \PDO::PARAM_INT);
            return $statement->execute();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}