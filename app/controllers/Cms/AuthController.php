<?php

namespace Cms;

class AuthController extends \BaseController {

    protected $layout = 'layouts.cms';

    public function adminAuth()
    {
        return \View::make('cms.auth.auth');
    }

    public function adminAuthHandler()
    {


       /*     $user = new \User;
            $user->firstname = 'Manish';
            $user->lastname = 'Singh';
            $user->address = 'Kathmandu, Nepal';
            $user->dob = '2011-01-25';
            $user->gender = '1';
            $user->email = 'mgsingh@alucio.com';
            $user->password = \Hash::make('asdfasdf');
            $user->role = 'admin';         
            $user->activated = 'true';
            $user->save();*/




        $validator = \Validator::make(
            \Input::only('email', 'password'),
            array(
                'email'     =>  array('required', 'email'),
                'password'  =>  array('required', 'min:6')
            )
        );

        if ($validator->fails()) 
        {
           return \Redirect::to('/admin/auth')->withErrors($validator)->withInput();      
        } 

        $post = $validator->getData();

        if (\Auth::attempt(array('email' => $post['email'], 'password' => $post['password'], 'role' =>  \User::ROLE_ADMIN)))
        {
           return \Redirect::route('cms.index');
        }
        else
        {
            return \Redirect::to('/admin/auth')->with('message', 'Invalid Username or Password')->withInput();  

        }


      
    }
} 