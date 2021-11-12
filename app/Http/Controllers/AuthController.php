<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\AccessLogs;
use Illuminate\Support\Str;
class AuthController extends Controller
{
    public function register(Request $request) {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = Hash::make($request->input('password'));
        
        $register = User::create([
            'name'=> $name,
            'email'=> $email,
            'password'=> $password
        ]);

        if ($register) {
            return response()->json([
                'success'=> true,
                'message' => 'Register Success!',
                'data'=> $register
            ],200);
        } else {
            return response()->json([
                'success'=> false,
                'message' => 'Register Fail!',
                'data'=> ''
            ],400);
        }
    }

    public function login(Request $request) {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = User::where('email',$email)->first();
        
        if ($user) {
            if (Hash::check($password,$user->password)){
                $apiToken = base64_encode(Str::random(40));
                $user->update([
                    'api_token'=> $apiToken
                ]);
                // add access log
                AccessLogs::create([
                    'user_id'=> $user->id,
                    'log_date'=> date('Y-m-d H:i:s')
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => 'Login Success!',
                    'data' =>[
                        'user' => $user,
                        'api_token' => 'Bearer '.$apiToken
                    ]
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Login Fail!',
                    'data' => ''
                ],400);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'wrong email!',
                'data' => ''
            ],500);
        }
    }
}
