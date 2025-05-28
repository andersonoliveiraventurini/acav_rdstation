<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    /** @use HasFactory<\Database\Factories\PedidoFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'pedidos_brcom';

    protected $fillable = [
        'orca',
        'qtd',
        'vista',
        'prazo',
        'tvista',
        'tprazo',
        'custo',
        'nome',
        'fone',
        'produto',
        'descricao',
        'descv',
        'descp',
        'ovista',
        'oprazo',
        'custot',
        'obs',
        'vendedor',
        'data',
        'enviado_api'
    ];

    protected $casts = [
        'data' => 'datetime',
    ];

    public function createOpportunityPayload()
    {
        return [
            'deal' => [
                'name' => $this->descricao,
                'title' => "Orçamento {$this->orca} - {$this->nome}",
                'pipeline_id' => config('services.rdstation.pipeline_id'),
                'contact_id' => $this->getRdContactId(),
                'deal_custom_fields' => [
                    [
                        'custom_field_id' => 'SEU_ID_CAMPO_ORCAMENTO',
                        'value' => $this->orca
                    ],
                    [
                        'custom_field_id' => 'SEU_ID_CAMPO_VALOR',
                        'value' => $this->tvista
                    ],
                    // Adicione outros campos customizados do seu funil
                ]
            ]
        ];
    }

    protected function getRdContactId()
    {
        // Implemente lógica para buscar/relacionar com o Contact ID no RD
        // Pode ser via relação com outra model ou API
        return null;
    }
}
