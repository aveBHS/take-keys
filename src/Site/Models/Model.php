<?php
/**
 * @var mysqli $db
 */
namespace Site\Models;

abstract class Model
{
    private $db;

    function __construct()
    {
        $this->db = require __DIR__ . "/../database.php";
    }

    function find($objectId)
    {
        $tableName = $this->tableName ?? getTableName(get_class($this));
        $tableIndex = $this->tableId ?? 'id';

        $query = $this->db->prepare(
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
                $this->$key = $value;
            }
            return $this;
        }
        return Null;
    }
}