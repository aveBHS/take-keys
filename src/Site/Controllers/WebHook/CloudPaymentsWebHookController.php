<?php

namespace Site\Controllers\WebHook;

use Site\Controllers\Exceptions\BadRequestController;
use Site\Core\HttpRequest;
use Site\Models\RequestModel;
use Site\Models\UserModel;

class CloudPaymentsWebHookController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        $req = RequestModel::find($request->post("email"), "email");
        if(!is_null($req)){
            $req->purchased = 1;
            try{
                return $req->save();
            } catch (\Exception $exception) {
                $request->show($exception->getMessage());
            }
        } else {
            $request->returnException(new BadRequestController(), 400);
        }
        return null;
    }
}