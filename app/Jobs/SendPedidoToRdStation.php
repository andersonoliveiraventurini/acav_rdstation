<?php

namespace App\Jobs;

use App\Models\Pedido;
use App\Services\RDStationService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendPedidoToRdStation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Pedido $pedido) {}

    public function handle(RDStationService $rdService)
    {
        $payload = $this->pedido->createOpportunityPayload();
        $result = $rdService->createOpportunity($payload);

        if ($result['success']) {
            $this->pedido->update(['enviado_api' => now()]);
        } else {
            // Tente novamente ou registre o erro para análise posterior
            Log::error('Falha no envio do Pedido para RD Station via Job', [
                'pedido_id' => $this->pedido->id,
                'erro' => $result['message'],
                'detalhes' => $result['details'] ?? null
            ]);
            // Opcional: lançar exception para reprocessar o job
            // throw new \Exception($result['message']);
        }
    }
}
