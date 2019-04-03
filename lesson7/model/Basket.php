<?php

namespace app\model;

use app\engine\Db;
use app\engine\Request;

class Basket extends DbModel
{
    protected $id;
    protected $session_id;
    protected $product_id;

    public function __construct($id = null, $session_id = null, $product_id = null)//, $count = null)
    {
        $this->id = $id;
        $this->session_id = $session_id;
        $this->product_id = $product_id;
        //$this->count = $count;
    }

    public static function getCountField($id){
        $sql = "SELECT `count` FROM `basket` WHERE `id` = $id";

        return Db::getInstance()->queryOne($sql);
    }

    public static function isUniqueItem(){

        $session_id = session_id();
        $product_id = $_POST['id'];
        $basketGoods = Basket::getAll();

        foreach ($basketGoods as $item) {

            if ( $item['session_id'] === $session_id && $item['product_id'] === $product_id) {
                return false;
            }
        }
    return true;
    }

    public static function deleteItem(){
        $tableName = static::getTableName();
        $product_id = $_POST['id'];
        $sql = "DELETE FROM {$tableName} WHERE product_id = {$product_id}";

        Db::getInstance()->queryOne($sql);
    }

    public static function updateBasket()
    {
        $tableName = static::getTableName();

        $product_id = $_POST['id'];

        $sql = "UPDATE `{$tableName}` SET  count = count+1 WHERE product_id={$product_id}";

        Db::getInstance()->queryOne($sql);

    }

    public static function getGoods()
    {
        $items = [];
        $basketGoods = Basket::getAll();
        foreach ($basketGoods as $item) {
            $good = (array)Products::getOne($item['product_id']);
            array_push($good, $item['count']);
            $items[] = $good;
        }

        return $items;
    }

    public static function getCount()
    {
        $basketGoods = Basket::getAll();
        foreach ($basketGoods as $item) {
            $items[] = Products::getOne($item['product_id']);
        }
        return $items;
    }

    public static function getTableName()
    {
        return "basket";
    }
}