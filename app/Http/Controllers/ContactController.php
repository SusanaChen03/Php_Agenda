<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function getAllContacts()
    {
        $contacts = DB::table('contacts')->where('user_id',1)->get()->toArray();//get nos trae una coleccion y toArray nos lo convierte en array
        //where para barreras para entrar where('user', 'LIKE'(que contenga 1)'='(que sea igual a 1))
        dump($contacts);
        // $contacts = DB::table('contacts')->select('name', 'surname')->where('user_id',1)->get()->toArray()   //más filtros

        // $contacts = DB::table('contacts')
        //->select('name', 'surname as apellido')
        //->where('user_id',1)->get()
        //->toArray()   //sustituye surname por apellido

        //return 'GET ALL CONTACTS CONTROLLER';  //console.log get all contacts controller.

        // $user = User::all(); //traer a todos los usuarios-ç.
        return $contacts;
    }

    public function getContactsAll()
    {
        //$contact = Contact::all();
        $contact = Contact::where('user_id', 7)->get()->toArray();

        if(empty($contact)){
            return response()->json(
                [
                    "succes" => "There are not contacts"
                ], 202
            );
        };
        
        return response()->json($contact, 200);
    }

    public function getContactById($id)
    {
        
        //$contact = DB::table('contacts')->where('user_id',1)->where('user_id',$id)->get();  //sacar los contactos que a creado ese usuario(user_id, quien este logeado, con un token)
        //$contact = DB::table('contacts')->where('user_id', 1)->find($id);    nos devuelve lo mismo.

        $contact = DB::table('contacts')->where('user_id',1)->where('user_id',$id)->first();
        //$contact = DB::table('contacts')->where('user_id',1)->where('user_id',$id)->firstOrFail(); 

        if(empty($contact)){
            return response()->json(
                [
                    "error" => "Contact not exists"
                ],400
            );
        };
        //return 'GET CONTACT BY ID->'. $id;
        //return $contact;
        return response()->json($contact, 200);

    }

    public function createContact(Request $request)
    {
      
        return 'CREATE CONTACT BY ID';
    }

    public function patchContactById($id)
    {
        return 'PATCH CONTACT BY ID'. $id;
    }

    public function deleteContactById($id)
    {
        return 'DELETE CONTACT BY ID'. $id;
    }
}
