@extends('admin.layouts.app')
@section('content')
<div class="col-12">
    {{-- alert --}}
    <div class="col6">
        @if (Session::has('deleteSuccess'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fa-solid fa-check"></i> {{ Session::get('deleteSuccess')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert"
                aria-label="Close"></button>
        </div>
        @endif
    </div>
    {{-- end laert --}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Admin Lists</h3>

        <div class="card-tools">
          {{-- <form action="{{ route('admin@listSearch') }}" method="post">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="adminSearch" class="form-control float-right" placeholder="Search">

                <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                </button>
                </div>
            </div>
          </form> --}}

          <form action="{{ route('admin@listSearch') }}" method="get">
            @csrf
            <div class="input-group input-group-sm" style="width: 150px;">
                <input type="text" name="adminSearch" class="form-control float-right" placeholder="Search" value="{{ request('adminSearch') }}">

                <div class="input-group-append">
                <button type="submit" class="btn btn-default">
                    <i class="fas fa-search"></i>
                </button>
                </div>
            </div>
          </form>

        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Gender</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($userData as $u )
             <tr>
              <td>{{ $u->id }}</td>
              <td>{{ $u->name }}</td>
              <td>{{ $u->email }}</td>
              <td>{{ $u->phone }}</td>
              <td>{{ $u->address }}</td>
              <td>{{ $u->gender }}</td>
              <td>
                @if ($u->id != Auth::user()->id)
                <a href="{{ route('admin@listDelete',$u->id) }}">
                    <button class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></button>
                </a>
                @endif
              </td>
             </tr>
            @endforeach

          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
@endsection
