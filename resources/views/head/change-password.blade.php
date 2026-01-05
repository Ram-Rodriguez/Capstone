@extends('head.layout')
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Account Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('head.dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Account Setting</li>
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
                        @if(Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>

                        <form action="{{ route('head.update-password') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                             <div class="card-body">
                                <div class="row">
                                    <div class="form-group col">
                                        <label>Old Password</label><label class="text-danger">*</label>
                                        <input type="password" name="old_password" class="form-control" placeholder="Enter old password">
                                        @error('old_password')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label>New Password</label><label class="text-danger">*</label>
                                        <input type="password" name="new_password" class="form-control" placeholder="Enter old password">
                                        @error('new_password')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                    <div class="form-group col">
                                        <label>Confirm New Password</label><label class="text-danger">*</label>
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="Enter old password">
                                        @error('password_confirmation')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="form-group col">
                                        <label>Title</label>
                                        <input type="text" name="title" class="form-control">
                                        @error('title')
                                        <p class="text-danger">{{$message}}</p>
                                        @enderror
                                    </div>
                                </div> --}}
                             </div>
                             <div class="card-footer">
                                <div>
                                    <button type="submit" class="btn btn-success" value="Add">Save</button>
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
