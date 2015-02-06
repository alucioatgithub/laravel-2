<?php

class BaseController extends Controller {

    const FAILURE = 0;
    const SUCCESS = 1;

    public $current_user = FALSE;


    public function __construct()
    {
       $this->current_user = $this->current_user();
    }


	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

    /**
     * Returns success response object
     *
     * @param  array $response = array()
     * @param  int   $status   = 200
     *
     * @return Illuminate\Support\Facades\Response
     **/
    protected function success(array $response = array(), $status = 200)
    {
        $response = array_merge(
            array('status' => self::SUCCESS),
            $response
        );

        return Response::json($response, $status);
    }

    /**
     * Returns failure response object
     *
     * @param  array $response = array()
     * @param  int   $status   = 400
     *
     * @return Illuminate\Support\Facades\Response
     **/
    protected function failure(array $response = array(), $status = 400)
    {
        $response = array_merge(
            array('status' => self::FAILURE),
            $response
        );

        return Response::json($response, $status);
    }


     /**
     * Returns Current logged in user info
     *
     * @return user object
     **/

    function current_user()
    {
        $user = FALSE;
        if (Auth::check())
        {
            $user = Auth::user();  
        }

        // share current route in all views
        View::share('current_route', Route::getCurrentRoute()->getPath());

        // share current user data in all views
        View::share('current_user', $user);

        return  $user;
    }



}
