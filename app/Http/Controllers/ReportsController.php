<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monitoring;
use PDF;

class ReportsController extends Controller
{
    public function reportsForm(Request $request){
        $user_type = $request->user_type;
        $date1 = $request->date1;
        $date2 = $request->date2;

        return view('reports.reports-form', compact('date1', 'date2', 'user_type'));
    }

    public function reportsPdf(Request $request){
        $user_type = $request->user_type;
        $date1 = $request->date1;
        $date2 = $request->date2;
        
        $datas = Monitoring::join('lib_visits', 'monitorings.s_id', '=', 'lib_visits.id')
        ->leftJoin('offices', 'offices.id', '=', 'lib_visits.office')
        ->leftJoin('campuses', 'campuses.id', '=', 'lib_visits.campus')
        ->select('lib_visits.*', 'monitorings.date', 'monitorings.time_in', 'monitorings.time_out', \DB::raw('COALESCE(offices.office_name, "No Office") as office_name'), \DB::raw('COALESCE(campuses.campus_name, "No Campus") as campus_name'))
        ->where('monitorings.date', '>=', $date1)
        ->where('monitorings.date', '<=', $date2);
        
        if ($date1 != $date2) {
            $datas->whereDate('monitorings.date', '>=', $date1);
            $datas->whereDate('monitorings.date', '<=', $date2);
        } else {
            $datas->whereDate('monitorings.date', $date1);
        }
        
        if ($user_type !== 'All') {
            $datas->where('lib_visits.user_type', '=', $user_type);
        }
        
        $datas = $datas->get();
        
        $pdf = PDF::loadView('reports.reports-pdf-all', compact('datas', 'user_type'))->setPaper('Legal', 'portrait');
        return $pdf->stream();
    }
    
    

    public function reportsGenerate(){
        
    }
}
