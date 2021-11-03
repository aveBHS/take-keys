<?php

namespace Site\Controllers\Objects;

use Site\Core\HttpRequest;
use Site\Core\TelegramNotifyService;
use Site\Models\ObjectModel;

class VerifyOwnerRequestController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args) { }

    public function request(HttpRequest $request, $args)
    {
        global $auth;
        $request->setHeader("Content-Type", "application/json");
        $tg = new TelegramNotifyService(env('TELEGRAM_KEY'));
        $object = ObjectModel::find($request->post("object"));
        if(!is_null($object)){
            if($object->status > 1){
                $request->show(json_encode([
                    "result" => "ERROR",
                    "reason" => "Объект уже неактуален"
                ]));
                return;
            }
            $tg->send(env("TELEGRAM_CALL_REQUESTS_CHAT"),
                "Запрос прозвона объекта https://take-keys.ru/id/{$object->id}\nТелефон объекта: +{$object->phones}\nПользователь ID{$auth()->id}\nТелефон пользователя: +{$auth()->request->phone}"
            );
            $request->show(json_encode([
                "result" => "OK"
            ]));
            return;
        }
        $request->show(json_encode([
            "result" => "ERROR",
            "reason" => "Объект не найден, обновите страницу и повторите попытку"
        ]));
    }
}