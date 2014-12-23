<?php

require_once __DIR__ .'/bootstrap.php';

$api = new Aardwarq\Api\Client($accessToken);

// Counter
$counter = new \Aardwarq\Api\Event\Counter();
$counter
    ->setMessage('Count #'. uniqid())
    ->setCount(7)
    ->increment()
    ;
// Sends 8
$result = $api->send($counter);

// Timer
$timer = new Aardwarq\Api\Event\Timer();
$timer
    ->setMessage('Time it takes for the example #'. uniqid())
    ->start()
    ;
usleep(rand(500,900));
$result = $api->send($timer);

// Milestone
$milestone = new Aardwarq\Api\Event\Milestone();
$milestone
    ->setMessage('An example has been made! #'. uniqid());

$api->send($milestone);