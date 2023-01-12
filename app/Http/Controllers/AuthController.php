<?php

namespace App\Http\Controllers;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
//igy örökölhetjük a BaseContorller metodusát
class AuthController extends Controller
{
    public function signUp(Request $request){
        //gyártunk egy felhasználót(adataival eggyüt) 
        $validator = Validator::make($request->all(),[
            "name" => "required",
            "email"=> "required",
            "password"=>"required",
            "confirm_password" => "required|same:password"
        ]);
        //a validáló nemsikerült
        if($validator->fails() ){
            //return sendError("Error validation", $validator->errors());
        }

        $input = $request->all();
        $input["password"] = bcrypt($input["password"]);
        //ide átadunk mindent
        $user = User::create($input);
        $success["name"] = $user->name;

        //return $this->sendResponse($success,"Sikeres Regisztráció");
    }

    public function signIn(Request $request)
    {
        //token gyártása,azonositásra
        //jön egy bejelentkezési probálkozás
        if(Auth::attempt(["email"=> $request->email,"password"=>$request->password])){
            //hitelességet ellenörzi a 2adatnak
            $authUser = Auth::user();
            //ha sikeres,generálunk egy tokent,megadjuk a nevét,szöveges formátumba kerül a token(plaintext)
            $success["token"] = $authUser->createToken("MyAuthApp")->plainTextToken;
            $success["name"] = $authUser->name;
            //addig kell tárolni a tokent amig ki nem jelentkezik
            print_r("siker");
            //basecontrollerből hivjuk ezt
            //return $this->sendResponse($success,"Sikeres Bejelentkezés");
        }
        else{
            print_r("nem");
              //ha nem sikerül a bejelentkezés
            //return $this->sendError("unathorized.".["error"=> "Hibás Adatok"]);
        }
    }
}
