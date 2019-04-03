<?php

namespace app\controllers;


use app\engine\Request;
use app\model\Basket;
use app\model\DbModel;
use app\model\Products;
use app\model\Users;


class ProductController extends Controller
{
    public function actionAddBasket()
    {

       if (Basket::isUniqueItem()){
            (new Basket(null, session_id(), (new Request())->getParams()['id']))->save();
            echo json_encode(['response' => 1]);
        }else{
            Basket::updateBasket();
           echo json_encode(['response' => 0]);
        }
    }

    public function actionDelBasket(){

        Basket::deleteItem();
        echo json_encode(['response' => 1]);
    }

    public function actionIndex()
    {
        $catalog = Products::getAll();

        echo $this->render("catalog", ['catalog' => $catalog]);
    }

    public function actionBasket(){

        $items = Basket::getGoods();
        echo $this->render("basket", ['basket'=>$items]);
    }

    public function actionLogout(){

        header("Location: /");
    }

    public function actionCard()
    {
        $id = (int)$_GET['id'];
        $product = Products::getOne($id);
        $username = Users::getName();

        $category = Products::getCategoryDescription($id);

        echo $this->render("card", ['product' => $product, 'username' => $username, 'category' => $category]);
    }

    public function actionSavechngs(){

        Products::saveChngs();
        $id = $_GET['id'];
        header("Location: /product/card/?id={$id}");
       }

    public function actionEdit()
    {

        $id = (int)$_GET['id'];
        $product = Products::getOne($id);

        echo $this->render("edit", ['product' => $product]);
    }
}