<?php

namespace Site\Controllers\WebHook;

use Site\Core\HttpRequest;
use Site\Models\CommunicatorModel;
use Site\Models\NotifyModel;
use Site\Models\NumberFunnelModel;

class ZvonokWebHook implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args) { }

    public function successful_call(HttpRequest $request, $args){
        return;
        $phone = getPhone($args[0]);

        $link_notify = NotifyModel::select([["address", $phone], ["object_id", [-1, ">"]]], [["id", "desc"]], 1)[0];
        $communication_config = CommunicatorModel::find($phone, "phone");

        if(!is_null($communication_config)){
            try{
                $notify = new NotifyModel();
                $notify->user_id = -1;
                $notify->message_id = 0;
                $notify->address = $communication_config->conversation_id;
                $notify->type = NotifyModel::notifyType['PACT'];
                $notify->status = 0;
                $notify->text = str_replace("[URL]", "https://take-keys.ru/", MESSENGER_SCENARIOS[1]);
                if(!is_null($link_notify))
                    $notify->text = str_replace("[URL]", "https://take-keys.ru/id/$link_notify->object_id", MESSENGER_SCENARIOS[1]);

                $communication_config->scenario_stage = 3;

                $notify->save();
                $communication_config->save();
            } catch (\Exception $e) {
                var_dump($e);
                bugReport($e);
                return;
            }
        }
    }

}