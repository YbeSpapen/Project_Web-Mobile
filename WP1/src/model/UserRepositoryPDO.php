<?php

namespace model;


class UserRepositoryPDO implements UserRepository
{
    private $connection = null;

    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function getTechnicians()
    {
        try {
            $statement = $this->connection->prepare('SELECT id, email, name FROM user WHERE role = "ROLE_TECHNICIAN"');
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);
            $arrayResults = array();

            if (count($results) > 0) {
                foreach ($results as $technician) {
                    $tech = new User($technician['id'], $technician['email'], $technician['name'], null, null);
                    array_push($arrayResults, $tech);
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

    public function addTechnician($email, $name, $role, $password)
    {
        try {
            $statement = $this->connection->
                prepare('INSERT INTO user (email, name, role, password) VALUES(?, ?, ?, ?)');
            $statement->bindParam(1, $email, \PDO::PARAM_STR);
            $statement->bindParam(2, $name, \PDO::PARAM_STR);
            $statement->bindParam(3, $role, \PDO::PARAM_STR);
            $statement->bindParam(4, $password, \PDO::PARAM_STR);
            $statement->execute();
            $id = $this->connection->lastInsertId();
            http_response_code(201);
            return new User($id, $email, $name, $role, $password);
        } catch (\Exception $exception) {
            http_response_code(400);
            return $exception->getMessage();
        }
    }
}