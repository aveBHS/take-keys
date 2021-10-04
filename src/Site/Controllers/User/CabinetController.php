<?php

namespace Site\Controllers\User;

use Site\Core\HttpRequest;
use Site\Models\Request;

class CabinetController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        $request->show(view("cabinet.index"));
    }

    public function disableRecommendations(HttpRequest $request, $args)
    {
        $requestId = (int) base64_decode($args[0]);
        $requestModel = Request::find($requestId);
        if($request->getMethod() == "POST"){
            if(!is_null($requestModel)){
                if ($requestModel->enabled == 0)
                    $requestModel->enabled = 0;
                else
                    $requestModel->enabled = 1;
                try{
                    $requestModel->save();
                } catch (\Exception $ex){
                    return null;
                }
            }
        }
    }
}