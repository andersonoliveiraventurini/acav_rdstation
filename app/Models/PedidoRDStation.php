<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PedidoRDStation extends Model
{
    /** @use HasFactory<\Database\Factories\PedidoRDStationFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'pedido_rdstations';
    protected $fillable = [
        'pedido_id',
        'rdstation_id',
        'status',
        'created_at',
        'updated_at'
    ];
}
