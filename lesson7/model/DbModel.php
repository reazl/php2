<?php

namespace app\model;

use app\engine\Db;
use app\interfaces\IModel;
use app\model\Models;
use app\engine\Request;

abstract class DbModel extends Models implements IModel
{

    public static function getOne($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->queryObject($sql, ['id' => $id], static::class);
    }

    public static function getAll()
    {
        $tableName = static::getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return Db::getInstance()->queryAll($sql);

    }

    public static function getCountWhere($field, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT count(*) as count FROM `{$tableName}` WHERE `{$field}` ={$field}";
        return Db::getInstance()->queryOne($sql, ["$field" => $value])['count'];
    }

    public static function getOneWhere($field, $value)
    {
        $tableName = static::getTableName();
        $sql = "SELECT (*) FROM `{$tableName}` WHERE `{$field}` ={$field}";
        // TODO: finish it
        return Db::getInstance()->queryOne($sql, ["$field" => $value])['count'];
    }

    public function update()
    {
        $tableName = static::getTableName();
        $params = [];
        $columns = [];

        foreach ($this as $key => $value) {
            if ($key == "id") continue;
            $params[":{$key}"] = $value;
            $columns["{$key}"] = $value;

        }
        $columns = implode(', ', array_map(
            function ($v, $k) {
                return sprintf("%s = '%s'", $k, $v);
            },
            $columns,
            array_keys($columns)
        ));

        $sql = "UPDATE `{$tableName}` SET  {$columns} WHERE id={$this->id}";

        Db::getInstance()->execute($sql, $params);

    }



    public function insert()
    {

        $params = [];
        $columns = [];

        foreach ($this as $key => $value) {
            if ($key == "id") continue;
            $params[":{$key}"] = "'$value'";
            $columns[] = $key;
        }

        $columns = implode(", ", $columns);
        $values = implode(", ", $params);
        $tableName = static::getTableName();


        $sql = "INSERT INTO `{$tableName}`({$columns}) VALUES ({$values})";

        Db::getInstance()->execute($sql, $params);

        $this->id = Db::getInstance()->LastInsertId();

    }



    public function save()
    {
        $this->insert();
    }

    public function delete()
    {
        $tableName = static::getTableName();
        $sql = "DELETE FROM {$tableName} WHERE id = :id";
        return Db::getInstance()->execute($sql, ['id' => $this->id]);
    }

    public function addObj()
    {

        $params = [];
        $values = [];
        foreach ($this as $key => $value) {

            $params[] = "`$key`";
            $values[] = "'$value'";

        }
        $tableName = $this->getTableName();
        $params = implode(', ', $params);
        $values = implode(', ', $values);
        $sql = "INSERT INTO `{$tableName}` ({$params}) VALUES ({$values})";

        return Db::getInstance()->queryAll($sql);
    }

    abstract public static function getTableName();
}