<?php

namespace app\model;

class Category extends Model
{
    public $id;
    public $time;
    public $description;

    public function __construct($value)
    {
        parent::__construct();

        $this->addObj($value);
    }

    public function getTableName()
    {
        return "category";
    }
}