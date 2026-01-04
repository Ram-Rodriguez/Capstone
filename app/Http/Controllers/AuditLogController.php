<?php

namespace App\Http\Controllers;

use App\Models\AuditLog;
use Illuminate\Http\Request;

class AuditLogController extends Controller
{
    public function index(Request $request)
    {
        $query = AuditLog::query()->latest();

        // Filters
        if ($request->filled('employee_number')) {
            $query->where('employee_number', $request->employee_number);
        }

        if ($request->filled('table_name')) {
            $query->where('table_name', $request->table_name);
        }

        if ($request->filled('record_id')) {
            $query->where('record_id', $request->table_name);
        }

        if ($request->filled('action')) {
            $query->where('action', $request->action);
        }

        $auditLogs = $query->paginate(20)->withQueryString();

        return view('admin.audit-logs.index', compact('auditLogs'));
    }
}
