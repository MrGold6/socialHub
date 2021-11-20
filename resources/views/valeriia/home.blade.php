@extends('layout.template')

@section('content')
    <div class="content">
        <div class="row">
            @foreach ($Posts as $post)
                @include('nazariy.includes.post', ['post' => $post])
            @endforeach
        </div>
    </div>
@endsection
