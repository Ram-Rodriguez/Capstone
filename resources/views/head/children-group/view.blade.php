@extends('head.layout')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Children Group</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('head.children-group.read') }}">Back</a></li>
                            <li class="breadcrumb-item active">{{ $children_group->name }}</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            @if (Session::has('success'))
                                <div class="alert alert-success">{{ Session::get('success') }}</div>
                            @endif

                            <div class="card-header">
                                <h1 class="card-title">{{ $children_group->name }}</h1>
                            </div>
                            <div class="card-body">
                                @if ($children_group->employee_id)
                                    <h5>Employee In-Charged {{ $children_group->employee?->first_name }}
                                        {{ $children_group->employee?->lastname }}</h5>
                                @else
                                    <h5>There is no one in-charge assigned to this group yet.</h5>
                                @endif
                                <p>Members:</p>
                                @forelse($children as $item)
                                    <p>{{ $item->id }} - {{ $item->first_name }} {{ $item->last_name }}</p>
                                @empty
                                    <p><em>There are no members in this team yet.</em></p>
                                @endforelse
                            </div>

                            <div class="card-footer">
                                <a role="button" href="{{route('head.children-group.edit', $children_group->id)}}" class="btn btn-primary">Edit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
