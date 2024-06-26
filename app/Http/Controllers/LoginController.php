<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Office;
use App\Models\Campus;

class LoginController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

    public function loginUserView(){
        $campus = Campus::all();
        $offices = Office::all();
        return view('monitoring.log-user-view', compact('offices', 'campus'));
    }

    public function loginAuthenticate(Request $request)
    {
        $request->validate([
            'username'=>'required',
            'password'=>'required|min:5|max:12'
        ]);

        $validated=auth()->attempt([
            'username'=>$request->username,
            'password'=>$request->password,
        ],$request->password);

        if($validated){
            return redirect()->route('dashboard')->with('success','Login Successfully');
        }else{
            return redirect()->back()->with('error','Invalid Credentials');
        }
    }
}
