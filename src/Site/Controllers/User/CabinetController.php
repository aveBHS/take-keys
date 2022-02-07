<?php

namespace Site\Controllers\User;

use DateTime;
use Site\Core\HttpRequest;
use Site\Models\CallResultModel;
use Site\Models\LogModel;
use Site\Models\NotifyCustomModel;
use Site\Models\ObjectCallModel;
use Site\Models\ObjectModel;
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

    public function notifications(HttpRequest $request, $args)
    {
        global $auth;
        $notifies = CallResultModel::select([["owner_id", $auth()->id]], [["id", "desc"]]);
        for($i = 0; $i < count($notifies ?? []); $i++){
            $notifies[$i]->object = ObjectModel::find($notifies[$i]->object_id);
            $notifies[$i]->result = ObjectCallModel::find($notifies[$i]->call_id);
            $notifies[$i]->type = "call";
            $d = DateTime::createFromFormat('Y-m-d H:i:s', $notifies[$i]->created_at);
            $notifies[$i]->time = $d->getTimestamp();;
        }
        $custom_notifies = NotifyCustomModel::select([["owner_id", $auth()->id], ["show_at", [time(), "<="]]], [["show_at", "desc"]]);
        for($i = 0; $i < count($custom_notifies ?? []); $i++){
            $custom_notifies[$i]->type = "custom";
            $d = DateTime::createFromFormat('Y-m-d H:i:s', $custom_notifies[$i]->created_at);
            $custom_notifies[$i]->time = empty($custom_notifies[$i]->show_at) ? $d->getTimestamp() : $custom_notifies[$i]->show_at;
        }
        $notifies = array_merge($notifies ?? [], $custom_notifies ?? []);
        $time_sort = array_column($notifies, 'time');
        array_multisort($time_sort, SORT_DESC, $notifies);

        $request->show(view("cabinet.notifies", ["notifies" => $notifies]));
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