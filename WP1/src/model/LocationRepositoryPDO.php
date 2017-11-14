<?php

namespace model;

use model\Location;

class LocationRepositoryPDO implements LocationRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getLocations()
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM location');
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $arrayResults = array();

            if (count($results) > 0) {
                foreach ($results as $location) {
                    $loc = new Location($location['id'], $location['name']);
                    array_push($arrayResults, $loc);
                }
                http_response_code(200);
                return $arrayResults;
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            http_response_code(400);
            return $exception->getMessage();
        }
    }

    public function setLocation($name)
    {
        try {
            $statement = $this->connection->prepare('INSERT INTO location (name) VALUE (?)');
            $statement->bindParam(1,$name,\PDO::PARAM_STR);
            $statement-> execute();
            $id = $this->connection->lastInsertId();
            http_response_code(200);
            return new Location($id,$name);
        } catch (\Exception $exception) {
            http_response_code(400);
            return $exception->getMessage();
        }
    }
}