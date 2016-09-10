<?php

namespace App;
use Zizaco\Entrust\EntrustRole;

class RoleUser extends EntrustRole
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role_user';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'role_id'];
}
