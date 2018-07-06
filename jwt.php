<?php

function token()
{
    $key = 'berk_gulp';

    $header = [
        'typ' => 'JWT',
        'alg' => 'HS256',
    ];

    $header = json_encode($header);
    $header = base64_encode($header);

    $payload = [
        'Username' => 'Kerim',
        'Password' => '55468579',
    ];

    $payload = json_encode($payload);
    $payload = base64_encode($payload);

    $signature = hash_hmac('sha256', $header . $payload, $key);
    $signature = base64_encode($signature);

    return "$header.$payload.$signature";
}

echo token();
