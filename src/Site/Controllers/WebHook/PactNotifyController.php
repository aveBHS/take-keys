<?php

namespace Site\Controllers\WebHook;

use Site\Core\HttpRequest;

class PactNotifyController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        $token = env('TELEGRAM_KEY');
        $chat_id = env('TELEGRAM_CHAT');
        $message = file_get_contents("php://input");
        if(json_decode($message, true)['type'] == "system") {
            $json_beautified = str_replace(
                array("{", "}", '","'),
                array("{\n    ", "\n}", "\",\n    \""),
                $message
            );
            $message = urlencode($json_beautified);
            $url = "https://api.telegram.org/bot$token/sendMessage?chat_id=$chat_id&text=$message";

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);
        }
    }
}