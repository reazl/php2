<?php
echo "<div class='catalog'>";
foreach ($catalog as $item):?>
<div class="item">
<a href="?c=product&a=card&id=<?=$item['id']?>">
    <h2><?=$item['name']?></h2>
</a>
<p><?=$item['description']?></p>
<p>Стоимость: <?=$item['price']?> рубля(ей)</p>
    <button class="order">Заказать</button>
</div>


<?endforeach;?>
</div>
