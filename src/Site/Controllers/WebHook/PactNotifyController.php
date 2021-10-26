<?php

namespace Site\Controllers\WebHook;

use Site\Core\HttpRequest;
use Site\Core\TelegramNotifyService;

class PactNotifyController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        $tg = new TelegramNotifyService(env('TELEGRAM_KEY'));
        $message = file_get_contents("php://input");
        if(json_decode($message, true)['type'] == "system") {
            $json_beautified = str_replace(
                array("{", "}", '","'),
                array("{\n    ", "\n}", "\",\n    \""),
                $message
            );
            $tg->send(env('TELEGRAM_CHAT'), $json_beautified);
        }
    }
}