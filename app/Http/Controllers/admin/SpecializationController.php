<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class SpecializationController extends Controller
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
        $specializations = DB::table('specialization')->orderBy('specialize_id', 'desc')->get();
        return view('admin.specialization.index', compact('specializations'));
    }

    public function create(){
        return view('admin.specialization.create');
    }

    public function store(Request $request){
        $validator = validator()->make($request->all(), [
            'specialize_title' => 'required|string|max:50',
            'specialize_description' => 'required|string|max:120',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }
        
        $specialization = DB::table('specialization')
            ->insertGetId([
                'specialize_title' 			=> $request->specialize_title,
                'specialize_description' 	=> $request->specialize_description,
            ]);


        $message = 'Inserted Successfully';

        return Redirect::back()->with('message', $message);

    }

    public function edit($id){
        $specialization = DB::table('specialization')->where('specialize_id', '=', $id)->first();
        
        return view('admin.specialization.edit', compact('specialization'));
    }

    public function update(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'specialize_title' => 'required|string|max:50',
            'specialize_description' => 'required|string|max:120',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }
        
        $specialization = DB::table('specialization')
            ->where('specialize_id', '=', $id)
            ->update([
                'specialize_title' => $request->specialize_title,
                'specialize_description' => $request->specialize_description,
            ]);

        $message = 'Updated Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function destroy(Request $request, $id){
        $specialization = DB::table('specialization')->where('specialize_id', '=', $id)->delete();
    }
}
