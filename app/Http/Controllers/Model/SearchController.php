<?php

namespace App\Http\Controllers\Model;

use App\Http\Controllers\Controller;

use Auth;

use App\User;
use Languages;
use App\Profile;

use Session;
use Request as GlobalRequest;

use Settings;

use Illuminate\Http\Request;


class SearchController extends Controller
{
	public function index(Profile $profileModel)
	{
//		$profile =  $profileModel->availableLanguages();

		$names = array();
		if($profileModel){

//			$profile_image = $profileModel->image;
			return view('new_search')->with(['profile' => $profileModel,  'names'=>$names ]);
		}
	}

	public function search(Profile $profileModel, Request $request, User $userModel)
	{
		if($request->all()==null){
			return redirect()->to('go');

		}
		
		$location = $request->input('nationality');
		$age = $request->input('age');
		$haircolor = $request->input('haircolor');
		$breast_number = $request->input('breast_number');
		$breast_letter = $request->input('breast_letter');
		$name = $request->input('name');
		$have_picture = $request->input('has_picture');
		$no_picture = $request->input('no_picture');
		$has_picture = $request->input('has_picture');

		if($profileModel){
			$profile= Profile::ofLocation($location, $request)->
			ofAge($age, $request)->
			ofName($name, $request)->
			ofHaircolor($haircolor, $request)->
			ofBreast_number($breast_number, $request)->
//			ofNo_picture($no_picture, $request)->
//			ofHas_picture($has_picture, $request)->
			ofBreast_letter($breast_letter, $request)->
			orderBy('age')
				->paginate(15);
//			->toSql();

//			dd($profile);
			return view('result_search')->with(['profile' => $profileModel, 'search_profile' => $profile ]);
		}
	}




	public function findModel(Request $request, Profile $profileModel )
	{
		$models=$profileModel->get();
		foreach ( $models as $item) {
			$names[] = $item['name'];
		}
		return response()->json([
			'auth' => 'success',
			'fields' => $names
		]);


	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  Request  $request
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
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
	public function update(Request $request, $id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}
}
