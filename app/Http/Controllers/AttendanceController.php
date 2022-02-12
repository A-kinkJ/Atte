<?php


namespace App\Http\Controllers;


use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $date = Carbon::today();
        $timestamp = Attendance::where('user_id',$user->id)->latest()->first();
        if ($timestamp == null ){
            $timestamp = Attendance::create([
                'user_id' => $user->id,
                //'begin_time' => Carbon::today(),
            ]);
        }
        return view('index', ['user' => $user]);


        if ($timestamp->begin_time != null && $date != date("Y-m-d", strtotime($timestamp->begin_time)) && $timestamp->end_time == null) {
            //前日勤怠開始ボタンを押したまま退勤ボタンを押さずに日付を跨いだ場合
            $lastEndTime = $timestamp->end_time;
            $lastDateTime = $timestamp->start_time;
            $lastDate = date("Y-m-d", strtotime(($lastDateTime)));
            $nextdate = date("Y-m-d", strtotime($lastDateTime . "+1 day"));
            //勤怠開始してから日付を跨いだ場合、勤怠開始時と同日の23:59:59をend_timeに挿入し、ログイン時の日時をstart_timeへ挿入
            while ($lastEndTime == null && $lastDate != $date) {

            $timestamp->update([
                'end_time' => Carbon::parse($lastDateTime)->endOfDay(),
                'getRest' => '00:00:00'
            ]);
            }

        return view('index',['user'=>$user]);
        }
    }

    public function start(Request $request)
    {  
         //勤務開始処置
        $user = Auth::user();
        // 打刻は１日一回まで
        $timeStamp = Attendance::where('user_id',$user->id)->latest()->first();
        if($timeStamp){
            $oldTimeStampStart = new Carbon($timeStamp->begin_time);

            $oldTimeStampDay = $oldTimeStampStart->startOfDay();
        }

        $newTimeStampDay = Carbon::today();

        //同日付の出勤打刻で、かつ直前のTimestampの退勤打刻がされていない場合エラーを吐き出す。
        //if ((isset($oldTimeStampDay) == $newTimeStampDay) && (empty($timeStamp->end_time))) {
            //return redirect()->back()->with('error', 'すでに出勤打刻がされています。');
        //}


        $timeStamp = Attendance::create([
            'user_id' => $user->id,
            'begin_time' => Carbon::now(),
            'date' => Carbon::today()
        ]);
            return redirect()->back()->with([
                'start_time' => true,
            ]);

    }

    public function end(Request $request)
    {
        //退勤処理
        $user = Auth::user();
        $timestamp = Attendance::where('user_id', $user->id)->latest()->first();

        //if(!empty($timestamp->end_time)){
            //return redirect()->back()->with('error','打刻済みです');
        //}else{
            $timestamp->update([
                'end_time' => Carbon::now()
            ]);

            return redirect()->back()->with([
            'end_time' => true,
        ]);
    }
}
