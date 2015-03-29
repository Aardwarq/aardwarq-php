<?php

namespace Aardwarq\Api;

use \League\OAuth2\Client\Token\AccessToken as AccessToken;

class OAuth2Provider extends \League\OAuth2\Client\Provider\AbstractProvider
{
    protected $domain = 'http://aardwarq.com';

    public function __construct($options)
    {
        parent::__construct($options);
        $this->headers = array(
            'Authorization' => 'Bearer'
        );
    }

    public function urlAuthorize()
    {
        return $this->domain .'/';
    }

    public function urlAccessToken()
    {
        return $this->domain .'/oauth/v2/token';
    }

    public function urlUserDetails(AccessToken $token) {

    }

    public function userDetails($response, AccessToken $token) {

    }

    public function userUid($response, AccessToken $token) {

    }
}