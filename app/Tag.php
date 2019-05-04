<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
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
        return $this->belongsToMany('App\Product', 'tag_products', 'tag_id', 'product_id');
    }
    // endregion:
}
