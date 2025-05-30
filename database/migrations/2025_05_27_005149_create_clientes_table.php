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
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->timestamp('enviado_api')->nullable();
            // funil de vendas no RD Station            
            $table->string('pipeline_id')->nullable()->comment('ID do funil de vendas no RD Station');
            $table->string('stage_id')->nullable()->comment('ID da etapa do funil de vendas no RD Station');
            $table->string('rdstation_id')->nullable()->comment('ID do orçamento no RD Station');
            $table->string('rdstation_status')->default(''); // Status do orçamento no RD Station
            $table->integer('numero')->default(0);
            $table->string('nome', 130)->default('*');
            $table->string('endereco', 130)->default('*');
            $table->string('cidade', 30)->default('*');
            $table->string('cep', 50)->default('00000-000');
            $table->string('telefone_res', 50)->default('*');
            $table->string('telefone_cial', 50)->default('*');
            $table->string('celular', 50)->default('*');
            $table->string('referencias', 125)->default('*');
            $table->string('cpf', 50)->default('*');
            $table->string('rg', 50)->default('*');
            $table->string('cnpj', 50)->default('*');
            $table->string('usuario', 50)->default('*');
            $table->tinyInteger('cliente')->default(0);
            $table->tinyInteger('fornecedor')->default(0);
            $table->date('nascimento')->nullable();
            $table->string('email', 50)->default('*');
            $table->string('contato', 50)->default('*');
            $table->integer('vencimento')->default(0);
            $table->double('valor', 10, 2)->default(0.00);
            $table->date('carta')->nullable();
            $table->date('seproc')->nullable();
            $table->integer('idcarta')->default(0);
            $table->date('enviado')->nullable();
            $table->string('bloqueio', 50)->default('*');
            $table->string('ref_cial', 60)->default('*');
            $table->date('emi_rg')->nullable();
            $table->string('filiacao', 60)->default('*');
            $table->tinyInteger('funcionario')->default(0);
            $table->integer('empresa')->default(1);
            $table->string('fantasia', 60)->default('*');
            $table->string('codmun', 15)->default('0');
            $table->string('casa', 10)->default('0');
            $table->string('UF', 2)->default('**');
            $table->integer('avisar')->default(0);
            $table->string('complemento', 45)->default('*');
            $table->double('limite', 10, 2)->default(0.00);
            $table->string('vendedor', 20)->default('*');
            $table->string('compl', 45)->default('*');
            $table->timestamp('momento')->useCurrent()->useCurrentOnUpdate();
            $table->string('referencias2', 125)->default('*');
            $table->date('ultima')->nullable();
            $table->string('referencias3', 125)->default('*');
            $table->string('entrega', 130)->default('*');
            $table->string('arquivo', 45)->default('*');
            $table->string('externo', 20)->default('*');
            $table->unsignedTinyInteger('carteira')->default(0);
            $table->unsignedTinyInteger('cheque')->default(0);
            $table->unsignedTinyInteger('boleto')->default(0);
            $table->date('cadastro')->nullable();
            $table->date('venc_limite')->nullable();
            $table->index('idcarta');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
