<?php

namespace Site\Controllers\WebHook;

use Site\Controllers\Exceptions\BadRequestController;
use Site\Core\HttpRequest;
use Site\Core\TelegramNotifyService;
use Site\Models\RequestModel;
use Site\Models\UserModel;

class CloudPaymentsWebHookController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        $tg = new TelegramNotifyService(env('TELEGRAM_KEY'));
        $user = UserModel::find($request->post('AccountId'));
        if(!is_null($user)){
            $req = RequestModel::find($user->request_id);
            if(!is_null($req)){
                $req->purchased = 1;
                try{
                    $req->save();
                    $tg->send(env("TELEGRAM_USERS_ACTIONS_CHAT"), "Успешная оплата ID{$user->id}");
                } catch (\Exception $exception) {
                    $request->show($exception->getMessage());
                }
            } else {
                $tg->send(env("TELEGRAM_USERS_ACTIONS_CHAT"), "Заявка не найдена, оплата успешная, ID{$user->id}");
                $request->returnException(new BadRequestController(), 400);
            }
        } else {
            $tg->send(env("TELEGRAM_USERS_ACTIONS_CHAT"), "Аккаунт не найден, оплата успешная, ID{$request->post('AccountId')}");
            $request->returnException(new BadRequestController(), 400);
        }
        return null;
    }
}