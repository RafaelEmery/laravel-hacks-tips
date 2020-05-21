<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * - Foi usado o pacote do prettus para Rep. Pattern
 * - Neste caso, usamos a "interface padrao"
 */

/**
 * Interface OrderRepository.
 *
 * @package namespace App\Repositories;
 */
interface OrderRepository extends RepositoryInterface
{
    /**
     * - Este metodo deve existir em todas classes que implementam esta interface
     * - Para cada metodo que iremos definir usando o Repository Pattern devemos definir aqui 
     * - E depois implementar no OrderRepositoryEloquent.php 
     */
    public function listAll();
}
