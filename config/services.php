<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => '751817738834943',  //client face của bạn
        'client_secret' => '63484a619c6c13b86abd75a625cd9b88',  //client app service face của bạn
        'redirect' => 'http://localhost:8080/cltech/public/admin/callback' //callback trả về
    ],

    'google' => [
        'client_id' => '110286160891-n9aths9h9kg8dnu1k703ol1hu4c4bkhs.apps.googleusercontent.com',
        'client_secret' => 'ihjgoZo9vjp3JjLO4D5GhF6y',
        'redirect' => 'http://localhost:8080/cltech/public/google/callback' 
    ],



];
