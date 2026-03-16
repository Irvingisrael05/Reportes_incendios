<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportStatusModel extends Model
{
    use HasFactory;

    protected $table = 'report_status'; // nombre de la tabla
    protected $primaryKey = 'id_status';
    public $timestamps = false;

    protected $fillable = [
        'description',
    ];

    // Relación con reportes
    public function reports()
    {
        return $this->hasMany(ReportModel::class, 'status_id', 'id_status');
    }
    public function status()
    {
        return $this->belongsTo(ReportStatusModel::class, 'status_id', 'id_status');
    }
}
