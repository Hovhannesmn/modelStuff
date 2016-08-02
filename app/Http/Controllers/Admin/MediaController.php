<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Media;

use Input;
use Validator;
use Redirect;

use Request;
use Response;

use Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $mediaItems = Media::orderBy('created_at', 'desc')->get();

        return view('admin.media.index')->with('mediaItems', $mediaItems);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //return view('admin.media.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function upload()
    {
        return view('admin.media.upload');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $file = array('image' => Input::file('file'));
        
        $rules = array('image' => 'required|mimes:jpg,jpeg,bmp,png|max:10000'); //mimes:jpeg,bmp,png and for max size max:10000
        
        $validator = Validator::make($file, $rules);
        
        if ($validator->fails()) {
            return Response::make($validator->errors()->first(), 400);
        }
        else {
            if (Input::file('file')->isValid()) {

                $file = Input::file('file');

                $fileName = $file->getClientOriginalName();
                $rep = $fileName;

                $ind = 1;
                while(file_exists(public_path('uploads/'.$rep))){
                    $rep = str_replace(['.jpg', '.jpeg', '.bmp', '.png'], '', $fileName).'_'.$ind.'.'.$file->getClientOriginalExtension();
                    $ind++;
                }
                $fileName = $rep;

                $destinationPath = 'uploads'; // upload path

                $media = new Media();
                $media->file_name = $fileName;//$file->getClientOriginalName();
                $media->file_type = $file->getClientMimeType();
                $media->file_size = $this->formatSizeUnits($file->getClientSize());
                $media->url = $destinationPath . '/' . $fileName;
                $media->title = ucfirst(str_slug($file->getClientOriginalName()));
                $media->caption = '';
                $media->alt = '';
                $media->description = '';

                Input::file('file')->move($destinationPath, $fileName); // uploading file to given path
                
                return (String)$media->save();
            }
            else {
                return Response::make('File is not valid', 400);
            }
        }
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
        $image = Media::findOrFail($id);

        return view('admin.media.edit')->with('image', $image);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $image = Media::findOrFail($id);

        $image->title = Request::input('title');
        $image->alt = Request::input('alt');
        $image->caption = Request::input('caption');
        $image->description = Request::input('description');

        $image->save();

        return redirect()->to('/admin/media/'.$id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) 
    {   
        $list = explode('-', $id);

        
        foreach ($list as $item) {
            $object = Media::find($item);
            if($object){
                if(file_exists(public_path($object->getOriginal('url')))){
                    unlink(public_path($object->getOriginal('url')));
                }
            }
        }

        return (String) Media::destroy($list);
    }

    protected function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
    }
}
