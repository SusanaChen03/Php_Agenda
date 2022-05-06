<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name',100);
            $table->string('surname', 100);
            $table->string('phone_number');
            $table->string('email'); //->unique();          //hacer que el email sea unico en la agenda
            $table->unsignedBigInteger('user_id');   //(USER_ID) es nuestra foreign key   //NULLABLE //unsignedBigInteger la misma clase que la BD, user_id, tiene que ser el mismo que la foreig key
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');   //SETNULL  //setNull/cascade set null es queuna vez borrado quede null
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
