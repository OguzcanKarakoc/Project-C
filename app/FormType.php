<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormType extends Model
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
    public function productForms()
    {
        return $this->hasMany('App\ProductForm');
    }
    // endregion:
}
