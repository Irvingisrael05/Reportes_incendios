<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Traits\Auditable;

class CategoryModel extends Model
{
   // use Auditable;
    use HasFactory;

    protected $table = 'categories'; // nombre de la tabla
    protected $primaryKey = 'id_category'; // clave primaria
    public $timestamps = false; // no usamos created_at / updated_at aquí

    protected $fillable = [
        'description',
        'image_reference',
    ];

    // Relación con evidences
    public function evidences()
    {
        return $this->hasMany(EvidenceModel::class, 'category_id', 'id_category');
    }
}
