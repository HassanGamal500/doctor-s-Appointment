<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PatientController extends Controller
{
    protected $user;
    
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = auth()->guard('admin')->user()->type;
            if(auth()->guard('admin')->user()->type != 1){
                return abort(404);
            }
            return $next($request);
        });
    }
    
    public function index(){
        $users = DB::table('users')
            ->select('id', 'username', 'phone', 'email')
            ->orderBy('id', 'desc')
            ->get();
        return view('admin.patient.index', compact('users'));
    }

    public function create(){
        $countries = DB::table('countries')->select('country_id as id', 'country_name as name')->get();
        return view('admin.patient.create', compact('countries'));
    }

    public function store(Request $request){

    	$messages = [
    		'username.regex' => 'Username must Must start with letter and 6-32 characters and Must Contains Letters and numbers only',
            'phone.regex' => 'phone must contain only numbers',
            'email.regex' => 'enter your email like example@gmail.xyz',
            'password.regex' => 'password must contain letters, numbers and symbols',
        ];

        $validator = validator()->make($request->all(), [
            'username' => 'required|unique:users,username|regex:/^[A-Za-z][A-Za-z0-9]{5,31}$/',
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'phone' => 'required|regex:/[0-9]/u|max:15|unique:users,phone',
            'email' => 'required|unique:users|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'birth_of_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'country' => 'required|exists:countries,country_id',
            'occupation' => 'nullable|max:50',
            'password' => 'required|min:6|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])/',
        ], $messages);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        if(filter_var(filter_var(strtolower($request->email), FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)){
            $users = DB::table('users')
	            ->insertGetId([
	                'username' => $request->username,
	                'email' => strtolower($request->email),
	                'first_name' => $request->first_name,
	                'last_name' => $request->last_name,
	                'phone' => convert($request->phone),
	                'birth_of_date' => $request->birth_of_date,
	                'gender' => $request->gender,
	                'country_id' => $request->country,
	                'occupation' => $request->occupation,
	                'password' => Hash::make($request->password) 
	            ]);
        } else {
            $error = 'your email is not correct';
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        $message = 'Inserted Successfully';

        return Redirect::back()->with('message', $message);

    }

    public function edit($id){
        $patients = DB::table('users')->where('id', '=', $id)->first();
        
        $countries = DB::table('countries')
            ->select('countries.country_id as id', 'country_name as name')
            ->get();

        return view('admin.patient.edit', compact('patients', 'countries'));
    }

    public function update(Request $request, $id){
    	$messages = [
    		'username.regex' => 'Username must Must start with letter and 6-32 characters and Must Contains Letters and numbers only',
            'phone.regex' => 'phone must contain only numbers',
            'email.regex' => 'enter your email like example@gmail.xyz',
            'password.regex' => 'password must contain letters, numbers and symbols',
        ];

        $validator = validator()->make($request->all(), [
            'username' => 'required|regex:/^[A-Za-z][A-Za-z0-9]{5,31}$/|unique:users,username,'.$id,
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'phone' => 'required|regex:/[0-9]/u|max:15|unique:users,phone,'.$id,
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:users,email,'.$id,
            'birth_of_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'country' => 'required|exists:countries,country_id',
            'occupation' => 'nullable|max:50',
            'password' => 'nullable|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])/',
        ], $messages);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }

        $email = strtolower($request->email);
        
        if(filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)){
            $users = DB::table('users')
                ->where('id', '=', $id)
                ->update([
                    'username' => $request->username,
	                'email' => strtolower($request->email),
	                'first_name' => $request->first_name,
	                'last_name' => $request->last_name,
	                'phone' => convert($request->phone),
	                'birth_of_date' => $request->birth_of_date,
	                'gender' => $request->gender,
	                'country_id' => $request->country,
	                'occupation' => $request->occupation,
                ]);
        } else {
            $error = 'your email is not correct';
            return Redirect::back()->with('error', $error);
        }

        if ($request->password) {
            $users = DB::table('users')
                ->where('id', '=', $id)
                ->update(['password' => Hash::make($request->password)]);
        }

        $message = 'Updated Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function destroy(Request $request, $id){
        $users = DB::table('users')->where('id', '=', $id)->delete();
    }
}
