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
        $tg = new TelegramNotifyService(env('TELEGRAM_KEY'));
        try {
            $request->setHeader("Content-Type", "application/json");
            $request->show('{"code":0}');

            $amount = (int)$request->post('PaymentAmount');
            if ($amount != (int)env("first_payment_amount_sale") && $amount != (int)env("first_payment_amount") || $request->post("Status") != "Completed") {
                $tg->send(env("TELEGRAM_USERS_ACTIONS_CHAT"), "Оплата на подмененную сумму - {$request->post('PaymentAmount')} руб, платеж отклонен, ID{$request->post('AccountId')}\nТокен: {$request->post('Token')}");
            } else {
                $user = UserModel::find($request->post('AccountId'));
                if (!is_null($user)) {
                    $req = RequestModel::find($user->request_id);
                    if (!is_null($req)) {
                        $req->purchased = 1;

                        $payment = PaymentModel::find($user->id, "user_id");
                        $payment_exists = true;
                        if (is_null($payment)) {
                            $payment_exists = false;
                            $req->purchased = 0;
                            $payment = new PaymentModel();
                            $payment->user_id = $user->id;
                            $payment->amount = env("recurrent_payment_amount");
                            $payment->next_attempt = -1;
                        }
                        $payment->status = PaymentModel::STATUSES['READY'];
                        $payment->token = $request->post("Token");

                        try {
                            $payment->save();
                            $req->save();

                            $notify = new NotifyModel();
                            $notify->user_id = $user->id;
                            $notify->type = NotifyModel::notifyType['SMS'];
                            $notify->text = view("notify.payment");
                            $notify->status = 0;
                            if (!$payment_exists)
                                $notify->text = view("notify.payment_bad");
                            $notify->save();

                            if (!$payment_exists)
                                $tg->send(env("TELEGRAM_USERS_ACTIONS_CHAT"), "Внимание, нарушение процесса подключения, дата платежа не указана, свяжитесь с клиентом ID{$user->id}");
                            else {
                                $checkout_date = date("d.m.Y H:i", $payment->next_attempt);
                                $tg->send(env("TELEGRAM_USERS_ACTIONS_CHAT"), "Успешная оплата ID{$user->id}\nСумма списания: {$payment->amount}\nДата списания: {$checkout_date}");
                            }
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
        } catch (\Exception $exception){
            $tg->send(env("TELEGRAM_USERS_ACTIONS_CHAT"), "Внимание! Ошибка оплаты @pavelkdtr");
            bugReport($exception);
        }
    }
}