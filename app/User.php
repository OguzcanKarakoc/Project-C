<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone_number',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // region: many to one
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    // endregion:

    // region: one to many
    public function addresses()
    {
        return $this->hasMany('App\Address');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
    // endregion:

    // region: many to many
    public function favorites()
    {
        return $this->belongsToMany('App\Product', 'favorites', 'user_id', 'product_id');
    }
    // endregion:
}
