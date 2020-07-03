<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index(){
        $results = array();

        $patients = DB::table('users')->count();
        $doctors = DB::table('doctors')->count();
        $newOrders = DB::table('orders')->where('status_id', '=', 1)->count();
        $orderFinished = DB::table('orders')->where('status_id', '=', 4)->count();
        if(auth()->guard('admin')->user()->type == 1){
            $appointments = DB::table('appointments')->count();
        } else {
            $appointments = DB::table('appointments')->where('doctor_id', '=', auth()->guard('admin')->user()->type_id)->count();
        }
        $specialization = DB::table('specialization')->count();
        $pains = DB::table('pains')->count();
        $countries = DB::table('countries')->count();

        $results['patients'] = $patients;
        $results['doctors'] = $doctors;
        $results['newOrders'] = $newOrders;
        $results['orderFinished'] = $orderFinished;
        $results['appointments'] = $appointments;
        $results['specialization'] = $specialization;
        $results['pains'] = $pains;
        $results['countries'] = $countries;

        return view('admin.dashboard.index', compact('results'));
    }
}
