<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminsPush extends Controller {
    public function send($tokens, $title, $body, $icon, $image, $action, $type='2'){
        $server_key = 'AAAATQlWdiI:APA91bHLHLnnK5bBzQNZ8oXZ63YglIN2nIm1vIrpH9YqPazjf4BSfSABcYOq6Nt0I3I0eTL0KISqxn-drAQsdtoyFoDWgRjXYocsU_-rfm6Drl48EX1LfTpxDgNPe_kXQVMP8wRw1HtJ';

        $token = $tokens;
        $header =[
            'Authorization: key=' .$server_key,
            'Content-Type: application/json'
        ];
        
        $msg=[
            'title'=> $title,
            'body' => $body,
            'icon' => $icon,
            'image' => 'http://localhost:8000/' . $image,
            'click_action' => 'http://localhost:8000/' . $action,
            'type' => $type
        ];
        
        // Example 
        // $msg=[
        //     'title'=>'Testing Notification',
        //     'body' =>'Notification from Reservation',
        //     'icon' =>'images/user/avatar_user.png',
        //     'image' =>'https://reservationsa.com/beta/images/user/avatar_user.png',
        //     'click_action' =>'https://reservationsa.com/beta/admin',
        // ];
            
        $payload=[
            'registration_ids' => $token,
            'data'             => $msg,
        ];
                
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fcm.googleapis.com/fcm/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($payload),
            CURLOPT_HTTPHEADER =>$header
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

    }

    public function getToken(Request $request){
        $auth = auth()->guard('admin')->user()->id;
        $insertToken = DB::table('administrations')->where('id', '=', $auth)->update(['firebase_token' => $request->token]);
        return response()->json($insertToken);
    }

    public function getTokenWeb(Request $request){
        $authWeb = auth()->user()->id;
        $insertToken = DB::table('users')->where('id', '=', $authWeb)->update(['firebase_token' => $request->token]);
        return response()->json($insertToken);
    }
}

?>