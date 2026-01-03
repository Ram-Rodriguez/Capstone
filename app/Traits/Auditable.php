<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use App\Support\AuditContext;

trait Auditable
{
    protected static function bootAuditable()
    {
        static::updating(function ($model) {
            $action = property_exists($model, 'is_archived') && $model->is_archived
            ? 'updated'
            : 'deleted';
            self::logChange($model, $action);
        });

        static::deleting(function ($model) {
            $action = property_exists($model, 'is_archived') && $model->is_archived
            ? 'archived'
            : 'deleted';
            self::logChange($model, $action);
        });
    }

    protected static function logChange($model, $action)
    {
        $user = Auth::user();
        $dirty = $model->getDirty();
        $original = $model->getOriginal();

        if (empty($dirty)) {
            return;
        }

        $oldValues = [];
        $newValues = [];

        foreach ($dirty as $field => $newValue) {

            // Handle file fields safely
            if (defined(get_class($model).'::FILE_FIELDS') &&
                in_array($field, $model::FILE_FIELDS)) {

                $oldValues[$field] = $original[$field] ? 'file_exists' : null;
                $newValues[$field] = 'file_updated';
                continue;
            }

            $oldValues[$field] = $original[$field] ?? null;
            $newValues[$field] = $newValue;
        }

        AuditLog::create([
            'employee_number' => Auth::guard('admin')->user()->employee_number,
            'table_name' => $model->getTable(),
            'record_id'  => $model->getKey(),
            'action'     => $action,
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);
    }
}

