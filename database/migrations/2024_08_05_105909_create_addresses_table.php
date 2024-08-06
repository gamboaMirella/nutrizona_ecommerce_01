<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            $table->integer('type'); //tipo del resinto: oficina, casa, etc.
            $table->string('description');
            $table->string('zone');
            $table->string('reference');
            $table->integer('receiver'); //valor=1 si es el receptor y 0 si es otro diferente al que pide el que recepciona
            $table->json('receiver_info');
            $table->boolean('default')->default(false); //direccion por defecto a la que se envia
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
