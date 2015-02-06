<?php
namespace Cms;

class TagController extends \BaseController {

     /**
     * Display a listing of tag.
     *
     * @return View
     */


    private $rules = array(
            'title'      => 'required|unique:tag|min:2',
            'description' => 'required|min:5'
        );

    public function index()
    {
       $tags = \Survey\Tag::all();
       return \View::make('cms.tag.index',compact('tags'));
    }

   
     /**
     * Create a tag.
     *
     * @return View
     */
    
    public function create()
    {
       return \View::make('cms.tag.create');     

    }




     /**
     * Show a tag detail
     * @param tagid
     *
     * @return View
     */
    
    public function show($tagid)
    {
        $tag = \Survey\Tag::find($tagid);

        if(empty($tag))
        {
            return \Response::make("Invalid Tag ID", 404);
        }

       return \View::make('cms.tag.show', compact('tag'));     

    }




     /**
     * Store tag data.
     *
     * @return Redirect
     */

    public function store()
    {       
        $validator =\Validator::make(\Input::all(), $this->rules);


        if ($validator->fails()) 
        {
            return \Redirect::route('admin.tag.create')
                ->withErrors($validator)
                ->withInput();
        } 
        else 
        {
            // store
            $tag = new \Survey\Tag;
            $tag->title = \Input::get('title');
            $tag->description = \Input::get('description');
            $tag->graphics = \Input::get('graphics');
            $tag->slug = \Str::slug($tag->title);

            $tag->save();

            // redirect to tag manage page
            return \Redirect::route('admin.tag.index')->with('message', 'Tag Successfully created!');

        }
      

    }
    
     /**
     * Edit tag view.
     *
     * @return View
     */

    public function edit($id)
    {
       $tag = \Survey\Tag::find($id);
       return \View::make('cms.tag.edit', compact('tag'));
    }


     /**
     * Update tag data.
     *
     * @return Redirect
     */


    public function update($id)
    {

        $tag = \Survey\Tag::find($id);

        $validator =\Validator::make(\Input::all(), $this->rules);


        if ($validator->fails()) 
        {
            return \Redirect::to('admin/tag/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput();
        } 
        else 
        {
            // store
            $tag->title = \Input::get('title');
            $tag->description = \Input::get('description');
            $tag->graphics = \Input::get('graphics');
            $tag->slug = \Str::slug($tag->title);;
            $tag->save();

            // redirect to tag manage page
            return \Redirect::route('admin.tag.index')->with('message', 'Tag Successfully updated');

        }

    }


     /**
     * Delete a tag data.
     *
     * @return Redirect
     */


    public function destroy($tag_id)
    {
        // find tag
       $tag = \Survey\Tag::find($tag_id);

       if($tag)
        {
            $tag->delete();
            return \Redirect::route('admin.tag.index')->with('message', 'Tag deleted Successfully');
        }
        else       
        return \Redirect::route('admin.tag.index')->with('message', 'Something went wrong. Please try again later.');

    }

}
