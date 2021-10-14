<?php /** @noinspection PhpUndefinedVariableInspection */

namespace Site\Models;

use Exception;

abstract class Model
{
    private $db;
    protected $tableId = null;
    protected $tableName = null;
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

    public static function findAll(array $objectIds, string $index = null, int $limit = null, int $offset = null)
    {
        $className = static::class;
        $model = new $className();

        $tableName = $model->tableName ?? getTableName(static::class);
        $tableIndex = $index ?? $model->tableId ?? 'id';

        $idFields = implode(",", array_fill(0, count($objectIds), "?"));
        $idFTypes = implode("", array_fill(0, count($objectIds), "s"));
        $query = $model->db->prepare(
            "SELECT * FROM `$tableName` WHERE `$tableIndex` IN ($idFields) " .
                (!is_null($limit) ? " LIMIT $limit " : "") .
                (!is_null($offset) ? " OFFSET $offset" : "")
        );
        if(!$query){
            return Null;
        }
        $query->bind_param($idFTypes, ...$objectIds);
        if($query->execute()){
            $result = $query->get_result();
            if($result->num_rows < 1) return null;

            $elements = [];
            while ($element = $result->fetch_assoc()){
                $model = new $className();
                foreach ($element as $key => $value)
                {
                    $model->$key = $value;
                }
                array_push($elements, $model);
            }

            return $elements;
        }
        return Null;
    }

    public static function select(array $where, int $limit = null, int $offset = null, bool $need_total = false)
    {
        $className = static::class;
        $model = new $className();
        $tableName = $model->tableName ?? getTableName(static::class);

        $conditionsValues = [];
        $conditionsPlaces = [];
        foreach($where as $conditionName => $conditionValue){
            if(is_array($conditionValue)){
                array_push($conditionsValues, $conditionValue[0]);
                array_push($conditionsPlaces, "`$conditionName`{$conditionValue[1]}?");
            } else {
                array_push($conditionsValues, $conditionValue);
                array_push($conditionsPlaces, "`$conditionName`=?");
            }
        }
        $conditionTypes = implode("", array_fill(0, count($where), "s"));
        $conditionsPlaces = implode(" AND ", $conditionsPlaces);

        $query = $model->db->prepare(
            "SELECT * FROM `$tableName` WHERE $conditionsPlaces " .
            (!is_null($limit) ? " LIMIT $limit " : "") .
            (!is_null($offset) ? " OFFSET $offset" : "")
        );
        if(!$query){
            return Null;
        }
        $query->bind_param($conditionTypes, ...$conditionsValues);
        if($query->execute()){
            $result = $query->get_result();
            if($result->num_rows < 1) return null;

            $elements = [];
            while ($element = $result->fetch_assoc()){
                $model = new $className();
                foreach ($element as $key => $value)
                {
                    $model->$key = $value;
                }
                array_push($elements, $model);
            }

            if($need_total) {
                $query = $model->db->prepare(
                    "SELECT COUNT(*) as `total` FROM `$tableName` WHERE $conditionsPlaces"
                );
                if (!$query) {
                    return Null;
                }
                $query->bind_param($conditionTypes, ...$conditionsValues);
                if($query->execute()){
                    $result = $query->get_result();
                    $result = $result->fetch_assoc();
                    return ["result" => $elements, "total" => $result['total']];
                }
            } else {
                return $elements;
            }

        }
        return Null;
    }

    public function remove()
    {
        $tableName = $this->tableName ?? getTableName(get_class($this));
        $tableIndex = $this->tableId ?? 'id';

        $query = $this->db->prepare(
            "DELETE FROM `$tableName` WHERE `$tableIndex`=?"
        );
        if(!$query){
            return Null;
        }
        $query->bind_param("s", $this->$tableIndex);
        if($query->execute()){
            return true;
        }
        return false;
    }

    /**
     * @throws Exception
     */
    public function save(): bool
    {
        $indexField = $this->tableId ?? 'id';
        $tableName = $this->tableName ?? getTableName(get_class($this));

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
            $this->$indexField = $query->insert_id;
            return true;
        } else {
            throw new Exception($this->db->error);
        }
    }

    protected static function query(string $query, array $params=null, string $types=null)
    {
        $className = static::class;
        $model = new $className();

        $query = $model->db->prepare($query);
        if(!$query){
            return null;
        }
        if(!is_null($params) && !is_null($types)) {
            if (!$query->bind_param($types, ...$params)) {
                return null;
            }
        }
        if($query->execute()){
            $results = $query->get_result();
            if($results->num_rows < 1) return [];

            $models = [];
            while($result = $results->fetch_assoc()){
                $className = get_class($model);
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