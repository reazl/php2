<?php

namespace app\model;

use app\engine\Db;
use app\interfaces\IModel;


abstract class Model implements IModel
{

    protected $db;


    public function __construct()
    {
        $this->db = Db::getInstance();
    }

    public function getOne($id) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return $this->db->queryOne($sql, [':id'=>$id]);
    }

    public function getAll() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return $this->db->queryAll($sql);

    }

    /*public function getID($value){
        $tableName = $this->getTableName();
        $params = $this->getParams();
        $sql = "SELECT `id` FROM {$tableName} WHERE {$params} = {$value}";
        return $this->db->queryOne($sql);
    }*/

    // Определяем набор полей для дальнейших запросов
    public function getParams(){
        $tableName = $this->getTableName();
        $sql = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '{$tableName}'";
        $columns = $this->db->queryAll($sql);
        $params = "(";

        foreach ($columns as $value => $item){
            foreach ($item as $column => $param){
                if ($param == "id") continue;
                $params .= "`{$param}`,";
            }
        }

        $params = substr($params, 0, -1);
        $params .= ")";

        return $params;
    }

    // Не доделал...
    public function updateObj($id, $values){
        $tableName = $this->getTableName();
        $params = $this->getParams();
        $valueSets = array();

        $str = preg_split('/\W+/', $params);
        $str = array_slice($str, 1, -1);

        /*for($i = 0; $i<sizeof($values); $i++) {

                $valueSets[$i] = $str[$i] . " = '" . $values[$i] . "'";
                echo "params: $str[$i]<br> values: $values[$i]";
        }
        var_dump($valueSets);*/
        /*$conditionSets = array();
        foreach($id as $key => $value) {
            $conditionSets[] = $key . " = '" . $value . "'";
        }*/

        /*$sql = "UPDATE {$tableName} SET ". join(",",$valueSets) . " WHERE id = :id";
        return $this->db->queryOne($sql, [':id'=>$id]);*/
    }

    // Универсальный метод добавления объектов в бд
    public function addObj($value) {
        $params = $this->getParams();
        $tableName = $this->getTableName();
        $sql = "INSERT INTO `{$tableName}` {$params} VALUES ({$value})";

        echo "params: {$params}, tableName: {$tableName}, value: {$value}";

        return $this->db->queryOne($sql);
    }

    public function delObj($id){
        $tableName = $this->getTableName();
        $sql = "DELETE FROM `{$tableName}` WHERE id = :id";
        echo $sql;
        return $this->db->queryOne($sql, [':id'=>$id]);
    }

    abstract public function getTableName();
}