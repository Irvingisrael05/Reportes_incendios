<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EvidenceModel extends Model
{

    protected $table = 'evidences';

    protected $primaryKey = 'id_evidence';

    public $timestamps = false;

    protected $fillable = [
        'report_id',
        'user_id',
        'category_id',
        'url',
        'evidence_date'
    ];

}
