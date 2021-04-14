<?php
require_once 'vendor/autoload.php';

$senderId = '';

$jsonUrl = 'webpush.json';

$fcmToken = '';

$client = new Google_Client();
$client->useApplicationDefaultCredentials();

$authDataJson = json_decode(file_get_contents($jsonUrl), true);

$client->setAuthConfig($authDataJson);
$client->addScope('https://www.googleapis.com/auth/firebase.messaging');
$httpClient = $client->authorize();

$data = [
    "message" => [
        "topic" => "dev",
        'data'  => [
            'title' => 'こんにちは',
            'body'  => '世界',
        ],
//        'token' => $fcmToken
    ],
];

$fcmApi = str_replace(
    'SENDER_ID',
    $senderId,
    'https://fcm.googleapis.com/v1/projects/SENDER_ID/messages:send'
);

$result = $httpClient->post($fcmApi, ['json' => $data]);
var_dump($result);
