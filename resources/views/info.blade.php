@extends('layouts.app')
@section('content')
    <div class="container">

        @if ($flash=session('message'))
            <div class="alert alert-success">
                {{$flash}}
            </div>
        @endif
        <div class="row">
            @foreach($file as $file)
                <div class="clo-md-4">
                    <div class="card" style="width: 20rem;">
                        <img src="{{asset("storage/$file->photo")}}" class="card-img-top">

                        <div class="card-body">
                            <a href={{route("downlodfile" , $file->id)}}><i class="fas fa-cloud-download-alt"></i></a>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </div>


@endsection
