<?php

namespace App\Observers;

use App\User;
use App\Jobs\SendCreatedUserEmail;

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
         * - Chamando o Job SendCreatedUserEmail
         * - Este sera um Job na fila do Laravel para enviar um email de usuario criado
         */

        SendCreatedUserEmailRoute::dispatch($user);
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
