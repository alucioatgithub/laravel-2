<?php

namespace Survey;

class Tag extends \EloquentMongo {

    protected $collection   = 'surveys_tags';

    protected $primaryKey = 'tagid';

    protected $fillable = [
        'title',
        'description',
        'graphics',
        'slug'
    ];

    protected $guarded = [
        '_id',
        'tagid'
    ];


    /**
     * Model events observe
     *
     * @return void
     **/
    public static function boot()
    {
        parent::boot();

        static::creating(function($tag) {
            $tag->tagid = uniqid();
        });
    }

    /**
     * Returns surveys of tag
     *
     * @return \Jenssegers\Mongodb\Eloquent\Builder
     **/
    public function getSurveys($tagid)
    {  
        $num_records = \Survey\Survey::where('tags', $tagid)->count();
        return \Survey\Survey::where(array('tags' => $tagid, ))->take(5)->skip(rand(0,$num_records-5))->get();
    }
}
