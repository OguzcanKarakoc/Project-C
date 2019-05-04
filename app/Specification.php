<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
        'product_id',
    ];

    // region: many to one
    public function product()
    {
        return $this->belongsTo('App\Product');
    }
    // endregion:
}
