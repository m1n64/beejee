<?php

namespace Beejee\App\Core;

use Beejee\App\Core\Classes\Str;

class Model
{
    protected $connection = null;
    protected $tableName = "";

    public function __construct()
    {
        $this->connection = DatabaseConnection::connect();
    }

    public function getData($limit = 0, $offset = 0, $sort = "")
    {
        $sql = "SELECT * FROM ".Str::clear($this->tableName);

        if (!empty($sort)) $sql .= " ORDER BY ".Str::clear($sort)." DESC";
        if ($limit > 0 || $offset > 0) $sql .= " LIMIT $limit, $offset";


        return $this->connection->query($sql)
            ->fetchAll();
    }

    public function storeData($data)
    {
        $this->formatQuery($data, $fields, $values);

        return $this->connection->query(
            "INSERT INTO ".Str::clear($this->tableName)." ($fields) VALUES($values)"
        );
    }

    public function updateData($data, $id)
    {
        $field = key($data);
        $value = gettype($data[$field]) == "string" ? "'$data[$field]'" : $data[$field];

        return $this->connection->query(
            "UPDATE ".Str::clear($this->tableName)." SET $field = $value WHERE id = ".$id
        );
    }

    public function getCount()
    {
        return $this->connection->query(
            "SELECT COUNT(id) as CNT FROM ".Str::clear($this->tableName)
        )
            ->fetch()["CNT"];
    }

    private function formatQuery($data, &$fields, &$values)
    {
        foreach ($data as $field=>$value) {
            $fields .= Str::clear($field)." ,";
            switch (gettype($value)) {
                default:
                case "string":
                    $values .= "'".Str::clear($value)."' ,";
                    break;

                case "integer":
                case "double":
                    $values .= Str::clear($value)." ,";
                    break;
            }
        }

        $fields = substr($fields,0,-1);
        $values = substr($values,0,-1);
    }
}