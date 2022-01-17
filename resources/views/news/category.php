<?php
include resource_path() . "/views/menu.php";
?>
<br>
<h3><?=$categoryName?></h3>
<br>
<?php foreach ($newsList as $news): ?>
    <div>
        <h2><a href="<?=route('news.show', ['id'=> $news['id']])?>"><?=$news['title']?></a></h2>

        <p>Автор: <?=$news['author']?> &nbsp; Дата добавления: <?=$news['created_at']?></p>
        <p><?=$news['description']?></p>
    </div>
    <hr>
<?php endforeach; ?>

