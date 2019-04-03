<?php

namespace app\controllers;

use app\engine\Db;
use app\model\Users;


class UserController extends Controller
{
    public function actionLogout()
    {

        session_destroy();
        setcookie("hash");
        header("Location: " . $_SERVER['HTTP_REFERER']);

    }

    public function actionLogin()
    {
        Users::login();

        header("Location: " . $_SERVER['HTTP_REFERER']);
    }

    public function actionReg()
    {
        $this->useLayout = false;
        Users::registration();
        echo $this->render("registration");
    }
}

