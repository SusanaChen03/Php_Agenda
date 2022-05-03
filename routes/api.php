<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
//localhost/api/contacts
Route::get('/contacts', function() {
    return 'GET ALL CONTACTS';
});

Route::get('/contact/{id}', function($id) {
    return 'GET CONTACT BY ID->'. $id;
});

Route::post('/contact', function (Request $request) {
    dump($request-> all());    //pasa el post en un array  //dump hay que borrarlas en produccion 
    // dd()  haz el dump y muere
    return 'CREATE CONTACT BY ID';
});

Route::patch('/contact/{id}', function($id) {
    return 'PATCH CONTACT BY ID'. $id;
});

Route::delete('/contact/{id}', function($id) {
    return 'DELETE CONTACT'. $id;
});
