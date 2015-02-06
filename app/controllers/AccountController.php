<?php

use Illuminate\Support\Facades\View;

class AccountController extends BaseController {

    protected $layout = 'layouts.main';

    /**
     * The methods returns two types of response
     * 1. If the request is XmlHttpRequest returns JSON
     * 2. If the request isn't XmlHttpRequest returns HTML
     *
     * @return mixed
     **/
    public function getProfile()
    {
        $user = Auth::user();

        $formData = array();

        foreach ($user->getFillable() as $field) {
            $formData[$field] = $user->{$field};
        }

        // Convert date of format
        if ($formData['dob'] != null) {
            $formData['dob'] = $formData['dob']->format('Y-m-d');
        }

        if (Request::ajax()) {
            return $this->success(array(
                'account' => $formData
            ));
        } else {
            return View::make(
                'account.profile',
                array(
                    'user'  =>  $formData
                )
            );
        }
    }

    /**
     * Update user's information
     * PUT /account
     *
     * @return Illuminate\Support\Facades\Redirect
     **/
    public function updateProfile()
    {
        $user = Auth::user();

        $validateRules = array(
            'firstname' =>  array(),
            'lastname'  =>  array(),
            'address'   =>  array(),
            'gender'    =>  array('in:male,female,other'),
            'dob'       =>  array('date'),
            'email'     =>  array('required_with:password', 'email'),
            'password'  =>  array('required_with:email', 'min:6')
        );

        // If there is an email in request & it's different that user's one
        // we need to add a unique validation rule for email's field
        if (Input::has('email') && Input::get('email') != $user->email) {
            $validateRules['email'][] = 'unique:users';
        }

        $validator = Validator::make(Input::all(), $validateRules);

        if ($validator->fails()) {
            return $this->failure(array(
                'error' => Error::create(
                    Error::INVALID_INPUT,
                    $validator->messages())
            ));
        }

        $data = $validator->getData();

        // If there is a `password` we need to hash it
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        // Delete `social` from data by security reasons
        if (isset($data['social'])) {
            unset($data['social']);
        }

        // Update the user
        foreach ($user->getFillable()  as $field) {
            if (isset($data[$field])) {
                $user->{$field} = $data[$field];
            }
        }

        $user->save();

        return $this->success();
    }
}
