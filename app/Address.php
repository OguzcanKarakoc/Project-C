<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'postcode',
        'city',
        'street',
        'house_number',
        'delivery_address',
        'user_id',
    ];

    // region: many to one
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // endregion:
}
