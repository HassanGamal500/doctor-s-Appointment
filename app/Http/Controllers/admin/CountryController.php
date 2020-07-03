<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class CountryController extends Controller
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
        $countries = DB::table('countries')->orderBy('country_id', 'desc')->get();
        return view('admin.country.index', compact('countries'));
    }

    public function create(){
        return view('admin.country.create');
    }

    public function store(Request $request){
        $validator = validator()->make($request->all(), [
            'country_name' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->withInput($request->all())->with('error', $error);
        }
        
        $pain = DB::table('countries')
            ->insertGetId([
                'country_name'	=> $request->country_name,
            ]);


        $message = 'Inserted Successfully';

        return Redirect::back()->with('message', $message);

    }

    public function edit($id){
        $country = DB::table('countries')->where('country_id', '=', $id)->first();
        
        return view('admin.country.edit', compact('country'));
    }

    public function update(Request $request, $id){
        $validator = validator()->make($request->all(), [
            'country_name' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return Redirect::back()->with('error', $error);
        }
        
        $country = DB::table('countries')
            ->where('country_id', '=', $id)
            ->update([
                'country_name' => $request->country_name,
            ]);

        $message = 'Updated Successfully';

        return Redirect::back()->with('message', $message);
    }

    public function destroy(Request $request, $id){
        $country = DB::table('countries')->where('country_id', '=', $id)->delete();
    }
}
