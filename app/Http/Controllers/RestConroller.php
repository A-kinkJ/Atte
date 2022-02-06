<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Rest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RestConroller extends Controller
{
    public function index()
    {

    }

    public function restStart()
    {
        $user = Auth::user();

        $restStart = Attendance::where('user_id',$user->id)->latest()->first();

        $timestamp = Rest::create([
            'attendance_id' => $restStart->id,
            'breake_begin_time' => Carbon::now(),
        ]);
        return redirect()->back()->with([
            'status' => '休憩開始です。',
            'rest_start' => true,
        ]);

    }

    public function restEnd()
    {
        $user = Auth::user();
        $restEnd = Attendance::where('user_id', $user->id)->latest()->first();
        $timestamp = Rest::where('attendance_id',$restEnd->id)->latest()->first();
        
        //if (!empty($timestamp->restEnd)){
            //return redirect()->back()->with('error','既に休憩終了が押されています。');
        //}
        $timestamp->update([
            'breake_end_time' => Carbon::now()
        ]);

        

        return redirect('/')->with([
            'status' => '休憩終了です。',
            'rest_end' => true,
            ]);

        //休憩時間の取得
        $timestamp = Rest::where('attendance_id',$user->id)->latest()->first();

        //$date = Rest::select(DB::raw('timediff(rest_end_time,rest_start_time) as resttime'))->where('attendance_id',$timestamp->id)->value('resttime');
    }
}
