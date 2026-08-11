<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use App\Models\Traits\Auditable;

class WeatherModel extends Model
{
    //use Auditable;

    protected $table = 'weather_conditions';
    protected $primaryKey = 'id_weather';
    public $timestamps = false;

    // Campos que se pueden llenar
    protected $fillable = [
        'temperature',
        'humidity',
        'precipitation',
        'wind_speed',
        'wind_direction',
        'atmospheric_pressure',
        'cloudiness',
        'record_date'
    ];

    // Relación con reportes
    public function report()
    {
        return $this->hasOne(ReportModel::class, 'weather_id', 'id_weather');
    }
}
