<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            /**
             * Alguns tipos novos:
             * 
             * - enum('nome_da_coluna', ['array_de_valores']) que possui possiveis valores
             * - boolean com o default para definir como sera por padrao
             */
            
            $table->id();
            $table->enum('status', ['delivered', 'pending', 'cancel']);
            $table->boolean('paid')->default(false);
            $table->string('track_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
