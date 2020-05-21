<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Repositories\OrderRepository;
use PDF;

class OrderController extends Controller
{   
    /**
     * @return orders (Collection) de acordo com as buscas/$query feitas
     */

    public function index()
    {      
        /**
         * Fazendo um filtro com Scopes:
         * 
         * - Usamos o metodo 'where' com uma funcao anonima dentro passando a $query ("busca")
         * - Chamamos a scopeStatus que existem em Order.php
         * - Deve ter o ->get() no final para termos uma Collection
         * 
         * Alternativas:
         * 
         * - Usar os scopes especificos em Order.php
         * $orders = Order::delivered()->get();
         * $orders = Order::pending()->get();
         * 
         * - Ou fazer um filtro "manual" usando 'switch($request->get('status'))' e 'case 'delivered': $orders = $orders->where('status','delivered');' 
         * - OBS: O jeito acima consiste em atribuir Order::all() e ir "sobrescrevendo", e o condicional nao precisa ser por 'switch case'
         */

        $orders = Order::where(function($query) {

            /**
             * Usando a scopeStatus: 
             * 
             * - Puxando o campo 'status' para a query, conseguimos fazer um filtro de acordo com o status passado como parametro 
             * - Em Order.php ao inves de usarmos scopes especificos como scopePending ou scopeDelivered, usamos o scopeStatus e passamos o status (valor do enum.) como parametro.
             * 
             * Alternativa:
             * 
             * - Usando scopes específicas (scopePending e scopeDelivered):
             * - O filtro tambem pode ser feito usando os scopes especificos
             * - Fazendo um condicional 'if(request()->get('status) == 'pending')' e dentro usamos a scope '$query->pending()'
             * - Igual ao uso do scopePaid abaixo...
             */

            if (request()->get('status')) {
                $query->status(request()->get('status'));
            }

            /**
             * - Scope especifico para quando o campo 'paid' for verdadeiro 
             * - Em Order.php usamos o scopePaid
             */

            if (request()->get('paid') == 1) {
                $query->paid();
            }
            
        })->get();

        return view('dashboard.index', compact('orders'));
    }

    public function create() 
    {
        return view('dashboard.create');
    }

    /**
     * @param OrderRequest como paramatro onde sao feitas todas as validacoes relacionada a este objeto que ira ser criado
     * @return route 'orders.index' que leva a tabela principal
     */

    public function store(OrderRequest $request) 
    {   
        $order = Order::create($request->all());

        return redirect(route('orders.index'));
    }

    /**
     * Usando o Repository Pattern:
     * 
     * - È útil pois assim adaptamos nosso projeto e nossos Models para o uso de outra ORM - diferente do Eloquent
     * - Existe um Order_backup.php
     * - O Order.php usa uma interface e uma trait para usar este Pattern
     * - Usamos este metodo para listar todos, independente do ORM que esta sendo usado
     * @param OrderRepository repositorio que definimos para cada Order
     * @return listAll metodo dinamico da interface OrderRepository e implementado em OrderRepositoryEloquent.php
     */

    public function all(OrderRepository $repository)  
    {
        return $repository->listAll();
    }

    /**
     * Gerando PDF da tabela 'orders':
     * 
     * - Foi usado o pacote barryvdh/laravel-dompdf
     * - Baixado e instalado pelo composer e configurado em 'app.php'
     * - O metodo loadview recebe como parametro uma view na pasta 'pdf' e uma Collection de orders
     * @return pdf->download para um arquivo chamado 'orders_report.pdf'
     */

    public function export()
    {
        $orders = Order::all();
        $pdf = PDF::loadview('pdf/orders', compact('orders'));

        return $pdf->download('orders_report.pdf');
    }
}
