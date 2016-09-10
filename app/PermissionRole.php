<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class PermissionRole extends EntrustRole
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'permission_role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['permission_id', 'role_id'];
}
