@extends('admin.layout')
@push('styles')
<style>
    .audit-pagination svg {
    width: 16px !important;
    height: 16px !important;
    }

    .audit-pagination .pagination {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .audit-pagination .page-link {
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.2;
    }
</style>
@endpush

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="mb-4">Audit Logs</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="admin.dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active">Audit Logs</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    {{-- Filters --}}
                    <form method="GET" class="row g-2 mb-4">
                        <div class="col-md-2">
                            <input name="employee_number" value="{{ request('employee_number') }}"
                                class="form-control" placeholder="Employee #">
                        </div>

                        <div class="col-md-2">
                            <input name="table_name" value="{{ request('table_name') }}"
                                class="form-control" placeholder="Table">
                        </div>

                        <div class="col-md-2">
                            <input name="record_id" value="{{ request('record_id') }}"
                                class="form-control" placeholder="Record ID">
                        </div>

                        <div class="col-md-2">
                            <select name="action" class="form-control">
                                <option value="">Action</option>
                                @foreach(['updated','deleted'] as $action)
                                    <option value="{{ $action }}" @selected(request('action') === $action)>
                                        {{ ucfirst($action) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button class="btn btn-primary w-100">Filter</button>
                        </div>
                    </form>

                    {{-- Table --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Actor Employee #</th>
                                    <th>Status</th>
                                    <th>Table</th>
                                    <th>Record ID</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                            @forelse ($auditLogs as $log)
                                <tr>
                                    <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
                                    <td>{{ $log->employee_number ?? '—' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-{{ $log->action === 'deleted' ? 'danger' : 'info' }}">
                                            {{ ucfirst($log->action) }}
                                        </span>
                                    </td>
                                    <td>{{ $log->table_name }}</td>
                                    <td>{{ $log->record_id }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-sm btn-outline-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#auditModal{{ $log->id }}">
                                            View
                                        </button>

                                        {{-- Modal --}}
                                        <div class="modal fade" id="auditModal{{ $log->id }}">
                                            <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Audit Details</h5>
                                                        <button type="button" class="close" data-bs-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <h6>Old Values</h6>
                                                        <pre class="bg-light p-2">{{ json_encode($log->old_values, JSON_PRETTY_PRINT) }}</pre>

                                                        <h6>New Values</h6>
                                                        <pre class="bg-light p-2">{{ json_encode($log->new_values, JSON_PRETTY_PRINT) }}</pre>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No audit logs found.</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="audit-pagination mt-3">
                        {{ $auditLogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
