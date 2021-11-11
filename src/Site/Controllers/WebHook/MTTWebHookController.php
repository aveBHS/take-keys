<?php

namespace Site\Controllers\WebHook;

use Site\Core\HttpRequest;
use Site\Models\CallAdsModel;
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
            $notify = NotifyModel::select(
                [ ["address", getPhone($request->json("number"))] ],
                [ ["created", "DESC"] ],
                1
            );
            if(!is_null($notify)) {
                $notify = $notify[0];
                $call_result = CallAdsModel::select(
                    [ ["phone_from", getPhone($request->json("number"))] ],
                    [ ["created", "DESC"] ],
                    1
                )[0];
                if ($request->json("result") == 1){
                    $notify->status = 0;
                    if(!is_null($call_result)) {
                        $call_result->result = 2;
                    }
                    try {
                        $notify->save();
                    } catch (\Exception $e) {
                        bugReport($e);
                    }
                } else {
                    if(!is_null($call_result)) {
                        $call_result->result = 1;
                    }
                    $notify->remove();
                }
                if(!is_null($call_result)) {
                    $call_result->save();
                }
            } else {
                echo(getPhone($request->json("number")));
            }
        }
    }
}