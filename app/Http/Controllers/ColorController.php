<?php

namespace App\Http\Controllers;
use App\Models\Color;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Http\Resources\Color as ColorResources;
use Validator;

class ColorController extends BaseController
{
    public function update(Request $request, $id ){
        $input = $request->all();

        $validator = Validator::make($input, [
            "color"=> "required"
        ]);

        if($validator->fails()){
            return $this->sendError($validator->errors());
       }

       $color = Color::find($id);
       $color->update($request->all());

            return $this->sendResponse(new ColorResources($color), "Szín frissítve");
    }
}