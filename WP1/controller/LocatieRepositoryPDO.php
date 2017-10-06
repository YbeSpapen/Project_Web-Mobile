<?php

namespace controller;

use model\Locatie;

class LocatieRepositoryPDO implements LocatieRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getLocaties()
    {
        try {
            $statement = $this->connection->prepare('SELECT * FROM Locatie');
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $arrayResults = array();

            if (count($results) > 0) {
                foreach ($results as $locatie) {
                    $loc = new Locatie($locatie['ID'], $locatie['Naam']);
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