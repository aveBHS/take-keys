<?php

namespace Site\Controllers\User;

use DateTime;
use Site\Core\HttpRequest;
use Site\Core\TelegramNotifyService;
use Site\Models\PaymentModel;

class UserSettingsController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        // TODO: Implement view() method.
    }

    public function setPaymentDate(HttpRequest $request, $args)
    {
        $request->setHeader("Content-Type", "application/json");
        $tg = new TelegramNotifyService(env("telegram_key"));

        $date = DateTime::createFromFormat("Y-m-d H:i:s", $request->post("date")." 06:00:00")->getTimestamp();
        $current_date = DateTime::createFromFormat("Y-m-d H:i:s", date("Y-m-d")." 06:00:00");
        $current_date = $current_date->getTimestamp();

        $next_day = DateTime::createFromFormat("Y-m-d H:i:s", date("Y-m-d")." 06:00:00");
        $next_day->modify("+1 day");
        $next_day = $next_day->getTimestamp();

        $next_month = DateTime::createFromFormat("Y-m-d H:i:s", date("Y-m-d")." 06:00:00");
        $next_month->modify("+1 month");
        $next_month = $next_month->getTimestamp();

        if(!is_null($date) && !($date < $current_date) && !($date > $next_month)){
            global $auth;

            $payment = PaymentModel::find($auth()->id, "user_id");
            if(!is_null($payment)){
                if(!empty($payment->token)){
                    $request->show(json_encode([
                        "result" => "already_created"
                    ]));
                    return;
                }
            } else {
                $payment = new PaymentModel();
            }
            $payment->user_id = $auth()->id;
            $payment->amount = env("recurrent_payment_amount") ?? -1;
            $payment->next_attempt = $date;
            $payment->status = PaymentModel::STATUSES["WAIT_FIRST"];
            if($payment->next_attempt == $current_date){
                $payment->next_attempt += 24 * 60 * 60;
            } else if($payment->next_attempt == $next_day){
                $payment->next_attempt += 6 * 60 * 60;
            }
            if($payment->amount < 0){
                $tg->send(env("telegram_chat"), "Внимание! Сумма рекуррентного платежа не установлена!");
                $request->show(json_encode([
                    "result" => "system_error"
                ]));
                return;
            }

            try {
                $payment->save();
                $request->show(json_encode([
                    "result" => "ok"
                ]));
            } catch (\Exception $e) {
                $tg->send(env("telegram_chat"), "Ошибка создания рекуррентного платежа:\n".$e->getMessage());
                $request->show(json_encode([
                    "result" => "system_error"
                ]));
            }
        } else {
            $request->show(json_encode([
                "result" => "incorrect_date"
            ]));
        }
    }
}