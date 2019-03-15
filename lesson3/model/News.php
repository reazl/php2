<?php

namespace app\model;

class News extends Model
{
    public $id;
    public $category;
    public $prev;
    public $text;

    public function getTableName()
    {
        return "news";
    }
    public function getFullNew($id)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT `text` FROM {$tableName} WHERE id = :id";
        return $this->db->queryOne($sql, [':id'=>$id]);
    }
}