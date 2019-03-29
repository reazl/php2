<?php

namespace app\model;

class Products extends DbModel
{
    public $id;
    public $name;
    public $description;
    public $price;


    public function __construct($id = null, $name = null, $description = null, $price = null)
    {

        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;

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