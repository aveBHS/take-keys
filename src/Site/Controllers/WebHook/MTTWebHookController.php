<?php

namespace Site\Controllers\WebHook;

use Site\Core\HttpRequest;
use Site\Models\NotifyModel;
use Site\Models\PhoneCallModel;

class MTTWebHookController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        $time = time();
        file_put_contents("./logs/mtt/mtt_json_$time.txt", var_export($request->json(), true));

        if($request->json("event") == "h"){
            $call = PhoneCallModel::find($request->json("callId"), "call_id");
            if(!is_null($call)){
                $call->call_status = $request->json("status") == "active" ?
                    PhoneCallModel::callStatuses["SUCCESS"] : PhoneCallModel::callStatuses["FAIL"];
                try {
                    $call->save();
                } catch (\Exception $e) {
                    $request->show($e->getMessage());
                }
            }
        } else if($request->json("event") == "callAds"){
            $notify = NotifyModel::find($request->json("phone"), "address");
            if($request->json("result") == 1){
                $notify->status = 0;
                try {
                    $notify->save();
                } catch (\Exception $e) {
                    bugReport($e);
                }
            } else {
                $notify->remove();
            }
        }
    }
}