<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceListController extends Controller
{
    public function index(Request $request){
        $user = Auth::user();
        $user_id = Auth::id();
        //$today = Attendance::get()->last();
        $date = Carbon::today()->format("Y-m-d");

        $attendance = Attendance::where('user_id',$user_id)->latest()->first();
        $timeStamp = Rest::where('attendance_id',$attendance->id)->latest()->first();

        $rests = DB::table('rests')
          ->selectRaw('date_format(breake_begin_time,"%Y%m%d") as today')
        ->selectRaw('sum(breake_end_time - breake_begin_time)')
        ->groupBy('attendance_id','today')
        ->get();
        //$rests = date('H:i:s',$rest);
        //$rests = DB::table('rests')->select('attendance_id','breake_begin_time','breake_end_time')->groupBy('attendance_id');

        $restBeginTime = new Carbon($timeStamp->breake_begin_time);
        $restEndTime = new Carbon($timeStamp->breake_end_time);
        $diff = $restEndTime->diffInSeconds($restBeginTime);
        $sumRests = date('H:i:s',$diff);
        //$restGroup = Rest::where('breake_begin_time','breake_begin_time')->groupBy('attendance_id')->first();
        //$breakeBeginTime = Rest::where('breake_begin_time')->groupBy('attendance_id')->all();
        //$breakeEndTime = Rest::where('breake_end_time')->groupBy('attendance_id')->all();

        //$diff = ($restGroup->'breake_behigin_time')->diffInSeconds($restGroup->breake_end_time);
        //$breakeTime = date('H:i:s',$diff);

        $restTime = Rest::wheredate('breake_begin_time',$timeStamp)->join('attendances','attendances.id','=','rests.attendance_id')->paginate(5)->items();

        $items = Attendance::whereDate('begin_time', $date)->join('users', 'users.id', '=', 'attendances.user_id')->paginate(5)->items();

        return view('attendance',['rests'=>$rests,'today'=>$date,'items'=>$items,'restTime'=>$restTime]);
    }

    public function attendanceDate(Request $request){
        $user = Auth::user();
        $user_id = Auth::id();

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


        $items = Attendance::whereDate('begin_time', $date)->join('users', 'users.id', '=', 'attendances.user_id')->paginate(5)->items();

        return view('attendance', ['items' => $items], ['today' => $date]);
    }
}
