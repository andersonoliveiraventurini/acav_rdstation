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
        Schema::create('orcamentos', function (Blueprint $table) {
            $table->id();
            $table->timestamp('enviado_api')->nullable();
            // funil de vendas no RD Station            
            $table->string('pipeline_id')->nullable()->comment('ID do funil de vendas no RD Station');
            $table->string('stage_id')->nullable()->comment('ID da etapa do funil de vendas no RD Station');
            $table->string('rdstation_id')->nullable()->comment('ID do orçamento no RD Station');
            $table->string('rdstation_status')->default(''); // Status do orçamento no RD Station
            $table->integer('orcamento')->default(0);
            $table->string('nome', 120)->default('*');
            $table->string('telefone', 20)->default('*');
            $table->double('qtd', 10, 3)->default(0.000);
            $table->integer('produto')->default(0);
            $table->double('unitario', 10, 4)->default(0.0000);
            $table->string('vendedor', 20)->default('*');
            $table->date('data')->nullable();
            $table->string('lote', 10)->default('*');
            $table->double('desconto', 10, 2)->default(0.00);
            $table->unsignedTinyInteger('liberado')->default(1);
            $table->integer('empresa')->default(1);
            $table->string('tipox', 145)->default('*');
            $table->string('prazox', 145)->default('*');
            $table->string('pagamentox', 145)->default('*');
            $table->string('fretex', 145)->default('*');
            $table->unsignedInteger('cliente')->default(0);
            $table->string('descri', 145)->default('*');
            $table->string('transporte', 30)->default('*');
            $table->double('qtd_entrega', 10, 3)->default(0.000);
            $table->string('hora_entrega', 25)->default('*');
            $table->string('user_entrega', 20)->default('*');
            $table->string('user_obs', 45)->default('*');
            $table->string('entregador', 45)->default('*');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orcamentos');
    }
};
