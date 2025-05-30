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
        Schema::create('pedido_rdstations', function (Blueprint $table) {
            $table->foreignId('cliente_id')->constrained()->onDelete('cascade');
            $table->string('order_id')->unique();
            $table->decimal('value', 10, 2);
            $table->string('currency', 3)->default('BRL');
            $table->string('payment_method')->nullable();
            $table->json('products'); // Armazena a lista de produtos
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedido_r_d_stations');
    }
};
