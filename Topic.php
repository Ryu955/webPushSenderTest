<?php

var_dump(addTopic());
var_dump(deleteTopic());

function addTopic()
{
    $serverKey = '';

    $baseUrl = 'https://iid.googleapis.com/iid/v1:batchAdd';

    $token = '';
    $tokenFirefox = '';


    $data = [
        'to'                  => '/topics/dev',
        'registration_tokens' => [$token, $tokenFirefox],
        'priority'            => 'high'
    ];


    $header = [
        'Authorization: key=' . $serverKey, 'Content-Type: application/json'
    ];

    $context = stream_context_create(
        [
            'http' => [
                'method'        => 'POST',
                'header'        => implode(PHP_EOL, $header),
                'content'       => json_encode($data),
                'ignore_errors' => true
            ]
        ]
    );

    $response = file_get_contents(
        $baseUrl,
        false,
        $context
    );

    $result = json_decode($response, true);
    return $result;
}

function deleteTopic()
{
    $baseUrl = 'https://iid.googleapis.com/iid/v1:batchRemove';
    $serverKey = '';
    $tokenFirefox = '';

    $header = [
        'Authorization: key=' . $serverKey, 'Content-Type: application/json'
    ];

    $data = [
        'to'                  => '/topics/dev',
        'registration_tokens' => [$tokenFirefox]
    ];

    $context = stream_context_create(
        [
            'http' => [
                'method'        => 'POST',
                'header'        => implode(PHP_EOL, $header),
                'content'       => json_encode($data),
                'ignore_errors' => true
            ]
        ]
    );

    $response = file_get_contents(
        $baseUrl,
        false,
        $context
    );

    $result = json_decode($response, true);

    return $result;
}