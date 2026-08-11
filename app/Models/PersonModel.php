<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Models\Traits\Auditable;

class PersonModel extends Model
{
  //  use Auditable;

    protected $table = 'persons';

    protected $primaryKey = 'id_person';

    public $timestamps = false;

    protected $fillable = [
        'first_name',
        'last_name',
        'middle_name',
        'phone',
        'email'

    ];

}
