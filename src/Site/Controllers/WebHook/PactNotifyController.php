<?php

namespace Site\Controllers\WebHook;

use Site\Core\HttpRequest;
use Site\Core\TelegramNotifyService;
use Site\Models\CommunicatorModel;
use Site\Models\NotifyModel;
use Site\Models\PhoneCallModel;

class PactNotifyController implements \Site\Controllers\Controller
{

    private function getMessage(string $text): string{
        $special_symbols_regex = '/[^а-яА-Яa-zA-Z\s]/';
        $text = trim(preg_replace($special_symbols_regex, ' ', strtolower($text)));
        while(strpos($text, "  ") !== false){
            $text = str_replace("  ", " ", $text);
        }
        return $text;
    }

    public function view(HttpRequest $request, $args)
    {
        /**
         * Стадии сценария
         * 0 - создано, нет событий
         * 1 - первое сообщение доставлено
         * 2 - есть ответ на сообщение \ написали первым
         */
        ini_set('display_errors', '1');ini_set('display_startup_errors', '1');error_reporting(E_ALL);

        $tg = new TelegramNotifyService(env('TELEGRAM_KEY'));
        $message = file_get_contents("php://input");
        $data = json_decode($message, true);
        switch ($data['type']){
            case "system":
                $json_beautified = str_replace(
                    array("{", "}", '","'),
                    array("{\n    ", "\n}", "\",\n    \""),
                    $message
                );
                $tg->send(env('TELEGRAM_CHAT'), $json_beautified);
                break;
            case "job":
                $notify = NotifyModel::find($data['data']['id'], "message_id");
                if(is_null($notify)){
                    usleep(500000);
                    $notify = NotifyModel::find($data['data']['id'], "message_id");
                }
                if(!is_null($notify)){
                    if($notify->user_id < 0){
                        $communication_config = CommunicatorModel::find($notify->user_id, "user_id");
                    } else {
                        $communication_config = CommunicatorModel::find($notify->address, "phone");
                    }
                    if(is_null($communication_config)) return;
                    $tg = new TelegramNotifyService(env('TELEGRAM_KEY'));

                    if($communication_config->scenario_stage == 0) {
                        if ($data['data']['result'] == "DELIVERED") {
                            $tg->send(env('TELEGRAM_CHAT'), "Сообщение доставлено клиенту +{$notify->address}");
                            $communication_config->scenario_stage = 1;
                            try {
                                $communication_config->save();
                            } catch (\Exception $e) {
                                bugReport($e);
                            }
                        } else {
                            $tg->send(env('TELEGRAM_CHAT'), "Сообщение НЕ доставлено клиенту +{$notify->address}");
                            try {
                                $call = new PhoneCallModel();
                                $call->phone = $communication_config->phone;
                                $call->call_type = PhoneCallModel::callTypes['FIRST_CONNECT'];
                                $call->call_status = PhoneCallModel::callStatuses['NEW'];
                                $call->next_attempt = 0;
                                $call->save();
                            } catch (\Exception $e) {
                                bugReport($e);
                            }
                        }
                    }
                }
                break;
            case "message":
            case "conversation":
                if($data['event']=="new"){
                    if($data['type']=="message"){
                        $communication_config = CommunicatorModel::find($data['data']['conversation_id'], "conversation_id");
                        if (is_null($communication_config)) {
                            $communication_config = CommunicatorModel::find($data['data']['external_public_id'], "phone");
                            if (is_null($communication_config)) {
                                return;
                            }
                        }
                        if((int) $communication_config->conversation_id < 0){
                            $communication_config->conversation_id = $data['data']['conversation_id'];
                            try {
                                $communication_config->save();
                            } catch (\Exception $e) {
                                bugReport($e);
                                return;
                            }
                        }
                    } else {
                        $communication_config = CommunicatorModel::find($data['data']['sender_external_id'], "phone");
                        if (is_null($communication_config)) {
                            return;
                        }
                        if((int) $communication_config->conversation_id < 0){
                            $communication_config->conversation_id = $data['data']['external_id'];
                            $communication_config->scenario = 0;
                            try {
                                $communication_config->save();
                            } catch (\Exception $e) {
                                bugReport($e);
                                return;
                            }
                        }
                    }

                    /**
                     * 0, 1 - первое сообщение
                     * 2 - ожидание звонка
                     * 3 - звонок произошел
                     */
                    $isNewMessage = false;
                    $notify = new NotifyModel();
                    $notify->user_id = -1;
                    $notify->message_id = 0;
                    $notify->address = $communication_config->conversation_id;
                    $notify->type = NotifyModel::notifyType['PACT'];
                    $notify->status = 0;

                    if ($data['type'] == "message" && $data['data']['income']) {
                        switch ($communication_config->scenario_stage) {
                            case 0:
                            case 1:
                                $link_notify = NotifyModel::select([["address", getPhone($data['data']['external_public_id'])], ["object_id", [-1, ">"]]], [["id", "desc"]], 1)[0];

                                $notify->text = str_replace("[URL]", "https://take-keys.ru/", MESSENGER_SCENARIOS[1]);
                                if(!is_null($link_notify))
                                    $notify->text = str_replace("[URL]", "https://take-keys.ru/id/$link_notify->object_id", MESSENGER_SCENARIOS[1]);

                                $communication_config->scenario_stage = 2;
                                $isNewMessage = true;
                            break;
                        }
                    }

                    if($isNewMessage) {
                        try {
                            $notify->save();
                            $communication_config->save();
                        } catch (\Exception $e) {
                            var_dump($e);
                            bugReport($e);
                            return;
                        }
                    }
                }
            break;
        }
    }
}