<?php

return [

    /*
    |--------------------------------------------------------------------------
    | SAAS Configuration
    |--------------------------------------------------------------------------
    */

    'demo' => env('DEMO_MODE', false),
    'bap_saas_secret' => env('BAP_SAAS_KEY', ''),
    'api_url' => env('APPLICATION_REST_API', null),
    'application_url' => env('APPLICATION_URL'),

    'payment_gateway' => env('PAYMENT_GATEWAY', 'stripe'), // braintree,stripe
    'enable_two_factor' =>  env('ENABLE_TWO_FACTOR', true),

    'currency' => 'usd',
    'currency_symbol' => '$',

    'account_activation' => env('ACCOUNT_ACTIVATION', false), // Allow users to register without account activation

    'languages' => [
        'en' => 'English',
    ],

    'stripe' => [
        'name' => env('APP_NAME', ''),
        'description' => env('SAAS_PAYMENT_DESC', 'Membership'),
        'currency' => env('SAASK_PAYMENT_CURRENCY', 'USD'),
    ],

    'braintree_invoice' => [
      'product' => 'CRM Subscription',
      'vendor' => 'Headquarters 1120 N Street Sacramento 916-654-5266'
    ],
];
