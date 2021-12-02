<?php

namespace Site\Core;

require("SendPulse/ApiInterface.php");
require("SendPulse/ApiClient.php");
require("SendPulse/Storage/TokenStorageInterface.php");
require("SendPulse/Storage/FileStorage.php");
require("SendPulse/Storage/SessionStorage.php");
require("SendPulse/Storage/MemcachedStorage.php");
require("SendPulse/Storage/MemcacheStorage.php");

use Exception;

use Sendpulse\RestApi\ApiClient;
use Sendpulse\RestApi\Storage\FileStorage;

use Site\Models\RequestModel;
use Site\Models\UserModel;

class SendPulseService
{
    private $user_id;
    private $api_token;
    private $sender;

    public function __construct($user_id, $api_token, $sender){
        $this->user_id = $user_id;
        $this->api_token = $api_token;
        $this->sender = $sender;
    }

    /**
     * @throws Exception
     */
    public function createSubscriber($book_id, UserModel $user, $confirm=true){
        $SPApiClient = new ApiClient($this->user_id, $this->api_token, new FileStorage());

        $request = RequestModel::find($user->request_id);
        $subscriber = array(
            array(
                'email' => $user->login,
                'variables' => array(
                    'phone' => $request->phone,
                    'name' => $user->name,
                )
            )
        );
        if($confirm){
            $SPApiClient->addEmails($book_id, $subscriber, [
                'confirmation' => 'force',
                'sender_email' => $this->sender
            ]);
        } else {
            $SPApiClient->addEmails($book_id, $subscriber);
        }
    }
}