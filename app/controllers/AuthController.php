<?php

use OAuth\Common\Exception\Exception;

class AuthController extends BaseController {

    const METHOD_BASIC      =   'basic';
    const METHOD_FACEBOOK   =   'facebook';
    const METHOD_TWITTER    =   'twitter';
    const METHOD_GOOGLE     =   'google';
    const METHOD_LINKEDIN   =   'linkedin';

    protected $layout = 'layouts.main';

    private static $_availableAuthMethods = array(
        self::METHOD_BASIC,
        self::METHOD_FACEBOOK,
        self::METHOD_TWITTER,
        self::METHOD_GOOGLE,
        self::METHOD_LINKEDIN
    );

    /**
     * Displays the login form or redirects to
     * social network handler.
     *
     * @param $method
     *
     * @return mixed
     **/
    public function userLogin($method)
    {
        if (!in_array($method, self::$_availableAuthMethods)) {
            return Redirect::to('/');
        }

        switch ($method) {

            case self::METHOD_BASIC:
                return View::make('auth.login-' . $method);

            case self::METHOD_FACEBOOK:
                return $this->facebookUserLoginHandler();

            case self::METHOD_TWITTER:
                return $this->twitterUserLoginHandler();

            case self::METHOD_GOOGLE:
                return $this->googleUserLoginHandler();

            case self::METHOD_LINKEDIN:
                return $this->linkedinUserLoginHandler();
        }
    }

    /**
     * Handles all login requests (POST)
     *
     * @param $method
     *
     * @return mixed
     **/
    public function userLoginHandler($method)
    {
        if (!in_array($method, self::$_availableAuthMethods)) {
            return Redirect::to('/');
        }

        switch ($method) {

            case self::METHOD_BASIC:
                return $this->basicUserLoginHandler();

            case self::METHOD_FACEBOOK:
                return $this->facebookUserLoginHandler();

            case self::METHOD_TWITTER:
                return $this->twitterUserLoginHandler();

            case self::METHOD_GOOGLE:
                return $this->googleUserLoginHandler();

            case self::METHOD_LINKEDIN:
                return $this->linkedinUserLoginHandler();
        }
    }

    /**
     * Handles the basic user login via email & password
     *
     * GET /auth/basic/login
     * + email
     * + password
     *
     * @return Illuminate\Support\Facades\Response
     **/
    public function basicUserLoginHandler()
    {
        $validator = Validator::make(
            Input::all(),
            array(
                'email'     =>  array('required', 'email'),
                'password'  =>  array('required', 'min:6')
            )
        );

        if ($validator->fails()) {
            return $this->failure(array(
                'error' => Error::create(
                    Error::INVALID_INPUT,
                    $validator->messages()
                )
            ));
        }

        $data = $validator->getData();

        $user = User::where('email', $data['email'])->get();

        if ($user->count()) {

            $user = $user->first();

            if (Hash::check($data['password'], $user->password)) {

                if ($this->_authorizeUser($user)) {
                    return $this->success();
                }
            }
        }

        return $this->failure();
    }

    /**
     * Handles Facebook's login/register
     *
     * @returns Illuminate\Support\Facades\Redirect
     **/
    public function facebookUserLoginHandler()
    {
        $facebook = new \Social\Facebook();

        if (Input::has('code')) {

            $facebook->requestAccessToken(Input::get('code'));

            if (Auth::check()) {

                Auth::user()->assignAccount($facebook);

            } else {

                $user = $facebook->authorizeUser();

                if (!$this->_authorizeUser($user)) {
                    return \Redirect::to('/');
                }
            }

            return Redirect::to('/account');

        } else {

            $facebook->clearUser();

            return Redirect::to($facebook->getAuthorizationUrl());
        }
    }

    /**
     * Handles Twitter's login/register
     *
     * @returns Illuminate\Support\Facades\Redirect
     **/
    public function twitterUserLoginHandler()
    {
        $twitter = new \Social\Twitter();

        if (Input::has('oauth_token') && Input::has('oauth_verifier')) {

            $twitter->requestAccessToken(
                Input::get('oauth_token'),
                Input::get('oauth_verifier')
            );

            if (Auth::check()) {

                Auth::user()->assignAccount($twitter);

            } else {

                $user = $twitter->authorizeUser();

                if (!$this->_authorizeUser($user)) {
                    return \Redirect::to('/');
                }
            }

            return Redirect::to('/account');

        } else {

            $twitter->clearUser();

            return Redirect::to($twitter->getAuthorizationUrl());
        }
    }

