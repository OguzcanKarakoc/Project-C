<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProsCon extends Model
{
    protected $fillable = [
        'text',
        'vote',
        'rating_id',
    ];

    // region: many to one
    public function rating()
    {
        return $this->belongsTo('App\Rating');
    }
    // endregion:


}
