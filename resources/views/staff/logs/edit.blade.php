@extends('staff.layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Log</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url()->previous()}}">Back</a></li>
                        <li class="breadcrumb-item active">Edit Log</li>
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
                        @if(Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        <div class="card-header">
                            <h3 class="card-title">Log Update Form</h3>
                        </div>

                        <form action="{{ route('staff.logs.update', $log->child_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                             <div class="card-body">
                                <div class="row">
                                    <input type="hidden" class="form-control"  name="child_id" value="{{$log->child_id}}" readonly></input>

                                    <div class="form-group col">
                                        <label>Details</label>
                                        <textarea type="text" name="details" class="form-control" rows="3">{{$log->details}}</textarea>
                                        @error('details')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                             </div>
                             <div class="card-footer">
                                <div>
                                    <button type="submit" class="btn btn-success" value="Save">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
