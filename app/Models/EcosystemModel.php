<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Traits\Auditable;

class EcosystemModel extends Model
{
    use Auditable;
    
    protected $table = 'ecosystems';
    protected $primaryKey = 'id_ecosystem';
    public $timestamps = false;
    protected $fillable = ['description'];
}
