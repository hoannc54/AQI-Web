<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AqiHourly extends Model
{
    protected $table = 'aqi_hourly';
    public function getBackgroundAttribute(){
        $aqi = $this->aqi;
        if ( $aqi >= 0 && $aqi <= 50){
            $background = 'blue';
        }elseif ($aqi > 50 && $aqi <= 100){
            $background = 'yellow';
        }elseif ($aqi > 100 && $aqi <= 200){
            $background = 'orange';
        }
        elseif ($aqi > 200 && $aqi <= 300){
            $background = 'red';
        }elseif ($aqi > 300){
            $background = 'brown';
        }
        return $background;
    }
}
