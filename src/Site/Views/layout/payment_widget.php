<?php
/**
 * @var int $amount
 */

$amount = $amount ?? env("cloudpayments_subscribe_amount");

?>

<script>
this.pay = function (user_id) {
    var widget = new cp.CloudPayments();
    widget.pay('charge',
        {
            publicId: '<?=env("cloudpayments_public_key")?>',
            description: '<?=env("cloudpayments_subscribe_desc")?>',
            amount: <?=$amount?>,
            currency: 'RUB',
            accountId: user_id,
            skin: "mini"
        },
        {
            onSuccess: function (options) {
                ym(85688374,'reachGoal','subscribed');
                $("#mobile_action_block").html(`
                    <button type="button" class="btn btn-48 btn-primary" onclick="send_call_request();">Связаться</button>
                    <a href="https://take-keys.com/booking"><button class="btn btn-48 btn-dark">Бронировать</button></a>`)
                $("#action_block").html(`
                    <button type="button" class="btn btn-48 btn-primary w-100 mb-3" onclick="send_call_request();">Связаться</button>
                    <a href="https://take-keys.com/booking"><button class="btn btn-48 btn-dark w-100 mb-4">Бронировать</button></a>`)
                Modal.getOrCreateInstance($("#popup-tarif-pay-success")).show()
            },
            onFail: function (reason, options) {
                Modal.getOrCreateInstance($("#popup-tarif-pay-fail")).show()
            }
        }
    )
};

</script>