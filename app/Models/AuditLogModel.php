<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLogModel extends Model
{
    /**
     * Tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'audit_logs';

    /**
     * Clave primaria de la tabla.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indica si el modelo debe manejar automáticamente los timestamps.
     * La tabla solo tiene 'created_at', sin 'updated_at'.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'table_name',
        'operation',
        'record_id',
        'old_data',
        'new_data',
        'changed_by_user_id',
        'changed_by_type',

        // ==========================================================
        // AGREGADO:
        // Guarda el usuario conectado directamente a PostgreSQL
        // Ejemplo: postgres, admin, irving, etc.
        // ==========================================================
        'db_user',

        'source_ip',
        'user_agent',
        'created_at',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',      // Convierte a Carbon
        'old_data'   => 'json',          // Convierte automáticamente de/a JSON
        'new_data'   => 'json',
    ];

    // ==============================================================
    // RELACIONES
    // ==============================================================

    /**
     * Obtiene el usuario autenticado que realizó el cambio.
     * Relación opcional (puede ser nulo si el cambio vino de SQL directo).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'changed_by_user_id', 'id_user');
    }

    // ==============================================================
    // SCOPES LOCALES (Filtros reutilizables)
    // ==============================================================

    /**
     * Filtra los logs por nombre de tabla.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $table
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForTable($query, $table)
    {
        if ($table) {
            return $query->where('table_name', $table);
        }
        return $query;
    }

    /**
     * Filtra los logs por tipo de operación (INSERT, UPDATE, DELETE).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $operation
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForOperation($query, $operation)
    {
        if ($operation) {
            return $query->where('operation', $operation);
        }
        return $query;
    }

    /**
     * Filtra los logs por origen (app = aplicación, postgres = SQL directo).
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $origin
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForOrigin($query, $origin)
    {
        if ($origin) {
            return $query->where('changed_by_type', $origin);
        }
        return $query;
    }

    /**
     * Filtra los logs a partir de una fecha específica.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $date
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFromDate($query, $date)
    {
        if ($date) {
            return $query->whereDate('created_at', '>=', $date);
        }
        return $query;
    }
}
