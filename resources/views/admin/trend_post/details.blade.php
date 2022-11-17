@extends('admin.layouts.app')
@section('content')
 <div class="col-6 offset-3 mt-5">
    <i class="fa-solid fa-arrow-left" onclick="history.back()"></i>
    <div class="card-header">
        <div class="text-center">

            @if ( $data['image'] == null)
             <img class=" rounded shadow" width="400px"
             src="{{ asset('defaultPostImage/defualtPostImage.png') }}"
             >
             @else
             <img class=" rounded shadow" width="400px"
                 src=" {{ asset('/storage/postImage/'.$data['image']) }}"
             >
             @endif 
        </div>
    </div>
    <div class="card-body">
        <h3 class="text-center">
            {{ $data->title }}
        </h3>
        <p class="text-start">
            {{ $data->title }}
        </p>
    </div>
    </div>
 </div>
@endsection
