<?php

namespace Site\Controllers\User;

use Site\Controllers\Controller;
use Site\Core\HttpRequest;
use Site\Core\TelegramNotifyService;
use Site\Models\ObjectModel;
use Site\Models\ObjectTypeModel;
use Site\Models\PhoneCallModel;
use Site\Models\RequestModel;
use Site\Models\UserModel;

class JoinController implements Controller
{
    function view(HttpRequest $request, $args){ }

    function join(HttpRequest $request, $args){
        $request->setHeader("Content-Type", "application/json");
        if (!preg_match('/[7]\d{10,12}/',
            getPhone($request->post("phone")))){
            $request->show(json_encode([
                "result"  => "ERROR",
                "reason"  => "Телефон указан некорректно"
            ]));
            return;
        }
        if (!filter_var($request->post("email"), FILTER_VALIDATE_EMAIL)){
            $request->show(json_encode([
                "result"  => "ERROR",
                "reason"  => "Почта указана некорректно"
            ]));
            return;
        }
        global $auth;

        $user = new UserModel();
        $user->login = strtolower($request->post("email"));
        $user->phone = getPhone($request->post("phone"));
        $user->password = md5($request->post("password"));
        $user->name = $request->post("name");
        $reqInfo = ObjectModel::find((int) $request->post("object"));

        if(is_null($reqInfo)){
            $request->show(json_encode([
                "result"  => "ERROR",
                "reason"  => "Обновите страницу и повторите попытку"
            ]));
            return;
        }

        $req = new RequestModel();
        $req->phone = getPhone($request->post("phone"));
        $req->email = strtolower(trim($request->post("email")));
        $req->purchased = 0;
        $req->is_free = 0;
        $req->status = 1;

        $req->lat = $reqInfo->lat;
        $req->lng = $reqInfo->lng;
        $req->price = $reqInfo->cost;
        $req->address = $reqInfo->address;
        $req->distance = 1000;

        $reqType = ObjectTypeModel::find($reqInfo->category_id, "inpars_id");
        $req->object_type = (int)($reqType->object_type_id ?? 1);
        $req->recommendations = "";

        try {
            if ($req->save()) {
                $user->request_id = $req->id;
                if ($user->save()) {
                    $auth->directLogin($user->id, false);
                    $request->show(json_encode([
                        "result" => "OK",
                        "user_id" => $user->id
                    ]));

                    $call = new PhoneCallModel();
                    $call->phone = $user->phone;
                    $call->call_type = PhoneCallModel::callTypes['REGISTRATION'];
                    $call->call_status = PhoneCallModel::callStatuses['NEW'];
                    $call->save();

                    $tg = new TelegramNotifyService(env('TELEGRAM_KEY'));
                    $site_url = env("url");
                    $tg->send(env("TELEGRAM_USERS_ACTIONS_CHAT"), "Новая регистрация\n{$user->name} ID{$user->id}"
                        . "\nНомер: +{$user->phone}\nОбъект-источник: https://$site_url/id/{$reqInfo->id}/");
                    return;
                }
            }
        } catch (\Exception $ex) {
            $tg = new TelegramNotifyService(env('TELEGRAM_KEY'));
            $tg->send(env("TELEGRAM_USERS_ACTIONS_CHAT"), var_export($ex->getMessage(), true));
        }
        $request->show(json_encode([
            "result"  => "ERROR",
            "reason"  => "Телефон или почта уже заняты"
        ]));
    }
}