<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Rest;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = ['user_id', 'begin_time', 'end_time', 'date'];


    public function rests(){
        return $this->hasMany(Rest::class);
    }

    public function getRest(){
        $sumRestTime = 0;
        $getRests = $this->rests();
        foreach($getRests as $getRest){
            $sumRestTime += $getRest->get_rest_time;
        }
        return gmdate("H:i:s", $sumRestTime);
    }

    public function attendanceTime(){

    }

}
