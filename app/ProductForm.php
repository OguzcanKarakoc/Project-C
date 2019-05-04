<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductForm extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
        'form_type',
        'product_id',
    ];

    // region: many to one
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function formType()
    {
        return $this->belongsTo('App\FormType');
    }
    // endregion:
}
