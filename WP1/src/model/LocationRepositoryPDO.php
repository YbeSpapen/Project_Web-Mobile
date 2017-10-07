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
                return $arrayResults;
            } else {
                return null;
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}