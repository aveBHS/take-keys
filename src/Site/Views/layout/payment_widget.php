<?php
/**
 * @var int $amount
 */

$full_amount = env("first_payment_amount") ?? $amount;
$part_amount = env("first_payment_amount_sale") ?? $amount;

?>

<script>
this.pay = function (user_id, full_amount=false) {
    var widget = new cp.CloudPayments();
    widget.pay('charge',
        {
            publicId: '<?=env("cloudpayments_public_key")?>',
            description: '<?=env("cloudpayments_subscribe_desc")?>',
            amount: full_amount?<?=$full_amount?>:<?=$part_amount?>,
            currency: 'RUB',
            accountId: user_id,
            skin: "mini"
        },
        {
            onSuccess: function (options) {
                ym(85688374,'reachGoal','subscribed');
                $("#mobile_action_block").html(`
                    <button type="button" class="btn btn-48 btn-primary" onclick="send_call_request();">Записаться на встречу</button>
                    <a href="https://take-keys.com/booking"><button class="btn btn-48 btn-dark">Бронировать</button></a>`)
                $("#action_block").html(`
                    <button type="button" class="btn btn-48 btn-primary w-100 mb-3" onclick="send_call_request();">Записаться на встречу</button>
                    <a href="https://take-keys.com/booking"><button class="btn btn-48 btn-dark w-100 mb-4">Бронировать</button></a>`)
                Modal.getOrCreateInstance($("#popup-tarif-pay-success")).show()
            },
            onFail: function (reason, options) {
                Modal.getOrCreateInstance($("#popup-tarif-take-keys")).show()
            }
        }
    )
};

</script>