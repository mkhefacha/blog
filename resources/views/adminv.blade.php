@extends('layouts.app')
@section('content')


    @if($flash = session('notfound'))
        <div class="alert alert-danger" role="alert">
            {{$flash}}
        </div>
    @endif



    @if($flash = session('message'))
        <div class="alert alert-success" role="alert">
            {{$flash}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6">
            <h4><a href="{{'/admin'}}"> admin panel</a></h4>
        </div>


        <div class="col-md-4">
            <form action="/search" method="get">
                @csrf
                <div class="input-group">
                    <input type="search" name="search" placeholder="search" class="form-control">
                    <span class="input-group-prepend">
                       <button type="submit" class="btn btn-primary">
                           search
                       </button>
                   </span>
                </div>
            </form>
        </div>
    </div> <br>
    {!!Form::open(['url' => '/add', 'method' => 'post'])!!}
    {!! Form::token() !!}

    <table class="table table-bordered">

        <tr>
            <th scope="col">#</th>
            <th scope="col">name<a href="?sort=asc"> <i class="fas fa-sort-amount-up"></i></a>
                <a href="?sort=desc"> <i class="fas fa-sort-amount-down"></i></a>
            </th>
            <th scope="col">email</th>
            <th scope="col">User</th>
            <th scope="col">Editor</th>
            <th scope="col">Admin</th>
            <th scope="col">delete</th>
            <th scope="col">update</th>


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
                    {!! Form::checkbox('roles_admin[]', $user->id , $user->hasRole('admin') ? '1': '0' ) !!}

                </td>
                <td><a href="{{route('user.delete', $user->id )}}"> <i class="far fa-trash-alt"></i>
                    </a></td>

                <td><a href="{{route('user.edite', $user->id )}}"><i class="fas fa-eye"></i></a></td>

            </tr>

        @endforeach
        </tbody>
    </table>
    {!! Form::submit('save',['class' =>'btn btn-primary']) !!}



    <div class="row align-items-center justify-content-center">
        {{ $users->links() }}
    </div>
  <div>
      <h1><a href="{{'/users'}}">Users Graphs</a></h1>

        <div class="row">
            <div class="col-md-6">

    <div style="width: 50%">
        {!! $usersChart->container() !!}
    </div>

    {!! $usersChart->script() !!}
    </div>
            <div class="col-md-6">
            <div style="width:20%">
                {!! $userChart->container() !!}
            </div>

            {!! $userChart->script() !!}


</div>
        </div>



@endsection










