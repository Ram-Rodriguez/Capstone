<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use App\Support\AuditContext;

trait Auditable
{
    protected static function resolveActor(): array
{
    if (Auth::guard('admin')->check()) {
        $user = Auth::guard('admin')->user();

        return [
            'user_id'         => $user->id,
            'employee_number' => $user->employee_number,
            'role'            => 'admin',
        ];
    }

    else {
        $user = Auth::user();

        return [
            'user_id'         => $user->id,
            'employee_number' => $user->employee_number
        ];
    }

    // return [
    //     'user_id'         => null,
    //     'employee_number' => null,
    //     'role'            => 'system',
    // ];
}
    protected static function bootAuditable()
    {
        static::updating(function ($model) {
            // $action = property_exists($model, 'is_archived') && $model->is_archived = 1
            // ? 'updated'
            // : 'deleted';
            self::logChange($model, 'updated');
        });

        static::deleting(function ($model) {
            self::logChange($model, 'deleted');
        });
    }

    protected static function logChange($model, $action)
    {
        $actor = self::resolveActor();

        if ($action === 'deleted') {
            AuditLog::create([
                'employee_number' => $actor['employee_number'],
                'table_name'      => $model->getTable(),
                'record_id'       => $model->getKey(),
                'action'          => 'deleted',
                'old_values'      => $model->getOriginal(),
                'new_values'      => null,
            ]);
            return;
        }
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
            'employee_number' => $actor['employee_number'],
            'table_name' => $model->getTable(),
            'record_id'  => $model->getKey(),
            'action'     => $action,
            'old_values' => $oldValues,
            'new_values' => $newValues,
        ]);
    }
}

