<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AdminsPush;

class DoctorAppointmentController extends Controller
{
    protected $user;
    
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = auth()->guard('admin')->user()->type;
            if(auth()->guard('admin')->user()->type != 2){
                return abort(404);
            }
            return $next($request);
        });
    }
    
    public function index(){
    	$id = auth()->guard('admin')->user()->type_id;

        $appointments = DB::table('appointments')
        	->where('doctor_id', '=', $id)
        	->orderBy('appointment_id', 'asc')
        	->get();

        foreach ($appointments as $appointment) {
        	$patient = DB::table('users')
        		->where('id', '=', $appointment->patient_id)
        		->select('username', 'phone', 'email', 'gender')
        		->first();
        	$appointment->patientInfo = $patient;
        }

        return view('admin.doctorAppointment.index', compact('appointments'));
    }

    public function changeStatus(Request $request) {

        $id = auth()->guard('admin')->user()->type_id;

	    date_default_timezone_set('Africa/Cairo');
   
        $appointment = DB::table('appointments')
        	->where('appointment_id', '=', $request->appointment_id)
        	->update([
	            'status_id'	=> $request->status_id,
	            'updated_at' => date('Y/m/d H:i:s')
	        ]);

	    $history = DB::table('status_history')->insert([
	    	'appointment_id' 	=> $request->appointment_id,
	    	'status_id'			=> $request->status_id,
	    	'created_at'		=> date('Y/m/d H:i:s')
	    ]);

        if($request->status_id == 3) {
            $sendNotification = new AdminsPush();

            $getTokens = DB::table('administrations')->where('type', '=', 1)->select('firebase_token')->get();

            foreach($getTokens as $token){
                $tokens[] = $token->firebase_token;
            }

            $sendNotification->send($tokens, 'Appointment Rejected', 'The Doctor Rejected This Appointment', asset('bg-02.jpg'), 'bg-02.jpg', '/admin/appointments', '3');
        }
	    
	    return $appointment;
    }
}
