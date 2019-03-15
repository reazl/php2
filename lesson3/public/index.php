<?php
include "../engine/Autoload.php";
include "../config/config.php";

use app\model\Products;
use app\model\News;
use app\engine\Autoload;
use app\model\Users;
use app\model\Category;

spl_autoload_register([new Autoload(), 'loadClass']);

$product1 = new Products("'Милкшейк', '17', '5', 'Клубника/вишня/абрикос'");

