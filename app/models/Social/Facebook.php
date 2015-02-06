<?php

namespace Social;

class Facebook extends ServiceAbstract {

    const SERVICE_NAME    =   'facebook';

    private $_serviceInstance;

    /**
     * Creates new instance of itself.
     * Creates instance of OAuth consumer
     *
     * @return \Social\Facebook
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
     * @param $code
     *
     * @return \Social\Facebook
     **/
    public function requestAccessToken($code)
    {
        $this->_serviceInstance->requestAccessToken($code);

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
        return (string) $this->_serviceInstance->getAuthorizationUri();
    }

    /**
     * Clear the access token from session if exists one
     *
     * @return \Social\Facebook
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

            return json_decode($this->_serviceInstance->request('/me'), true);

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

        return array(
            'userid'    =>  $account['id'],
            'email'     =>  $account['email'],
            'firstname' =>  $account['first_name'],
            'lastname'  =>  $account['last_name'],
        );
    }
}
