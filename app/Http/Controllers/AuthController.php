<?php

namespace App\Http\Controllers;

use App\Providers\FirebaseServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AuthController extends Controller
{
    public function authLogin(Request $request){
        $users =  new FirebaseServiceProvider();
        $users->connect('users');
        $data = $users->where('email','=',$request->email);
        $id = key((array)$data);

        
        if ($data[$id]['email'] == $request->email && $data[$id]['password'] == $request->password) {
            $now = Carbon::now();
            $users->connect("authTokens");
            $users->create([
                'uuid_user' => $id,
                'created_at' => $now->toDateTimeString(),
                'expired_date' => $now->addDays(1)->toDateTimeString(),
            ]);
            $tokenData = $users->where('created_at', "=", $now->addDays(-1)->toDateTimeString());
            $token = key((array)$tokenData);


            return response()->json([
                'data' => [
                    'message' => "successfull login",
                    'token' => $token
                ],
                'status' => true
            ]);    
        }
    }


    public function authMe(Request $request){

            return response()->json([
                'test' => true
            ], 200);

    }

    public static function checkAuth($request){
        try {
            $token = explode(" ",$request->header('Authorization'))[1];

            if ($token == "null") {
                return false;
            }
    
            $users =  new FirebaseServiceProvider();
            $users->connect('authTokens');
            $data = $users->find($token)->get();
    
            $expired = Carbon::createFromTimeString($data[$token]['expired_date']);
            $now = Carbon::now();
    
            // check expired
            if($now->greaterThan($expired)){
                return false;
            }
            
            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
