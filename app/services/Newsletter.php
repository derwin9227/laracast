<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use MailchimpMarketing\ApiClient;

class Newsletter
{
    public function subscribe (String $email, string $list = null){
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client()->lists->addListMember($list, [
            "email_address" => $email,
            "status" => "subscribed",
        ]);
    }//subscribe

    protected function client(){

        return (new ApiClient)->setConfig([
            'apiKey' => config('services.mailchimp.key'),
            'server' => 'us20'
        ]);
    }//client
}