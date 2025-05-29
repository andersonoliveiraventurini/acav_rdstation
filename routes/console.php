<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;


Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::command('app:processar-pedidos')
    ->everyFiveMinutes()
    ->onSuccess(function () {
        Log::info('Pedidos processados com sucesso.');
    })
    ->onFailure(function () {
        Log::error('Falha ao processar pedidos.');
    });

    Schedule::command('app:processar-orcamentos')
    ->everyFiveMinutes()
    ->onSuccess(function () {
        Log::info('Orçamentos processados com sucesso.');
    })
    ->onFailure(function () {
        Log::error('Falha ao processar orçamentos.');
    });

    Schedule::command('app:processar-clientes')
    ->everyFiveMinutes()
    ->onSuccess(function () {
        Log::info('Clientes processados com sucesso.');
    })
    ->onFailure(function () {
        Log::error('Falha ao processar clientes.');
    });
