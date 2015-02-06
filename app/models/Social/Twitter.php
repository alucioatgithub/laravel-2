<?php

namespace Social;


class Twitter extends ServiceAbstract {

    const SERVICE_NAME    =   'twitter';

    private $_serviceInstance;

    /**
     * Creates new instance of itself.
     * Creates instance of OAuth consumer
     *
     * @return \Social\Twitter
     **/
    public function __construct()
    {
        $this->_serviceInstance = \OAuth::consumer(ucfirst(self::SERVICE_NAME));
    }

    /**
     * Returns name of the service
     *
     * @return string
     **/
    public function getServiceName()
    {
        return self::SERVICE_NAME;
    }

    /**
     * Requests an access token
     *
     * @param $token
     * @param $verifier
     *
     * @return \Social\Twitter
     **/
    public function requestAccessToken($token, $verifier)
    {
        $this->_serviceInstance->requestAccessToken($token, $verifier);

        return $this;
    }

    /**
     * Makes authorization (and registration if user does not exits)
     *
     * @return \User
     **/
    public function authorizeUser()
    {
        return $this->_authorizeUser(
            self::SERVICE_NAME,
            $this->getAccountData()
        );
    }

    /**
     * Returns an URI for authorization the user
     * to the site
     *
     * @return string
     **/
    public function getAuthorizationUrl()
    {
        $reqToken = $this->_serviceInstance->requestRequestToken();

        return (string) $this->_serviceInstance->getAuthorizationUri(array(
            'oauth_token' => $reqToken->getRequestToken()
        ));
    }

    /**
     * Clear the access token from session if exists one
     *
     * @return \Social\Twitter
     **/
    public function clearUser()
    {
        $this->_serviceInstance->getStorage()->clearToken(
            $this->_serviceInstance->service()
        );

        return $this;
    }

    /**
     * Returns the account of user
     *
     * @return mixed
     **/
    public function getAccount()
    {
        try {

            return  json_decode($this->_serviceInstance->request('account/verify_credentials.json'), true);

        } catch (Exception $e) {

            return null;
        }
    }

    /**
     * Returns the account's data
     *
     * @return array
     **/
    public function getAccountData()
    {
        $account = $this->getAccount();

        if ($account == null) {
            return null;
        }

        $names = explode(' ', $account['name']);
        $firstName = $lastName = $names[0];

        if (isset($names[1])) {
            $lastName = $names[1];
        }

        return array(
            'userid'    =>  $account['id_str'],
            'firstname' =>  $firstName,
            'lastname'  =>  $lastName
        );
    }
}
