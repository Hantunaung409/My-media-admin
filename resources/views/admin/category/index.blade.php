@extends('admin.layouts.app')
@section('content')
<div class="col-4">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ route('category@create') }}">
            @csrf
            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" class="form-control @error('categoryName') is-invalid  @enderror" id="name" name="categoryName" placeholder="Enter Category Name" value="{{ old('categoryName') }}">
              @error("categoryName")
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea name="categoryDescription" id="description" cols="30" rows="5" placeholder="Enter Description..." class="form-control @error('categoryDescription') is-invalid  @enderror">{{ old('categoryDescription') }}</textarea>
              @error("categoryDescription")
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
      </div>
    </div>
</div>
<div class="col-7 offset-1">
        {{-- alert --}}

        @if (session('deleteSuccess'))
        <div class="col mt-1">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><i class="fa-solid fa-trash"></i>{{ session('deleteSuccess') }}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        </div>
       @endif

       {{-- end alert --}}
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Category List</h3>

        <div class="card-tools">
        {{-- Search --}}
            <form action="{{ route('admin@categoryPage') }}" method="get">
             @csrf
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="search" class="form-control float-right" placeholder="Search" value="{{ request('search') }}">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
            </form>
        {{-- End of Search --}}
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Category Name</th>
              <th>Description</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($categoryData as $data )
            <tr>
              <td>{{ $data->category_id }}</td>
              <input type="hidden" name="categoryId" class="categoryId" value="{{ $data->category_id }}">
              <td>{{ $data->title }}</td>
              <td>{{ $data->description }}</td>
              <td>
                <a href="{{ route('category@editPage',$data->category_id) }}">
                 <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                </a>
                 <button class="btn btn-sm bg-danger text-white deleteBtn" ><i class="fas fa-trash-alt"></i></button>
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
@section('scriptSource')
       <script>
        $(document).ready(function() {
            $('.deleteBtn').click(function() {
            $parentNode = $(this).parents("tr");
            $categoryId = $parentNode.find('.categoryId').val();
                $.ajax({
                    type: 'get',
                    url: '/admin/category/ajax/delete',
                    data: {
                      'id' : $categoryId
                    },
                    dataType: 'json',
                })
                window.location.href = "/admin/category";
            })
        })
    </script>
@endsection
