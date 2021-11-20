@extends('layout.template')

@section('content')
    <div class="content">
        <div class="row">
            @foreach ($Users as $user)
                <p><b>{{$user->lastName}}  {{$user->firstName}}  {{$user->middleName}}</b></p>
                <a href="{{route('DeleteGroupUsers', $user->id)}}">
                    <p>Delete</p>
                </a>
                </a>
            @endforeach
        </div>
    </div>
@endsection

