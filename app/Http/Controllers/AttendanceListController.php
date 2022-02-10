<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Rest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;


class AttendanceListController extends Controller
{
    public function index(Request $request){
        //Auth::check();
        $user = Auth::user();
        $user_id = Auth::id();
        $date = Carbon::today()->format("Y-m-d");


        $attendance = Attendance::where('user_id',$user_id)->latest()->first();
        $timeStamp = Rest::where('attendance_id',$attendance->id)->latest()->first();

        //$rests = DB::table('rests')
        //->selectRaw('date_format(breake_begin_time,"%Y%m%d") as today')
        //->selectRaw('sum(breake_end_time - breake_begin_time)')
        //->groupBy('attendance_id','today')
        //->get();

        $items = Attendance::whereDate('begin_time', $date)->paginate(5);

        return view('attendance',['today'=>$date,'items'=>$items]);
    }

    public function attendanceDate(Request $request){
        Auth::check();
        //$user = Auth::user();
        $user_id = Auth::id();
        $date = Carbon::today()->format("Y-m-d");

        $nowdate = $request->input('today');
        $dayflg = $request->input('dayflg');

        if ($dayflg == "next") {
            $date = date("Y-m-d", strtotime($nowdate . "+1 day"));
        } else if ($dayflg == "back") {
            $date = date("Y-m-d", strtotime($nowdate . "-1 day"));
        }

        $attendance = Attendance::where('user_id', $user_id)->latest()->first();
        $timeStamp = Rest::where('attendance_id', $attendance->id)->latest()->first();

        $rests = DB::table('rests')
            ->selectRaw('date_format(breake_begin_time,"%Y%m%d") as today')
            ->selectRaw('sum(breake_end_time - breake_begin_time)')
            ->groupBy('attendance_id', 'today')
            ->get();


        $items = Attendance::whereDate('begin_time', $date)->with('user')->paginate(5);

        return view('attendance', ['today' => $date, 'items' => $items]);
    }
}
