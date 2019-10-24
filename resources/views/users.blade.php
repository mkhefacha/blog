@extends('layouts.app')

@section('content')
    <h1>Users Graphs</h1>
  <h4>{{ $precent}}%</h4>
    <div style="width:20%">
        {!! $usersChart->container() !!}
    </div>

    {!! $usersChart->script() !!}

@endsection



