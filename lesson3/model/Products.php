<?php

namespace app\model;

use app\engine\Db;

class Products extends Model
{
    public $id;
    public $name;
    public $description;
    public $price;
    public $category;

    public function __construct($value)
    {
        parent::__construct();

        $this->addObj($value);
    }


    public function getTableName()
    {
       return "products";
    }

}