    /**
     * Handles Google's login/register
     *
     * @returns Illuminate\Support\Facades\Redirect
     **/
    public function googleUserLoginHandler()
    {
        $google = new \Social\Google();

        if (Input::has('code')) {

            $google->requestAccessToken(Input::get('code'));

            if (Auth::check()) {

                Auth::user()->assignAccount($google);

            } else {

                $user = $google->authorizeUser(Input::get('code'));

                if (!$this->_authorizeUser($user)) {
                    return \Redirect::to('/');
                }
            }

            return Redirect::to('/account');

        } else {

            $google->clearUser();

            return Redirect::to($google->getAuthorizationUrl());
        }
    }

    /**
     * Handles LinkedIn's login/register
     *
     * @returns Illuminate\Support\Facades\Redirect
     **/
    public function linkedinUserLoginHandler()
    {
        $linkedIn = new \Social\LinkedIn();

        if (Input::has('code')) {

            $linkedIn->requestAccessToken(Input::get('code'));

            if (Auth::check()) {

                Auth::user()->assignAccount($linkedIn);

            } else {

                $user = $linkedIn->authorizeUser(Input::get('code'));

                if (!$this->_authorizeUser($user)) {
                    return \Redirect::to('/');
                }
            }

            return Redirect::to('/account');

        } else {

            $linkedIn->clearUser();

            return Redirect::to($linkedIn->getAuthorizationUrl());
        }
    }

    /**
     * Displays the registration form of method
     *
     * This methods calls only for basic method
     *
     * @param $method
     *
     * @return Illuminate\Support\Facades\View
     **/
    public function userRegister($method)
    {
        if (!in_array($method, self::$_availableAuthMethods)) {
            return Redirect::to('/');
        }

        return View::make('auth.register-basic');
    }

    /**
     * Handles registration requests (POST)
     *
     * @param $method
     *
     * @return Illuminate\Support\Facades\Response
     **/
    public function userRegisterHandler($method)
    {
        switch ($method) {

            case self::METHOD_BASIC:
                return $this->basicUserRegisterHandler();
        }
    }

    /**
     * User's registration using basic way
     *
     * GET /auth/basic/register
     * + firstname
     * + lastname
     * + dob
     * + email
     * + password
     *
     * @return Illuminate\Support\Facades\Response
     **/
    public function basicUserRegisterHandler()
    {
        $validator = Validator::make(
            Input::all(),
            array(
                'firstname' =>  array('required'),
                'lastname'  =>  array('required'),
                'dob'       =>  array('required', 'date'),
                'email'     =>  array('required', 'email', 'unique:users'),
                'password'  =>  array('required', 'min:6')
            )
        );

        if ($validator->fails()) {
            return $this->failure(array(
                'error' => Error::create(
                    Error::INVALID_INPUT,
                    $validator->messages()
                )
            ));
        }

        $data = $validator->getData();
        $data['password'] = Hash::make($data['password']);

        $user = \User::create(array(
            'email'     =>  $data['email'],
            'password'  =>  $data['password'],
            'activated' =>  false
        ));

        $verifyToken  = $user->userid;
        $verifyToken .= '|' . Hash::make(
            $data['password'] . \User::VERIFY_ACCOUNT_SALT);
        $verifyToken .= '|' . \Carbon\Carbon::now();

        $verifyToken = Crypt::encrypt($verifyToken);

        $userEmail   = $data['email'];

        Mail::send(
            'emails.auth.verify',
            array(
                'token'     => $verifyToken,
                'username'  => $data['firstname'] . ' ' . $data['lastname']
            ),
            function($message) use ($userEmail) {
                $message->subject('Verify account');
                $message->to($userEmail);
            });

        unset($data['email']);
        unset($data['password']);

        foreach ($data as $field => $value) {
            $user->{$field} = $value;
        }

        $user->save();

        if ($user == null) {
            return $this->failure();
        }

        return $this->success();
    }

    /**
     * Logout the user
     *
     * @return Illuminate\Support\Facades\Redirect
     **/
    public function userLogout()
    {
        Auth::logout();

        return Redirect::to('/');
    }

