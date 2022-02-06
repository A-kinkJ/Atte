<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rest extends Model
{
    use HasFactory;

    protected $table = 'rests';

    protected $fillable = ['attendance_id', 'breake_begin_time', 'breake_end_time'];


    public function get_rest_time()
    {
        $endTime = strtotime($this->breake_end_time);
        $startTime = strtotime($this->breake_begin_time);
        $diff = $endTime - $startTime;
        //$endTime = new Carbon($this->breake_end_time);
        //$startTime = new Carbon($this->breake_begin_time);
        //$diff = $startTime->diffInSeconds($endTime);
        if(gmdates("H:i:s",$diff) == null){
            return "00:00:00";
        }else{
        return gmdate("H:i:s", $diff);
    }
        //return $diff;
        
    }
}
