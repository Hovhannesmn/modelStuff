<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Contacts;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    public function getIndex(){
        return view('admin.contacts.index');
    }

    public function postIndex(Request $request){
        $this->validate($request, [
            'name' => 'required|array|translated',
            'address' => 'required|array|translated',
            'phone'   => 'required',
            'email'   => 'required|email',
        ]);

        Contacts::save($request->all());

        return redirect()->action('Admin\ContactsController@getIndex');
    }
}
