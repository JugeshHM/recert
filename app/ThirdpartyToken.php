<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThirdpartyToken extends Model
{
  
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'thirdparty_tokens';
    
    protected $hidden = array('disable','created_at','updated_at');
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['token', 'disable', 'created_at', 'updated_at'];
}
