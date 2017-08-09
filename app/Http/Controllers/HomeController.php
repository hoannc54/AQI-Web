<?php

namespace App\Http\Controllers;

use App\Models\AqiHourly;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        $aqiHourly = AqiHourly::orderBy('created_at', 'desc')->first();
        $aqi = $aqiHourly->aqi;
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
        $listAqi = AqiHourly::orderBy('created_at', 'desc')->get();
        return view('frontend.home')->with([
            'aqiHourly' => $aqiHourly,
            'background' => $background,
            'listAqi' => $listAqi
        ]);
    }

    public function getAqiHourly($location_id){
        $aqiHourly = AqiHourly::where('location_id', $location_id)->orderBy('created_at', 'desc')->first();
        return response([
            'aqiHourly' => $aqiHourly->aqi,
            'location' => $aqiHourly->location_id
        ]);
    }
}
