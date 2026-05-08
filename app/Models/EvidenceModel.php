<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Auditable;
use App\Models\CategoryModel;

class EvidenceModel extends Model
{
    use Auditable;

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

    // RELACION CON CATEGORIAS
    public function category()
    {
        return $this->belongsTo(
            CategoryModel::class,
            'category_id',
            'id_category'
        );
    }
}
