<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonasModel extends Model
{

    protected $table = 'persons';

    protected $primaryKey = 'id_person';

    public $timestamps = false;

    protected $fillable = [

        'first_name',
        'last_name',
        'middle_name',
        'phone'

    ];

}
