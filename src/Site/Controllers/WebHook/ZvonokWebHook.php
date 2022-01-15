<?php

namespace Site\Controllers\WebHook;

use Site\Core\HttpRequest;
use Site\Models\NotifyModel;
use Site\Models\NumberFunnelModel;

class ZvonokWebHook implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args) { }

    public function successful_call(HttpRequest $request, $args){
        $phone = getPhone($args[0]);
        $number_funnel = new NumberFunnelModel();
        $number_funnel->phone = $phone;
        $notify = NotifyModel::select([["address", $phone], ["status", "-1"]], [["id", "desc"]], 1)[0];
        $notify->status = 0;
        if(empty($notify->message_id)){
            $notify->message_id = -1;
        }
        if(empty($notify->address)){
            $notify->address = -1;
        }
        try {
            $notify->save();
            $number_funnel->save();
        } catch (\Exception $e) {
            bugReport($e);
        }
    }

}