<?php 

return array( 
	
	/*
	|--------------------------------------------------------------------------
	| oAuth Config
	|--------------------------------------------------------------------------
	*/

	'storage' => 'Session', 

	'consumers' => array(

        'Facebook' => array(
            'client_id'     => '472625166183455',
            'client_secret' => '0b958b3f8e4da556ed13d44622aead5a',
            'scope'         => array('email'),
        ),

        'Twitter' => array(
            'client_id'     => '',
            'client_secret' => '',
        ),

        'Google'    =>  array(
            'client_id'     =>  '',
            'client_secret' =>  '',
            'scope'         =>  array('userinfo_email', 'userinfo_profile'),
        ),

        'Linkedin'  =>  array(
            'client_id'     =>  '',
            'client_secret' =>  '',
            'scope'         =>  array('r_basicprofile', 'r_emailaddress')
        )
	)

);