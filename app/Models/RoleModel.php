<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Traits\Auditable;

class RoleModel extends Model
{
    use Auditable;
    protected $table = 'roles';
    protected $primaryKey = 'id_role';
    public $timestamps = false;

    protected $fillable = ['role_type'];
}