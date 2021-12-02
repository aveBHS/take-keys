<?php

namespace Site\Controllers\Objects;

use Site\Core\HttpRequest;
use Site\Core\SendPulseService;
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

            userLog("Запрос прозвона объекта",
                "Объект: ID {$object->id}");
            if($object->isAd){
                try {
                    $email_confirm = new SendPulseService(env("sendpulse_user_id"), env("sendpulse_api_token"), env("sendpulse_sender"));
                    $email_confirm->createSubscriber(env("sendpulse_ads_call_id"), $auth(), false);
                } catch (\Exception $exception){
                    bugReport($exception);
                }
                $tg->send(env("TELEGRAM_CALL_REQUESTS_CHAT"),
                    "Запрос прозвона рекламного объекта https://take-keys.ru/id/{$object->id}\nПользователь ID{$auth()->id}"
                );
            } else {
                $tg->send(env("TELEGRAM_CALL_REQUESTS_CHAT"),
                    "Запрос прозвона объекта https://take-keys.ru/id/{$object->id}\nИсточник: {$object->origin}\nТелефон объекта: +{$object->phones}\nПользователь ID{$auth()->id}\nТелефон пользователя: +{$auth()->request->phone}"
                );
            }
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