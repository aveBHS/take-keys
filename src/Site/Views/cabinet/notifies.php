<?php
/**
 * @var array $notifies
 */

global $request;
global $auth;
?>

<?=view("layout.header", ["_page_title" => "Уведомления"])?>

<?=view("layout.lk.templ_open", ["current_page" => LK_NOTIFIES_PAGE])?>
<h1 class="h1 item__title h-64 my-4">Уведомления</h1>
<div class="lk-notifications">
    <?=view("layout.lk.notification_vip")?>
    <?php foreach($notifies as $notify) {
        echo view("layout.lk.notification_item", ["notify" => $notify]);
    } ?>
</div>
<?=view("layout.lk.templ_close")?>

<?=view("layout.footer")?>
