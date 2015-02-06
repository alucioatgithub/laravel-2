<?php

class FlowController extends BaseController {

	/**
     * The layout that should be used for responses.
     */
    protected $layout = 'layouts.flow';

	public function getIndex()
	{
		$user = $this->current_user();

		$usersurvey = new \UserSurveys($user);
		$survey = $usersurvey->getRandomSurvey();

       	$this->layout->content = \View::make('flow.index',compact('survey'));
	}

	public function getQuestion($serveyid)
	{
		$survey = \survey\Survey::find($serveyid);

	   if(count($survey)<1)
        {
            return \Response::make("Invalid Survey ID", 404);
        }

		return \View::make('flow.details', compact('survey'));
		
	}

	public function getTag($slug = '')
	{
	 	$tag = \Survey\Tag::where('slug', $slug)->first();
	 	
        if(empty($tag))
        {
            return \Response::make("Invalid Tag", 404);
        }

        $user = $this->current_user();

		$usersurvey = new \UserSurveys($user);
		$surveys = $usersurvey->getRandomSurvey($slug, 5);


/*
        $tag_model = new \Survey\Tag;
 		$surveys = $tag_model->getSurveys($tag->tagid);*/
		return \View::make('flow.tag', compact('tag', 'surveys'));
	}

}
