@extends('layout.template')

@section('content')
    <div class="content">
        <div class="row">
            @foreach ($Groups as $group)
                <a href="{{route('Group', $group->id)}}">{{$group->title}}</a>
                <br>
            @endforeach

            <a href="{{route('myGroups')}}">Мої групи</a>
        </div>
    </div>
@endsection
