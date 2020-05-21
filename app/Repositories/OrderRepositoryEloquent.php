<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\OrderRepository;
use App\Models\Order;
use App\Validators\OrderValidator;

/**
 * - Foi usado o pacote do prettus para Rep. Pattern
 * - Neste caso, usamos o "repository padrão" e implementamos a interface que definimos 
 */

/**
 * Class OrderRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
     * - Metodo que faz a listagem de todos as Order
     * - Serve para ser chamado e executado independente da ORM do projeto
     * @return Order collection com todas as Orders
     */
    public function listAll()
    {
        return Order::all();
    }    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
