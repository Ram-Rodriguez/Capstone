@extends('head.layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Record</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url()->previous()}}">Back</a></li>
                        <li class="breadcrumb-item active">Edit Record</li>
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
                            <h3 class="card-title">Edit {{ $children->first_name }}'s Record</h3>
                        </div>

                        <form action="{{ route('head.children.update', $children->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $children->id }}"/>
                             <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Select Children Group</label>
                                        <select name="children_group_id" class="form-control">
                                            @foreach ($children_groups as $item)
                                            <option value="{{ $item->id }}" {{ ( $item->id == $children->children_group_id) ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('children_group_id')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Admission Date</label>
                                        <input type="date" name="doa" class="form-control" value="{{ $children->doa }}">
                                        @error('doa')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Is Foundling</label><br>
                                        <input type="hidden" name="is_foundling" value="{{ $children->is_foundling }}">
                                        <input type="checkbox" name="is_foundling" class="form-check-input ml-2" value="1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>First Name</label>
                                        <input type="text" name="first_name" class="form-control" value="{{ $children->first_name }}">
                                        @error('first_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Middle Name</label>
                                        <input type="text" name="middle_name" class="form-control" value="{{ $children->middle_name }}">
                                        @error('middle_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Last Name</label>
                                        <input type="text" name="lastname" class="form-control" value="{{ $children->lastname }}">
                                        @error('lastname')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Blood Type</label>
                                        <select name="blood_type" class="form-control">
                                            <option value="A+" {{ ( $item->id == "A+") ? 'selected' : '' }}>A+</option>
                                            <option value="A-" {{ ( $item->id == "A-") ? 'selected' : '' }}>A-</option>
                                            <option value="B+" {{ ( $item->id == "B+") ? 'selected' : '' }}>B+</option>
                                            <option value="B-" {{ ( $item->id == "A-") ? 'selected' : '' }}>B-</option>
                                            <option value="AB+" {{ ( $item->id == "AB+") ? 'selected' : '' }}>AB+</option>
                                            <option value="AB-" {{ ( $item->id == "AB-") ? 'selected' : '' }}>AB-</option>
                                            <option value="O+" {{ ( $item->id == "O+") ? 'selected' : '' }}>O+</option>
                                            <option value="O-" {{ ( $item->id == "O+") ? 'selected' : '' }}>O-</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Age</label>
                                        <input type="text" name="age" class="form-control" value="{{ $children->age }}">
                                        @error('age')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Height</label>
                                        <input type="text" name="height" class="form-control" value="{{ $children->height }}">
                                        @error('height')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Weight</label>
                                        <input type="text" name="weight" class="form-control" value="{{ $children->weight }}">
                                        @error('weight')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" value="{{ $children->dob }}">
                                        @error('dob')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Father's Name</label>
                                        <input type="text" name="father_name" class="form-control" value="{{ $children->father_name }}">
                                        @error('father_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Mother's Name</label>
                                        <input type="text" name="mother_name" class="form-control" value="{{ $children->mother_name }}">
                                        @error('mother_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Guardian's Name</label>
                                        <input type="text" name="guardian_name" class="form-control" value="{{ $children->guardian_name }}">
                                        @error('guardian_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Case Study File</label><br>
                                        @if($children->csf != null)
                                            <a href="{{ route('download.csf', $children->id) }}">Download Existing File</a>
                                        @endif
                                        <input type="file" name="csf" class="form-control" value="{{ $children->csf }}">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Proof of Efforts</label><br>
                                        @if($children->poe != null)
                                            <a href="{{ route('download.poe', $children->id) }}">Download Existing File</a>
                                        @endif
                                        <input type="file" name="poe" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Certfiicate of Foundling (If Applicable)</label><br>
                                        @if($children->cof != null)
                                            <a href="{{ route('download.cof', $children->id) }}">Download Existing File</a>
                                        @endif
                                        <input type="file" name="cof" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Certificate of Legal Adoption</label><br>
                                        @if($children->cola != null)
                                            <a href="{{ route('download.cola', $children->id) }}">Download Existing File</a>
                                        @endif
                                        <input type="file" name="cola" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Certificate for Surrendered Child</label><br>
                                        @if($children->cfsc != null)
                                            <a href="{{ route('download.cfsc', $children->id) }}">Download Existing File</a>
                                        @endif
                                        <input type="file" name="cfsc" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Birth Certificate</label><br>
                                        @if($children->bc != null)
                                            <a href="{{ route('download.bc', $children->id) }}">Download Existing File</a>
                                        @endif
                                        <input type="file" name="bc" class="form-control">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Admission Photo</label><br>
                                        @if($children->admission_photo != null)
                                            <a href="{{ route('download.admission_photo', $children->id) }}">Download Existing File</a>
                                        @endif
                                        <input type="file" name="admission_photo" class="form-control">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Latest Photo</label><br>
                                        @if($children->latest_photo != null)
                                            <a href="{{ route('download.latest_photo', $children->id) }}">Download Existing File</a>
                                        @endif
                                        <input type="file" name="latest_photo" class="form-control">
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
