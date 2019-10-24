
@extends('layouts.app')
@section('content')

{!!Form::open(['url' => '/uplod', 'method' => 'post','enctype'=>'multipart/form-data'])!!}
{!! Form::token() !!}
{{Form::file("photo",
             [
                "class" => "form-group",])
}}

{!! Form::submit('save',['class' =>'btn btn-primary']) !!}
{!! Form::close() !!}
@endsection
