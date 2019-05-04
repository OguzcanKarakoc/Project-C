<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'product_id',
    ];

    // region: many to one
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    // endregion:
}
