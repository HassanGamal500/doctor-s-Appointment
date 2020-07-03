<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\AdminsPush;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$pains = DB::table('pains')->select('pain_id as id', 'pain_name as name')->get();
        return view('website.makeOrder', compact('pains'));
    }

    public function makeOrder(Request $request) {

        $id = auth()->user()->id;

        $validator= validator()->make($request->all(),[
        	'pain' => 'required|exists:pains,pain_id',
        	'comment' => 'nullable',
        ]);

        if ($validator->fails()){
            $response = [
                'status' => 0,
                'message' => $validator->errors()->first(),
                'data' => []
            ];
            return response()->json($response);
        }

	    date_default_timezone_set('Africa/Cairo');
   
        $order = DB::table('orders')->insertGetId([
            'patient_id'        => $id,
            'pain_id'           => $request->pain,
            'order_comment'     => $request->comment,
            'status_id'         => 1,
            'created_at'		=> date('Y/m/d H:i:s')
        ]);

        $sendNotification = new AdminsPush();

        $getTokens = DB::table('administrations')->where('type', '=', 1)->select('firebase_token')->get();

        foreach($getTokens as $token){
            $tokens[] = $token->firebase_token;
        }

        $sendNotification->send($tokens, 'New Order', 'You Have a New Order With Patient', asset('bg-02.jpg'), 'bg-02.jpg', '/admin/orders', '1');
	    
	    return $order;
    }
}
