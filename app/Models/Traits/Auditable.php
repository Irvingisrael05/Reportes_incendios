<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

trait Auditable
{
    protected static function bootAuditable()
    {
        static::created(function ($model) {
            $model->auditLog('INSERT', $model->getAttributes(), null);
        });

        static::updated(function ($model) {
            $old = $model->getOriginal();
            $new = $model->getAttributes();
            $old = self::removeSensitiveFields($old);
            $new = self::removeSensitiveFields($new);
            $model->auditLog('UPDATE', $new, $old);
        });

        static::deleted(function ($model) {
            $old = $model->getOriginal();
            $old = self::removeSensitiveFields($old);
            $model->auditLog('DELETE', null, $old);
        });
    }

    protected function auditLog($operation, $newData, $oldData)
    {
        DB::connection()->statement(
            'INSERT INTO public.audit_logs 
            (table_name, operation, record_id, old_data, new_data, changed_by_user_id, changed_by_type, source_ip, user_agent)
            VALUES (?, ?, ?::text, ?::jsonb, ?::jsonb, ?, ?, ?::inet, ?)',
            [
                $this->getTable(),
                $operation,
                (string) $this->getKey(),
                $oldData ? json_encode($oldData) : null,
                $newData ? json_encode($newData) : null,
                Auth::id(),
                'app',
                request()->ip(),
                request()->userAgent()
            ]
        );
    }

    protected static function removeSensitiveFields(array $data)
    {
        $sensitive = ['password', 'remember_token'];
        foreach ($sensitive as $field) {
            if (array_key_exists($field, $data)) {
                $data[$field] = '[REDACTED]';
            }
        }
        return $data;
    }
}