<?php

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


function notificationCount(){
  if(auth()->guard('admin')->user()->type == 1){
   $orders = DB::table('orders')->where('order_read', '=', 0)->count();
  } else {
    $orders = 0;
  }
  $appointment = DB::table('appointments')->where('appointment_read', '=', 0)->count();
  return $orders + $appointment;
}

function orderCount(){
	$orders = DB::table('orders')->where('order_read', '=', 0)->count();
	return $orders;
}

function appointmentCount(){
  if(auth()->guard('admin')->user()->type == 1){
    $appointment = DB::table('appointments')->where('appointment_read', '=', 0)->count();
  } else {
    $appointment = DB::table('appointments')
      ->where('appointment_read', '=', 0)
      ->where('doctor_id', '=', auth()->guard('admin')->user()->type_id)
      ->count();
  } 
	 
	return $appointment;
}

function convert($string) {
    $arabic = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩',','];
    $num = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.'];
    $englishNumbersOnly = str_replace($arabic, $num, $string);

    return $englishNumbersOnly;
}

function setActive($path)
{
    return Request::is($path . '*') ? ' active' :  '';
}

function checkOrder() {
	$orders = DB::table('orders')->where('status_id', '=', 1)->count();
	return $orders;
}

