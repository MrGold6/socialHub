@extends('layout.template')

@section('content')
    <div class="content">
        <div class="row">
            <img src="{{ asset('ImageGroup/'.$Group->image) }}" class="card-img rounded" alt="...">

            <p>{{$Group->title}}</p>
            <p>{{$Group->description}}</p>

            <a href="{{route('GroupUsers', $Group->id)}}">
                <p>Count -{{$UsersCount}}</p>
            </a>
            @if(Auth::user()->id==$Group->idUserOwner)
            <a href="{{route('UpdateGroupView', $Group->id)}}">
                <p>Update</p>
            </a>

            <a href="{{route('DeleteGroup', $Group->id)}}">
                <p>Delete</p>
            </a>
            @endif

            @if(Auth::user()->id==$Group->idUserOwner)<a href="{{ route('CreatePostView', $Group->id)}}">create</a>@endif

            @foreach ($Posts as $post)
                @include('nazariy.includes.post', ['post' => $post])
            @endforeach

        </div>
    </div>
@endsection
