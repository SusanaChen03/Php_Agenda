<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        Log::info('Init register');
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);
    
            if($validator->fails()){            //metodo fails true o false
                return response()->json($validator->errors()->toJson(),400);
            }
    
            $user = User::create([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => bcrypt($request->password)
            ]);
            $token = JWTAuth::fromUser($user);   //recupera los datos del usuario y nos lo encripta a la $token
    
            return response()->json(compact('user','token'),201);
            
        } catch (\Throwable $th) {
            //throw $th;
            //dd($th->getMessage());              //solo sale el mensaje de error

            return response()->json([ 'error'=> 'upssss!'], 500);
        }
        //return 'register';
    }
}