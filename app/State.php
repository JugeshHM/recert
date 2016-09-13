<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\State
 *
 * @mixin \Eloquent
 */
class State extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'states';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description', 'created_at', 'updated_at'];
}
