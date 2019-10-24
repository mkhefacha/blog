@extends('layouts.app')

@section('content')


    <div class="container">

        @if($flash=session('message'))
            <div class="alert alert-success">
                {{ $flash }}
            </div><br />
        @endif
        <h5 >contacter-nous</h5>

        <form  action="{{route('contact')}}"  method="post">
            {{ csrf_field() }}


            <div class="form-group">
                <label for="exampleFormControlInput1">Email address</label>
                <input type="email" class="form-control" name="email">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput1">subject</label>
                <input type="text" class="form-control" name="subject">
            </div>


            <div class="form-group">
                <label for="exampleFormControlTextarea1">message</label>
                <textarea class="form-control"  name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-hide-validate">envoyer</button>
        </form>
    </div>


@endsection
