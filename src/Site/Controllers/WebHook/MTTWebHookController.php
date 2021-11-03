<?php

namespace Site\Controllers\WebHook;

use Site\Core\HttpRequest;
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
                } catch (\Exception $e) {}
            }
        }
    }
}