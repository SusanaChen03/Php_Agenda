<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function getAllContacts()
    {
        return 'GET ALL CONTACTS CONTROLLER';
    }

    public function getContactById($id)
    {
        return 'GET CONTACT BY ID->'. $id;
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
