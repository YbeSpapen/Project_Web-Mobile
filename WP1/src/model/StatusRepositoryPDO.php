<?php

namespace model;

use model\Status;

class StatusRepositoryPDO implements StatusRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getStatusesByLocationId($locationId)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM status WHERE locationId = ?');
            $statement->bindParam(1, $locationId, \PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $arrayResults = array();

            if (count($results) > 0) {
                foreach ($results as $status) {
                    $stat = new Status($status['id'], $status['locationId'], $status['status'], $status['date']);
                    array_push($arrayResults, $stat);
                }
                return $arrayResults;
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function addStatus($id, $locationId, $status, $date)
    {
        try {
            $statement = $this->connection->prepare('INSERT INTO status (id, locationId, status, date) VALUES(?, ?, ?, ?)');
            $statement->bindParam(1, $id, \PDO::PARAM_INT);
            $statement->bindParam(2, $locationId, \PDO::PARAM_INT);
            $statement->bindParam(3, $status, \PDO::PARAM_STR);
            $statement->bindParam(4, $date, \PDO::PARAM_STR);
            return $statement->execute();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}