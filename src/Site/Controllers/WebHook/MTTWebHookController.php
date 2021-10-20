<?php

namespace Site\Controllers\WebHook;

use Site\Core\HttpRequest;

class MTTWebHookController implements \Site\Controllers\Controller
{

    public function view(HttpRequest $request, $args)
    {
        file_put_contents("mtt_post.txt", var_export($request->post(), true));
        file_put_contents("mtt_get.txt", var_export($request->get(), true));
        file_put_contents("mtt_json.txt", var_export($request->json(), true));
    }
}