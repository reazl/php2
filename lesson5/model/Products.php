<?php

namespace app\model;

class Products extends DbModel
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $category;

    public function __construct($id = null, $name = null, $description = null, $price = null, $category = null)
    {
        //parent::__construct();
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
        //$this->addObj($value);
    }


    public static function getTableName()
    {
       return "products";
    }

}