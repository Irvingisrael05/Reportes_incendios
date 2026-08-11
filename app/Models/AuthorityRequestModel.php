<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Models\Traits\Auditable;

class AuthorityRequestModel extends Model
{
   // use Auditable;

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
    public function user() { return $this->belongsTo(User::class, 'user_id', 'id_user'); }

}
