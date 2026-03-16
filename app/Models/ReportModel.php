<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportModel extends Model
{
    protected $table = 'reports';
    protected $primaryKey = 'id_report';
    public $timestamps = false;

    // Campos que se pueden llenar
    protected $fillable = [
        'user_id',
        'ecosystem_id',
        'weather_id',
        'status_id',
        'latitude',
        'longitude',
        'report_date',
        'description'
    ];

    // Relación con Ecosystem
    public function ecosystem()
    {
        return $this->belongsTo(EcosystemModel::class, 'ecosystem_id', 'id_ecosystem');
    }

    // Relación con Category (opcional, si se requiere)
    public function category()
    {
        return $this->belongsTo(CategoryModel::class, 'category_id', 'id_category');
    }

    // Relación con Status
    public function status()
    {
        return $this->belongsTo(ReportStatusModel::class, 'status_id', 'id_status');
    }

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

}
