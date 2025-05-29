# acav_rdstation


O projeto executa Laravel junto ao container de Mysql, dentro de um container docker.

Para executar o projeto é necessário executar o container e após isso executar o "bash", que seria o terminal, dentro do container. Assim será possível instalar os componentes e atualizar, caso necessário:

docker compose up -d –-build

docker exec -it nome-servico bash

Então executar - dentro do bash: 
- composer install (na instalação)

- php artisan storage:link (cria o link simbólico que armazena as imagens e arquivos)

- copia do arquivo ".env.example" para ".env" (cp .env.example .env)

- inserir configurações de banco e outras

- php artisan key:generate - gera chave hash da aplicação

- exit (comando para sair e voltar a docker)


Tendo como estrutura principal o Laravel 12, no momento de criação 2024-2025 e PHP 8.4 como requisito mínimo necessário. O container de Mysql pode ser utilizado em outro projeto e não precisa estar atrelado ao projeto "acav_rdstation".

Docker - container 

Dentro do container docker existe a configuração de portas utilizada e as variáveis de ambiente estão sendo utilizadas a partir do arquivo ".env". 

Variáveis de ambiente - aquivo ".env"

// Webhook que gera notificações para um grupo "space" do google - indica falha na execução de pontos crítivcos, caso ocorram

GOOGLE_CHAT_WEBHOOK_URL=________

// dados de vinculação de e-mail que enviara notificações da API

MAIL_MAILER=smtp
MAIL_HOST=smtp.....
MAIL_PORT=587
MAIL_ENCRYPTION=tls
MAIL_USERNAME="email@gmail.br"
MAIL_PASSWORD=_____________
MAIL_FROM_ADDRESS="email@acav.br"
MAIL_FROM_NAME="${APP_NAME}"

O projeto utiliza a biblioteca "pedroni/laravel-rd-station" para realizar a conexão com a RD Station. 

As tratativas de acesso aos dados são feitas na pasta "app/Console/Commands" pelos arquivos:

- ProcessarClientes.php
- ProcessarOrcamentos.php
- ProcessarPedidos.php

No projeto inicial dentro de "routes/console.php" existe a estrutura que ativa as buscas de registros e envia para a RD Station. 

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
