<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    //const ROLE_ADMIN_ID = 2;  //constante para utilziarlo en toda el archivo
    public function getUserByContactId($id)  
    {
        try {
            Log::info('getUserByContactId');

            $user = Contact::find($id)->user;

            if(empty($user)) {
                return response()->json([
                    "error"=> 'este contacto no pertenece a ningun usuario'
                ],404);
            }
            return response()->json($user, 200);
        } catch (\Throwable $th) {
            Log::error('Ha ocurrido un error'. $th->getMessage());
            return response()->json([
                "error"=> 'Ha ocurrido un error'
            ],404);
        };
    }

    public function createUserAdmin($id)
    {
        try {
            Log::info('created user Admin');
            
            $rolAdmin = 2;

            $user = User::find($id);
            
            $user->roles()->attach($rolAdmin);      //este es el numero del rol qu esta en la DB
            //$user->roles()->attach($ROLE_ADMIN_ID);

            return response()->json(['success'=> "se ha creado el admin->"], 200);
         } catch (\Throwable $th) {
                Log::error('createUserAdmin->'.$th->getMessage());

                return response()->json(['error'=> "ha ocurrido un error"], 500);
        }
    }


    public function destroyUserAdmin($id)
    {
        try {
            Log::info('destroy user Admin');
            
            $rolAdmin = 2;

            $user = User::find($id);
            
            $user->roles()->detach($rolAdmin);      //este es el numero del rol qu esta en la DB
            //$user->roles()->attach($ROLE_ADMIN_ID);

            return response()->json(['success'=> "se ha borrado el admin"], 200);
         } catch (\Throwable $th) {
                Log::error('destroyUserAdmin'.$th->getMessage());

                return response()->json(['error'=> "ha ocurrido un error"], 500);
        }
    }
}
