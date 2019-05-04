<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
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
    public function products()
    {
        return $this->hasMany('App\Product');
    }
    // endregion:
}
