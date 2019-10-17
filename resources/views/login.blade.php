@extends('layouts.app')
@section('content')

    <div class="container">
        @if(session()->get('danger'))
            <div class="alert alert-danger">
                {{ session()->get('danger') }}
            </div><br />
        @endif


        <h4>login page</h4>

        <form method="post" action="/login">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input  type="password" class="form-control"  name="password" placeholder="Password">
            </div>

            <button type="submit" class="btn btn-primary">save</button>
        </form>






    </div>

@endsection