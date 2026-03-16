<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorityRequestModel extends Model
{

    protected $table = 'authority_requests';

    protected $primaryKey = 'id_request';

    public $timestamps = false;

    protected $fillable = [

        'user_id',
        'company_name',
        'company_key',
        'employee_key',
        'company_location'

    ];

}
