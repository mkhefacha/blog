@extends('layouts.app')
@section('content')

    <div class="container">


        <form method="post" action="/register">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">name</label>
                <input type="text"  name="name" class="form-control"   placeholder="Enter name">
            </div>

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