<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Traits\Auditable;
class User extends Authenticatable
{
    use Auditable;
    
    use Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';
    public $timestamps = true; // tu tabla tiene created_at y updated_at

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'person_id',
        'username',
        'password',
        'role_id',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function person() { return $this->belongsTo(PersonModel::class, 'person_id', 'id_person'); }
    public function role() { return $this->belongsTo(RoleModel::class, 'role_id', 'id_role'); }
    public function authorityRequest() { return $this->hasOne(AuthorityRequestModel::class, 'user_id', 'id_user')->where('status', 'approved'); }

}