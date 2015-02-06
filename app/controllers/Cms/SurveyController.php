<?php
namespace Cms;

class SurveyController extends \BaseController {

     /**
     * Display a listing of survey.
     *
     * @return View
     */


    private $rules = array(
            'type'      => 'required|unique:survey|min:2',
            'information' => 'required|min:5',
            'author' => 'required|exists:users,userid',
            'title' => 'required|unique:survey|between:2,255'
        );

    public function index()
    {
       $surveys = \Survey\Survey::all();

       return \View::make('cms.survey.index')->with('surveys', $surveys);
    }

   
     /**
     * Create a survey.
     *
     * @return View
     */
    
    public function create()
    {
        $users = $this->get_users_drop();
        $tags = \Survey\Tag::all();
       return \View::make('cms.survey.create', compact('users', 'tags'));     

    }

    private function get_users_drop()
    {
        $all_users = \user::all();
        $users = array();
        $users[''] = 'Select';

        foreach($all_users as $user) {
            $users[$user->userid] = $user->firstname." ".$user->lastname;
        }
        return $users;
    }

     /**
     * Show a survey detail
     * @param surveyid
     *
     * @return View
     */
    
    public function show($surveyid)
    {
        $survey = \Survey\Survey::find($surveyid);
        if(empty($survey))
        {
            return \Response::make("Invalid Survey ID", 404);
        }

       return \View::make('cms.survey.show', compact('survey'));     

    }


     /**
     * Store survey data.
     *
     * @return Redirect
     */

    public function store()
    {       
        $validator =\Validator::make(\Input::all(), $this->rules);


        if ($validator->fails()) 
        {
            return \Redirect::route('admin.survey.create')
                ->withErrors($validator)
                ->withInput();
        } 
        else 
        {
            // store
            //create a new object Laravel style
            $format = 'Y-m-d';
            $start = \DateTime::createFromFormat($format, \Input::get('start_date'));
            $end = \DateTime::createFromFormat($format, \Input::get('end_date'));

            $app = app();
            $targeting = $app->make('stdClass');
            $targeting->start = $start;
            $targeting->end = $end;
            $targeting->polygon = \Input::get('polygon');
            $targeting->referrer = \Input::get('referrer');
            $targeting->manualend = \Input::get('manualend');

            // store
            $survey = new \Survey\Survey;
            $survey->type = \Input::get('type');
            $survey->title = \Input::get('title');
            $survey->tags = \Input::get('tags');
            $survey->author = \Input::get('author');
            $survey->information = \Input::get('information');
            $survey->targeting = $targeting;

            $survey->save();

            // redirect to survey manage page
            return \Redirect::route('admin.survey.index')->with('message', 'Survey Successfully created!');

        }
      

    }

    
     /**
     * Edit survey view.
     *
     * @return View
     */

    public function edit($id)
    {
        $users = $this->get_users_drop();
        $tags = \Survey\Tag::all();
        $survey = \Survey\Survey::find($id);

        if(empty($survey))
        {
            return \Response::make("Invalid Survey ID", 404);
        }

       return \View::make('cms.survey.edit', compact('survey', 'users', 'tags'));
    }


     /**
     * Update survey data.
     *
     * @return Redirect
     */


    public function update($id)
    {

        $survey = \Survey\Survey::find($id);

        $rules = $this->rules;

        $validator =\Validator::make(\Input::all(), $rules);


        if ($validator->fails()) 
        {
            return \Redirect::to('admin/survey/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } 
        else 
        {
            //create a new object Laravel style

            $format = 'Y-m-d';
            $start = \DateTime::createFromFormat($format, \Input::get('start_date'));
            $end = \DateTime::createFromFormat($format, \Input::get('end_date'));


            $app = app();
            $targeting = $app->make('stdClass');
            $targeting->start =  $start;
            $targeting->end = $end;
            $targeting->polygon = \Input::get('polygon');
            $targeting->referrer = \Input::get('referrer');
            $targeting->manualend = \Input::get('manualend');

            // store
            $survey->type = \Input::get('type');
            $survey->title = \Input::get('title');
            $survey->tags = \Input::get('tags');
            $survey->author = \Input::get('author');
            $survey->information = \Input::get('information');
            $survey->targeting = $targeting;
            $survey->save();

            // redirect to survey manage page
            return \Redirect::route('admin.survey.index')->with('message', 'Survey Successfully updated');

        }

    }


     /**
     * Delete a survey data.
     *
     * @return Redirect
     */


    public function destroy($survey_id)
    {
        // find survey
       $survey = \Survey\Survey::find($survey_id);

       if($survey)
        {
            $survey->delete();
            return \Redirect::route('admin.survey.index')->with('message', 'Survey deleted Successfully');
        }
        else
       
        return \Redirect::route('admin.survey.index')->with('message', 'Something went wrong. Please try again later.');

    }

}
