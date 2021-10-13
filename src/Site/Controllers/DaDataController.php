<?php

namespace Site\Controllers;

use Site\Controllers\Exceptions\BadRequestController;
use Site\Controllers\Exceptions\ForbiddenController;
use Site\Core\HttpRequest;
use Site\Models\RequestModel;
use Site\Models\UserModel;

class DaDataController implements Controller
{

    public function view(HttpRequest $request, $args)
    {
        if(is_null($request->json("query"))){
            $request->returnException(new BadRequestController(), 400);
        }

//        $req = RequestModel::find($request->json("phone"), "phone");  || is_null($request->json("phone"))
//        if(is_null($req) || $req->purchased < 1){
//            $request->returnException(new ForbiddenController(), 403);
//        }

        $request->setHeader("Content-Type", "application/json");
        $post_data = [
            "query"         => $request->json("query"),
            "lat"           => 55.752004,
            "lng"           => 37.617734,
            "radius_meters" => 600000,
            "count"         => 3
        ];
        $data_json = json_encode($post_data);

        $headers = [
            "Content-Type: application/json",
            "Authorization: Token 799c886b20a4d661a9ba93711831c43a3edc3e54",
            "X-Secret: ae8a5b16489ac23883c583fbba94810b73f0299b"
        ];

        $curl = curl_init('https://suggestions.dadata.ru/suggestions/api/4_1/rs/suggest/address');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_VERBOSE, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($curl, CURLOPT_POST, true);
        $html = curl_exec($curl);
        curl_close($curl);

        $request->show($html);
    }
}