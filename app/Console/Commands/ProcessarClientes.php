<?php

namespace App\Console\Commands;

use App\Models\Cliente;
use Illuminate\Console\Command;
use Pedroni\RdStation\Facades\RdStation;

class ProcessarClientes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:processar-clientes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $clientes = Cliente::whereNull('enviado_api')->get();
        if ($clientes->isEmpty()) {
            $this->info('Nenhum orçamento para processar.');
            return;
        } else {
            $this->info('Processando ' . $clientes->count() . ' clientes...');
            foreach ($clientes as $cliente) {
                RdStation::events()->conversion([
                    'email' => $cliente->email, // email do cliente
                    'conversion_identifier' => config('app.rd_cliente'), // ID do funil
                    'cf_nome' => 'Nome do Cliente',
                    'cf_telefone' => '(99) 99999-9999',
                    'tags' => ['lead-crm'],
                    // outros campos customizados do formulário
                ]);
            }
            $this->info('Clientes processados com sucesso!');
            // Atualiza os Clientes como enviados
            $clientes->update(['enviado_api' => now()]);
            $clientes->save();
            $this->info('Clientes marcados como enviados.');
        }
    }
}
