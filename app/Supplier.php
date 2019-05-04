<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
        'email',
    ];

    // region: one to many
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    // endregion:
}
