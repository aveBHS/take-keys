<?php

namespace Site\Controllers\WebHook;

use Site\Core\HttpRequest;
use Site\Core\TelegramNotifyService;
use Site\Models\CommunicatorModel;
use Site\Models\NotifyModel;
use Site\Models\PhoneCallModel;

class PactNotifyController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        /**
         * Стадии сценария
         * 0 - создано, нет событий
         * 1 - первое сообщение доставлено
         * 2 - есть ответ на сообщение \ написали первым
         */
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
                $notify = NotifyModel::find($data['data']['message_id'], "message_id");
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
                        } else {
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
                            $communication_config = new CommunicatorModel();
                            $communication_config->conversation_id = $data['data']['conversation_id'];
                            $communication_config->phone = "-1";
                            $communication_config->scenario_stage = 2;
                            $communication_config->scenario = 1;
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
                            $communication_config = new CommunicatorModel();
                            $communication_config->conversation_id = $data['data']['external_id'];
                            $communication_config->phone = $data['data']['sender_external_id'];
                            $communication_config->scenario_stage = 2;
                            $communication_config->scenario = 1;
                            try {
                                $communication_config->save();
                            } catch (\Exception $e) {
                                bugReport($e);
                                return;
                            }
                        }
                        if(empty($communication_config->conversation_id)){
                            $communication_config->conversation_id = $data['data']['external_id'];
                            $communication_config->scenario = 1;
                            try {
                                $communication_config->save();
                            } catch (\Exception $e) {
                                bugReport($e);
                                return;
                            }
                        }
                    }


                    if($data['type']=="conversation" || ($data['type']=="message" && $data['data']['income'])){
                        $notify = new NotifyModel();
                        $notify->user_id = -1;
                        $notify->address = -1;
                        $notify->type = NotifyModel::notifyType['PACT'];
                        $notify->text = MESSENGER_SCENARIOS[$communication_config->scenario];
                        $notify->status = 0;
                        try {
                            $notify->save();
                        } catch (\Exception $e) {
                            bugReport($e);
                            return;
                        }
                    }
                }
                break;
        }
    }
}