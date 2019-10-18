@extends('layouts.app')
@section('content')
    <div class="container">

         @if ($flash=session('message'))
             <div class="alert alert-success">
                 {{$flash}}
             </div>
              @endif
         @foreach($file as $file)


                <img src="{{asset("storage/$file->photo")}}"  class="rounded float-left" width="50%" height="100%">

</div>
@endforeach

@endsection