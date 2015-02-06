<?php

class SurveyController extends BaseController {

    /**
     * Returns one survey
     *
     * GET /api/survey/<surveyid>
     *
     * @param $surveyId
     *
     * @return Illuminate\Support\Facades\Response
     **/
    public function getSurvey($surveyId)
    {
        $response = array();

        $validator = Validator::make(array(
            'surveyid' => $surveyId
        ), array(
            'surveyid' => array(
                'required',
                'size:13',
                'exists:surveys,surveyid'
            )
        ));

        // Check the survey ID
        if ($validator->fails()) {

            $response = array(
                'error' => Error::create(
                    Error::INVALID_INPUT,
                    $validator->messages()
                )
            );

            return $this->failure($response);
        }

        // Get the survey
        $survey = \Survey\Survey::find($surveyId);

        // Clean up the survey
        unset($survey['_id']);
        unset($survey['created_at']);
        unset($survey['updated_at']);
        unset($survey['tags']);
        unset($survey['targeting']);

        $response['survey'] = $survey;

        return $this->success($response);
    }

    /**
     * Returns tags of the survey
     *
     * GET /api/survey/<surveyid>/tags
     *
     * @param $surveyId
     *
     * @return Illuminate\Support\Facades\Response
     **/
    public function getSurveyTags($surveyId)
    {
        $response = array();

        $validator = Validator::make(array(
            'surveyid' => $surveyId
        ), array(
            'surveyid' => array(
                'required',
                'size:13',
                'exists:surveys,surveyid'
            )
        ));

        // Check the survey ID
        if ($validator->fails()) {

            $response = array(
                'error' => Error::create(
                    Error::INVALID_INPUT,
                    $validator->messages()
                )
            );

            return $this->failure($response);
        }

        // Get the survey
        $survey = \Survey\Survey::find($surveyId);

        $response['survey'] = array(
            'surveyid'   => $surveyId,
            'tags'       => array()
        );

        $surveyTags = $survey->getTags()->get();

        foreach ($surveyTags->toArray() as $tag) {
            $response['survey']['tags'][] = array(
                'tagid'         =>  $tag['tagid'],
                'title'         =>  $tag['title'],
                'description'   =>  $tag['description'],
                'graphics'      =>  $tag['graphics']
            );
        }

        return $this->success($response);
    }

    /**
     * Returns boolean value, is the user relevant
     * to the survey based on his GEO
     *
     * GET /api/survey/{surveyid}/relevant/{userid}
     *
     * @param $surveyId
     * @param $userId
     *
     * @return Illuminate\Support\Facades\Response
     **/
    public function isSurveyRelevantToUser($surveyId, $userId)
    {
        $response = array();

        $validator = Validator::make(array(
            'surveyid'  => $surveyId,
            'userid'    =>  $userId
        ), array(
            'surveyid' => array(
                'required',
                'size:13',
                'exists:surveys,surveyid'
            ),
            'userid' => array(
                'required',
                'size:13',
                'exists:users,userid'
            )
        ));

        if ($validator->fails()) {
            $response = array(
                'error' => Error::create(
                    Error::INVALID_INPUT,
                    $validator->messages()
                )
            );
            return $this->failure($response);
        }

        $survey = \Survey\Survey::find($surveyId);
        $user   = \User::find($userId);

        $relevant = $user->surveys()->doesSurveyRelevantToMe($survey);

        return $this->success(array(
            'relevant'  =>  $relevant
        ));
    }

    /**
     * Returns all surveys that applies to user's location
     *
     * GET /api/user/{userid}/surveys
     *
     * @param $userId
     *
     * @return Illuminate\Support\Facades\Response
     **/
    public function getSurveysThaAppliesToUser($userId)
    {
        $response = array();

        $validator = Validator::make(array(
            'userid'    =>  $userId
        ), array(
            'userid' => array(
                'required',
                'size:13',
                'exists:users,userid'
            )
        ));

        if ($validator->fails()) {
            $response = array(
                'error' => Error::create(
                    Error::INVALID_INPUT,
                    $validator->messages()
                )
            );
            return $this->failure($response);
        }

        $surveys = \User::find($userId)->surveys()->getAllSurveysThatAppliesToMe();

        $response['surveys'] = $surveys;

        return $this->success($response);
    }

    /**
     * Returns a random survey that applies to the user
     * with optional tag's name parameter
     *
     * @param null $tagname
     *
     * @return \Illuminate\Support\Facades\Response
     */
    public function getRandomSurvey($tagname = null)
    {
        $survey  = Auth::user()->surveys()->getRandomSurvey($tagname);

        if ($survey == null) {
            return $this->failure([
                'error' =>  Error::create(
                    Error::RESOURCE_IS_NOT_FOUND
                )
            ]);
        }

        return $this->success(['survey' =>  $survey]);
    }
}
