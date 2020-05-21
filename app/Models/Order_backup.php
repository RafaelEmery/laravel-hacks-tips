<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * - Esta classe é basicamente o "Modal normal" que usamos 
 * - Feito para ser "uma base" na Repository Pattern
 * - Todas os métodos, hacks e alterações no Order é feito por aqui
 */
 
class Order extends Model
{   
    protected $fillable = [
        'status',
        'track_code'
    ];

    /**
     * Global Scope:
     * 
     * - Ainda tenho duvidas sobre...
     */

    protected static function boot() 
    {
        parent::boot();

        static::addGlobalScope('status', function(Builder $builder) {
            $builder->where('status', '<>', 'cancel');
        });
    }

    /**
     * Local Scopes:
     * 
     * - "Filtros" que podemos fazer com o Laravel
     * - A sintaxe deve ser em camel case
     * - A scope sera chamada como metodo do Eloquent, ex.: Order::pending()
     * - Basicamente retornamos a busca com o resultado que queremos
     */

    public function scopePending($query) 
    {
        return $query->where('status', 'pending');
    }

    public function scopeDelivered($query) 
    {
        return $query->where('status', 'delivered');
    }

    public function scopeCanceled($query)
    {
        return $query->where('status', 'cancel');
    }

    public function scopePaid($query) 
    {
        return $query->where('paid', 1);
    }

    /**
     * Local Scope (geral):
     * 
     * - Esta scope retorna o $status que passamos como parametro
     * - Entao, basicamente conseguimos resumir as outras 3 scopes acime de status em uma
     * - Usamos em OrderController.php
     */

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Accessors:
     * 
     * - Sao os "getters" do Laravel
     * - Usamos quando queremos exibir/pegar valores de uma forma diferente da qual eles estao no banco de dados
     * - Esta pratica evita fazermos codigos na blade
     * - Deve ser feito com camel case e entre "get..." e "...Attribute"
     * - Quando for chamado, usamos o snake case. Para o accessor abaixo seria $order->formatted_status
     */

    public function getFormattedStatusAttribute()
    {
        switch($this->status) {
            case 'delivered':
                return 'Enviado!';
            break;

            case 'pending':
                return 'Pendente!';
            break;

            case 'cancel';
                return 'Cancelado!';
            break;
        }
    }

    public function getFormattedPaidAttribute()
    {
        return $this->paid ? 'Pago!' : 'Aguardando pagamento...';
    }

    /**
     * Mutators:
     * 
     * - Sao os "setters" do Laravel
     * - Usamos quando queremos gravar/setar algum valor no banco de dados diferente do que foi entrado
     * - Assim como os accessors, deve ser respeitado o camel case
     * - O certo e "set..." nome da coluna no BD "...Attribute"
     * - Toda vez que o dado for gravado, entrara na forma que voce definiu
     * - Neste caso abaixo, ele grava o track_code com um "#" na frente
     */

    public function setTrackCodeAttribute($value) 
    {
        return $this->attributes['track_code'] = "#{$value}";
    }
}
