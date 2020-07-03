<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class DoctorController extends Controller
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
        $doctors = DB::table('doctors')->orderBy('doctor_id', 'desc')->get();
        return view('admin.doctor.index', compact('doctors'));
    }

    public function create(){
        $specializations = DB::table('specialization')->select('specialize_id as id', 'specialize_title as name')->get();
        return view('admin.doctor.create', compact('specializations'));
    }

    public function store(Request $request){

    	$messages = [
            'phone.regex' => 'phone must contain only numbers',
            'email.regex' => 'enter your email like example@gmail.xyz',
            'password.regex' => 'password must contain letters, numbers and symbols',
        ];

        $validator = validator()->make($request->all(), [
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'phone' => 'required|regex:/[0-9]/u|max:15|unique:doctors,doctor_phone',
            'email' => 'required|unique:doctors,doctor_email|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
            'specialization' => 'required|exists:specialization,specialize_id',
            'doctor_start' => 'required|date_format:H:i',
            'doctor_end' => 'required|date_format:H:i|after:doctor_start',
            'password' => 'required|min:6|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])/',
        ], $messages);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        if(filter_var(filter_var(strtolower($request->email), FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)){
            $doctors = DB::table('doctors')
	            ->insertGetId([
	                'doctor_first_name' => $request->first_name,
	                'doctor_last_name' => $request->last_name,
	                'doctor_phone' => convert($request->phone),
	                'doctor_email' => strtolower($request->email),
	                'specialization_id' => $request->specialization,
	                'doctor_start' => $request->doctor_start,
	                'doctor_end' => $request->doctor_end,
	            ]);

            $admin = DB::table('administrations')->insert([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => strtolower($request->email),
                'phone' => convert($request->phone),
                'password' => Hash::make($request->password),
                'type' => 2,
                'type_id' => $doctors
            ]);
        } else {
            $error = 'your email is not correct';
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        $message = 'Inserted Successfully';

        return Redirect::back()->with('message', $message);

    }

    public function edit($id){
        $doctors = DB::table('doctors')->where('doctor_id', '=', $id)->first();

        $specializations = DB::table('specialization')->select('specialize_id as id', 'specialize_title as name')->get();

        return view('admin.doctor.edit', compact('doctors', 'specializations'));
    }

    public function update(Request $request, $id){
    	$messages = [
            'phone.regex' => 'phone must contain only numbers',
            'email.regex' => 'enter your email like example@gmail.xyz',
            'password.regex' => 'password must contain letters, numbers and symbols',
        ];

        $validator = validator()->make($request->all(), [
            'first_name' => 'required|string|max:25',
            'last_name' => 'required|string|max:25',
            'phone' => 'required|regex:/[0-9]/u|max:15|unique:doctors,doctor_phone,'.$id.',doctor_id',
            'email' => 'required|email|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix|unique:doctors,doctor_email,'.$id.',doctor_id',
            'specialization' => 'required|exists:specialization,specialize_id',
            'doctor_start' => 'required|date_format:H:i:s',
            'doctor_end' => 'required|date_format:H:i:s|after:doctor_start',
            'password' => 'nullable|min:6|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])/',
        ], $messages);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }

        $email = strtolower($request->email);
        
        if(filter_var(filter_var($email, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL)){
            $doctors = DB::table('doctors')
                ->where('doctor_id', '=', $id)
                ->update([
                    'doctor_first_name' => $request->first_name,
	                'doctor_last_name' => $request->last_name,
	                'doctor_phone' => convert($request->phone),
	                'doctor_email' => strtolower($request->email),
	                'specialization_id' => $request->specialization,
	                'doctor_start' => $request->doctor_start,
	                'doctor_end' => $request->doctor_end
                ]);

            if($request->password) {
                $admin = DB::table('administrations')->where('type_id', '=', $id)
                ->update([
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => strtolower($request->email),
                    'phone' => convert($request->phone),
                    'password' => Hash::make($request->password)
                ]);
            } else {
                $admin = DB::table('administrations')->where('type_id', '=', $id)
                ->update([
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => strtolower($request->email),
                    'phone' => convert($request->phone)
                ]);
            }
                
        } else {
            $error = 'your email is not correct';
            return Redirect::back()->with('error', $error);
        }

        $message = 'Updated Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function destroy(Request $request, $id){
        $doctors = DB::table('doctors')->where('doctor_id', '=', $id)->delete();
        $admin = DB::table('administrations')->where('type_id', '=', $id)->delete();
    }
}
