@extends('layouts.app')
@section('content')

    <div class="container">
        <h4>admin panel</h4>            
           <form method="post" action="/update" >
                 {!! Form::open(['url' => '/add']) !!}
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
                <input type="hidden" name="id_user[]" value="{{$user->id}}">
               {!! Form::hidden('id_user[]', $user->id !!}


                <tr>
                
                                     
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    
             <td> 
             <input type="checkbox"  name="roles_user[]" value="{{$roles->id}}" {{$user->hasRole('user') ? 'checked' : ' '}}> 
             {!! Form::checkbox('roles_user[]', $roles->id, true) !!};
 
             </td>
                    <td>
                <input type="checkbox" name="role_editor[]" value="{{$roles->id}}" {{$user->hasRole('editor') ? 'checked' : ' '}}>
                    </td>
                    <td>
                        <input type="checkbox" name="role_admin[]" value="{{$roles->id}}" {{$user->hasRole('admin') ? 'checked' : ' '}}>
                    </td>  
                </tr>
             
        @endforeach
          </tbody>
        </table>
              echo Form::submit('save');
                          <button type="submit" class="btn btn-primary">update</button>
            
                    </form> 
        

    </div>

@endsection

