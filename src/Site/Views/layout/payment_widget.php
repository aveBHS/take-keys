<?php
/**
 * @var int $amount
 */

$amount = $amount ?? env("cloudpayments_subscribe_amount");

?>

<script>
this.pay = function (user_id) {
    var widget = new cp.CloudPayments();
    widget.pay('auth', // или 'charge'
        { //options
            publicId: '<?=env("cloudpayments_public_key")?>', //id из личного кабинета
            description: '<?=env("cloudpayments_subscribe_desc")?>', //назначение
            amount: <?=$amount?>, //сумма
            currency: 'RUB', //валюта
            accountId: user_id, //идентификатор плательщика (необязательно)
            skin: "mini", //дизайн виджета (необязательно)
            data: {
                myProp: 'myProp value'
            }
        },
        {
            onSuccess: function (options) { // success
                Modal.getOrCreateInstance($("#popup-tarif-pay-success")).show()
            },
            onFail: function (reason, options) { // fail
                Modal.getOrCreateInstance($("#popup-tarif-pay-fail")).show()
            },
            onComplete: function (paymentResult, options) { //Вызывается как только виджет получает от api.cloudpayments ответ с результатом транзакции.
                alert("done");
            }
        }
    )
};

</script>