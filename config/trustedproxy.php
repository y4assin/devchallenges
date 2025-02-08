<?php

use Illuminate\Http\Request;

return [
    'proxies' => '*', // 🔥 Permite que Laravel detecte cualquier proxy
    'headers' => Request::HEADER_FORWARDED | Request::HEADER_X_FORWARDED_FOR | 
                 Request::HEADER_X_FORWARDED_HOST | Request::HEADER_X_FORWARDED_PORT | 
                 Request::HEADER_X_FORWARDED_PROTO,
];
