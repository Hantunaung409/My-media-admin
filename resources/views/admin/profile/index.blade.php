@extends('admin.layouts.app')
@section('content')
    <div class="col-8 offset-3 mt-5">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header p-2">
                    <legend class="text-center">User Profile</legend>
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
                            @if (Session::has('changePasswordSuccess'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong><i class="fa-solid fa-check"></i> {{ Session::get('changePasswordSuccess')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            @endif
                            {{-- end alert --}}
                            <form class="form-horizontal" action="{{ route('admin@profileEdit') }}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="inputName" class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="inputName" placeholder="Name"
                                            value="{{ old('adminName', $userData->name)  }}" name="adminName">
                                    </div>
                                    @error('adminName')
                                        <div class="text-danger">*{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email"
                                            value="{{ old('adminEmail',  $userData->email )}}" name="adminEmail">
                                    </div>
                                    @error('adminEmail')
                                    <div class="text-danger">*{{ $message }}</div>
                                @enderror
                                </div>
                                <div class="form-group row">
                                    <label for="inputtPhone" class="col-sm-3 col-form-label">Phone</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="inputPhone" placeholder="Phone"
                                            value="{{ old('adminPhone', $userData->phone)  }}" name="adminPhone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputAdress" class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea id="" cols="30" rows="5" placeholder="Enter your address"
                                            class="form-control" name="adminAddress">{{ old('adminAddress',$userData->address ) }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputGender" class="col-sm-3 col-form-label">Gender</label>
                                    <div class="col-sm-9">
                                        <select name="adminGender" id="inputGender" class="form-control">
                                            <option value="" @if ($userData->gender == null) selected @endif>Choose
                                                your gender</option>
                                            <option value="male" @if ($userData->gender == 'male') selected @endif>Male
                                            </option>
                                            <option value="female" @if ($userData->gender == 'female') selected @endif>
                                                Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn bg-dark text-white float-right">Update</button>
                                    </div>
                                </div>
                            </form>
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                    <a href="{{ route('admin@changePasswordPage') }}">Change Password</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
