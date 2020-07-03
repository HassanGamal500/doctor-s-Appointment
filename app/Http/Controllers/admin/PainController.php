<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PainController extends Controller
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
        $pains = DB::table('pains')->orderBy('pain_id', 'desc')->get();
        return view('admin.pain.index', compact('pains'));
    }

    public function create(){
        return view('admin.pain.create');
    }

    public function store(Request $request){
        $validator = validator()->make($request->all(), [
            'pain_name' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }
        
        $pain = DB::table('pains')
            ->insertGetId([
                'pain_name'	=> $request->pain_name,
            ]);


        $message = 'Inserted Successfully';

        return Redirect::back()->with('message', $message);

    }

    public function edit($id){
        $pain = DB::table('pains')->where('pain_id', '=', $id)->first();
        
        return view('admin.pain.edit', compact('pain'));
    }

    public function update(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'pain_name' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }
        
        $pain = DB::table('pains')
            ->where('pain_id', '=', $id)
            ->update([
                'pain_name' => $request->pain_name,
            ]);

        $message = 'Updated Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function destroy(Request $request, $id){
        $pain = DB::table('pains')->where('pain_id', '=', $id)->delete();
    }
}
