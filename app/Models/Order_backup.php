<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
 
class Order extends Model
{   
    protected $fillable = [
        'status',
        'track_code'
    ];

    protected static function boot() 
    {
        parent::boot();

        static::addGlobalScope('status', function(Builder $builder) {
            $builder->where('status', '<>', 'cancel');
        });
    }

    public function scopePending($query) 
    {
        return $query->where('status', 'pending');
    }

    public function scopeDelivered($query) 
    {
        return $query->where('status', 'delivered');
    }

    //Falta a Scope para o cancelado...

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopePaid($query) 
    {
        return $query->where('paid', 1);
    }

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

    public function setTrackCodeAttribute($value) 
    {
        return $this->attributes['track_code'] = "#{$value}";
    }
}
