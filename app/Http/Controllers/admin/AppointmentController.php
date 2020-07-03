<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\AdminsPush;

class AppointmentController extends Controller
{
    protected $user;
    
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->user = auth()->guard('admin')->user()->type;
            if(auth()->guard('admin')->user()->type != 1){
                return abort(404);
            }
            return $next($request);
        })->except('getAppointments');
    }
    
    public function index(){
        $appointments = DB::table('appointments')->orderBy('appointment_id', 'asc')->get();
        foreach ($appointments as $appointment) {
        	$patient = DB::table('users')
        		->where('id', '=', $appointment->patient_id)
        		->select('username', 'phone', 'email', 'gender')
        		->first();
        	$appointment->patientInfo = $patient;
        	$doctor = DB::table('doctors')
        		->where('doctor_id', '=', $appointment->doctor_id)
        		->select('doctor_first_name as first_name', 'doctor_last_name as last_name', 'doctor_phone as phone', 'doctor_email as email')
        		->first();
        	$appointment->doctorInfo = $doctor;
        }
        $appointmentSeen = DB::table('appointments')->update(['appointment_read' => 1]);
        return view('admin.appointment.index', compact('appointments'));
    }

    public function create(){
    	$patients = DB::table('users')->select('id', 'username')->get();
    	$doctors = DB::table('doctors')->select('doctor_id as id', 'doctor_first_name as first_name', 'doctor_last_name as last_name')->get();
        return view('admin.appointment.create', compact('patients', 'doctors'));
    }

    public function createOrder($id){
        $order = DB::table('orders')->where('order_id', '=', $id)->first();
        $patients = DB::table('users')->where('id', '=', $order->patient_id)->select('id', 'username')->get();
        $doctors = DB::table('doctors')->select('doctor_id as id', 'doctor_first_name as first_name', 'doctor_last_name as last_name')->get();
        return view('admin.appointment.create', compact('patients', 'doctors', 'order'));
    }

    public function store(Request $request){
        $validator = validator()->make($request->all(), [
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'patient' => 'required|exists:users,id',
            'doctor' => 'required|exists:doctors,doctor_id'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }

        date_default_timezone_set('Africa/Cairo');
        
        $appointments = DB::table('appointments')
            ->insertGetId([
                'appointment_date'	=> $request->appointment_date,
                'appointment_time'	=> $request->appointment_time,
                'patient_id'		=> $request->patient,
                'doctor_id'			=> $request->doctor,
                'status_id'			=> 1,
                'created_at'		=> date('Y/m/d H:i:s'),
            ]);

        $history = DB::table('status_history')->insert([
            'appointment_id'    => $appointments,
            'status_id'         => 1,
            'created_at'        => date('Y/m/d H:i:s')
        ]);

        if($request->order_done) {
            $orderUpdate = DB::table('orders')->where('order_id', '=', $request->order_done)->update([
                'status_id' => 4
            ]);
        }

        $sendNotification = new AdminsPush();
        //Patient
        $getTokens = DB::table('users')->where('id', '=', $request->patient)->select('firebase_token')->get();

        foreach($getTokens as $token){
            $tokens[] = $token->firebase_token;
        }

        $sendNotification->send($tokens, 'New Appointment', 'You Have a New Appointment With Doctor', asset('bg-02.jpg'), 'bg-02.jpg', '/appointment');

        //Doctor
        $getTokensAdmin = DB::table('administrations')->where('type_id', '=', $request->doctor)->select('firebase_token')->get();

        foreach($getTokensAdmin as $token){
            $tokensAdmin[] = $token->firebase_token;
        }

        $sendNotification->send($tokensAdmin, 'New Appointment', 'You Have a New Appointment With Patient', asset('bg-02.jpg'), 'bg-02.jpg', '/appointment');

        $message = 'Inserted Successfully';

        return Redirect::back()->with('message', $message);

    }

    public function edit($id){
        $appointment = DB::table('appointments')->where('appointment_id', '=', $id)->first();
        $patients = DB::table('users')->select('id', 'username')->get();
    	$doctors = DB::table('doctors')->select('doctor_id as id', 'doctor_first_name as first_name', 'doctor_last_name as last_name')->get();
        
        return view('admin.appointment.edit', compact('appointment', 'patients', 'doctors'));
    }

    public function update(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'appointment_date' => 'required|date',
            'appointment_time' => 'required|date_format:H:i',
            'patient' => 'required|exists:users,id',
            'doctor' => 'required|exists:doctors,doctor_id'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }
        
        $appointment = DB::table('appointments')
            ->where('appointment_id', '=', $id)
            ->update([
                'appointment_date'	=> $request->appointment_date,
                'appointment_time'	=> $request->appointment_time,
                'patient_id'		=> $request->patient,
                'doctor_id'			=> $request->doctor,
                'status_id'			=> 1,
            ]);

        $history = DB::table('status_history')->insert([
            'appointment_id'    => $id,
            'status_id'         => 1,
            'created_at'        => date('Y/m/d H:i:s')
        ]);

        $sendNotification = new AdminsPush();

        //Patient
        $getTokens = DB::table('users')->where('id', '=', $request->patient)->select('firebase_token')->get();

        foreach($getTokens as $token){
            $tokens[] = $token->firebase_token;
        }

        $sendNotification->send($tokens, 'New Appointment', 'You Have a New Appointment With Doctor', asset('bg-02.jpg'), 'bg-02.jpg', '/appointment');

        //Doctor
        $getTokensAdmin = DB::table('administrations')->where('type_id', '=', $request->doctor)->select('firebase_token')->get();

        foreach($getTokensAdmin as $token){
            $tokensAdmin[] = $token->firebase_token;
        }

        $sendNotification->send($tokensAdmin, 'New Appointment', 'You Have a New Appointment With Patient', asset('bg-02.jpg'), 'bg-02.jpg', '/appointment');


        $message = 'Updated Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function destroy(Request $request, $id){
        $appointment = DB::table('appointments')->where('appointment_id', '=', $id)->delete();
    }

    public function getAppointments(){
        if(auth()->guard('admin')->user()->type = 1){
            $appointments = DB::table('appointments')->where('appointment_read', '=', 0)->count();
        } else {
            $appointments = DB::table('appointments')->where('doctor_id', '=', auth()->guard('admin')->user()->type_id)->where('appointment_read', '=', 0)->count();
        }
            
        return response()->json($appointments);
    }

    public function appointment_notify(){
        $appointments = DB::table('appointments')->where('notify_read', '=', 0)->count();
        $update = DB::table('appointments')->where('notify_read', '=', 0)->update(['notify_read' => 1]);
        return response()->json($appointments);
    }
}
