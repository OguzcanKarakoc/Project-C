<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rating',
        'user_id',
        'product_id',
        'comment',
    ];


    // region: many to one
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    // endregion:

    // region: one to many
    public function prosCons()
    {
        return $this->hasMany('App\ProsCon');
    }
    // endregion:
}
