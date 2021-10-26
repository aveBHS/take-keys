<?php

namespace Site\Core;

class TelegramNotifyService
{
    private $token;

    public function __construct($token){
        $this->token = $token;
    }

    public function send(array $chats, string $message){
        $message = urlencode($message);
        foreach($chats as $chat_id){
            $message = urlencode($message);
            $url = "https://api.telegram.org/bot{$this->token}/sendMessage?chat_id=$chat_id&text=$message";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
        }
    }
}