@extends('layouts.app')

@section('content')





    <div class="container">
        <form action="/del" method="post">
            @csrf
            <table class="table table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th scope="col"><input type="checkbox" class="selectall"></th>

                    <th scope="col">name</a> </th>
                    <th scope="col">email</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td><input type="checkbox" name=" ids[]" class="selectbox" value="{{$user->id}}"></td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <button type="submit" class="btn btn-danger">delete all selected</button>
        </form>


        <div class="row align-items-center justify-content-center">
            {{ $users->links() }}
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.selectall').click(function () {
                {
                    $('.selectbox').prop('checked', true);
                }
            });


        });
    </script>

@endsection