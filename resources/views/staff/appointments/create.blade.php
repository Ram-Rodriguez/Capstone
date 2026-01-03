@extends('staff.layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Appointment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('staff.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Create Appointment</li>
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
                            <h3 class="card-title">Appointment Form</h3>
                        </div>

                        <form action="{{ route('staff.appointments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                             <div class="card-body">
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Appointment Date</label>
                                        <input type="datetime-local" name="appointment_date" class="form-control" min="{{date('Y-m-d\TH:i' , strtotime(\Carbon\Carbon::now()))}}">
                                        @error('appointment_date')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label>Child of Interest</label>
                                        <select name="child_id" class="form-control">
                                            <option value="" disabled selected>Select Class</option>
                                            @foreach ($children as $item)
                                            <option value="{{ $item->id }}">{{ $item->id }} {{ $item->first_name }} {{ $item->last_name }}</option>
                                            @endforeach
                                        </select>
                                        @error('child_id')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control">
                                        @error('title')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Details</label>
                                        <textarea type="text" name="details" class="form-control" rows="3"></textarea>
                                        @error('details')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                             </div>
                             <div class="card-footer">
                                <div>
                                    <button type="submit" class="btn btn-success" value="Add">Add</button>
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
