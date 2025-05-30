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
        Schema::create('pedidos_brcom', function (Blueprint $table) {
            $table->id();
            $table->timestamp('enviado_api')->nullable();
            // funil de vendas no RD Station            
            $table->string('pipeline_id')->nullable()->comment('ID do funil de vendas no RD Station');
            $table->string('stage_id')->nullable()->comment('ID da etapa do funil de vendas no RD Station');
            $table->string('rdstation_id')->nullable()->comment('ID do orçamento no RD Station');
            $table->string('rdstation_status')->default(''); // Status do orçamento no RD Station
            $table->integer('orca')->nullable();
            $table->double('qtd')->nullable();
            $table->decimal('vista', 19, 4)->nullable();
            $table->decimal('prazo', 19, 4)->nullable();
            $table->decimal('tvista', 19, 4)->nullable();
            $table->decimal('tprazo', 19, 4)->nullable();
            $table->decimal('custo', 19, 4)->nullable();
            $table->string('nome', 40)->nullable();
            $table->string('fone', 40)->nullable();
            $table->integer('produto')->nullable();
            $table->string('descricao', 60)->nullable();
            $table->double('descv')->nullable();
            $table->double('descp')->nullable();
            $table->decimal('ovista', 19, 4)->nullable();
            $table->decimal('oprazo', 19, 4)->nullable();
            $table->decimal('custot', 19, 4)->nullable();
            $table->string('obs', 120)->nullable();
            $table->string('vendedor', 60)->nullable();
            $table->dateTime('data')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};
