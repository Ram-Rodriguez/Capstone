@extends('head.layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Child</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('head.children.read')}}">Back</a></li>
                        <li class="breadcrumb-item active">Create Record</li>
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
                            <h3 class="card-title">Add Child Record</h3>
                        </div>

                        <form action="{{ route('head.children.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                             <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Select Children Group (Optional)</label>
                                        <select name="children_group_id" class="form-control">
                                            <option value="" disabled selected>Select Class</option>
                                            @foreach ($children_groups as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('children_group_id')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Admission Date</label><label class="text-danger">*</label>
                                        <input type="date" name="doa" class="form-control" max="{{date('Y-m-d' , strtotime(\Carbon\Carbon::now()))}}">
                                        @error('doa')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Is Foundling (Optional)</label><br>
                                        <input type="hidden" name="is_foundling" value="0">
                                        <input type="checkbox" name="is_foundling" class="form-check-input ml-2" value="1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>First Name/Temporary Name</label><label class="text-danger">*</label>
                                        <input type="text" name="first_name" class="form-control">
                                        @error('first_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Middle Name (Optional)</label>
                                        <input type="text" name="middle_name" class="form-control">
                                        @error('middle_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Last Name (Optional)</label>
                                        <input type="text" name="lastname" class="form-control">
                                        @error('lastname')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Blood Type (Optional)</label>
                                        <select name="blood_type" class="form-control">
                                            <option value="" disabled selected>Select Blood Type</option>
                                            <option value="A+">A+</option>
                                            <option value="A-">A-</option>
                                            <option value="B+">B+</option>
                                            <option value="B-">B-</option>
                                            <option value="AB+">AB+</option>
                                            <option value="AB-">AB-</option>
                                            <option value="O+">O+</option>
                                            <option value="O-">O-</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Age (Optional)</label>
                                        <input type="text" name="age" class="form-control">
                                        @error('age')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Height (Optional)</label>
                                        <input type="text" name="height" class="form-control">
                                        @error('height')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Weight (Optional)</label>
                                        <input type="text" name="weight" class="form-control">
                                        @error('weight')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Date of Birth (Optional)</label>
                                        <input type="date" name="dob" class="form-control" max="{{date('Y-m-d' , strtotime(\Carbon\Carbon::now()))}}">
                                        @error('dob')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Father's Name (Optional)</label>
                                        <input type="text" name="father_name" class="form-control">
                                        @error('father_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Mother's Name (Optional)</label>
                                        <input type="text" name="mother_name" class="form-control">
                                        @error('mother_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Guardian's Name (Optional)</label>
                                        <input type="text" name="guardian_name" class="form-control">
                                        @error('guardian_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Case Study File (Optional)</label>
                                        <input type="file" name="csf" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Proof of Efforts (Optional)</label>
                                        <input type="file" name="poe" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Certfiicate of Foundling (If Applicable)</label>
                                        <input type="file" name="cof" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Certificate of Legal Adoption (Optional)</label>
                                        <input type="file" name="cola" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Certificate for Surrendered Child (Optional)</label>
                                        <input type="file" name="cfsc" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Birth Certificate (Optional)</label>
                                        <input type="file" name="bc" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Admission Photo (Optional)</label>
                                        <input type="file" name="admission_photo" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Latest Photo (Optional)</label>
                                        <input type="file" name="latest_photo" class="form-control">
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
