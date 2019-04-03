<?php
/** @var \app\model\Products $product */
?>

<h2>Наименование:<?=$product->name?></h2>
<p>Описание:<?=$product->description?></p>
<p>Цена:<?=$product->price?></p>
<a class="edit" href="?c=product&a=edit&id=<?=$product->id?>">Редактировать</a>
