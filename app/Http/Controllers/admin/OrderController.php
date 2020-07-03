<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
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
        $orders = DB::table('orders')
        	->select('order_id', 'patient_id', 'pain_id', 'order_comment as comment', 'created_at', 'status_id')
        	->orderBy('order_id', 'desc')
        	->get();
        foreach ($orders as $order) {
        	$patient = DB::table('users')
        		->where('id', '=', $order->patient_id)
        		->select('id', 'username', 'phone', 'email', 'gender')
        		->first();
        	$order->patientInfo = $patient;
        	$pain = DB::table('pains')->where('pain_id', '=', $order->pain_id)->select('pain_name')->first();
        	$order->PainInfo = $pain;
        }

        $orderSeen = DB::table('orders')->update(['order_read' => 1]);
        // dd($orders);
        return view('admin.order.index', compact('orders'));
    }

    public function getOrders(){
        $orders = DB::table('orders')->where('order_read', '=', 0)->count();
        return response()->json($orders);
    }

    public function order_notify(){
        $orders = DB::table('orders')->where('notify_read', '=', 0)->count();
        $update = DB::table('orders')->where('notify_read', '=', 0)->update(['notify_read' => 1]);
        return response()->json($orders);
    }

    public function getNotifications(){
        $orders = DB::table('orders')->where('order_read', '=', 0)->count();
        $appointments = DB::table('appointments')->where('appointment_read', '=', 0)->count();
        $plus = $orders + $appointments;
        return response()->json($plus);
    }
}
