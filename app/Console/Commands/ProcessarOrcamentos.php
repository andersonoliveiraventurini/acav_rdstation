<?php

namespace App\Console\Commands;

use App\Models\Orcamento;
use Illuminate\Console\Command;
use Pedroni\RdStation\Facades\RdStation;

class ProcessarOrcamentos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:processar-orcamentos';

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
        $orcamentos = Orcamento::whereNull('enviado_api')->get();
        if ($orcamentos->isEmpty()) {
            $this->info('Nenhum orçamento para processar.');
            return;
        } else {
            $this->info('Processando ' . $orcamentos->count() . ' orçamentos...');
            foreach ($orcamentos as $orcamento) {
                RdStation::events()->conversion([
                    'email' => $orcamento->email, // email do cliente
                    'conversion_identifier' => config('app.rd_orcamento'), // ID do funil
                    'cf_nome' => 'Nome do Cliente',
                    'cf_telefone' => '(99) 99999-9999',
                    'tags' => ['lead-crm'],
                    // outros campos customizados do formulário
                ]);
            }
            $this->info('Orçamentos processados com sucesso!');
            // Atualiza os orçamentos como enviados
            $orcamentos->update(['enviado_api' => now()]);
            $orcamentos->save();
            $this->info('Orçamentos marcados como enviados.');
        }
    }
}
