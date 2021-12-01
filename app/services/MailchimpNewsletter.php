<?php

namespace App\Services;

use Illuminate\Support\Facades\App;
use MailchimpMarketing\ApiClient;

class MailchimpNewsletter implements Newsletter
{
    public function __construct(protected ApiClient $client){
        //
    }

    public function subscribe (String $email, string $list = null){
        $list ??= config('services.mailchimp.lists.subscribers');

        return $this->client->lists->addListMember($list, [
            "email_address" => $email,
            "status" => "subscribed",
        ]);
    }//subscribe
}