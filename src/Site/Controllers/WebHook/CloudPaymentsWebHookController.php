<?php

namespace Site\Controllers\WebHook;

use Site\Controllers\Exceptions\BadRequestController;
use Site\Core\HttpRequest;
use Site\Core\TelegramNotifyService;
use Site\Models\NotifyModel;
use Site\Models\PaymentModel;
use Site\Models\RequestModel;
use Site\Models\UserModel;

class CloudPaymentsWebHookController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        $request->setHeader("Content-Type", "application/json");
        $request->show('{"code":0}');

        $tg = new TelegramNotifyService(env('TELEGRAM_KEY'));
        $user = UserModel::find($request->post('AccountId'));
        if(!is_null($user)){
            $req = RequestModel::find($user->request_id);
            if(!is_null($req)){
                $req->purchased = 1;

                $payment = PaymentModel::find($user->id, "user_id");
                $payment_exists = true;
                if(is_null($payment)){
                    $payment_exists = false;
                    $req->purchased = 0;
                    $payment = new PaymentModel();
                    $payment->user_id = $user->id;
                    $payment->amount = env("recurrent_payment_amount");
                    $payment->next_attempt = -1;
                }
                $payment->token = $request->post("Token");

                try{
                    $payment->save();
                    $req->save();

                    $notify = new NotifyModel();
                    $notify->user_id = $user->id;
                    $notify->type = NotifyModel::notifyType['SMS'];
                    $notify->text = view("notify.payment");
                    $notify->status = 0;
                    if(!$payment_exists)
                        $notify->text = view("notify.payment_bad");
                    $notify->save();

                    $tg->send(env("TELEGRAM_USERS_ACTIONS_CHAT"), "Успешная оплата ID{$user->id}");
                    if(!$payment_exists)
                        $tg->send(env("TELEGRAM_USERS_ACTIONS_CHAT"), "Внимание, нарушение процесса подключения, дата платежа не указана, свяжитесь с клиентом ID{$user->id}");
                } catch (\Exception $exception) {
                    bugReport($exception);
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