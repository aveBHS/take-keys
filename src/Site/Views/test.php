<?php
$_page_title = "Тестовая страница | Take Keys";
?>

<?=view("layout.header", ["_page_title" => $_page_title])?>

<div class="container">
    <h1 class="h1 mt-5 mb-3">Тестовая страница</h1>
    <button class="btn btn-primary sp_notify_prompt">Включить Push</button>
</div>

<?=view("layout.footer")?>
