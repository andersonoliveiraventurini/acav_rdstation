<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePedidoRequest;
use App\Http\Requests\UpdatePedidoRequest;
use App\Models\Pedido;
use App\Services\RDStationService;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, RDStationService $rdService)
    {
        $pedido = Pedido::create($request->all());

        if ($this->sendToRdStation($pedido, $rdService)) {
            return response()->json([
                'message' => 'Pedido criado e enviado para RD Station com sucesso!'
            ], 201);
        }

        return response()->json([
            'message' => 'Pedido criado mas falhou no envio para RD Station'
        ], 201);
    }

    private function sendToRdStation(Pedido $pedido, RDStationService $rdService)
    {
        if (!$pedido->enviado_api) {
            $payload = $pedido->createOpportunityPayload();
            $response = $rdService->createOpportunity($payload);

            if ($response) {
                $pedido->update(['enviado_api' => now()]);
                return true;
            }
        }
        return false;
    }

    /**
     * Display the specified resource.
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePedidoRequest $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
