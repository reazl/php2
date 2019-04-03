<?php

namespace app\controllers;


use app\model\Products;


class ProductController extends Controller
{


    public function actionIndex()
    {

        $catalog = Products::getAll();

        echo $this->render("catalog", ['catalog' => $catalog]);
    }

    public function actionCard()
    {
        $id = (int)$_GET['id'];
        $product = Products::getOne($id);


        echo $this->render("card", ['product' => $product]);
    }

    public function actionEdit()
    {
        $id = (int)$_GET['id'];
        $product = Products::getOne($id);

        echo $this->render("edit", ['product' => $product]);
    }
}