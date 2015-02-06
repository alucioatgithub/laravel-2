<?php

class Surrogate extends EloquentMongo {

    const KEY_LENGTH        = 32;

    const PASSWORD          = 'password';
    const SECURITY_QUESTION = 'security_question';

    public $timestamps = false;

    protected $collection   = 'surrogate_passwords';
    protected $primaryKey   = 'userid';

    protected $dates = ['dob'];

    protected $fillable = [
        'userid',
        'unlock',
        'key'
    ];

    protected $guarded = [
        '_id'
    ];

    /**
     * Get an array of all of available unlock types
     *
     * @return array
     **/
    public static function getAvailableUnlockTypes()
    {
        return array(
            self::PASSWORD,
            self::SECURITY_QUESTION
        );
    }
}
