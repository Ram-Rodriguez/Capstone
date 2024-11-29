@extends('head.layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Court Appointment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
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
                            <h3 class="card-title">Court Appointment Form</h3>
                        </div>

                        <form action="{{ route('head.appointments.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                             <div class="card-body">
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Appointment Date</label>
                                        <input type="datetime-local" name="appointment_date" class="form-control">
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
                                <div class="row">
                                    <h3>Required Documents</h3>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Case Study File</label>&emsp;
                                        <input type="hidden" name="csf" value="0">
                                        <input type="checkbox" name="csf" class="form-check-input ml-2" value="1">
                                        <br>
                                        <label>Proof of Efforts</label>&emsp;
                                        <input type="hidden" name="poe" value="0">
                                        <input type="checkbox" name="poe" class="form-check-input ml-2" value="1">
                                        <br>
                                        <label>Certificate of Foundling</label>&emsp;
                                        <input type="hidden" name="cof" value="0">
                                        <input type="checkbox" name="cof" class="form-check-input ml-2" value="1">
                                        <br>
                                        <label>Certificate for Legal Adoption</label>&emsp;
                                        <input type="hidden" name="cola" value="0">
                                        <input type="checkbox" name="cola" class="form-check-input ml-2" value="1">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Certificate for Surrendered Child</label>&emsp;
                                        <input type="hidden" name="cfsc" value="0">
                                        <input type="checkbox" name="cfsc" class="form-check-input ml-2" value="1">
                                        <br>
                                        <label>Birth Certificate</label>&emsp;
                                        <input type="hidden" name="bc" value="0">
                                        <input type="checkbox" name="bc" class="form-check-input ml-2" value="1">
                                        <br>
                                        <label>Admission Photo</label>&emsp;
                                        <input type="hidden" name="admission_photo" value="0">
                                        <input type="checkbox" name="admission_photo" class="form-check-input ml-2" value="1">
                                        <br>
                                        <label>Latest Photo</label>&emsp;
                                        <input type="hidden" name="latest_photo" value="0">
                                        <input type="checkbox" name="latest_photo" class="form-check-input ml-2" value="1">
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
