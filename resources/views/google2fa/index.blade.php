@extends('layouts.main')
@section('content')
    {{-- <p>{{$code}}</p> --}}
    {{-- <p>{{$qrcode}}</p> --}}
    <form class="form-horizontal " action="/google2fa/authenticate" method="POST">
        <input class="form-control" name="one_time_password" type="text">

        <button class="btn btn-primary" type="submit">Authenticate</button>
    </form>
    <img class="img-responsive" src="{!! $inlineUrl !!}"/>
    {{-- <img src="{{!! $inlineUrl !!}}"> --}}
@endsection
