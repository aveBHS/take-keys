<?php
/**
 * @var string VIEW_PATH
 **/

$_page_title = "Главная страница | Take Keys";
?>

<?=view("layout.header", ["_page_title" => $_page_title])?>

<div class="container">
    <h1>Content</h1>
</div>

<?=view("layout.footer")?>
