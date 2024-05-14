<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\libVisit;
use App\Models\Monitoring;
use App\Models\Office;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class MonitoringController extends Controller
{
    public function monitorRead(){
        $monitorings = Monitoring::join('lib_visits', 'lib_visits.id', '=', 'monitorings.s_id')
                ->select('monitorings.*', 'lib_visits.*')
                ->get();

        return view('monitoring.mon-list', compact('monitorings'));  
    }   

    public function monitorReadPost(Request $request){
        $date1 = $request->date1;
        $date2 = $request->date2;
            
        $monitorings = Monitoring::join('lib_visits', 'monitorings.s_id', '=', 'lib_visits.id')
        ->leftJoin('offices', 'offices.id', '=', 'lib_visits.office')
        ->leftJoin('campuses', 'campuses.id', '=', 'lib_visits.campus')
        ->select('lib_visits.*', 'monitorings.date', 'monitorings.time_in', 'monitorings.time_out', \DB::raw('COALESCE(offices.office_name, "No Office") as office_name'), \DB::raw('COALESCE(campuses.campus_name, "No Campus") as campus_name'))
        ->where('monitorings.date', '>=', $date1)
        ->where('monitorings.date', '<=', $date2);

        $countmon = Monitoring::rightJoin('lib_visits', 'monitorings.s_id', '=', 'lib_visits.id')
        ->leftJoin('offices', 'offices.id', '=', 'lib_visits.office')
        ->select(\DB::raw('COALESCE(lib_visits.course, "No Course") as course'), 'lib_visits.user_type', \DB::raw('COUNT(monitorings.id) as count'))
        ->where('monitorings.date', '>=', $date1)
        ->where('monitorings.date', '<=', $date2)
        ->groupBy('course', 'lib_visits.user_type');
    
        if ($date1 === $date2) {
            $monitorings->whereDate('monitorings.date', '=', $date1);
            $countmon->whereDate('monitorings.date', '=', $date1);
        } else {
            $monitorings->whereDate('monitorings.date', '>=', $date1)
                        ->whereDate('monitorings.date', '<=', $date2);

            $countmon->whereDate('monitorings.date', '>=', $date1)
                        ->whereDate('monitorings.date', '<=', $date2);
        }
    
        $monitorings = $monitorings->get();

        $countmon = $countmon->get();
    
        return view('monitoring.mon-list', compact('monitorings', 'date1', 'date2', 'countmon'));  
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
                return 'Time out';
            } else {
                Monitoring::create([
                    's_id' => $student->id,
                    'date' => $currentDate,
                    'time_in' => $currentTime,
                    'status' => 'incomplete'
                ]);
                // return response()->json(['message' => 'Log In']);
                return 'Time In';
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

        if($utype == "Students" || $utype == "Faculty"){
            $validator = Validator::make($request->all(), [
                'visit_id' => 'required|integer',
            ]);

            $validator->setAttributeNames([
                'visit_id' => 'Name',
            ]);
        }
        if($utype == "Staff" || $utype == "Guest"){
            if(empty($visit_id)){
                $validator = Validator::make($request->all(), [
                    'lname' => 'required',
                    'fname' => 'required',
                    ($utype == "Staff") ? 'office' : 'campus' => ($utype == "Staff") ? 'required' : 'nullable',
                ]);

                $validator->setAttributeNames([
                    'lname' => 'Last Name',
                    'fname' => 'First Name',
                    ($utype == "Staff" ? 'office' : '') => ($utype == "Staff" ? 'Office Name' : ''),
                ]);                
            }
        }
        
        if(!empty($validator)){
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }
        }

        if($utype == 'Students' || $utype == 'Faculty'){
            
            $incompleteRecord = Monitoring::where('s_id', $visit_id)
                ->where('date', $currentDate)
                ->where('status', 'incomplete')
                ->first();

            if ($incompleteRecord) {
                $incompleteRecord->time_out = $currentTime;
                $incompleteRecord->status = 'completed';
                $incompleteRecord->save();
                return redirect()->back()->with('success','Time-out');
            } else {
                Monitoring::create([
                    's_id' => $visit_id,
                    'date' => $currentDate,
                    'time_in' => $currentTime,
                    'status' => 'incomplete'
                ]);
                return redirect()->back()->with('success','Time-in');
            }
        }
        elseif($utype == 'Staff' || $utype == 'Guest'){
            if($visit_id != ""){

                $incompleteRecord = Monitoring::where('s_id', $visit_id)
                ->where('date', $currentDate)
                ->where('status', 'incomplete')
                ->first();

                if ($incompleteRecord) {
                    $incompleteRecord->time_out = $currentTime;
                    $incompleteRecord->status = 'completed';
                    $incompleteRecord->save();
                    return redirect()->back()->with('success','Time-out');
                } else {
                    Monitoring::create([
                        's_id' => $visit_id,
                        'date' => $currentDate,
                        'time_in' => $currentTime,
                        'status' => 'incomplete'
                    ]);
                    return redirect()->back()->with('success','Time-in');
                }
            }
            else{
                $existingRecord = libVisit::where('lname', $request->lname)
                    ->where('fname', $request->fname)
                    ->where('mname', $request->mname)
                    ->first();

                if (!$existingRecord) {
                    $libVisit = libVisit::create([
                        'user_type' => $utype,
                        'lname' => $request->lname,
                        'fname' => $request->fname,
                        'mname' => $request->mname,
                        ($utype == 'Staff') ? 'office' : 'campus' => ($utype == 'Staff') ? $request->office : $request->campus,
                    ]);                        

                    $libVisitid = $libVisit->id;

                    Monitoring::create([
                        's_id' => $libVisitid,
                        'date' => $currentDate,
                        'time_in' => $currentTime,
                        'status' => 'incomplete'
                    ]);

                    return redirect()->back()->with('success','Time-in');
                }else{
                    
                }
            }
        }

    }
}
