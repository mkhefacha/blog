@extends('layouts.app')

@section('content')


    <div class="container">

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br/>
        @endif

        @if($flash=session('message'))
            <div class="alert alert-success">
                {{ $flash }}
            </div><br/>
        @endif
        <h5>contacter-nous</h5>

        <form action="{{route('contact')}}" method="post">
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
                <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="3"></textarea>
            </div>


            <div class="form-group">
                <label for="captcha"></label>
                <div class="col-md-6">
                    <div class="captcha">
                        <span>{!! captcha_img('math') !!}</span>
                        <button class="btn btn-success  btn-refresh">Rrefresh</button>
                    </div>


                    <input id="captcha" type="text" class="form-control mt-2 @error('captcha') is-invalid @enderror"
                           name="captcha"
                           value="{{ old('captcha') }}" placeholder="">

                    @error('captcha')
                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>


            <button type="submit" class="btn btn-hide-validate">envoyer</button>
        </form>
    </div>


@endsection
