<?php

namespace app\controllers;


use app\engine\Request;
use app\model\Basket;
use app\model\Products;


class ProductController extends Controller
{
    public function actionAddBasket()
    {

            (new Basket(null, session_id(), (new Request())->getParams()['id']))->save();
        echo json_encode(['response' => 1]);
    }

    public function actionIndex()
    {
        $catalog = Products::getAll();

        echo $this->render("catalog", ['catalog' => $catalog]);
    }

    public function actionBasket(){
        $basketGoods = Basket::getAll();


        foreach ($basketGoods as $item) {

            $items[] = (array)Products::getOne($item['product_id']);
            $items += ['count' => $item['count']];
            //$items->count = $item['count'];
//array_push($items, $item['count']);
        }
        echo $this->render("basket", ['basket'=>$items]);
    }

    public function actionLogout(){
        echo "Logout";
        header("Location: /");
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