<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Service;
use App\ServiceTranslation;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    
    public function index()
    {
        return view('admin.services.index')->with('services', Service::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'slug' => 'required|alpha_dash|unique:services,slug',
            'name' => 'array|translated'
        ]);

        $service = new Service([
            'slug'  => $request->input('slug'),
            'name' => $request->input('name'),
        ]);

        $service->save();
        
        return redirect('admin/services');
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
        return view('admin.services.edit')->with('service', Service::findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $service_id)
    {
        $this->validate($request, [
            'slug' => 'required|alpha_dash|unique:services,slug,'.$service_id,
            'name' => 'array|translated'
        ]);

        $service = Service::findOrFail($service_id);

        $service->slug = $request->input('slug');
        $service->name = $request->input('name');

        $service->save();
        
        return redirect('admin/services');
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

        Service::destroy($list);

        return $list;
    }
}
