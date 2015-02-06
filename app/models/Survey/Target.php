<?php

namespace Survey;

class Target extends \EloquentMongo {

    protected $collection   = 'surveys_targets';

    protected $primaryKey = 'targetid';

    protected $fillable = [
        'title',
        'description',
        'geometry'
    ];

    protected $guarded = [
        '_id',
        'targetid'
    ];


    /**
     * Model events observe
     *
     * @return void
     **/
    public static function boot()
    {
        parent::boot();

        static::creating(function($target) {
            $target->targetid = uniqid();
        });
    }
}
