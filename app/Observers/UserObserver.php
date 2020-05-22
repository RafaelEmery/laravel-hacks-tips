<?php

namespace App\Observers;

use App\User;
use Illuminate\Support\Facades\Mail;

/**
 * Observers:
 * 
 * - Usamos o observer para despertar uma acao quando algo for feito com o Model
 * - Relacionamos com --model=NomeModel o observer com o Model
 * - Esta pratica ajuda a diminuirmos os tamanhos dos controllers
 * - É rodado antes de executar a instancia no banco de dados
 * - Devemos mexer no AppServiceProvider para funcionar
 */

class UserObserver
{
    /**
     * Handle the user "created" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function created(User $user)
    {
        /**
         * - Podemos alterar algo sempre que um usuario for criado
         * - $user->name += "teste" concatena ao nome do usuario
         */

         /**
          * - Desta forma, sempre que criarmos um usuario um email sera disparado
          * - Usamos a Facade de Mail no Laravel para isso, e configuramos o smtp no .env com mailtrap
          */

        Mail::send([], [], function($message) {
            $message->to('rafael.emerycade@gmai.com')
            ->$subject('Novo usuário cadastrado no sistema!')
            ->setBody('Um novo usuário foi cadastrado...'); 
        });
    }

    /**
     * Handle the user "updated" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        //
    }

    /**
     * Handle the user "deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        //
    }

    /**
     * Handle the user "restored" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function restored(User $user)
    {
        //
    }

    /**
     * Handle the user "force deleted" event.
     *
     * @param  \App\User  $user
     * @return void
     */
    public function forceDeleted(User $user)
    {
        //
    }
}
