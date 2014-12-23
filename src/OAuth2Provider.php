<?php

namespace Aardwarq\Api;

use \League\OAuth2\Client\Token\AccessToken as AccessToken;

class OAuth2Provider extends \League\OAuth2\Client\Provider\AbstractProvider
{
    const DOMAIN = 'http://aardwarq.com.dev';

    public function __construct($options)
    {
        parent::__construct($options);
        $this->headers = array(
            'Authorization' => 'Bearer'
        );
    }

    public function urlAuthorize()
    {
        return self::DOMAIN .'/';
    }

    public function urlAccessToken()
    {
        return self::DOMAIN .'/oauth/v2/token';
    }

    public function urlUserDetails(AccessToken $token) {

    }

    public function userDetails($response, AccessToken $token) {

    }

    public function userUid($response, AccessToken $token) {

    }
}