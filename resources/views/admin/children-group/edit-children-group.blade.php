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
            <h3 class="card-title">Update Children Group</h3>
          </div>


          <form action="{{ route('children-group.update', $children_group->id) }}" method="POST">
            @csrf
            {{ method_field('PUT') }}
            <input type="hidden" name="id" value="{{ $children_group->id }}"/>
            <div class="card-body">
              <div class="form-group">
                <label for="children_group_name">Children Group</label><label class="text-danger">*</label>
                <input type="text" class="form-control" id="children_group_name" value="{{ old('name', $children_group->name) }}" name="children_group_name">
              </div>
              @error('children_group_name')
                <p class="text-danger">{{ $message }}</p>
              @enderror
                <label>Employee in Charge (Optional)</label>
                <select name="employee_id" class="form-control">
                    <option value="" disabled>Select Employee</option>
                    @foreach ($employee as $item)
                    <option value="{{ $item->id }}" {{($item->id == $children_group->employee_id) ? 'selected' : ''}}>{{ $item->id }} - {{ $item->first_name }} {{ $item->last_name }}</option>
                    @endforeach
                </select>
                @error('employee_id')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
@endsection
