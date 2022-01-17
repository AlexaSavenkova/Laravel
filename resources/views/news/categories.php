<?php
include resource_path() . "/views/menu.php";
?>
<br>
<ul>
    <?php foreach ($categoryList as $category): ?>
            <li><a href="<?=route('news.category', ['slug'=> $category['slug']])?>"><?=$category['name']?></a></li>
    <?php endforeach; ?>
</ul>
