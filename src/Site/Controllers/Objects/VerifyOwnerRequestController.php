<?php

namespace Site\Controllers\Objects;

use Site\Core\HttpRequest;
use Site\Core\SendPulseService;
use Site\Core\TelegramNotifyService;
use Site\Models\CallResultModel;
use Site\Models\ObjectCallModel;
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
                $call_result = CallResultModel::select([["owner_id", $auth()->id], ["object_id", $object->id]]);
                if(!empty($call_result) && $call_result[0]->call_status != OBJECT_CALL_FAILED){
                    $request->show(json_encode([
                        "result" => "INFO",
                        "reason" => "Вы уже отправили заявку на связь с владельцем этого объекта"
                    ]));
                    return;
                }
                try {
                    $call_request = ObjectCallModel::select([["object_id", $object->id]]);
                    if(empty($call_request)){
                        $call_request = new ObjectCallModel();
                        $call_request->object_id = $object->id;
                        $call_request->result_time = 0;
                        $call_request->call_status = OBJECT_CALL_NEW;
                        $call_request->save();
                    } else {
                        $call_request = $call_request[0];
                        if($call_request->call_status == OBJECT_CALL_DONE){
                            if(time() >= ((int)$call_request->result_time+7200)){
                               $call_request->call_status = OBJECT_CALL_NEW;
                               $call_request->save();
                            }
                        }
                    }

                    $call_result = new CallResultModel();
                    $call_result->object_id = $object->id;
                    $call_result->owner_id = $auth()->id;
                    $call_result->call_id = $call_request->id;
                    $call_result->show_at = 0;
                    $call_result->save();
                } catch (\Exception $exception) {
                    bugReport($exception);
                    $request->show(json_encode([
                        "result" => "ERROR",
                        "reason" => "Произошла ошибка, мы уже работаем над этим, пожалуйста, повторите попытку позднее"
                    ]));
                    return;
                }
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

    public function cancel_request(HttpRequest $request, $args)
    {
        global $auth;
        $request->setHeader("Content-Type", "application/json");
        $call_result = CallResultModel::select([["owner_id", $auth()->id], ["object_id", $args[0]]]);
        if(!empty($call_result)){
            $call_result[0]->remove();
            userLog("Отмена прозвона объекта",
                "Объект: ID {$args[0]}");
            $request->show(json_encode([
                "result" => "OK"
            ]));
        } else {
            $request->show(json_encode([
                "result" => "ERROR",
                "reason" => "Заявка не найдена"
            ]));
        }
    }
}