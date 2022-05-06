<?php

namespace Beejee\App\Core;

class Migration
{

    public static function create($table, $fields)
    {
        try {
            $connection = DatabaseConnection::connect();

            $params = "id int NOT NULL AUTO_INCREMENT,";
            foreach ($fields as $key => $value) {
                $params .= $key . " " . $value . ", ";
            }
            $params .= "PRIMARY KEY (id)";

            $sql = "CREATE TABLE $table(
            $params   
            );";

            $connection->query($sql)
                ->execute();

            return "ok";
        } catch (\PDOException $error) {
            print_r($error->getMessage());
        }
    }
}