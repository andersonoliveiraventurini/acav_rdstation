<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model
{
    /** @use HasFactory<\Database\Factories\PedidoFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'pedido_rdstations';
    protected $fillable = [
        'enviado_api',
        // funil de vendas no RD Station            
        'pipeline_id',
        'stage_id',
        'rdstation_id',
        'rdstation_status',
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
        'data'
    ];
}
