<?php /** @noinspection PhpUndefinedVariableInspection */

namespace Site\Models;

use Exception;

abstract class Model
{
    private $db;
    protected $fields = [];

    function __construct()
    {
        global $db;
        $this->db = $db;
    }

    public function __get(string $name)
    {
        if(in_array($name, get_class_vars(static::class))) return $this->$name;
        return (in_array($name, $this->fields) or $name == ($this->tableId ?? 'id')) ? $this->$name : null;
    }

    public static function find($objectId, string $index = null)
    {
        $className = static::class;
        $model = new $className();

        $tableName = $model->tableName ?? getTableName(static::class);
        $tableIndex = $index ?? $model->tableId ?? 'id';

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

    /**
     * @throws Exception
     */
    public function save(): bool
    {
        $indexField = $this->tableId ?? 'id';
        $tableName = $model->tableName ?? getTableName(get_class($this));

        $fields = [];
        $values = [];
        $types = "";
        foreach ($this->fields as $field){
            if ($field == $indexField) continue;
            array_push($fields, "$field");
            array_push($values, $this->$field ?? '');
            $types .= "s";
        }

        if($this->$indexField){
            $updateFields = [];
            foreach($fields as $field){
                array_push($updateFields, "`$field`=?");
            }
            array_push($values, $this->$indexField);
            $types .= "s";

            $updateFields = implode(",", $updateFields);
            $sql = "UPDATE `$tableName` SET $updateFields WHERE `$indexField` = ?";
        } else {
            $insertFields = [];
            $insertPlaces = [];
            foreach($fields as $field){
                array_push($insertFields, "`$field`");
                array_push($insertPlaces, "?");
            }
            $insertFields = implode(",", $insertFields);
            $insertPlaces = implode(",", $insertPlaces);

            $sql = "INSERT INTO `$tableName` ($insertFields) VALUES ($insertPlaces)";
        }
        $query = $this->db->prepare($sql);
        if($query && $query->bind_param($types, ...$values) && $query->execute()){
            return true;
        } else {
            throw new Exception($this->db->error);
        }
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