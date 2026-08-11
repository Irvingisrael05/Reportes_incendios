<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Models\Traits\Auditable;

class AssignmentModel extends Model
{
    //use Auditable;

    protected $table = 'assignments';
    protected $primaryKey = 'id_assignment';
    public $timestamps = false;

    protected $fillable = [
        'report_id',
        'authority_id',
        'assignment_date',
        'attended_date'
    ];

    // Relación con Report
    public function report()
    {
        return $this->belongsTo(ReportModel::class, 'report_id', 'id_report');
    }

    // Relación con Authority/User
    public function authority()
    {
        return $this->belongsTo(User::class, 'authority_id', 'id_user');
    }



}
