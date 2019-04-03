<?php

namespace app\model;

class Feedback extends Model
{
    public $id;
    public $author;
    public $text;

    public function getTableName()
    {
        return "feedback";
    }
}