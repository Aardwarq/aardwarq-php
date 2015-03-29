<?php

require_once __DIR__ .'/../vendor/autoload.php';


use Aardwarq\Api\Client;
use Aardwarq\Api\Event\Exception as ApiException;

define('CLIENT_ID', '33_5d54sebjas08gw08o4soc4k84ook48s0ww88s0w4k80gog8og');
define('CLIENT_SECRET', '3uay0u9f0xes048kccsw0ow4kowo40swsok40kkog848skkks4');

$provider = new Aardwarq\Api\OAuth2Provider([
    'clientId'     => CLIENT_ID,
    'clientSecret' => CLIENT_SECRET,
    'redirectUri'  => 'http://aardwarq.com/'
]);

$token = $provider->getAccessToken('clientCredentials');

\Aardwarq\Api\Event\Event::setDefaults([
    'context' => 'CLI',
    'environment' => 'development',
    'version' => 'v0.1.1',
]);

$accessToken = $token->accessToken;

// Define exception handler
$api = new Client($accessToken);
set_exception_handler(function (\Exception $exception) use ($api) {
    echo 'Handling!';
    $apiException = new ApiException();
    $apiException
        ->setMessage($exception->getMessage())
        ->setStackTrace($exception->getTrace())
    ;

    $result = $api->send($apiException);
});

set_error_handler(function ($errno, $errstr, $errfile, $errline) use ($api) {
    $apiException = new ApiException();
    $apiException
        ->setMessage($errstr)
        ->setStackTrace([
            [
                'file' => $errfile,
                'line' => $errline
            ]
        ])
    ;
    $api->send($apiException);
});
