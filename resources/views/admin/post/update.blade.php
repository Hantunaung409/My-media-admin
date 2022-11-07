@extends('admin.layouts.app')
@section('content')
<div class="col-4">
    <div class="card">
      <div class="card-body">
        <form method="POST" action="{{ route('post@edit') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control @error('posttitle') is-invalid  @enderror" id="title" name="postTitle" placeholder="Enter post Title" value="{{ old('posttitle',$targetPostData->title) }}">
              @error("posttitle")
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <input type="hidden" name="postId" value="{{ $targetPostData->post_id }}">
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea name="postDescription" id="description" cols="30" rows="5" placeholder="Enter Description..." class="form-control @error('postDescription') is-invalid  @enderror">{{ old('postDescription',$targetPostData->description) }}</textarea>
              @error("postDescription")
                  <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="mb-3">
                <label for="postImage" class="form-label">Image</label>
                <input type="file" class="form-control" id="postImage" name="postImage" placeholder="Choose a photo" >
                @if ($targetPostData->image != null)
                <img src="{{ asset('storage/postImage/'.$targetPostData->image) }}" alt="" style="width: 280px" class=" rounded shadow-sm">
              @else
              <img src="{{ asset('defaultPostImage/defualtPostImage.png') }}" alt="" style="width: 280px" class=" rounded shadow-sm">
              @endif
            </div>
            <div class="mb-3">
                <label for="category" class="form-label">Choose a Category</label>
                <select name="categoryId" id="category" class="form-control">
                 @foreach ($categoryData as $data)
                     <option value="{{  $data->category_id  }}" class="form-control"
                        @if($data->category_id == $targetPostData->category_id)
                         selected
                         @endif
                     >{{ $data->title }}</option>
                 @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
          </form>
      </div>
    </div>
</div>
<div class="col-7 offset-1">
        {{-- alert --}}

        @if (session('postDeleted'))
        <div class="col mt-1">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong><i class="fa-solid fa-trash"></i>{{ session('postDeleted') }}</strong>
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
              <th>Post Title</th>
              <th>Description</th>
              <th>Image</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($postData as $pdata )
            <tr>
              <td>{{ $pdata->post_id }}</td>
              <input type="hidden" class=" postId" value="{{ $pdata->post_id }}">
              <td>{{ $pdata->title }}</td>
              <td>{{ $pdata->description }}</td>
              <td >
                @if ($pdata->image != null)
                  <img src="{{ asset('storage/postImage/'.$pdata->image) }}" alt="" style="width: 100px" class=" rounded shadow-sm">
                @else
                <img src="{{ asset('defaultPostImage/defualtPostImage.png') }}" alt="" style="width: 100px" class=" rounded shadow-sm">
                @endif

               </td>
              <td>
                <a href="{{ route('post@editPage',$pdata->post_id) }}">
                 <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                </a>
                <a href="{{ route('post@delete',$pdata->post_id) }}">
                 <button class="btn btn-sm bg-danger text-white deleteBtn"><i class="fas fa-trash-alt"></i></button>
                </a>
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



