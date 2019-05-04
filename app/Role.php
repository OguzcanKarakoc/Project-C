<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    static $count;

    // region: one to many
    public function users()
    {
        return $this->hasMany('App\User');
    }
    // endregion:
}
