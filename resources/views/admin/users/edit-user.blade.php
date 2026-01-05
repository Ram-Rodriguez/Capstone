@extends('admin.layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit User {{$user->id}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('users.read') }}">Users</a></li>
                        <li class="breadcrumb-item active">Edit User</li>
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
                            <h3 class="card-title">User Form</h3>
                        </div>

                        <form action="{{ route('users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id"value="{{ $user->id }}">
                             <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Select Role</label><label class="text-danger">*</label>
                                        <select name="role" class="form-control">
                                            <option value="staff" {{ ($user->role == "staff") ? 'selected' : '' }}>Staff</option>
                                            <option value="head" {{ ($user->role == "head") ? 'selected' : '' }}>Head</option>
                                            <option value="admin" {{ ($user->role == "admin") ? 'selected' : '' }}>Admin</option>
                                        </select>
                                        @error('role')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Employee Number</label><label class="text-danger">*</label>
                                        <input type="text" name="employee_number" class="form-control" value="{{ $user->employee_number }}">
                                        @error('employee_number')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>First Name</label><label class="text-danger">*</label>
                                        <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}">
                                        @error('first_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Middle Name (Optional)</label>
                                        <input type="text" name="middle_name" class="form-control" value="{{ $user->middle_name }}">
                                        @error('middle_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>Last Name</label><label class="text-danger">*</label>
                                        <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}">
                                        @error('last_name')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label>Email</label><label class="text-danger">*</label>
                                        <input type="email" name="email" class="form-control" value="{{ $user->email }}">
                                        @error('email')
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

                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Reset Password</h3>
                        </div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.reset-password', $user->id) }}" onsubmit="return confirm('Are you sure you want to reset the password for this user?')">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                   <div class="form-group col-md-4">
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                        <input class="form-control" type="password" name="password" required placeholder="Temporary Password">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <button class="btn btn-danger" type="submit">Force Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
