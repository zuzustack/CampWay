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
        $data = $users->where('email','=',$request->email)->get();
        $id = key((array)$data);

        if ($data[$id]['type_account'] != "admin") {
            return response()->json([
                'data' => [
                    'message' => "Gagal login",
                ],
                'status' => true
            ],403);    
        }
        
        if ($data[$id]['email'] == $request->email && $data[$id]['password'] == $request->password) {
            $now = Carbon::now();
            $users->connect("authTokens");
            $users->create([
                'uuid_user' => $id,
                'created_at' => $now->toDateTimeString(),
                'expired_date' => $now->addDays(1)->toDateTimeString(),
            ]);
            $tokenS =  new FirebaseServiceProvider();
            $tokenData = $tokenS->connect("authTokens")->where('created_at', "=", $now->addDays(-1)->toDateTimeString())->get();
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


    public function authUserLogin(Request $request){
        $users =  new FirebaseServiceProvider();
        $users->connect('users');
        $data = $users->where('email','=',$request->email)->get();
        $id = key((array)$data);

        if (count($data) == 0) {
            return response()->json([
                'data' => [
                    'message' => "Gagal login",
                ],
                'status' => true
            ],403);    
        }


        if ($data[$id]['type_account'] != "users") {
            return response()->json([
                'data' => [
                    'message' => "Gagal login",
                ],
                'status' => true
            ],403);    
        }
        
        if ($data[$id]['email'] == $request->email && $data[$id]['password'] == $request->password) {
            $now = Carbon::now();
            $users->connect("authTokens");
            $users->create([
                'uuid_user' => $id,
                'created_at' => $now->toDateTimeString(),
                'expired_date' => $now->addDays(1)->toDateTimeString(),
            ]);
            $tokenS =  new FirebaseServiceProvider();
            $tokenData = $tokenS->connect("authTokens")->where('created_at', "=", $now->addDays(-1)->toDateTimeString())->get();
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


    public function authSignUpUser(Request $request){
        $users =  new FirebaseServiceProvider();
        $users->connect('users');
        $data = $users->where('email','=',$request->email)->get();

        if (count($data) != 0) {
            return response()->json([
                'data' => [
                    'message' => "Email Sudah digunakan",
                ],
                'status' => false
            ],403);
        }

        $users = new FirebaseServiceProvider();
        
        $users->connect("users");
        $users->create([
            'email' => $request->email,
            'password' => $request->password,
            'type_account' => "users",
            'create_at' => Carbon::now(),
            'update_at' => Carbon::now(),
        ]);


        return response()->json([
            'data' => [
                'message' => "Success Create Account",
            ],
            'status' => true
        ],200);
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
