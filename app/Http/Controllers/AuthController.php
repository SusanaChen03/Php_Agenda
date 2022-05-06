<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    const ROLE_USER_ID = 1;

    public function register(Request $request)    //registro con JWT
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

            $user->roles()->attach(self::ROLE_USER_ID);   //REGISTRO CON ROLE

            $token = JWTAuth::fromUser($user);   //recupera los datos del usuario y nos lo encripta a la $token
    
            return response()->json(compact('user','token'),201);
            
        } catch (\Throwable $th) {
            //throw $th;
            //dd($th->getMessage());              //solo sale el mensaje de error

            return response()->json([ 'error'=> 'upssss!'], 500);
        }
        //return 'register';   
    }

    public function login (Request $request)
    {
        try {
            $input = $request->only('email', 'password');
            $jwt_token = null;

            if (!$jwt_token = JWTAuth::attempt($input)) {
                return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
                ], Response::HTTP_UNAUTHORIZED);
            }

            return response()->json([
                'success' => true,
                'token' => $jwt_token,
            ]);
        } catch (\Throwable $th) {
            return response()->json(['error=> "Error login user'], 500);
        }
    }

    public function profile()                   //profile del usuario con autenticacion 
    {

        try {
            return response()->json(auth()->user());
        } catch (\Throwable $th) {
            return response()->json(['error=> error profile'],500);
        }
    }

    public function logout(Request $request)    //esto se hace por body "token":""
    {
        
        $this->validate($request, [
            'token' => 'required'
            ]);

            try {
                JWTAuth::invalidate($request->token);

                return response()->json([
                    'success' => true,
                    'message' => 'User logged out successfully'
                ]);
            } catch (\Exception $exception) {

                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, the user cannot be logged out'
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
    }
}