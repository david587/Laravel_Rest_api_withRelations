<?php

namespace App\Http\Controllers;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DragonController extends Controller
{
    public function store(Request $request){
        $colorReq = $request->color;
        $color = DB::table("colors")->where("color",$colorReq)->get();
        // $color = Color::first($colorReq)->get();
        print_r($color);
    }
}
