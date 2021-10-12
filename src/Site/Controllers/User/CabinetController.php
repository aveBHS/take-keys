<?php

namespace Site\Controllers\User;

use Site\Core\HttpRequest;
use Site\Models\RequestModel;

class CabinetController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        global $auth;
        $requestModel = RequestModel::find($auth()->request_id);
        if(is_null($requestModel)){
            $auth->logout();
            $request->redirect("/login");
        }
        $request->show(view("cabinet.index", ["request" => $requestModel]));
    }

    public function disableRecommendations(HttpRequest $request, $args)
    {
        global $auth;
        $requestModel = RequestModel::find($auth()->request_id);
        if($request->getMethod() == "POST"){
            if(!is_null($requestModel)){
                if ($requestModel->status == 0)
                    $requestModel->status = 4;
                else if($requestModel->status == 4 || $requestModel->status == 5)
                    $requestModel->status = 0;
                else return null;
                try{
                    $requestModel->save();
                } catch (\Exception $ex){
                    return null;
                }
            }
        }
    }
}