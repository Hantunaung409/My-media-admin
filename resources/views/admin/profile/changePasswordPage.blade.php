@extends('admin.layouts.app')
@section('content')
    <div class="col-10 offset-2 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">Change My Password</legend>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            {{-- alert  --}}
                            @if (Session::has('updateSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-check"></i> {{ Session::get('updateSuccess')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif

                            @if (Session::has('fail'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-check"></i> {{ Session::get('fail')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            {{-- end alert --}}
                            <form class="form-horizontal" action="{{ route('admin@changePassword') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="oldPassword" class="col-sm-4 col-form-label">Old Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="oldPassword" placeholder="Enter Old Password"
                                            value="{{ old('oldPassword', )  }}" name="oldPassword">
                                    </div>
                                    @error('oldPassword')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="newPassword" class="col-sm-4 col-form-label">New Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="newPassword" placeholder="Enter New Password"
                                            value="{{ old('newPassword', )  }}" name="newPassword">
                                    </div>
                                    @error('newPassword')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <label for="confirmPassword" class="col-sm-4 col-form-label">Comfirm Password</label>
                                    <div class="col-sm-8">
                                        <input type="password" class="form-control" id="oldPassword" placeholder="Enter Old Password"
                                            value="{{ old('confirmPassword', )  }}" name="confirmPassword">
                                    </div>
                                    @error('confirmPassword')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white float-right">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
