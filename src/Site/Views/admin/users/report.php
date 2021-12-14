<?php
/**
 * @var array $logs
 * @var array $user
 */
?>
<?=view("admin.layout.header", ["title" => "Отчет пользователя ID{$user->id}"])?>

<div class="container-fluid px-4">
    <h1 class="h1 item__title mb-1 mt-5">Отчет работы системы Take-Keys</h1>
    <h3 class="h3 item__title mb-4">Системный UUID: <?=$user->id?></h3>

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

<?=view("admin.layout.footer")?>