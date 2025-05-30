<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orcamento extends Model
{
    /** @use HasFactory<\Database\Factories\OrcamentoFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'enviado_api',
        // funil de vendas no RD Station   
        'pipeline_id',
        'stage_id',
        'rdstation_id',
        'rdstation_status',
        'orcamento',
        'nome',
        'telefone',
        'qtd',
        'produto',
        'unitario',
        'vendedor',
        'data',
        'lote',
        'desconto',
        'liberado',
        'empresa',
        'tipox',
        'prazox',
        'pagamentox',
        'fretex',
        'cliente',
        'descri',
        'transporte',
        'qtd_entrega',
        'hora_entrega',
        'user_entrega',
        'user_obs',
        'entregador'
    ];
}
