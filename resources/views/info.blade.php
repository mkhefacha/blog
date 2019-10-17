@extends('layouts.app')
@section('content')
    <div class="container">


         @foreach($file as $file)
            <div class="row">

                <img src="{{asset("storage/$file->photo")}}"  class="rounded float-left" width="50%" height="100%">

 @endforeach
    </div>


@endsection