<?php

Route::get('/', 'HomeController@defaultHome');

Route::resource(
    'questions',
    'QuestionsController',
    [
    'only' => 
        [
            'index',
            'show'
]]);

Route::get('auth/{method}/login', 'AuthController@userLogin');



Route::group(array('before' => 'guest'), function() {

    Route::get('/admin/auth', 'Cms\\AuthController@adminAuth');
    Route::post('/admin/auth', 'Cms\\AuthController@adminAuthHandler');

    Route::post('/auth/{method}/login', 'AuthController@userLoginHandler');

    Route::get('/auth/{method}/register', 'AuthController@userRegister');
    Route::post('/auth/{method}/register', 'AuthController@userRegisterHandler');

    Route::get('/auth/password/remind', 'AuthController@passwordRemind');
    Route::post('/auth/password/remind', 'AuthController@passwordRemindHandler');

    Route::get('/auth/password/reset/{token}', 'AuthController@passwordReset');
    Route::post('/auth/password/reset', 'AuthController@passwordResetHandler');

    Route::get('/auth/verify/{token}', 'AuthController@verifyHandler');
});

Route::group(array('before' => 'auth.user'), function() {

    Route::get('/auth/logout', 'AuthController@userLogout');

    Route::get('/account', 'AccountController@getProfile');
    Route::put('/account', 'AccountController@updateProfile');
    Route::get('/auth/assign/{method}', 'AuthController@assignSocialAccount');


    // API. Survey routes
    Route::get('/api/survey/random', 'SurveyController@getRandomSurvey');
    Route::get('/api/survey/tag/{tagname}/random', 'SurveyController@getRandomSurvey');

    Route::get('/api/survey/{surveyid}', 'SurveyController@getSurvey');
    Route::get('/api/survey/{surveyid}/tags', 'SurveyController@getSurveyTags');
    Route::get('/api/survey/{surveyid}/relevant/{userid}', 'SurveyController@isSurveyRelevantToUser');
    Route::get('/api/user/{userid}/surveys', 'SurveyController@getSurveysThaAppliesToUser');

    Route::post('/api/opinion/create', 'OpinionsController@store');
});

Route::group(array('prefix' => 'admin', 'before' => 'auth.admin'), function() {

    Route::get('/', [
        'as'    =>  'cms.index',
        'uses'  =>  'Cms\\DashboardController@getIndex'
    ]);
    Route::get('/logout', function(){
        Auth::logout();
        return Redirect::route('cms.index');
    });

    Route::get('users/{users}/activate', array('as' => 'admin.users.activate', 'uses' => 'Cms\\UsersController@getActivate'));
    Route::get('users/{users}/deactivate',  array('as' => 'admin.users.deactivate', 'uses' =>'Cms\\UsersController@getDeactivate'));
    Route::resource('users', 'Cms\\UsersController');
    Route::resource('tags', 'Cms\\TagsController');
    Route::resource('questions', 'Cms\\QuestionsController');
    Route::resource('tag', 'Cms\\TagController');
    Route::resource('survey', 'Cms\\SurveyController');
});


Route::group(array('prefix' => 'flow', 'before' => 'auth.user'), function() {
    Route::get('/', array('as' => 'flow.index', 'uses'=>'FlowController@getIndex'));
    Route::get('question/{surveyid}', array('as' => 'flow.question', 'uses' =>'FlowController@getQuestion'));
    Route::get('tag/{slug}', array('as' => 'flow.tag', 'uses' => 'FlowController@getTag'));
});