    /**
     * Login an user
     *
     * @param $user
     *
     * @return mixed
     **/
    private function _authorizeUser(\User $user)
    {
        if ($user->role == \User::ROLE_USER && $user->activated == false) {
            return false;
        }

        foreach (\Surrogate::getAvailableUnlockTypes() as $unlock) {

            $key = \Surrogate::class . '-' . $unlock;

            Session::set($key, $user->surrogate($unlock)->first()->key);
        }

        Auth::login($user);

        return true;
    }

    /**
     * Assigns new social account for the existed user
     *
     * @param $method
     *
     * @return Illuminate\Support\Facades\Redirect
     **/
    public function assignSocialAccount($method)
    {
        if (!in_array($method, self::$_availableAuthMethods)) {
            return Redirect::to('/');
        }

        if ($method == self::METHOD_BASIC) {
            return Redirect::to('/');
        }

        return Redirect::to('/auth/' . $method . '/login');
    }


    /**
     * Display the password reminder view.
     *
     * @return Illuminate\Support\Facades\View
     */
    public function passwordRemind()
    {
        return View::make('auth.password-remind');
    }

    /**
     * Handle password reminder request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function passwordRemindHandler()
    {
        $validator = Validator::make(
            Input::only('email'),
            array(
                'email' =>  array('required', 'email', 'exists:users,email')
            )
        );

        if ($validator->fails()) {
            return $this->failure(array(
                'error' => Error::create(
                    Error::INVALID_INPUT,
                    $validator->messages()
                )
            ));
        }

        $data = $validator->getData();

        $user = User::where('email', $data['email'])->first();

        $user->passwordRemind();

        return $this->success();
    }

    /**
     * Display the password reset view.
     *
     * @return Illuminate\Support\Facades\View
     */
    public function passwordReset($token = null)
    {
        if (is_null($token)) {
            App::abort(404);
        }

        return View::make('auth.password-reset')->with('token', $token);
    }

    /**
     * Handle password reset request
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function passwordResetHandler()
    {
        $credentials = Input::only(
            'password', 'password_confirmation', 'token'
        );

        $validator = Validator::make(
            $credentials,
            array(
                'password'              =>  array('required', 'min:6'),
                'password_confirmation' =>  array('required', 'min:6', 'same:password'),
                'token'                 =>  array('required')
            )
        );

        if ($validator->fails()) {
            return $this->failure(array(
                'error' => Error::create(
                    Error::INVALID_INPUT,
                    $validator->messages()
                )
            ));
        }

        $data = $validator->getData();
        $passwordRemind = null;

        try {

            $passwordRemind = explode('|', Crypt::decrypt($data['token']));

            if (count($passwordRemind) != 3) {
                throw new Exception('Invalid token');
            }

            $expiredDate = \Carbon\Carbon::parse(array_pop($passwordRemind));

            if ($expiredDate->lt(\Carbon\Carbon::now())) {
                throw new Exception('Invalid token');
            }

            $userid = array_shift($passwordRemind);
            $hashedPassword = array_shift($passwordRemind);

            $user = \User::find($userid);

            if (!Hash::check($user->password . \User::REMIND_PASSWORD_SALT, $hashedPassword)) {
                throw new Exception('Invalid token');
            }

            $user->is_activated = true;
            $user->save();

        } catch (Exception $e) {

            return $this->failure(array(
                'error' => \Error::create(
                    \Error::INVALID_INPUT,
                    'Invalid token'
                )
            ));
        }

        return $this->success();
    }

    /**
     * Handle account verification
     *
     * @param $token
     *
     * @return Illuminate\Support\Facades\Response
     */
    public function verifyHandler($token)
    {
        $verify  = null;

        try {

            $verify = explode('|', Crypt::decrypt($token));
            if (count($verify) != 3) {
                throw new Exception('Invalid token');
            }

            $userid = array_shift($verify);
            $hashedPassword = array_shift($verify);

            $user = \User::find($userid);

            if (!Hash::check($user->password . \User::VERIFY_ACCOUNT_SALT, $hashedPassword)) {
                throw new Exception('Invalid token');
            }

            $user->activated = true;
            $user->save();

        } catch (Exception $e) {

            return $this->failure(array(
                'error' => \Error::create(
                    \Error::INVALID_INPUT,
                    'Invalid token'
                )
            ));
        }

        return $this->success();
    }
}
