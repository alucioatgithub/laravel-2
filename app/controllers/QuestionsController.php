<?php

/*

PHP PROFICIENCY DEMONSTRATION

Relevant routing setup:
+--------+-----------------------------------+------------------+----------------------------+----------------+---------------+
| Domain | URI                               | Name             | Action                     | Before Filters | After Filters |
+--------+-----------------------------------+------------------+----------------------------+----------------+---------------+
|        | GET|HEAD questions                | questions.index  | QuestionsController@index  |                |               |
|        | GET|HEAD questions/{questions}    | questions.show   | QuestionsController@show   |                |               |
+--------+-----------------------------------+------------------+----------------------------+----------------+---------------+

For the purpose of this test we will use a simplified Eloquent


*/

class QuestionsController extends BaseController {

	public function index()
	{
        $questions = Question::all();
        print_r($questions);
	}

    public function show()
    {

    }

}

class Question extends EloquentMongo {

    protected $collection = 'questions';

}