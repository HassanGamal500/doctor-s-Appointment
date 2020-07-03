<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$id = auth()->user()->id;
    	$getUser = DB::table('users')->where('id', '=', $id)->first();
    	$getCountry = DB::table('countries')->select('country_id as id', 'country_name as name')->get();
        return view('website.profile', compact('getUser', 'getCountry'));
    }

    public function updateProfile(Request $request) {

        $id = auth()->user()->id;

        $messages = [
            'phone.regex' => 'phone must contain only numbers',
            'email.regex' => 'enter your email like example@gmail.xyz',
            'password.regex' => 'password must contain letters, numbers and symbols',
        ];

        $validator= validator()->make($request->all(),[
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'phone' => 'required|regex:/[0-9]/u|max:15|unique:users,phone,'.$id,
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users,email,'.$id,
        	'birth_of_date' => 'required|date',
        	'gender' => 'required|in:male,female',
        	'country' => 'required|exists:countries,country_id',
        	'occupation' => 'nullable|max:50',
            'password' => 'nullable|min:6|confirmed|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])/',
        ], $messages);

        if ($validator->fails()){
            $response = [
                'status' => 0,
                'message' => $validator->errors()->first(),
                'data' => []
            ];
            return response()->json($response);
        }

	    if($request->new_password != null){
	        $update = DB::table('users')->where('id', '=', $id)->update([
	            'first_name'        => $request->first_name,
	            'last_name'         => $request->last_name,
	            'phone'             => $request->phone,
	            'email'             => $request->email,
	            'birth_of_date'		=> $request->birth_of_date,
	            'gender' 			=> $request->gender,
	            'country_id'		=> $request->country,
	            'occupation'		=> $request->occupation,
	            'password'          => Hash::make($request->new_password)
	        ]);
	    } else {
	        $update = DB::table('users')->where('id', '=', $id)->update([
	            'first_name'        => $request->first_name,
	            'last_name'         => $request->last_name,
	            'phone'             => $request->phone,
	            'email'             => $request->email,
	            'birth_of_date'		=> $request->birth_of_date,
	            'gender' 			=> $request->gender,
	            'country_id'		=> $request->country,
	            'occupation'		=> $request->occupation
	        ]);
	    }
	    
	    return $update;
        
    }
}
