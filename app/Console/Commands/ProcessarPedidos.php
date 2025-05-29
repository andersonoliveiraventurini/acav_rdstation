<?php

namespace App\Console\Commands;

use App\Models\Pedido;
use Illuminate\Console\Command;
use Pedroni\RdStation\Facades\RdStation;

class ProcessarPedidos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:processar-pedidos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processa pedidos e envia para a API do RD Station';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $pedidos = Pedido::whereNull('enviado_api')->get();
        if ($pedidos->isEmpty()) {
            $this->info('Nenhum pedido para processar.');
            return;
        } else {
            $this->info('Processando ' . $pedidos->count() . ' pedidos...');
            foreach ($pedidos as $pedido) {
                RdStation::events()->conversion([
                    'email' => $pedido->email, // email do cliente
                    'conversion_identifier' => config('app.rd_pedido'), // ID do funil
                    'cf_nome' => 'Nome do Cliente',
                    'cf_telefone' => '(99) 99999-9999',
                    'tags' => ['lead-crm'],
                    // outros campos customizados do formulário
                ]);
            }
            $this->info('Pedidos processados com sucesso!');
            // Atualiza os pedidos como enviados
            $pedidos->update(['enviado_api' => now()]);
            $pedidos->save();
            $this->info('Pedidos marcados como enviados.');
            
        }
    }
}
