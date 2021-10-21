<?php

namespace Site\Core;

class CloudPaymentsService
{
    private $token;

    public function __construct(string $login, string $password){
        $this->token = base64_encode("$login:$password");
    }

    public function createSubscription(string $token, int $user_id, string $email, int $amount){
        $api_url = "https://api.cloudpayments.ru/subscriptions/create";
        $request_params = [
            "token"               => $token,
            "accountId"           => $user_id,
            "description"         => "Оплата услуг сервиса Take-Keys",
            "email"               => $email,
            "amount"              => $amount,
            "currency"            => "RUB",
            "requireConfirmation" => false,
            "startDate"           => "2014-08-06T16=>46=>29.5377246Z",
            "interval"            => "Day",
            "period"              => 3
        ];

        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request_params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: {$this->token}"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $response = json_decode($response);

        if($response->Success){
            return (int) $response->Model->Id;
        }
        return False;
    }
}