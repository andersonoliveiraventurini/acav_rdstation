<?php

namespace App\Console\Commands;

use App\Models\Cliente;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
        $this->info('Acessando o BRcom para atualziar de clientes...');
        // Verifica se a tabela de clientes existe
        $clientesbrcom = DB::connection('mysqlbrcom')->select("select * from clientes");
        if (empty($clientesbrcom)) {
            $this->info('Nenhum cliente para processar.');
            return;
        } else {
            $this->info('Salvando dados ' . count($clientesbrcom) . ' clientes...');
            $clientes = Cliente::all();
            if (count($clientesbrcom) == count($clientes)) {
                $this->info('Todos os clientes já foram processados.');
                return;
            } else {
                foreach ($clientesbrcom as $cliente) {
                    // Verifica se o cliente já existe no banco de dados
                    $existingCliente = Cliente::where('email', $cliente->email)->first();
                    if (!$existingCliente) {
                        // Cria um novo cliente se não existir
                        Cliente::create([
                            'nome' => $cliente->nome,
                            'email' => $cliente->email,
                            'telefone' => $cliente->telefone,
                            'enviado_api' => null, // Define como null para indicar que ainda não foi enviado
                        ]);
                    }
                }
            }

            $this->info('clientes processados com sucesso!');
            // Atualiza os clientes como enviados
            DB::connection('mysqlbrcom')->table('clientes')->whereNull('enviado_api')->update(['enviado_api' => now()]);
            $this->info('clientes marcados atualizados.');
        }


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
