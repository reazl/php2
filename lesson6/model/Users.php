<?php

namespace app\model;

use app\engine\Db;


class Users extends DbModel
{
    public $id;
    public $login;
    public $pass;


    public function __construct($id=null, $login=null, $pass=null)
    {
        $this->id = $id;
        $this->login = $login;
        $this->pass = $pass;

    }

    private static function auth($login, $pass)
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM `users` WHERE `login` = :login";
        $result = $db->queryOne($sql, ['login'=>$login]);
        if (password_verify($pass, $result['pass'])) {
            $_SESSION['login'] = $login;
            $_SESSION['id'] = $result['id'];
            return true;
        }
        return false;
    }

    public static function registration(){
        $err = array();
        $db = Db::getInstance();
        $login = $_POST['login'];
            # проверям логин

        if (!preg_match("/^[a-zA-Z0-9]+$/", $login)) {
            $err[] = "Логин может состоять только из букв английского алфавита и цифр";
        }

        if (strlen($login) < 3 or strlen($login) > 30) {
            $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
        }

        # проверяем, не сущестует ли пользователя с таким именем

        $sql = "SELECT id FROM users WHERE login = :login";
        $result = $db->queryOne($sql, ['login' => $login]);

        if (!is_null($result)) {
            $err[] = "Пользователь с таким логином уже существует в базе данных";
        }

            # Если нет ошибок, то добавляем в БД нового пользователя

            if (count($err) == 0) {
                $login = $_POST['login'];

                # Убераем лишние пробелы и делаем двойное шифрование

                $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);
                $regQuery = "INSERT INTO users SET login='" . $login . "', pass ='" . $password . "'";
                $db->queryOne($regQuery);
                //echo 'Поздравляем с регистрацией! Через несколько секунд Вы будете перемещены на главную страницу.';
                //sleep(5);
                header("Location: /public/");
            } else {
                print "<b>При регистрации произошли следующие ошибки:</b><br>";
                foreach ($err AS $error) {
                    print $error . "<br>";
                }
            }


    }

    public static function login(){
        if (isset($_POST['send'])) {
            $login = $_POST['login'];
            $pass = $_POST['pass'];

            if (!self::auth($login, $pass)) {
                Die('Не верный логин пароль');
            } else {
                if (isset($_POST['save'])) {
                    $hash = uniqid(rand(), true);
                    $db = Db::getInstance();
                    $id = strip_tags(stripslashes($_SESSION['id']));
                    $sql = "UPDATE `users` SET `hash` = '{$hash}' WHERE `users`.`id` = {$id}";
                    $db->queryOne($sql, ['id'=>$id]);
                    setcookie("hash", $hash, time() + 3600);
                }
                $user = self::getName();
            }
        }
    }

    public static function isAuth(){
        if (isset($_COOKIE["hash"])) {
            $hash = $_COOKIE["hash"];
            $db = Db::getInstance();
            $tableName = self::getTableName();
            $sql = "SELECT * FROM `{$tableName}` WHERE `hash`='{$hash}'";
            $result = $db->queryOne($sql, $hash);
            $user = $result['login'];
            if (!empty($user)) {
                $_SESSION['login'] = $user;
            }
        }
        return isset($_SESSION['login']) ? true : false;
    }

    public static function getName(){
        return self::isAuth() ? $_SESSION['login'] : false;
    }

    public static function getTableName()
    {
        return "users";
    }

}