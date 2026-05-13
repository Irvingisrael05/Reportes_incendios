<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Auditable;

class ReportModel extends Model
{
    use Auditable;

    protected $table = 'reports';
    protected $primaryKey = 'id_report';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'ecosystem_id',
        'category_id',
        'weather_id',
        'status_id',
        'latitude',
        'longitude',
        'municipality',
        'locality',
        'report_date',
        'description'
    ];

    public function status() { return $this->belongsTo(ReportStatusModel::class, 'status_id', 'id_status'); }
    public function ecosystem() { return $this->belongsTo(EcosystemModel::class, 'ecosystem_id', 'id_ecosystem'); }
    public function category() { return $this->belongsTo(CategoryModel::class, 'category_id', 'id_category'); }
    public function weather() { return $this->belongsTo(WeatherModel::class, 'weather_id', 'id_weather'); }
    public function evidences() { return $this->hasMany(EvidenceModel::class, 'report_id', 'id_report'); }
    public function assignments() { return $this->hasMany(AssignmentModel::class, 'report_id', 'id_report'); }
}
