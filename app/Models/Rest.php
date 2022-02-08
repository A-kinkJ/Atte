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
        $breakeEndTime = strtotime($this->breake_end_time);
        $breakeStartTime = strtotime($this->breake_begin_time);
        $diff = $breakeEndTime - $breakeStartTime;
        
        return $diff;
        
    }
}
