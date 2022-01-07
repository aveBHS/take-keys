<?php

namespace Site\Controllers\User;

use DateTime;
use Site\Core\HttpRequest;
use Site\Core\TelegramNotifyService;
use Site\Models\ObjectTypeModel;
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
                userLog("Установка предполагаемой даты заселения",
                    "Дата установлена на {$request->post('date')}");
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

    public function setFilter(HttpRequest $request, $args)
    {
        $request->setHeader("Content-Type", "application/json");

        if(
            filter("\d+\;\d+", $request->post("filter-price")) &&
            filter("\d+(\.\d+)?", $request->post("filter-radius")) &&
            filter("\d+(\.\d+)?", $request->post("geo_lon")) &&
            filter("\d+(\.\d+)?", $request->post("geo_lat")) &&
            in_array((int) $request->post("filter-actuality"), DATE_FILTER_HOURS) &&
            strlen($request->post("filter-object-type")) > 0 &&
            strlen($request->post("filter-address")) > 0)
        {
            $object_type = ObjectTypeModel::find($request->post("filter-object-type"), "object_type_slug");
            if(!is_null($object_type)) {
                global $auth;
                $req = $auth()->request;

                $req->price_min = (int)explode(";", $request->post("filter-price"))[0];
                $req->price_max = (int)explode(";", $request->post("filter-price"))[1];
                $req->distance = (int)(((float) $request->post("filter-radius") * 1000));

                $req->address = $request->post("filter-address");
                $req->lat = (float)$request->post("geo_lat");
                $req->lng = (float)$request->post("geo_lon");
                $req->actual_filter = (int) $request->post("filter-actuality");

                $req->recommendations = "";
                $req->object_type = $object_type->object_type_id;

                try {
                    $req->save();
                    userLog("Изменение настроек подбора",
                        "Адрес: {$req->address} ({$req->lat}; {$req->lng})\nРадиус: {$req->distance} м\n" .
                        "Тип объекта: {$object_type->object_type_slug}\nЦена: {$req->price_min} руб - {$req->price_max} руб");
                    $request->show(json_encode([
                        "result" => "OK"
                    ]));
                } catch (\Exception $exception) {
                    var_dump($exception);
                    bugReport($exception);
                    $request->show(json_encode([
                        "result" => "ERROR",
                        "reason" => "Произошла ошибка, мы уже знаем о ней и скоро все исправим, пожалуйста, попробуйте позднее"
                    ]));
                }
            } else {
                $request->show(json_encode([
                    "result" => "ERROR",
                    "reason" => "Форма заполнена некорректно, пожалуйста, обновите страницу"
                ]));
            }
        } else {
            $request->show(json_encode([
                "result" => "ERROR",
                "reason" => "Форма заполнена некорректно, проверьте заполнение полей"
            ]));
        }
    }
}