@extends('layouts.app')
@section('content')

    <div class="container">
        <h4>admin panel</h4>

        {!! Form::open(['url' => '/add'],['method'=>'post']) !!}
        {!! Form::token() !!}

        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">name</th>
                <th scope="col">email</th>
                <th scope="col">User</th>
                <th scope="col">Editor</th>
                <th scope="col">Admin</th>


            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)

                {!! Form::hidden('users_id[]', $user->id )!!}

                <tr>


                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>

                    <td>
                        {!! Form::checkbox('roles_user[]', $user->id , $user->hasRole('user') ? '1': '0') !!}

                    </td>
                    <td>

                        {!! Form::checkbox('roles_editor[]', $user->id, $user->hasRole('editor') ? '1': '0' ) !!}

                    </td>

                    <td>

                        {!! Form::checkbox('roles_admin[]', $user->id, $user->hasRole('admin') ? '1': '0' ) !!}
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>

        {!! Form::submit('save',['class' =>'btn btn-primary']) !!}

       {!! form::close()!!}


    </div>

@endsection

