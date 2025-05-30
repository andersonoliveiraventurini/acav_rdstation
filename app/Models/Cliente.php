<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    /** @use HasFactory<\Database\Factories\ClienteFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'enviado_api',
        // funil de vendas no RD Station    
        'pipeline_id',
        'stage_id',
        'rdstation_id',
        'rdstation_status',
        'numero',
        'nome',
        'endereco',
        'cidade',
        'cep',
        'telefone_res',
        'telefone_cial',
        'celular',
        'referencias',
        'cpf',
        'rg',
        'cnpj',
        'usuario',
        'cliente',
        'fornecedor',
        'nascimento',
        'email',
        'contato',
        'vencimento',
        'valor',
        'carta',
        'seproc',
        'idcarta',
        'enviado',
        'bloqueio',
        'ref_cial',
        'emi_rg',
        'filiacao',
        'funcionario',
        'empresa',
        'fantasia',
        'codmun',
        'casa',
        'UF',
        'avisar',
        'complemento',
        'limite',
        'vendedor',
        'compl',
        'momento',
        'referencias2',
        'ultima',
        'referencias3',
        'entrega',
        'arquivo',
        'externo',
        'carteira',
        'cheque',
        'boleto',
        'cadastro',
        'venc_limite',
        'idcarta'
    ];
}
