<?php

namespace app\model;

class Category extends DbModel
{
    public $id;
    public $time;
    public $description;

    public function __construct($value)
    {
        parent::__construct();

        $this->addObj($value);
    }

    public static function getTableName()
    {
        return "category";
    }
}