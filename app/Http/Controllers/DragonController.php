<?php

namespace App\Http\Controllers;
use App\Models\Color;
use App\Models\Dragon;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Http\Resources\Dragon as DragonResources;
use Validator;

class DragonController extends BaseController
{
    public function store(Request $request){
        $input = $request->all();
        // $input["color_id"] = DB::table("colors")->where("color",$input["color_id"])->first()->id;
        $input["color_id"] = Color::where("color",$input["color_id"])->first()->id;
        // print_r($input);
        $validator = Validator::make($input, [
            "name"=>"required",
            "age"=>"required",
            "color_id"=>"required"
        ]);

        if($validator->fails()){
             return $this->sendError($validator->errors());
        }

         $dragon = Dragon::create($input);

        return $this->sendResponse(new DragonResources($dragon), "létrehozva");
    }

    public function index()
    {
        $dragons = Dragon::with("color")->get();
        return $this->sendResponse(DragonResources::collection($dragons),"ok");
    }

    public function update(Request $request, $id ){
        $input = $request->all();

        $validator = Validator::make($input, [
            "name"=> "required",
            "age"=> "required"
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
       }

       $dragon = Dragon::find($id);
       $dragon->update($request->all());

       return $this->sendResponse(new DragonResources($dragon), "Sárkány frissítve");
    }
}
