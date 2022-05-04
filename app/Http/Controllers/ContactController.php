<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'surname' => 'required|string',
            'phone_number' => 'required|string',
            'email' => 'required|email',

        ]);
 
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        };


        $newContact = new Contact();  //instanciamos el modelo

        //$userId = auth()->user()->id;

        $newContact->name = $request->name;
        $newContact->surname=$request->surname;
        $newContact->email=$request->email;
        $newContact->phone_number=$request->phone_number;
        //$newContact->user_id=$userId;                           //mala practica, es solo para practicar, no se pone
        $newContact->user_id=$request->user_id;                         

        $newContact->save();

        //return 'CREATE CONTACT BY ID';
        return response()->json(["data"=>$newContact, "success"=>'Contact created'], 200);

    }

    public function patchContactById(Request $request, $id)
    {
     

        $contact = Contact::where('user_id',$id)->where('user_id',1)->first();

        if(empty($contact)){
            return response()->json(["error"=> "contact not exists"], 404);
        };

        if(isset($request->name)){
            $contact->name = $request->name;
        }
        if(isset($request->surname)){
            $contact->surname = $request->surname;
        }
        if(isset($request->email)){
            $contact->email = $request->email;
        }
        if(isset($request->phone_number)){
            $contact->phone_number = $request->phone_number;
        }
        if(isset($request->user_id)){
            $contact->user_id = $request->user_id;
        }

        $contact->save();

        //return 'UPDATE CONTACT BY ID'. $id;
        //return ["data"=>$contact, "success"=>'Contact updated'];
        return response()->json(["data"=>$contact, "success"=>'Contact updated'], 200);
    }


    public function deleteContactById($id)
    {
        $contact = Contact::where('user_id',$id)->where('user_id',1)->first();
        
        if(empty($contact)){
            return response()->json(["error"=> "contact not exists"], 404);
        };

        $contact->delete();
        //return 'DELETE CONTACT BY ID'. $id;
        return response()->json(["data"=> "contact deleted"], 200);
    }
}
