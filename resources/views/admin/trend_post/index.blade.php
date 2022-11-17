@extends('admin.layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Post</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>Post ID</th>
              <th>Post Title</th>
              <th>Post Image</th>
              <th>View Count</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
             @foreach ($data as $d)
               <tr>
                <td>{{ $d->post_id }}</td>
                <td>{{ $d->title }}</td>
                <td>                       
                  @if ($d->image != null)
                      <img src="{{ asset('storage/postImage/' . $d->image) }}" alt=""
                          style="width: 100px" class=" rounded shadow-sm">
                  @else
                      <img src="{{ asset('defaultPostImage/defualtPostImage.png') }}" alt=""
                          style="width: 100px" class=" rounded shadow-sm">
                  @endif
                </td>
                <td><i class="fa-solid fa-eye me-1"></i>0</td>
                <td><a href="{{ route('admin@trendPostDetails',$d->post_id) }}"><i class="fa-solid fa-circle-info"></i></a></td>
               </tr>
             @endforeach
          </tbody>
        </table>
        
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    {{-- <div class=" float-right">{{ $data->links() }}</div> --}}
  </div>
@endsection
