<?php
/** @var \app\model\Products $product */
// TODO доделать
?>
<form method="post" action="<?=$product->update()?>">
<h2>Наименование: <input type="text" name="name" value="<?=$product->name?>"></h2>
<p>Описание: <input type="text" name="desc" value="<?=$product->description?>"></p>
<p>Цена: <input type="text" name="price" value="<?=$product->price?>"></p>
<input type="submit">
</form>