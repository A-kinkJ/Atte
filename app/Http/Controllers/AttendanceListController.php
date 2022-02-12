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
        if ($request->page) {
        $date = $request->date; // 現在指定している日付を取得
        } else {
            $date = Carbon::today()->format("Y-m-d");
        }

        $user = Auth::user();
        $user_id = Auth::id();
        


        $attendance = Attendance::where('user_id',$user_id)->latest()->first();
        $timeStamp = Rest::where('attendance_id',$attendance->id)->latest()->first();

        $items = Attendance::whereDate('begin_time', $date)->paginate(5);
        $items->appends(compact('date'));

        return view('attendance',['today'=>$date,'items'=>$items]);
    }

    public function attendanceDate(Request $request){
        if ($request->page) {
            $date = $request->date; // 現在指定している日付を取得
        } else {
            $date = Carbon::today()->format("Y-m-d");
        }
        $user = Auth::user();
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


        $items = Attendance::whereDate('begin_time', $date)->paginate(5);
        $items->appends(compact('date'));

        return view('attendance', ['today' => $date, 'items' => $items]);
    }

    public function userList(){
        $items = User::Paginate(10);
        return view('userList',['items'=>$items]);
    }

    public function userAttendanceList(){
        $date = Carbon::today()->format("Y-m-d");

        $user = Auth::user();
        $user_id = Auth::id();



        $attendance = Attendance::where('user_id', $user_id)->latest()->first();
        $timeStamp = Rest::where('attendance_id', $attendance->id)->latest()->first();

        $items = Attendance::whereDate('begin_time', $date)->where('user_id', $user_id)->paginate(5);
        $items->appends(compact('date'));

        return view('userattendancelist', ['today' => $date, 'items' => $items]);
    }

    public function userAttendanceListNext(Request $request){
        $date = Carbon::today()->format("Y-m-d");
        $user = Auth::user();
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


        $items = Attendance::whereDate('begin_time', $date)->where('user_id', $user_id)->paginate(5);
        $items->appends(compact('date'));

        return view('userattendancelist', ['today' => $date, 'items' => $items]);
    }
}
