<?php

namespace Site\Core;

class TelegramNotifyService
{
    private $token;

    public function __construct($token){
        $this->token = $token;
    }

    public function send($chats, string $message){
        $message = urlencode($message);
        if(!is_array($chats)) $chats = [$chats];
        foreach($chats as $chat_id){
            $url = "https://api.telegram.org/bot{$this->token}/sendMessage?chat_id=$chat_id&text=$message";
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
        }
    }
}