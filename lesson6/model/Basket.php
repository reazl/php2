<?php

namespace app\model;

use app\engine\Db;

class Basket extends DbModel
{
    protected $id;
    protected $session_id;
    protected $product_id;

    public function __construct($id = null, $session_id = null, $product_id = null)
    {
        $this->id = $id;
        $this->session_id = $session_id;
        $this->product_id = $product_id;
    }

    public static function getCountField($id){
        $sql = "SELECT `count` FROM `basket` WHERE `id` = $id";

        return Db::getInstance()->queryOne($sql);
    }

    public static function getGoods()
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