<?php

namespace Site\Models;

abstract class Model
{
    private $db;

    function __construct()
    {
        global $db;
        $this->db = $db;
    }

    public static function find($objectId, string $index = null)
    {
        $className = static::class;
        $model = new $className();

        $tableName = $index ?? $model->tableName ?? getTableName(get_class(static::class));
        $tableIndex = $model->tableId ?? 'id';

        $query = $model->db->prepare(
            "SELECT * FROM `$tableName` WHERE `$tableIndex`=? LIMIT 1"
        );
        if(!$query){
            return Null;
        }
        $query->bind_param("s", $objectId);
        if($query->execute()){
            $result = $query->get_result();
            if($result->num_rows < 1) return Null;
            $result = $result->fetch_assoc();

            foreach ($result as $key => $value)
            {
                $model->$key = $value;
            }
            return $model;
        }
        return Null;
    }

    protected function query(string $query, array $params, string $types)
    {
        $query = $this->db->prepare($query);
        if(!$query){
            return null;
        }
        if(!$query->bind_param($types, ...$params)){
            return null;
        }
        if($query->execute()){
            $results = $query->get_result();
            if($results->num_rows < 1) return [];

            $models = [];
            while($result = $results->fetch_assoc()){
                $className = get_class($this);
                $model = new $className();
                foreach ($result as $key => $value)
                {
                    $model->$key = $value;
                }
                array_push($models, $model);
            }

            return $models;
        }
        return Null;
    }
}