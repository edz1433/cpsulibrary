<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Campus;
use App\Models\Setting;

class UserController extends Controller
{
    //
    public function userRead() {
        $user = User::all();

        return view("user.list", compact('user'));
    }

    public function userCreate(Request $request) {
        $request->validate([
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'gender' => 'required',
            'username' => 'required|unique:users,username',
            'password' => 'required',
            'role' => 'required',
        ]);

        $userName = $request->input('username'); 
        $existingUser = User::where('username', $userName)->first();

        if ($existingUser) {
            return redirect()->route('userRead')->with('error', 'User already exists!');
        }

        try {
            User::create([
                'lname' => $request->input('lname'),
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'gender' => $request->input('gender'),
                'username' => $userName,
                'password' => Hash::make($request->input('password')),
                'role' => $request->input('role'),
            ]);

            return redirect()->route('userRead')->with('success', 'User stored successfully!');
        } catch (\Exception $e) {
            return redirect()->route('userRead')->with('error', 'Failed to store user!');
        }
    }

    public function userEdit($id) {
        $user = User::all();

        $selectedUser = User::find($id);

        return view('user.list', compact('user', 'selectedUser'));
    }

    public function userUpdate(Request $request) {
        $request->validate([
            'id' => 'required',
            'lname' => 'required',
            'fname' => 'required',
            'mname' => 'required',
            'gender' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
        ]);

        try {
            $userName = $request->input('username');
            $existingUser = User::where('username', $userName)->where('id', '!=', $request->input('id'))->first();

            if ($existingUser) {
                return redirect()->back()->with('error', 'User already exists!');
            }

            $user = User::findOrFail($request->input('id'));
            $user->update([
                'lname' => $request->input('lname'),
                'fname' => $request->input('fname'),
                'mname' => $request->input('mname'),
                'gender' => $request->input('gender'),
                'username' => $userName,
                'password' => Hash::make($request->input('password')),
                'role' => $request->input('role'), 
            ]);

            return redirect()->route('userEdit', ['id' => $user->id])->with('success', 'Updated Successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to update User!');
        }
    }
    public function userDelete($id){
        $users = User::find($id);
        $users->delete();

        return response()->json([
            'status'=>200,
            'uid'=>$id,
        ]);
    }

    public function appLogin(Request $request)
    {
        $credentials = $request->only('uname', 'pass');
        $uname = $credentials['uname'];
        $pass = $credentials['pass'];

        if (Auth::attempt(['username' => $uname, 'password' => $pass])) {
            $user = Auth::user();

            $token = ([
                'id' => $user->id,
                'fname' => $user->fname,
                'lname' => $user->lname
            ]);
    
            return response()->json(['token' => $token]);
        }

        return response()->json(['error' => '0'], 401);
    }
}
