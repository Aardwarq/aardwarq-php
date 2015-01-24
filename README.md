# Aardwarq PHP library

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

This is the PHP API client for [Aardwarq.com](http://aardwarq.com).

## Usage

``` php
// Configure Aardwarq API Client
$provider = new Aardwarq\Api\OAuth2Provider([
    'clientId'     => 'CLIENT_ID',
    'clientSecret' => 'CLIENT_SECRET',
    'redirectUri'  => 'http://aardwarq.com/'
]);

$token = $provider->getAccessToken('clientCredentials');
$api = new Aardwarq\Api\Client($token->accessToken);

// You can set defaults for every event
\Aardwarq\Api\Event\Event::setDefaults([
    'context' => 'CLI', // 
    'environment' => 'development',
    'version' => 'v0.1.1', // Version of your app
]);

// Register exception handler
set_exception_handler(function (\Exception $exception) use ($api) {
    echo 'Handling!';
    $apiException = new \Aardwarq\Api\Event\Exception();
    $apiException
        ->setMessage($exception->getMessage())
        ->setStackTrace($exception->getTrace())
    ;

    $result = $api->send($apiException);
});

```

## Credits

- [Marin Crnković](https://github.com/anorgan)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
