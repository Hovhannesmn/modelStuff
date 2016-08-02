<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
        return view('admin.galleries.index')->with('sliders', Gallery::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
       $gallery = new Gallery();
       $gallery->title = 'New gallery';
       $gallery->save();

       return redirect()->to('admin/galleries/'.$gallery->id.'/edit');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        
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
        $gallery = Gallery::findOrFail($id);

        return view('admin.galleries.edit')->with('gallery', $gallery);
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
        $gallery = Gallery::findOrFail($id);
        $gallery->fill($request->except('_token'));
        $gallery->save();

        return redirect()->to('admin/galleries');
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

        Gallery::destroy($list);

        return $list; 
    }
}
