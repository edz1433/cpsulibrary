<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\libVisit;
use App\Models\Monitoring;
use App\Models\Office;
use Carbon\Carbon;

class MonitoringController extends Controller
{
    public function monitorRead(){
        $monitorings = Monitoring::join('lib_visits', 'lib_visits.id', '=', 'monitorings.s_id')
                ->select('monitorings.*', 'lib_visits.*')
                ->get();

        return view('monitoring.mon-list', compact('monitorings'));  
    }   

    public function getUserType(Request $request)
    {
        $userType = $request->input('userType');
        $users = libVisit::where('user_type', $userType)->get();

        return response()->json($users);
    }

    public function logAttendance(Request $request)
    {
        $bcodeScan = $request->input('bcodeScan');
        $currentDate = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->format('H:i:s');

        $student = libVisit::where('s_id', $bcodeScan)->first();

        if ($student) {
            $incompleteRecord = Monitoring::where('s_id', $student->id)
                ->where('date', $currentDate)
                ->where('status', 'incomplete')
                ->first();

            if ($incompleteRecord) {
                $incompleteRecord->time_out = $currentTime;
                $incompleteRecord->status = 'completed';
                $incompleteRecord->save();
                // return response()->json(['message' => 'Log Out']);
                return 'Log out';
            } else {
                Monitoring::create([
                    's_id' => $student->id,
                    'date' => $currentDate,
                    'time_in' => $currentTime,
                    'status' => 'incomplete'
                ]);
                // return response()->json(['message' => 'Log In']);
                return 'Log In';
            }
        } else {
            // return response()->json(['message' => 1], 404);
            return '0';
        }
    }

    public function logAttendanceManual(Request $request)
    {
        $utype = $request->user_type;
        $action = $request->action;
        $visit_id = $request->input('visit_id');
        $currentDate = Carbon::now()->format('Y-m-d');
        $currentTime = Carbon::now()->format('H:i:s');


        if($action == "in"){
            if($utype == 'Students' || $utype == 'Faculty'){
                $incompleteRecord = Monitoring::where('s_id', $visit_id)
                    ->where('date', $currentDate)
                    ->where('status', 'incomplete')
                    ->first();
                if ($incompleteRecord) {
                    $incompleteRecord->time_out = $currentTime;
                    $incompleteRecord->status = 'completed';
                    $incompleteRecord->save();
                    return redirect()->back()->with('success1','Time-in');
                } else {
                    Monitoring::create([
                        's_id' => $visit_id,
                        'date' => $currentDate,
                        'time_in' => $currentTime,
                        'status' => 'incomplete'
                    ]);
                    return redirect()->back()->with('success1','Time-out');
                }
            }
            elseif($utype == 'Staff' || $utype == 'Visitor'){
                Monitoring::create([
                    's_id' => $visit_id,
                    'date' => $currentDate,
                    'time_in' => $currentTime,
                    'lname' => $request->lname,
                    's_fname' => $request->s_fname,
                    's_mname' => $request->s_mname,
                    'status' => 'incomplete'
                ]);

                Monitoring::create([
                    's_id' => $visit_id,
                    'date' => $currentDate,
                    'time_in' => $currentTime,
                    'lname' => $request->lname,
                    's_fname' => $request->s_fname,
                    's_mname' => $request->s_mname,
                    'status' => 'incomplete'
                ]);
                return redirect()->back()->with('success1','Time-inssss');
            }
        }

        if($action == "out"){
            $incompleteRecord = Monitoring::where('s_id', $visit_id)
            ->where('date', $currentDate)
            ->where('status', 'incomplete')
            ->first();

            $incompleteRecord->time_out = $currentTime;
            $incompleteRecord->status = 'completed';
            $incompleteRecord->save();
            return redirect()->back()->with('success1','Time-in');
        }
    }
}
