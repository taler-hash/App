<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use DB;
use Session;
class loginController extends Controller
{
    public function login(Request $request){
        $checkTableadmin = DB::table('admin')
        ->where('username', $request->username)
        ->where('password', $request->password)->get();
        if($checkTableadmin->isNotEmpty())
        {
            session(['name'=> $request->username ,'data'=> $checkTableadmin->pluck('type')->implode(', ')]);
            dd("Admin");
            return response()->json("success");
        }
        else
        {
            $checkTablemanager = DB::table('admin')
            ->where('username', $request->username)
            ->where('password', $request->password)->get();

            $checkTableusers = DB::table('users')
            ->where('student_id', $request->username)
            ->where('password', $request->password)->get();

            if($checkTablemanager->isNotEmpty())
            {
                session(['name'=> $request->username ,'data'=> $checkTablemanager->pluck('type')->implode(', ')]);
                dd("Manager");
                return response()->json("success");
            }
            if($checkTableusers->isNotEmpty())
            {
                session(['name'=> $request->username ,'data'=> 'student']);
                dd("Student");
                return response()->json("success");
            }
            return response()->json("fail");
        }
        
    }
}
