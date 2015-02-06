<?php

namespace Survey;

class Opinion extends \EloquentMongo {

    protected $collection   = 'opinions';

    protected $primaryKey = 'opinionid';

    protected $fillable = [
        'opinionid',
        'surveyid',
        'userid',
        'responseid',
        'gender',
        'location',
        'dob',
        'timestamp'
    ];

    protected $guarded = [
        '_id'
    ];


    /**
     * Model events observe
     *
     * @return void
     **/
    public static function boot()
    {
        static::creating(function($opinion) {

            $opinion->opinionid = uniqid();
            $opinion->timestamp = \Carbon\Carbon::now();
        });
    }
}
