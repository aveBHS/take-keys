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
        $tg = new TelegramNotifyService(env('TELEGRAM_KEY'));
        $object = ObjectModel::find($request->post("object"));
        if(!is_null($object)){
            $tg->send(env("TELEGRAM_CHAT"),
                "Запрос прозвона объекта https://take-keys.ru/id/{$object->id}\n
                Телефон объекта: +{$object->phones}\n
                Пользователь ID{$auth()->id}\n
                Телефон пользователя: +{$auth()->request->phone}"
            );
        }
    }
}