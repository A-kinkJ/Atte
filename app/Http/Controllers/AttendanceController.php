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
        $lastEndTime = optional($timestamp)->end_time;
        $lastDateTime = optional($timestamp)->begin_time;
        $lastDate = date('Y-m-d',strtotime(($lastDateTime)));



        //if ($lastEndTime == null && $lastDate != $date){
            //$timestamp->update([
            //    'end_time'=>Carbon::parse($lastEndTime)->endOfDay()
            //]);

            //$timestamp = Attendance::create([
            //    'user_id' => $user->id,
            //    'begin_time' => Carbon::today(),
            //]);
        //}
        return view('index',['user'=>$user]);

        //if(Auth::check()){
        //$today = Carbon::today();
        //$month = intaval($today->month);
        //$day = intaval($today-day);
        //$format = $today->format('Y年m月d日');
        //$items = Attendance::GetMonthAttendance($month)->GetDayAttendance($day)->get();
        //return view('index',['items'=>$items,'day'=>$format,'user'=>$user]);
        //}else{
        //return redirect('/login');
        //}

        
    }

    public function start(Request $request)
    {  
         //勤務開始処置
        $user = Auth::user();
        // 打刻は１日一回まで
        $oldTimeStamp = Attendance::where('user_id',$user->id)->latest()->first();
        if($oldTimeStamp){
            $oldTimeStampStart = new Carbon($oldTimeStamp->begin_time);

            $oldTimeStampDay = $oldTimeStampStart->startOfDay();
        }

        $newTimeStampDay = Carbon::today();

        //同日付の出勤打刻で、かつ直前のTimestampの退勤打刻がされていない場合エラーを吐き出す。
        if ((isset($oldTimeStampDay) == $newTimeStampDay) && (empty($oldTimeStamp->end_time))) {
            return redirect()->back()->with('error', 'すでに出勤打刻がされています。');
        }
        

        $timestamp = Attendance::create([
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

            return redirect('/');//->with('status','お疲れ様でした');
    }
}
