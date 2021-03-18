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
         'client_id' =>'680178716228617', // client face 
         'client_secret' =>'b72767105f670f6337786ac9026f9fc5', // client app service 
         'redirect' => 'http://localhost/shopbanhanglaravel/admin/callback' //callback trả về
    ],
    'google' => [
        'client_id' => '1030049687460-5cnln4firseoojq5jjl9u15dudbj0plk.apps.googleusercontent.com',
        'client_secret' => 'qLuGki4XGotBPOJoRAKwT9E-',
        'redirect' => 'http://localhost/shopbanhanglaravel/google/callback' 
    ],


];
