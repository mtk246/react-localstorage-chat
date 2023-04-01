<?php

declare(strict_types=1);

return [
    'user_name' => env('TABLEAU_USER_NAME', 'tableau'),
    'client_id' => env('TABLEAU_CLIENT_ID', ''),
    'access_key' => env('TABLEAU_ACCESS_KEY', ''),
    'access_secret' => env('TABLEAU_ACCESS_SECRET', ''),
    'token_cache_time' => 10,
];
