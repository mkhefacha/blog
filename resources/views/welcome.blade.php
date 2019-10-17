
    @extends('layouts.app')
    @section('content')

{!! Form::open(['url' => '/uplod','enctype'=>'multipart/form-data','method'=>'post']) !!}
{!! Form::token() !!}

{!! Form::label('upload file') !!} <br>
{!! Form::file('photo')!!}

{!! Form::submit('save',['class' => 'btn btn-primary'])!!}
{!! Form::close() !!}

@endsection