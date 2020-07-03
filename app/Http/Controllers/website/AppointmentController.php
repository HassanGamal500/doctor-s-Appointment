<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\AdminsPush;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$id = auth()->user()->id;
    	$appointments = DB::table('appointments')->where('patient_id', '=', $id)->get();
    	foreach ($appointments as $appointment) {
    		$doctorInfo = DB::table('doctors')->where('doctor_id','=', $appointment->doctor_id)->first();
    		$appointment->doctorInfo = $doctorInfo;
    	}
        return view('website.appointment', compact('appointments'));
    }

    public function changeStatus(Request $request) {

        $id = auth()->user()->id;

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

            $sendNotification->send($tokens, 'Appointment Rejected', 'The Patient Rejected This Appointment', asset('bg-02.jpg'), 'bg-02.jpg', '/admin/appointments', '3');
        }
	    
	    return $appointment;
    }
}
