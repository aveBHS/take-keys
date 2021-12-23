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
        $notify = NotifyModel::find($phone, "address");
        $notify->status = 0;
        try {
            $notify->save();
            $number_funnel->save();
        } catch (\Exception $e) {
            bugReport($e);
        }
    }

}