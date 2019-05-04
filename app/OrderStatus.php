<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    // region: one to many
    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    // endregion:
}
