@extends('staff.layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>View Child Record</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url()->previous()}}">Back</a></li>
                        <li class="breadcrumb-item active">Child Record</li>
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
                            <h3 class="card-title">Child ID No: {{$child->id}}'s Record</h3>
                        </div>
                             <div class="card-body">
                                    @if(\Carbon\Carbon::now()->diffInMonths($child->doa) <= -3)
                                    <div class="row">
                                        <div class="btn btn-success">
                                            This Record is Eligible for Adoption Petition
                                        </div>
                                    </div><br>
                                    @endif
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Children Group</label>
                                        <select name="children_group_id" class="form-control" readonly>
                                            <option value="" disabled selected>Select Class</option>
                                            @foreach ($children_groups as $item)
                                            <option value="{{ $item->id }}" {{($child->children_group_id == $item->id) ? 'selected': ''}} disabled>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('children_group_id')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Admission Date</label>
                                        <input type="date" name="doa" class="form-control" value="{{ $child->doa }}" disabled>
                                        @error('doa')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Is Foundling</label><br>
                                        <input type="hidden" name="is_foundling" value="0">
                                        <input type="checkbox" name="is_foundling" class="form-check-input ml-2" value="1" {{($child->is_foundling == 1) ? 'checked': ''}} disabled>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>First Name/Temporary Name</label>
                                        <input type="text" name="first_name" class="form-control" value="{{$child->first_name}}" readonly>
                                        @error('first_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Middle Name</label>
                                        <input type="text" name="middle_name" class="form-control" value="{{$child->middle_name}}" readonly>
                                        @error('middle_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Last Name</label>
                                        <input type="text" name="lastname" class="form-control" value="{{$child->lastname}}" readonly>
                                        @error('lastname')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Blood Type</label>
                                        <input type="text" class="form-control" value="{{$child->blood_type}}" readonly>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Age</label>
                                        <input type="text" name="age" class="form-control" value="{{$child->age}}" readonly>
                                        @error('age')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Height</label>
                                        <input type="text" name="height" class="form-control" value="{{$child->height}}" readonly>
                                        @error('height')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Weight</label>
                                        <input type="text" name="weight" class="form-control" value="{{$child->weight}}" readonly>
                                        @error('weight')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" class="form-control" value="{{$child->dob}}" readonly>
                                        @error('dob')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Father's Name</label>
                                        <input type="text" name="father_name" class="form-control" value="{{$child->father_name}}" readonly>
                                        @error('father_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Mother's Name</label>
                                        <input type="text" name="mother_name" class="form-control" value="{{$child->mother_name}}" readonly>
                                        @error('mother_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Guardian's Name</label>
                                        <input type="text" name="guardian_name" class="form-control" value="{{$child->guardian_name}}" readonly>
                                        @error('guardian_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <h3>Documents:</h3>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Case Study File</label>&emsp;
                                        <input type="checkbox" name="csf" class="form-check-input ml-2" value="1" {{($child->csf) ? 'checked' : ''}} disabled>
                                        @if($child->csf)<br><a href="{{ route('head.download.csf', $child->id) }}">Download Case Study File</a>@endif
                                        <br>
                                        <label>Proof of Efforts</label>&emsp;
                                        <input type="checkbox" name="poe" class="form-check-input ml-2" value="1" {{($child->poe) ? 'checked' : ''}} disabled>
                                        @if($child->poe)<br><a href="{{ route('head.download.poe', $child->id) }}">Download Proof of Efforts</a>@endif
                                        <br>
                                        <label>Certificate of Foundling</label>&emsp;
                                         <input type="checkbox" name="cof" class="form-check-input ml-2" value="1" {{($child->cof) ? 'checked' : ''}} disabled>
                                         @if($child->cof)<br><a href="{{ route('head.download.cof', $child->id) }}">Download Certificate of Foundling</a>@endif
                                         <br>
                                        <label>Certificate for Legal Adoption</label>&emsp;
                                        <input type="checkbox" name="cola" class="form-check-input ml-2" value="1" {{($child->cola) ? 'checked' : ''}} disabled>
                                        @if($child->cola)<br><a href="{{ route('head.download.cola', $child->id) }}">Download Certificate for Legal Adoption</a>@endif
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Certificate for Surrendered Child</label>&emsp;
                                        <input type="checkbox" name="cfsc" class="form-check-input ml-2" value="1" {{($child->cfsc) ? 'checked' : ''}} disabled>
                                        @if($child->cfsc)<br><a href="{{ route('head.download.cfsc', $child->id) }}">Download Certificate for Surrendered Child</a>@endif
                                        <br>
                                        <label>Birth Certificate</label>&emsp;
                                        <input type="checkbox" name="bc" class="form-check-input ml-2" value="1" {{($child->bc) ? 'checked' : ''}} disabled>
                                        @if($child->bc)<br><a href="{{ route('head.download.bc', $child->id) }}">Download Birth Certificate</a>@endif
                                        <br>
                                        <label>Admission Photo</label>&emsp;
                                        <input type="checkbox" name="admission_photo" class="form-check-input ml-2" value="1" {{($child->admission_photo) ? 'checked' : ''}} disabled>
                                        @if($child->admission_photo)<br><a href="{{ route('head.download.admission_photo', $child->id) }}">Download Admission Photo</a>@endif
                                        <br>
                                        <label>Latest Photo</label>&emsp;
                                        <input type="checkbox" name="latest_photo" class="form-check-input ml-2" value="1" {{($child->latest_photo) ? 'checked' : ''}} disabled>
                                        @if($child->latest_photo)<br><a href="{{ route('head.download.latest_photo', $child->id) }}">Download Latest Photo</a>@endif
                                    </div>
                                </div>
                             </div>
                             <div class="card-footer">
                                <div>
                                    <a role="button" class="btn btn-success" value="Edit" href="{{route('staff.children.edit', $child->id)}}">Edit</a>
                                    <a role="button" class="btn btn-info" value="Logs" href="{{route('staff.logs.index', $child->id)}}">Logs</a>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
