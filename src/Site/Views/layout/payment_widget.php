<?php
/**
 * @var int $amount
 */

$full_amount = env("first_payment_amount") ?? $amount;
$part_amount = env("first_payment_amount_sale") ?? $amount;
$min_amount = env("first_payment_amount_minimal") ?? $amount;

?>

<script>
this.pay = function (user_id, pay_mode) {
    var widget = new cp.CloudPayments();
    var amounts = [<?=$full_amount?>,<?=$part_amount?>,<?=$min_amount?>];
    widget.pay('charge',
        {
            publicId: '<?=env("cloudpayments_public_key")?>',
            description: '<?=env("cloudpayments_subscribe_desc")?>',
            amount: amounts[pay_mode],
            currency: 'RUB',
            accountId: user_id,
            skin: "modern"
        },
        {
            onSuccess: function (options) {
                ym(85688374,'reachGoal','subscribed');
                window.location.reload();
            },
            onFail: function (reason, options) {
                window.location.reload();
                // Modal.getOrCreateInstance($("#popup-tarif-take-keys")).show()
            }
        }
    )
};

</script>