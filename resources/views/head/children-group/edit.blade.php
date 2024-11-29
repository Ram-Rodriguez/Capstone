@extends('head.layout')
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
          <li class="breadcrumb-item"><a href="{{ route('head.children-group.read') }}">Back</a></li>
          <li class="breadcrumb-item active">{{$children_group->name}}</li>
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
            <h3 class="card-title">Edit Children Group</h3>
          </div>


          <form action="{{ route('head.children-group.update', $children_group->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="form-group col">
                <label for="children_group_name">Children Group</label>
                <input type="text" class="form-control" id="children_group_name" name="children_group_name" value="{{$children_group->name}}">
              </div>
              @error('children_group_name')
                <p class="text-danger">{{ $message }}</p>
              @enderror
              <div class="form-group col">
                <label>Employee in Charge</label>
                <select name="employee_id" class="form-control">
                    <option value="">Select Employee</option>
                    @foreach ($employee as $item)
                    <option value="{{ $item->id }}" {{($item->id == $children_group->employee_id) ? 'selected' : ''}}>{{ $item->id }} - {{ $item->first_name }} {{ $item->last_name }}</option>
                    @endforeach
                </select>
                @error('employee_id')
                <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            </div>


            <div class="card-footer">
              <button type="submit" class="btn btn-success">Save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
@endsection
