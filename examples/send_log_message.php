<?php

require_once __DIR__ .'/bootstrap.php';

$api = new Aardwarq\Api\Client($accessToken);

$logMessage = new \Aardwarq\Api\Event\LogMessage();
$logMessage
    ->setMessage('Test from PHP API client #'. uniqid())
    ;

$result = $api->send($logMessage);
