<?php
/**
 * @var array $logs
 **/

global $request;
global $auth;
$flash_error = $request->getFlash("login_error");
$_page_title = "Отчет работы системы | Take Keys";

?>

<?=view("layout.header", ["_page_title" => $_page_title])?>

<div class="container">
    <h1 class="h1 item__title mb-1 mt-5">Отчет работы системы Take-Keys</h1>
    <h3 class="h3 item__title mb-4">Системный UUID: <?=$auth()->id?></h3>

    <ul>
        <?php foreach($logs as $log){ ?>
        <li>
             <h3><?=$log->title?></h3>
            <?=str_replace("\n", "<br>", $log->content)?><br>
            <small>Дата записи: <?=$log->created?></small>
        </li>
        <?php } ?>
    </ul>
</div>

<button onclick="Chatra('openChat', true)" class="btn btn-dark btn-icon btn-chat">
    <i class="icon"><img src="/images/icons/chat.svg"></i>
</button>

<?=view("layout.footer")?>
