<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    // region: many to many
    public function products()
    {
        return $this->belongsToMany('App\Product', 'category_products', 'category_id', 'product_id');
    }
    // endregion:
}
