<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [    //para usar el metodo create en el post
        'name',
        'surname',
        'phone_number',
        'email',
        'user_id'    //foreign key esta en el contactos
    ];

    //protected $table = 'contacts';      //cuando el nombre de la tabla no esta con el mismo nombre en singular.
    //protected $primaryKey = 'Flight_id';   //cuando no es el id por defecto
    //public $timestamp = false; //no se actualiza estos campos
    //const CREATED_AT = 'creation_date'  cambio de nombre de esta propiedad predefinida

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');    //el modelo contacto pertenece a usuarios
    }
}
