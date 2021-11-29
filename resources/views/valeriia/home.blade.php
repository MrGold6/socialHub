@extends('layout.template')

@section('content')


    @foreach ($Posts as $post)
        <div class="content">
            @include('nazariy.includes.post', ['post' => $post])
        </div>
    @endforeach

@endsection
