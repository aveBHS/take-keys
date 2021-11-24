<?php

namespace Site\Controllers\User;

use Site\Core\HttpRequest;
use Site\Models\LogModel;
use Site\Models\RequestModel;

class CabinetController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        $request->redirect("/catalog/recommendations");
    }

    public function report(HttpRequest $request, $args)
    {
        global $auth;
        $logs = LogModel::select([["user_id", $auth()->id]]);
        $request->show(view("cabinet.report", ['logs' => $logs]));
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