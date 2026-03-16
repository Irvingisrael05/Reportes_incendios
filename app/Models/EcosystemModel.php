<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EcosystemModel extends Model
{
    protected $table = 'ecosystems';
    protected $primaryKey = 'id_ecosystem';
    public $timestamps = false;
    protected $fillable = ['description'];
}
