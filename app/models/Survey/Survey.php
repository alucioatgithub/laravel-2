<?php

namespace Survey;

class Survey extends \EloquentMongo {

    const TYPE_MULTIPLY_LINEAR      =   'ml';
    const TYPE_MULTIPLY_NON_LINEAR  =   'mn';
    const TYPE_MULTIPLY_SELECTION   =   'ms';

    protected $collection   = 'surveys';

    protected $primaryKey = 'surveyid';

    protected $fillable = [
        'type',
        'title',
        'tags',
        'author',
        'information',
        'targeting',
        'location',
        'responses',
        'manualend'
    ];

    protected $guarded = [
        '_id',
        'surveyid',
        'location'
    ];

    protected $dates = array('start', 'end');

    /**
     * Returns tags of survey
     *
     * @return \Jenssegers\Mongodb\Eloquent\Builder
     **/
    public function getTags()
    {     
       return  \Survey\Tag::whereIn('tagid', $this->tags)->get();       
    }



     /**
     * Returns Author of survey
     *
     * @return \Jenssegers\Mongodb\Eloquent\Builder
     **/
    public function getAuthor()
    {  
       return \User::find($this->author);       
    }


     /**
     * Returns Total responses of survey
     *
     * @return \Jenssegers\Mongodb\Eloquent\Builder
     **/
    public function totalAnswers()
    {     
        if(isset($this->responses))
           return count($this->responses);       
       else
           return 0;
    }







    /**
     * Assigns new tag to the survey
     *
     * @param $tag
     *
     * @return \Survey\Survey
     **/
    public function assignTag(\Survey\Tag $tag)
    {
        $tags   = $this->tags;
        $tags[] = $tag->tagid;

        $this->tags = $tags;

        $this->save();
    }

     


    /**
     * Checks, if the survey has a response
     *
     * @param $responseid
     *
     * @return bool
     */
    public function hasResponse($responseid)
    {
        foreach ($this->responses as $response) {
            if ($response['responseid'] == $responseid) {
                return true;
            }
        }

        return false;
    }

    /**
     * Model events observe
     *
     * @return void
     **/
    public static function boot()
    {
        parent::boot();

        static::creating(function($survey) {
            $survey->surveyid = uniqid();
        });

    }
}
