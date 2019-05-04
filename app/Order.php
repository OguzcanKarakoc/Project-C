<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address_id',
        'order_status_id',
    ];

    // region: many to one
    public function orderStatus()
    {
        return $this->belongsTo('App\OrderStatus');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function address()
    {
        return $this->belongsTo('App\Address');
    }

    public function shipment()
    {
        return $this->belongsTo('App\Shipment');
    }
    // endregion:

    // region: one to many
    public function products()
    {
        return $this->hasMany('App\OrderProduct');
    }
    // endregion:


}
