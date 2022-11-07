@extends('admin.layouts.app')
@section('content')
<div class="col-4">
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
        <h3 class="card-title">Category Edit Page</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
          <form action="{{ route('category@update') }}" class="m-1" method="POST">
            @csrf
            <label for="categoryName" class="form-label">Category Name</label>
            <input type="text" id="categoryName" name="categoryName"  value="{{ old('categoryName',$toUpdateData->title) }}" class="form-control @error('categoryName')
                is-invalid
            @enderror">
            @error('categoryName')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <label for="categoryDescription" class="form-label">Category Description</label>
            <textarea name="categoryDescription"  id="categoryDescription" cols="30" rows="5" class="form-control @error('categoryDescription')
                is-invalid
            @enderror">{{ old('categoryDescription',$toUpdateData->description) }}</textarea>
            @error('categoryDescription')
             <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <input type="hidden" name="categoryId" value="{{ $toUpdateData->category_id }}">
            <button type="submit" class="btn btn-sm btn-dark text-white mt-2 float-end mb-2">Update</button>
          </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    <div class="col-8 offset-2 mt-5">
        <a href="{{ route('admin@categoryPage') }}">
            <button class="btn btn-primary" type="button">Go To Create Page</button>
        </a>

    </div>
  </div>
  {{-- end of update form --}}


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
             <button class="btn btn-sm bg-danger text-white deleteBtn"><i class="fas fa-trash-alt"></i></button>
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

