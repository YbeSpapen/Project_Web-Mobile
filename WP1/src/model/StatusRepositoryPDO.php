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
}