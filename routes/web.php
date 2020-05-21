<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes(); 

Route::get('/', function () {
    return view('welcome');
});

/**
 * - Esta rota serve para mostrar uma outra abordagem sobre Collections
 * - Alguns recursos e atributos para collections
 */
Route::get('/collections', function () {
    
    /**
     * - Definindo a collection
     * - Usando o metodo collect (?)
     */
    $fruits = collect([
        'apple', 'pear', 'banana', 'strawberry'
    ]);

    /**
     * Rejeitando um elemento em uma collecion:
     * 
     * - Podemos usar o metodo reject para "deletar" um elemento especifico
     * - Isto pode ser util em operacoes com collections
     * - Passamos como parametro uma funcao anonima
     * @param fruit que queremos "rejeitar"
     * @return strawberry que e o elemento da collection escolhido
     */
    $fruits = $fruits->reject(function($fruit) {
        return $fruit == 'strawberry';
    });

    dd($fruits);
});

/** 
 * - Rota para o metodo all no controller
 * - Este metodo usa o Repository Pattern
 * - E feito para retornar todos os elementos independente da ORM do projeto
 */

Route::get('all', 'OrderController@all');

Route::get('/home', 'HomeController@index')->name('home');

/**
 * - Grupo de rotas para o sistema Admin
 * - Possuem um middleware (filtro) 'auth', ou seja, somente usuarios logados
 * - Chamamos os metodos por aqui...
 */

Route::group(['middleware' => 'auth', 'prefix' => 'orders'], function () {
    
    Route::get('/', 'OrderController@index')->name('orders.index');

    Route::get('/create', 'OrderController@create')->name('orders.create');

    Route::post('/create', 'OrderController@store')->name('orders.store');

    Route::get('/export', 'OrderController@export')->name('orders.export');
});
