<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function getUserByContactId($id)   //de momento no funciona
    {
        try {
            Log::ingo('getUserByContactId');

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
}
