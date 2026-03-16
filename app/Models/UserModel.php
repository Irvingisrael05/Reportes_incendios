<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\PersonModel;


class UserModel extends Authenticatable
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'person_id',
        'username',
        'password',
        'role_id',
        'status'
    ];

    protected $hidden = ['password']; // para que no se muestre en arrays o JSON

    // RELACION CON PERSONA
    public function person()
    {
        return $this->belongsTo(PersonModel::class, 'person_id', 'id_person');
    }

}
