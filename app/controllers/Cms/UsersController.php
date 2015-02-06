<?php
namespace Cms;

class UsersController extends \BaseController {

     /**
     * Display a listing of users.
     *
     * @return View
     */


    private $rules = array(
            'email'      => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|between:4,20',
            'firstname' => 'required|between:2,50',
            'lastname' => 'required|between:2,50',

        );

    public function index()
    {
       $users = \user::all();


       return \View::make('cms.users.index',compact('users'));
    }

   
     /**
     * Create a user.
     *
     * @return View
     */
    
    public function create()
    {
       return \View::make('cms.users.create');     

    }




     /**
     * Show a user detail
     * @param userid
     *
     * @return View
     */
    
    public function show($userid)
    {
        $user = \User::find($userid);

        if(empty($user))
        {
            return \Response::make("Invalid User ID", 404);
        }

       return \View::make('cms.users.show', compact('user'));     

    }




     /**
     * Store user data.
     *
     * @return Redirect
     */

    public function store()
    {       
        $validator =\Validator::make(\Input::all(), $this->rules);


        if ($validator->fails()) 
        {
            return \Redirect::route('admin.users.create')
                ->withErrors($validator)
                ->withInput();
        } 
        else 
        {
            // store
            $user = new \User;
            $user->firstname = \Input::get('firstname');
            $user->lastname = \Input::get('lastname');
            $user->address = \Input::get('address');
            $user->dob = \Input::get('dob');
            $user->gender = \Input::get('gender');
            $user->email = \Input::get('email');
            $user->avatar = \Input::get('avatar');
            $user->social = \Input::get('social');
            $user->bio = \Input::get('bio');
            $user->password = \Hash::make(\Input::get('password'));
            $user->role = \Input::get('role');         
            $user->activated = \Input::get('activated');

            if($user->role == "admin")
            $user->capability = \Input::get('capability');

            $user->save();

            // redirect to user manage page
            return \Redirect::route('admin.users.index')->with('message', 'User Successfully created');

        }
      

    }

    
     /**
     * Edit user view.
     *
     * @return View
     */

    public function edit($id)
    {
       $user = \User::find($id);
       return \View::make('cms.users.edit', compact('user'));
    }


     /**
     * Update user data.
     *
     * @return Redirect
     */


    public function update($id)
    {

        $user = \user::find($id);


        $rules = $this->rules;


        if($user->email == \Input::get('email'))    
        {
            unset($rules['email']);           
        }


        if(\Input::get('password')=='')    
        {
            unset($rules['password']);
        }
       


        $validator =\Validator::make(\Input::all(), $rules);


        if ($validator->fails()) 
        {
            return \Redirect::to('admin/users/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } 
        else 
        {
            // store
            $user->firstname = \Input::get('firstname');
            $user->lastname = \Input::get('lastname');
            $user->address = \Input::get('address');
            $user->dob = \Input::get('dob');
            $user->gender = \Input::get('gender');
            $user->email = \Input::get('email');
            $user->avatar = \Input::get('avatar');
            $user->social = \Input::get('social');
            $user->bio = \Input::get('bio');

            if(\Input::get('password')!='')
                $user->password = \Hash::make(\Input::get('password'));

            $user->role = \Input::get('role');         
            $user->activated = \Input::get('activated');

            if($user->role == "admin")
            $user->capability = \Input::get('capability');



            $user->save();

            // redirect to user manage page
            return \Redirect::route('admin.users.index')->with('message', 'User Successfully updated');

        }

    }


     /**
     * Delete a user data.
     *
     * @return Redirect
     */


    public function destroy($user_id)
    {
        // find user
       $user = \User::find($user_id);

       if($user)
        {
            $user->delete();
            return \Redirect::route('admin.users.index')->with('message', 'User deleted Successfully');
        }
        else
       
        return \Redirect::route('admin.users.index')->with('message', 'Something went wrong. Please try again later.');

    }



    public function getActivate($userid)
    {
        return $this->_changeStatus($userid, 'activate');
    }

     public function getDeactivate($userid)
    {
        return $this->_changeStatus($userid, 'deactivate');
    }



    private function _changeStatus($userid, $status)
    {
        if(in_array($status, array('activate', 'deactivate')))
        {
            $user = \User::find($userid);

           if($user)
            {
                if($status == 'activate')
                {
                    $user->activated = 'true';
                    $message = "User activated successfully";
                }
                else 
                {
                    $user->activated = 'false';
                    $message = "User deactivated successfully";
                }

                $user->save();
                return \Redirect::route('admin.users.index')->with('message', $message);
            }
        }
        return \Redirect::route('admin.users.index')->with('message', 'Something went wrong. Please try again later.');        
    }
}
