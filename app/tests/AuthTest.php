<?php

class AuthTest extends TestCase {

    /**
     * Test user's login with basic way
     * The test checks only handler, not the response
     *
     * @return void
     **/
    public function testBasicLogin()
    {
        $userEmail = $this->_faker->email();

        $this->client->request(
            'POST',
            '/auth/basic/login',
            array(
                'email'     =>  $userEmail,
                'password'  =>  $userEmail
            )
        );

        $response = json_decode($this->client->getResponse()->getContent());

        if (!$this->client->getResponse()->isOk()) {
            $this->assertTrue(isset($response->status), 'Response has not status');
            return;
        }
    }

    /**
     * Test user's registration with basic way
     *
     * @return void
     **/
    public function testBasicRegister()
    {
        $userEmail = $this->_faker->email();

        $this->client->request(
            'POST',
            '/auth/basic/register',
            array(
                'firstname' =>  $this->_faker->firstName(),
                'lastname'  =>  $this->_faker->lastName(),
                'email'     =>  $userEmail,
                'dob'       =>  $this->_faker->date(),
                'password'  =>  $userEmail
            )
        );

        $response = json_decode($this->client->getResponse()->getContent());

        if ($this->client->getResponse()->isOk()) {
            $this->assertEquals($response->status, BaseController::SUCCESS);
            return;
        }

        if ($response->error) {
            $this->assertFalse(isset($response->error), json_encode($response->error));
            return;
        }
    }
}
