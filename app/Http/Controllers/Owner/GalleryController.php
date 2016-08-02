<?php

namespace App\Http\Controllers\Owner;

use Illuminate\Http\Request;

use App\Profile;
use App\ProfileImage;

use Validator;
use Session;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function index($profile_id)
    {
        if(intval(Session::get('step')) > 0 && intval(Session::get('step')) < 4)
        {
            return redirect()->to('owner/profile');
        }
        return view('profile.gallery.index')->with('profile', Profile::findOrFail($profile_id));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request, $profile_id)
    {
        $files = array('image' => $request->file('file'));

        $rules = array('image' => 'required|mimes:jpg,jpeg,bmp,png|max:10000'); //mimes:jpeg,bmp,png and for max size max:10000

        $validator = Validator::make($files, $rules);

        if ($validator->fails()) {
            return Response::make($validator->errors()->first(), 400);
        }

        $file = $request->file('file');

        $profile = Profile::findOrFail($profile_id);

        if ($file->isValid()) {
            $image_info = getimagesize($file);
            $image_width = $image_info[0];
            $image_height = $image_info[1];

            $fileName = rand(11111,99999) . '.' . $file->getClientOriginalExtension();
            $destinationPath = 'uploads/profiles/'.$profile_id; // upload path

            $image = new ProfileImage();
            $image->url = $destinationPath . '/' . $fileName;

            if($request->input('general') == 'true')
            {
                $image->is_general = true;
                if($profile->image)
                {
                    $profile->image->delete();
                }
            }
            else
            {
                $image->is_general = false;
            }

            $image->width = $image_width;
            $image->height = $image_height;
            $image->order = $profile->images->count();

            $profile->images()->save($image);

            $file->move($destinationPath, $fileName); // uploading file to given path

            print_r(json_encode($image->toArray()));
            exit;
        }

        return Response::make('File is not valid', 400);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $profile_id, $id)
    {
        $profile = Profile::findOrFail($profile_id);

        $image = $profile->images()->where('id', $id)->first();

        if($image)
        {
            $image->order = $request->input('order');
            $image->save();

            return (String)true;
        }

        return (String)false;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($profile_id, $id)
    {
        $profile = Profile::findOrFail($profile_id);

        $images = $profile->allImages()->whereIn('id', explode('-', $id))->get();

        foreach ($images as $image) {
            $image->delete();
        }

        return $images;
    }
}
