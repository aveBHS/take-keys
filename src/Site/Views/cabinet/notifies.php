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
    <?php foreach($notifies as $notify) {
        switch ($notify->type){
            case "call":
                echo view("layout.lk.notification_item", ["notify" => $notify]);
                break;
            case "custom":
                echo view("layout.lk.notification_custom", ["notify" => $notify]);
                break;
        }
    } ?>
</div>
<?=$auth()->request->purchased == 1 ?"":view("layout.payment_widget", ["amount" => env("first_payment_amount_sale")])?>
<?=view("layout.lk.templ_close")?>

<?=view("layout.footer")?>
