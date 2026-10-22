<?php

return [
    'merchant_code' => env('DUITKU_MERCHANT_CODE', ''),
    'api_key' => env('DUITKU_API_KEY', ''),
    'env' => env('DUITKU_ENV', 'sandbox'), // 'sandbox' or 'production'
    'expiry_period' => (int) env('DUITKU_EXPIRY_PERIOD', 60), // in minutes

    'sandbox_url' => 'https://sandbox.duitku.com/webapi/api/merchant/v2/inquiry',
    'production_url' => 'https://passport.duitku.com/webapi/api/merchant/v2/inquiry',
];
