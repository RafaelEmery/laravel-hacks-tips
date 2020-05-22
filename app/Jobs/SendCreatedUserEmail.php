<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

/**
 * Filas:
 * 
 * - As queues do Laraval auxiliam a rodar multiplos processos e a "desafogar" o processamento do sistema
 * - Devemos fazer a tabela de Jobs com php artisan queue:table
 * - Se dermos php artisan queue:list vemos a fila de Jobs sendo executadas em background
 * - Filas sao uteis em casos que o sistema pode processar dados em segundo plano enquanto o usuario usa, entre outros
 * - Por exemplo, envio de email de recuperacao e confimacao de conta
 */

/**
 * Jobs:
 * 
 * - Acoes que ficaram na fila (Queue) esperando para ser executadas
 * - Existe a tabela de jobs nas migrations
 * - Este Job e para enviar um email quando um usuario for criado
 * - E chamado no UserObserver no metodo create
 */

class SendCreatedUserEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $user;

    /**
     * Create a new job instance. 
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        /**
          * - Desta forma, sempre que criarmos um usuario um email sera disparado (Observer x Job)
          * - Usamos a Facade de Mail no Laravel para isso, e configuramos o smtp no .env com mailtrap
          */

        Mail::send([], [], function($message) {
            $message->to('rafael.emerycade@gmai.com')
            ->$subject('{$this->user->name} foi cadastrado no sistema!')
            ->setBody('Um novo usuário foi cadastrado...'); 
        });
    }
}
