<?php

namespace app\model;
use app\engine\Db;

class Products extends DbModel
{
    public $id;
    public $name;
    public $description;
    public $price;


    public function __construct($id = null, $name = null, $description = null, $price = null, $category = null)
    {

        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;

    }

    public static function saveChngs()
    {
        $tableName = static::getTableName();
        $params = [];
        $columns = [];

        foreach ($_POST as $key => $value) {
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

        $sql = "UPDATE `{$tableName}` SET  {$columns} WHERE id={$_POST['id']}";

        Db::getInstance()->execute($sql, $params);

    }

    public static function getCategory($id)
    {
        $tableName = static::getTableName();
        $sql = "SELECT `category` FROM `{$tableName}` WHERE id=:id";
        return Db::getInstance()->queryOne($sql, ['id' => $id])['category'];
    }

    public static function getCategoryDescription($id)
    {
        $categoryID = Products::getCategory($id);
        $tableName = Category::getTableName();
        $sql = "SELECT `description` FROM `{$tableName}` WHERE id=$categoryID";

        return Db::getInstance()->queryOne($sql, ['id' => $categoryID])['description'];

    }

    public function __call($closuire, $args)
    {
        return call_user_func_array($this->{$closuire}, $args);
    }

    public static function getTableName()
    {
       return "products";
    }

}