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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');
            
            $table->string('pdf_path')->nullable(); //ticket de compra
            $table->json('content');
            $table->json('address');

            $table->integer('payment_method')->default(1); //metodo de pago
            $table->string('transaction_id'); //numero de la tarnsaccion del pago

            $table->float('total');
            $table->integer('status')->default(1); //estado de la orden

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
