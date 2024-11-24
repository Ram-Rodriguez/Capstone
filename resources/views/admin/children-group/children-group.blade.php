@extends('admin.layout')
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
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
          <li class="breadcrumb-item active">Children Group</li>
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
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

          <div class="card-header">
            <h3 class="card-title">Add Children Group</h3>
          </div>


          <form action="{{ route('children-group.store') }}" method="POST">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="children_group_name">Children Group</label>
                <input type="text" class="form-control" id="children_group_name" placeholder="Enter Children Group Name" name="children_group_name">
              </div>
              @error('children_group_name')
                <p class="text-danger">{{ $message }}</p>
              @enderror
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
@endsection