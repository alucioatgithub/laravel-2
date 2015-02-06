<?php

use Jenssegers\Mongodb\Model as EloquentMongo;

class Question extends EloquentMongo {

    protected $collection = 'questions';

}