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
        Schema::create('covers', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');
            $table->string('title');
            $table->dateTime('start_at'); /**Desde cuando se quiere que tenga vigencia esa portada */
            $table->dateTime('end_at')->nullable();
            $table->boolean('is_active')->default(true);

            $table->integer('order')->default(0); /**Orden de la portada */

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('covers');
    }
};
