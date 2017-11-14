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

    public function getStatusesPercentage()
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM status');
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

            if (count($results)> 0) {
                $total = count($results);
                $numberHappy= 0;
                foreach ($results as $status) {
                    if ($status['status'] == 'HAPPY') {
                        $numberHappy = $numberHappy + 1;
                    }
                }
                $percentage = ($numberHappy/$total)*100;
                http_response_code(200);
                return $percentage;
            } else {
                http_response_code(204);
                $percentage = null;
                return $percentage;
            }

        } catch (\Exception $exception) {
            http_response_code(400);
            return $exception->getMessage();
        }
    }

    public function getStatusesByLocationId($location_id)
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM status WHERE location_id = ?');
            $statement->bindParam(1, $location_id, \PDO::PARAM_INT);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $arrayResults = array();

            if (count($results) > 0) {
                foreach ($results as $status) {
                    $stat = new Status($status['id'], $status['location_id'], $status['status'], $status['date']);
                    array_push($arrayResults, $stat);
                }
                http_response_code(200);
                return $arrayResults;
            } else {
                http_response_code(204);
                return null;
            }
        } catch (\Exception $exception) {
            http_response_code(400);
            return $exception->getMessage();
        }
    }

    public function addStatus($location_id, $status, $date)
    {
        try {
            $statement = $this->connection->prepare('INSERT INTO status (location_id, status, date) VALUES(?, ?, ?)');
            $statement->bindParam(1, $location_id, \PDO::PARAM_INT);
            $statement->bindParam(2, $status, \PDO::PARAM_STR);
            $statement->bindParam(3, $date, \PDO::PARAM_STR);
            $statement->execute();
            $id = $this->connection->lastInsertId();
            http_response_code(201);
            return new Status($id, $location_id, $status, $date);
        } catch (\Exception $exception) {
            http_response_code(400);
            return $exception->getCode();
        }
    }
}