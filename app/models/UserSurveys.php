<?php

class UserSurveys extends Eloquent {

    private $user;

    /**
     * @param User $user
     */
    public function __construct(\User $user)
    {
        $this->user = $user;
    }


    /**
     * Checks for, can the user answer the survey
     *
     * @param \Survey\Survey $survey
     *
     * @return bool
     */
    public function canAnswer(\Survey\Survey $survey)
    {
        return $this->user->doesSurveyRelevantToMe($survey);
    }


    /**
     * Checks, does the user already answered the surveys
     *
     * @param \Survey\Survey $survey
     *
     * @return bool
     */
    public function hasAnswered(\Survey\Survey $survey)
    {
        return in_array($survey->surveyid, $this->user->surveys);
    }


    /**
     * Adds the survey to the list on answered ones
     *
     * @param \Survey\Survey   $survey
     * @param string           $responseid
     *
     * @return bool
     */
    public function answer(\Survey\Survey $survey, $responseid)
    {
        $surveys = $this->user->surveys;

        if (in_array($survey->surveyid, $surveys)) {
            return false;
        }

        if (!$survey->hasResponse($responseid)) {
            return false;
        }

        $surveys[] = $survey->surveyid;

        $this->user->surveys = $surveys;
        $this->user->save();

        \Survey\Opinion::create([
            'surveyid'      =>  $survey->surveyid,
            'responseid'    =>  $responseid,
            'gender'        =>  $this->user->gender,
            'location'      =>  $this->user->location,
            'dob'           =>  $this->user->dob
        ]);

        return true;
    }

    /**
     * Checks, does the passed survey relevant to the user
     *
     * @param $survey
     *
     * @return boolean
     **/
    public function doesSurveyRelevantToMe($survey)
    {
        $userPoint = $this->user->location;

        $result = DB::collection('surveys')->raw(function($collection) use ($userPoint, $survey)
        {
            return $collection->find(array(
                'surveyid'  =>  $survey->surveyid,
                'location'  =>  array(
                    '$near'   =>  array(
                        '$geometry' =>  $userPoint
                    )
                )
            ));
        });

        return ($result->count() == 1);
    }

    /**
     * Returns all surveys that relevant to user
     *
     * @param $options
     *
     * @return array
     **/
    public function getAllSurveysThatAppliesToMe($options = array())
    {
        $now       = \Carbon\Carbon::now();
        $userPoint = $this->user->location;

        $params = array();
        $params = array(
       /*     'location'  =>  array(
                '$geoNear'   =>  array(
                    '$geometry' =>  $userPoint
                )
            ),*/
            'targeting.start'     =>  array(
                '$lt'   =>  $now
            ),
            'targeting.end'       =>  array(
                '$gt'   =>  $now
            )
        );

        // Check additional options
        if (isset($options['tagname'])) {

            $tags = [];
            $tagsItems = \Survey\Tag::where(['slug' => $options['tagname']])
                ->get()->all();

            foreach ($tagsItems as $tag) {
                $tags[] = $tag->tagid;
            }

            if (empty($tags)) {
                return [];
            }

            $params['tags'] = ['$in' => $tags];
        }

        $results = DB::collection('surveys')->raw(function($collection) use ($params, $userPoint, $now)
        {
            return $collection->find(
                $params,
                array(
                    'surveyid'  =>  true
                )
            );
        });
        $surveyIds = array();
        
        if(!empty($results)) {
            foreach ($results as $survey) {
                $surveyIds[] = $survey['surveyid'];
            }
        }
        return $surveyIds;
        
    }


    /**
     * Returns a random survey that applies to the user
     * with optional tag's name parameter
     *
     * @param null $tagname
     *
     * @return null
     */
    public function getRandomSurvey($tagname = null, $limit = 1)
    {
        $options = [];

        if ($tagname != null) {
            $options['tagname'] = $tagname;
        }

        $surveys = $this->getAllSurveysThatAppliesToMe($options);

        if (empty($surveys)) {
            return null;
        }
    
        if($limit > 1)
        {
            $limit = (count($surveys)>$limit)? $limit :  count($surveys);
            $rand = array_rand($surveys, $limit);
            $ids = array();
            foreach ($rand as $key) 
            $ids[] = $surveys[$key];
            return \Survey\Survey::whereIn('surveyid', $ids )->get();
        }
        else
        {
            return \Survey\Survey::find($surveys[array_rand($surveys, 1)]);
        }
    }   
}