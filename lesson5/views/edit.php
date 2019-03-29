<?php
/** @var \app\model\Products $product */
// TODO доделать
?>
<form action="<?=$product->save()?>">
<h2>Наименование: <input type="text" value="<?=$product->name?>"></h2>
<p>Описание: <input type="text" value="<?=$product->description?>"></p>
<p>Цена: <input type="text" value="<?=$product->price?>"></p>
<input type="submit">
</form>