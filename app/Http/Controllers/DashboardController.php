<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\libVisit;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        $student = libVisit::where('user_type', 'Students')->get();
        $faculty = libVisit::where('user_type', 'Faculty')->get();
        $staff = libVisit::where('user_type', 'Staff')->get();
        $visitor = libVisit::where('user_type', 'Visitor')->get();

        $datavisit = [
            'student' => $student,
            'faculty' => $faculty,
            'staff' => $staff,
            'visitor' => $visitor,
        ];

        return view('home.dashboard', compact('datavisit'));
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('getLogin')->with('success','You have been Successfully Logged Out');
    }
}
